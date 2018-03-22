<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 06.03.2018
 * Time: 21:13
 */

namespace services;

use services\Product;

/***
 * Class RealProduct - класс реального продукта
 * @package services
 */
class RealProduct
{

    private $filename;                        //имя файла для обработки

    private $parent_product;                  //родительский товар

    public $child_products = array();         //вариативные(дочерние) товары - если нет - null

    private $arr_headers_woocommerce = ["Title","SKU","Permalink","Price","Attribute Name","Attribute Value","Image URL","Product Categories","_ean","Weight","Length","Width","Height","_yoast_wpseo_metadesc","_parentSKU","device_name","release_year"];

    /*Геттеры - сеттеры*/
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

    /**
     * @return mixed
     */
    public function getParentProduct()
    {
        return $this->parent_product;
    }

    /**
     * @param mixed $parent_product
     */
    public function setParentProduct($parent_product)
    {
        $this->parent_product = $parent_product;
    }

    /**
     * @return null
     */
    public function getChildProducts()
    {
        return $this->child_products;
    }

    /**
     * @param null $child_products
     */
    public function setChildProducts($child_products)
    {
        $this->child_products = $child_products;
    }

    /*Переопределенные методы*/
    public function __toString()
    {
        return $this->parent_product->getTitle()."";
    }

    /****************************************************************************************************************/
    /**
     * чтение данных из файла экспорта woocommerce
     * @return array - результирующий массив
     */
    private function getDataFromFileMAWoocommerce(){

        //добавить $this->>arr_headers = ["Title","SKU"];

        $row = 0;
        $arr = array();
        //массив нужных индексов
        $head_row = array();
        $result_array = array();

        $handle = fopen($this->filename, "r");
        while (($data = fgetcsv($handle)) !== FALSE) {


            //парсим шапку
            if($row==0){
                foreach ($this->arr_headers_woocommerce as $item){
                    $head_row[$item] = self::array_search_custom($item,$data);
                }
            }else{

                $temp = array();
                foreach ($this->arr_headers_woocommerce as $col){

                    $temp[$col] = $data[$head_row[$col]];

                }//foreach

                $result_array[]=$temp;

            }

            $row++;

        }//while
        fclose($handle);

        return $result_array;

    }//getDataFromFileMAWoocommerce

    /***
     * преобразуем прочитанные данные в массив товаров
     * @return array - массив товаров
     */
    public function getArrayRealProductsMAWoocommerce(){

        //получаем массив данных из файла
        $array_from_file = self::getDataFromFileMAWoocommerce();

        $arr_real_products = array();

        //получаем родительские товары
        foreach ($array_from_file as $item){

            if(empty($item["_parentSKU"])){

//["Title","SKU","Price","Attribute Name","Attribute Value","Image URL","Product Categories","_ean","Weight","Length","Width","Height","_yoast_wpseo_metadesc","_parentSKU","device_name","release_year"];
//$title, $SKU, $price, $attribute_name, $attribute_value, $image_url, $parent_SKU, $category, $EAN, $seo, $device_name, $release_year, $weight, $length, $width, $height
                $temp_product = new Product($item["Title"],
                                            $item["SKU"],
                                            $item["Permalink"],
                                            $item["Price"],
                                            $item["Attribute Name"],
                                            $item["Attribute Value"],
                                            explode("|",$item["Image URL"])[0],
                                            $item["_parentSKU"],
                                            $item["Product Categories"],
                                            $item["_ean"],
                                            $item["_yoast_wpseo_metadesc"],
                                            $item["device_name"],
                                            $item["release_year"],
                                            $item["Weight"],
                                            $item["Length"],
                                            $item["Width"],
                                            $item["Height"]

                     );

                $real_product = new RealProduct();
                $real_product->setParentProduct($temp_product);
                $arr_real_products[] = $real_product;

                unset($item);

            }//if

        }//foreach

        //добавляем вариации
        //получаем родительские товары
        foreach ($array_from_file as $item) {

            if (!empty($item["_parentSKU"])) {

                $variation_product = new Product($item["Title"],
                    $item["SKU"],
                    $item["Permalink"],
                    $item["Price"],
                    $item["Attribute Name"],
                    $item["Attribute Value"],
                    explode("|",$item["Image URL"])[0],
                    $item["_parentSKU"],
                    $item["Product Categories"],
                    $item["_ean"],
                    $item["_yoast_wpseo_metadesc"],
                    $item["device_name"],
                    $item["release_year"],
                    $item["Weight"],
                    $item["Length"],
                    $item["Width"],
                    $item["Height"]

                );

                foreach ($arr_real_products as $product){
                    if($product->getParentProduct()->getSKU() == $item["_parentSKU"]){
                        $product->child_products[]=$variation_product;
                    }

                    //unset($item);
                }

            }//if

        }//foreach


        return $arr_real_products;

    }//getArrayRealProducts

    //пользовательский поиск индекса
    private function array_search_custom($item,$data){

        $ind = 0;

        for ($i =0 ; $i<count($data); $i++){
            if(mb_stripos($data[$i], $item)!==false){

                $ind = $i;
                break;
            } //if
        }//for

        return $ind ;
    }//array_search_custom

}//class