<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 15.03.2018
 * Time: 15:24
 */

namespace services;


use Log;
use Mockery\Exception;
use PHPExcel;
use PHPExcel_Exception;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Exception;
use PHPExcel_Writer_Excel2007;
use services\GoogleTranslate;

class YandexProduct
{

    private $filename;

    private $yandex_market_data;

    private $excelCells = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ","CA","CB","CC","CD","CE","CF","CG","CH","CI","CJ","CK","CL","CM","CN","CO","CP","CQ","CR","CS","CT","CU","CV","CW","CX","CY","CZ","DA","DB","DC","DD","DE","DF","DG","DH","DI","DJ","DK","DL","DM","DN","DO","DP","DQ","DR","DS","DT","DU","DV","DW","DX","DY","DZ","EA","EB","EC","ED","EE","EF","EG","EH","EI","EJ","EK","EL","EM","EN","EO","EP","EQ","ER","ES","ET","EU","EV","EW","EX","EY","EZ"];

    private $direct_type_campaign_name = "E7";
    private $direct_number_order = "E8";
    private $direct_negative_words_campaign = "E9";
    private $direct_currency = "H8";
    private $direct_text_headers = ["additional_item","type_item","mobile_item", "group_id","group_name","number_group","lot_impressions","phase_id","phrase","product", "item_id","header_1","header_2","text","length_header_1","length_header_2","length_text","link","domain","region","bid","bid_in_social","contacts","item_status", "headers","description_quick_link","adress_quick_link","param_1","param_2","label" ,"image"];

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

    private $yandex_market_headers = ["id","available","delivery","pickup","store","url","vendor","name","category","price","oldprice","currencyId","picture","description","param","sales_notes","manufacturer_warranty","country_of_origin","barcode","cpa","bid","cbid"];

    public function createYandexMarketData($result_ads, $parameters){

        $result[] = $this->yandex_market_headers;

        $this->yandex_market_data = $result_ads;

        try{

            foreach ($result_ads as $product){

                $result = array_merge($result, self::createYandexMarketProduct($product, $parameters) );

            }//foreach

            return $result;

        }catch (Exception $e){
            Log::error("Ошибка создания файла Yandex Market: {$e->getMessage()} // {$e->getTraceAsString()}");
            return array();
        }

    }//createYandexMarketData($result_ads, $_GET)

    private function createYandexMarketProduct($product, $parameters){

        $result = array();

        //если у товара нет вариаций
        if(count($product->getChildProducts())==0){

            $row = $row = self::createRowYandexMarket($product->getParentProduct(), $parameters);

            $result[] = $row;
            unset($row);
        }else {

            //записываем вариации
            foreach ($product->getChildProducts() as $child) {

                $row = self::createRowYandexMarket($child, $parameters);

                $result[] = $row;
                unset($row);

            }//foreach

        }

        return $result;

    }//createYandexMarketData($product, $parameters)

    private function createRowYandexMarket($child, $parameters){

        $row = array_flip($this->yandex_market_headers);

       // ["id","available","delivery","pickup","store","url","vendor","name","category","price","oldprice","currencyId","picture","description","param","sales_notes","manufacturer_warranty","country_of_origin","barcode","cpa","bid","cbid","fee"];

        /*перевод полей*/
        $desc = self:: getParentSeo($child->getParentSKU());
        $temp["description"] = isset($desc)? $desc : "" ;
        $temp["atr_name"] = $child->getAttributeName();
        $temp["atr_value"] = $child->getAttributeValue();

        $translate = $temp;

        if($parameters["fromLang"]!=$parameters["toLang"]) {
            $res = GoogleTranslate::translate(json_encode($temp), $parameters["fromLang"], $parameters["toLang"]);
           // echo $res;
            //$translate = json_decode($res);
            $desc = self:: getParentSeo($child->getParentSKU());
            $translate["description"] = isset($desc)? GoogleTranslate::translate($desc, $parameters["fromLang"], $parameters["toLang"]) : "";
            $translate["atr_name"] =  GoogleTranslate::translate($child->getAttributeName(), $parameters["fromLang"], $parameters["toLang"]) ;
            $translate["atr_value"] = GoogleTranslate::translate($child->getAttributeValue(), $parameters["fromLang"], $parameters["toLang"]);

        }

     //   var_dump($translate);

        $row["id"] = $child->getSKU();
        $row["available"] = $parameters["available"];
        $row["delivery"] = $parameters["delivery"];
        $row["pickup"] = $parameters["pickup"];
        $row["store"] = $parameters["store"];
        $row["url"] = $child->getPermalink();
        $row["vendor"] = isset($parameters["vendor"])?$parameters["vendor"]:"reboon|MGBH";
        $row["name"] = $child->getTitle();
        $row["category"] = $parameters["category"];
        $row["price"] = $child->getPrice();
        $row["oldprice"] = "";
        $row["currencyId"] = "RUR";
        $row["picture"] = $child->getImageUrl();

        $row["description"] = isset($translate["description"] )? $translate["description"]:"Описание";
            $row["param"] =  isset($translate["atr_name"])?$translate["atr_name"]:""."|".isset($translate["atr_value"])?$translate["atr_value"]:"";
        $row["sales_notes"] = $parameters["sales_notes"];
        $row["manufacturer_warranty"] = $parameters["manufacturer_warranty"];
        $row["country_of_origin"] = $parameters["country_of_origin"];
        $row["barcode"] = $child->getEAN();
        $row["cpa"] = $parameters["cpa"];
        $row["bid"] = $parameters["bid"];
        $row["cbid"] = $parameters["cbid"];

        unset($translate);
        //"barcode","cpa","bid","cbid","fee"

        return $row;


    }//createRowYandexMarket($child, $parameters)

    private function getParentSeo($sku){

        foreach ($this->yandex_market_data as $item){
            if($item->getParentProduct()->getSKU()==$sku){
                return $item->getParentProduct()->getSeo();
            }

        }//foreach
        return "";
    }

    public function writeDataToFile($data_for_write){

        try {
        $cells = array_slice($this->excelCells,0, count($data_for_write[0]));

        $excel = new PHPExcel();


        $excel->setActiveSheetIndex(0);


        $worksheet = $excel->getActiveSheet();

        $ind = 1;
        //внесение днных в книгу
        foreach ($data_for_write as $row){

            $i = 0;
            foreach ($row as $col){
                $worksheet->setCellValue($cells[$i].$ind, $col);
                $i++;
            }
            $ind++;
        }

        //сохранение документа
        /*1*/
//            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
//            $objWriter->save($newfile);
        /*2*/
        $objWriter = new PHPExcel_Writer_Excel2007($excel);
        $objWriter->save($this->filename);

    }

    catch (PHPExcel_Reader_Exception $e) {
     Log::error("Ошибка чтения xlsx файла {$e->getMessage()} // {$e->getTraceAsString()}");
    } catch (PHPExcel_Exception $e) {
    Log::error("Ошибка записи xlsx файла  {$e->getMessage()} // {$e->getTraceAsString()}");
    }


    }//writeDataToFile($data_for_write)

    public function createYandexDirectData($result_ads, $custom_data){

          $result = array();

          foreach ($result_ads as $product){

              $result = array_merge($result, self::getDirectProductData($product, $custom_data));

          }

          return $result;
    }//createYandexDirectData($result_ads, $_GET)

    private function getDirectProductData($product, $custom_data){

        $result = array();

        if(count($product->getChildProducts())==0){
            $result[]=self::getChildRow($product->getParentProduct(),$custom_data);
        }else {

            foreach ($product->getChildProducts() as $child) {
                $result[] = self::getChildRow($child, $custom_data);
            }
        }

        return $result;

    }

    private function getChildRow($child,$custom_data){

        $row = array_flip($this->direct_text_headers);
//["additional_item","type_item","mobile_item", "group_id","group_name","number_group","lot_impressions","phase_id","phrase","product", "item_id","header_1","header_2","text","length_header_1","length_header_2","length_text","link","domain","region","bid","bid_in_social","contacts","item_status", "headers","description_quick_link","adress_quick_link","param_1","param_2","label" ,"image"];

        $row["additional_item"] = "-";
        $row["type_item"] = $custom_data["item_type"];
        $row["mobile_item"] = "-";

        //получаем случайное имя файла
        //смена числа генератора
        srand(self::make_seed());
        $row["group_id"] = rand();
        $row["group_name"] = "Группа ".$child->getTitle();
        $row["number_group"] = rand();
        $row["lot_impressions"] = "-";
        $row["phase_id"] = rand();
        $row["phrase"] = "'---autotargeting";
        $row["product"] = "";
        $row["item_id"] = rand();
        $row["header_1"] = str_replace("[*]", $child->getTitle(), $custom_data["header_1"]);
        $row["header_2"] = str_replace("[*]", $child->getTitle(), $custom_data["header_2"]);
        $row["text"] = str_replace("[*]", $child->getTitle(), $custom_data["description"]);
        $row["length_header_1"] = strlen($row["header_1"]);
        $row["length_header_2"] = strlen($row["header_2"]);
        $row["length_text"] = strlen($row["text"]);
        $row["link"] = $child->getPermalink();
        $row["domain"] = parse_url($row["link"])["host"];
        $row["region"] = implode(',',$custom_data["region"]);
        $row["bid"] = 0.1;
        $row["bid_in_social"] = "";
        $row["contacts"] = "-";
        $row["item_status"] = "Активная";
        $row["headers"] = "";
        $row["description_quick_link"] = "";
        $row["adress_quick_link"] = "";
        $row["param_1"] = $child->getAttributeName().":".$child->getAttributeValue();
        $row["param_2"] = "";
        $row["label"] = date('Y-m-d');
        $row["image"] = $child->getImageUrl();

        return $row;

    }//getChildRow($child,$custom_data)

    public function writeDirectDataToFile($data_for_write, $custom_data){

        $cells = array_slice($this->excelCells,0, count($this->direct_text_headers));

        try {
            $excel = PHPExcel_IOFactory::load("uploads/yandex/direct_example.xlsx");
            $excel->setActiveSheetIndexByName("Тексты");
            $worksheet = $excel->getActiveSheet();

            //получаем случайное имя файла
            //смена числа генератора
            srand(self::make_seed());
            $worksheet->setCellValue($this->direct_type_campaign_name, $custom_data["campaign_type"]);
            $worksheet->setCellValue($this->direct_number_order, rand());
            $worksheet->setCellValue($this->direct_negative_words_campaign, implode(" -", explode("\n", $custom_data["negative_words"])));
            $worksheet->setCellValue($this->direct_currency, $custom_data["currency"]);

            $ind = 12;
            //внесение днных в книгу
            foreach ($data_for_write as $row){

                $i = 0;
                foreach ($row as $col){
                    $worksheet->setCellValue($cells[$i].$ind, $col);
                    $i++;
                }
                $ind++;
            }

            //сохранение документа
            /*1*/
//            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
//            $objWriter->save($newfile);
            /*2*/
            $objWriter = new PHPExcel_Writer_Excel2007($excel);
            $objWriter->save($this->filename);

        } catch (PHPExcel_Reader_Exception $e) {
            Log::error("Ошибка чтения xlsx файла {$e->getMessage()} // {$e->getTraceAsString()}");
        } catch (PHPExcel_Exception $e) {
            Log::error("Ошибка записи xlsx файла  {$e->getMessage()} // {$e->getTraceAsString()}");
        }

    }//writeDirectDataToFile($data_for_write)

    // рандомизировать микросекундами
    private function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }//make_seed()


}//class