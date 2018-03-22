<?php
/**
 * Created by PhpStorm.
 * User: Коваленко Николай
 * Date: 14.03.2018
 * Time: 13:26
 * Создание рекламы для товаров в Google
 */

namespace services;


use Log;
use Mockery\Exception;

class GoogleProduct
{

    private $filename = "";

    private $google_merchant_headers = ["id","title","description","link","image_link","availability","price","google_product_category","brand","gtin","condition","is_bundle","color","material","age_group","custom_label_0"];

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /***
     * @param $result_ads - массив товаров из файла
     * @param $parameters - параметры пользователя
     * @return array - массив с рекламой
     */
    public function createGoogleMerchantData($result_ads, $parameters){

       // if(empty($this->filename)) throw new Exception();

        $result[] = $this->google_merchant_headers;

        try{

              foreach ($result_ads as $product){

                  $result = array_merge($result, self::createGoogleMerchanCenter($product, $parameters) );

              }//foreach

            return $result;

        }catch (Exception $e){
            Log::error("Ошибка создания файла Google Merchant : {$e->getMessage()} // {$e->getTraceAsString()}");
            return array();
        }

    }//createGoogleMerchantData($result_ads, $parameters)

    public function writeDataToCsvFile($data){

        if(empty($this->filename)) throw new Exception();
        //открываем файл на дописывание
        $fp = fopen($this->filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

//    fclose($fp);

        foreach ($data as $row) {
            //записываем строку
            fputcsv($fp, $row, "\t");
        }

        //закрываем файл
        fclose($fp);

    }//writeDataToCsvFile()

    /***
     * создание массива записей для товара
     * @param $product - объект класса RealProduct
     * @param $parameters - параметры пользователя
     * @return array
     */
    private function createGoogleMerchanCenter($product, $parameters){

        $result = array();

        //если у товара нет вариаций
        if(count($product->getChildProducts())==0){

            $row = $row = self::createRowGoogleMerchanCenter($product->getParentProduct(), $parameters);

            $result[] = $row;
            unset($row);
        }else {

            //записываем вариации
            foreach ($product->getChildProducts() as $child) {

                $row = self::createRowGoogleMerchanCenter($child, $parameters);

                $result[] = $row;
                unset($row);

            }//foreach

        }

        return $result;

    }//createGoogleMerchanCenter($product, $parameters)


    /***
     * создание строки рекламы google merchant center
     * @param $child - текущий товар
     * @param $parameters - параметры пользователя
     * @return array|null
     */
    private function createRowGoogleMerchanCenter($child, $parameters){

        $row = array_flip($this->google_merchant_headers);

        //["id","title","description","link","image_link","availability","price","google_product_category","brand","gtin","condition","is_bundle","color","material","custom_label_0"];

        $row["id"] = $child->getSKU();
        $row["title"] = $child->getTitle();
        $row["description"] = str_replace("[*]", $child->getDeviceName(), $parameters["description"]);
        $row["link"] = $child->getPermalink();
        $row["image_link"] = $child->getImageUrl();
        $row["availability"] = $parameters["availability"];
        $row["price"] = $child->getPrice();
        $row["google_product_category"] = $parameters["product_category"];
        $row["brand"] = $parameters["brand"];
        $row["gtin"] = $child->getEAN();
        $row["condition"] = $parameters["condition"];
        $row["is_bundle"] = $parameters["is_bundle"];
        $row["color"] = $child->getAttributeValue();
        $row["material"] = $parameters["material"];
        $row["age_group"] = $parameters["age_group"];
        $row["custom_label_0"] = date("Y-m-d");

        return $row;

    }//createRowGoogleMerchanCenter($product, $parameters)

}//class