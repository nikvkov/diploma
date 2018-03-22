<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 07.03.2018
 * Time: 13:17
 */

namespace services;


use Log;
use PHPExcel_Writer_Excel2007;
use services\Product;
use Mockery\Exception;
use PHPExcel;
use PHPExcel_Exception;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Exception;

class AmazonProduct
{

    private $filename;

    private $row_header = [
        "external_product_id_type",
        "parent_child",
        "variation_theme",
        "update_delete",
        "color_map",
        "size_map",
        "item_display_length_unit_of_measure",
        "item_dimensions_unit_of_measure",
        "item_weight_unit_of_measure",
        "website_shipping_weight_unit_of_measure",
        "package_dimensions_unit_of_measure",
        "package_weight_unit_of_measure",
        "country_of_origin",
        "battery_cell_composition",
        "battery_type",
        "eu_toys_safety_directive_age_warning",
        "eu_toys_safety_directive_warning",
        "eu_toys_safety_directive_language",
        "battery_type",
        "currency",
        "condition_type",
        "product_tax_code",
        "weee_tax_value_unit_of_measure",

    ];

    private $excelCells = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ","CA","CB","CC","CD","CE","CF","CG","CH","CI","CJ","CK","CL","CM","CN","CO","CP","CQ","CR","CS","CT","CU","CV","CW","CX","CY","CZ","DA","DB","DC","DD","DE","DF","DG","DH","DI","DJ","DK","DL","DM","DN","DO","DP","DQ","DR","DS","DT","DU","DV","DW","DX","DY","DZ","EA","EB","EC","ED","EE","EF","EG","EH","EI","EJ","EK","EL","EM","EN","EO","EP","EQ","ER","ES","ET","EU","EV","EW","EX","EY","EZ"];

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
    }      //имя файла

    /***
     * распарсивание данных из файла
     * @return array - массив прочитанных данных
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function parseDataFromFile(){

        try {
            $excel = PHPExcel_IOFactory::load($this->filename);

            $excel->setActiveSheetIndexByName("Valid Values");

            $worksheet = $excel->getActiveSheet();

            $temp = $worksheet->toArray();

            for ($i = 0; $i < count($temp); $i++) {
                if (empty($temp[$i])) unset($temp[$i]);
            }

            $list = $temp;
            unset($list[0]);
            $headers = array_flip($list[1]);
            $flip_headers = array_flip($headers);
            unset($list[1]);

            $result = array();

            foreach ($headers as $item) {

                //  $temp[$flip_headers[$item]] =array();
                foreach ($list as $row) {
                    $var[] = $row[$item];
                }

                $var = array_diff($var, array(null));
                $result[$flip_headers[$item]] = $var;
                unset($var);
            }


            return $result;
        }
        catch (PHPExcel_Reader_Exception $ex){
            return array();
        }
        catch (PHPExcel_Exception $ex){
            return array();
        }

    }//parseDataFromFile

    /***
     * распарсивание заголовков данных
     * @return array - массив прочитанных данных
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function parseHeaderDataFromFile(){

        try {
            $excel = PHPExcel_IOFactory::load($this->filename);

            $excel->setActiveSheetIndexByName("Template");

            $worksheet = $excel->getActiveSheet();

            $temp = $worksheet->toArray();

            for ($i = 0; $i < count($temp); $i++) {
                if (empty($temp[$i])) unset($temp[$i]);
            }

            return $temp[2];
        }
        catch (PHPExcel_Reader_Exception $ex){
            return array();
        }
        catch (PHPExcel_Exception $ex){
            return array();
        }

    }//parseDataFromFile

    /***
     * распарсивание товаров для amazon ads
     * @return array - массив прочитанных данных
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function parseProductForAds($indexes){

        try {
            $need_data = ["item_sku", "item_name", "parent_sku","parent_child"];

            $excel = PHPExcel_IOFactory::load($this->filename);

            $excel->setActiveSheetIndexByName("Template");

            $worksheet = $excel->getActiveSheet();

            $temp = $worksheet->toArray();

            for ($i = 0; $i < count($temp); $i++) {
                if (empty($temp[$i])) unset($temp[$i]);
            }

            $temp = array_slice($temp,3);


            foreach ($temp as $row){

                foreach ($indexes as $item){
                    $temp_row[] = $row[$item];
                }

                $result[] = $temp_row;
                unset($temp_row);
            }

            return $result;
        }
        catch (PHPExcel_Reader_Exception $ex){
            return array();
        }
        catch (PHPExcel_Exception $ex){
            return array();
        }

    }//parseDataFromFile

    /***
     * @param $arr - массив данных из файла экспорта
     * @param $custom_select - пользовательский выбор данных
     * @return array - массив данных для записи в файл
     */
    public function getExportData($arr, $custom_select){

        try {
            $headers = self::parseHeaderDataFromFile();

            $template_data = self::parseDataFromFile();



            $amazon_export_file = array();

                foreach ($arr as $product){
                    $parent_product = $product->getParentProduct();
                    $row = self::createRow($arr, $custom_select, $headers, $template_data,  $parent_product,"");

                    $amazon_export_file[]=$row;

                    //заполняем данные дочерних товаров
                    if(/*$is_parent &&*/ count($product->getChildProducts())>0){

                        foreach ($product->getChildProducts() as $child){
                            //$row_child = array_flip($headers);
                            $row_child = self::createRow($arr, $custom_select, $headers, $template_data, $child, $parent_product->getSeo());
                            $amazon_export_file[]=$row_child;

                            unset($row_child );

                        }//foreach_child

                    }//if count >0

                    unset($row);

                }//foreach

            //return $amazon_export_file ;
            self::writeXLSXFile($this->filename, $custom_select["all_filename"], count($headers), $amazon_export_file);

            return $custom_select["all_filename"];
            }
            catch (Exception $ex){
            return array();
        } catch (PHPExcel_Reader_Exception $e) {
            return array();
        } catch (PHPExcel_Exception $e) {
            return array();
        }

    }//getExportData($arr)

    /***
     * Создание строки для записи в файл
     * @param $arr - массив данных из файла экспорта
     * @param $custom_select - массив данных выбранных пользователем
     * @param $headers - массив заголовков
     * @param $template_data - массив данных из шаблона
     * @param $parent_product - ссылка на товар
     * @param $seo  - описание
     * @return array|null
     */
    private function createRow($arr, $custom_select, $headers, $template_data, $parent_product, $seo){
        $row = array_flip($headers);

        /*start*/


        $is_parent = /*count($product->getChildProducts())>0?true:false;*/ empty($parent_product->getParentSKU());
        // var_dump($is_parent );
        //заполняем данные для родительского товара

        //заполняем пользовательский выбор
        foreach ($headers as $col){
            if(isset($custom_select["amazon_".$col])){
                $row[$col] = $custom_select["amazon_".$col];
            }else{
                $row[$col] ="";
            }
        }

        //заполняем данные товара
        $row["item_sku"] = $custom_select["amazon_brand_name"].$parent_product->getSKU();
        if(!$is_parent) {$row["external_product_id"] = $parent_product->getEAN();}
        if($is_parent) {$row["external_product_id_type"] = "";}

        $row["item_name"] = $parent_product->getTitle();
        $row["manufacturer"] = $custom_select["amazon_brand_name"];

        if(!$is_parent) {$row["part_number"] = $custom_select["amazon_brand_name"].$parent_product->getSKU();}
        $row["parent_child"] = $is_parent?$template_data["parent_child"][0]:$template_data["parent_child"][1];

        if(!$is_parent) {$row["standard_price"] = $parent_product->getPrice();}
        if(!$is_parent) {$row["quantity"] = 100;}
        if(!$is_parent) {$row["main_image_url"] = $parent_product->getImageUrl();}

        /*
         * Другие картинки
         * */

        if(!$is_parent) {$row["parent_sku"] = $custom_select["amazon_brand_name"].$parent_product->getParentSKU();;}
        if(!$is_parent) {$row["relationship_type"] = $template_data["relationship_type"][0];}
        if(!$is_parent) {$row["product_description"] = $seo;}
        if($is_parent) {$row["model"] = $parent_product->getCategory();}
        if(!$is_parent){


//            $ans = GoogleTranslate::getTranslate($custom_select["amazon_bullet_point1"],$custom_select["fromLang"], $custom_select["toLang"]);

          //  $translator = new LanguageTranslator();

         //   $targetData = $translator->translate($custom_select["amazon_bullet_point1"], $custom_select["fromLang"], $custom_select["toLang"]);
          //  echo  $targetData;



            $row["color_name"] = str_replace("-"," ",$parent_product->getAttributeValue());

            if($custom_select["fromLang"]!=$custom_select["toLang"]) {
                $row["color_map"] = GoogleTranslate::translate($parent_product->getAttributeValue(), $custom_select["fromLang"], $custom_select["toLang"]);
            }

            foreach ($template_data["color_map"] as $color) {
                if(mb_stripos($parent_product->getAttributeValue(), $color)!==false)
                    $row["color_map"] = $color;
            }

            $row["item_height"] = round(str_replace(',','.',$parent_product->getHeight()),0);
            $row["item_length"] = $parent_product->getLength();
            $row["item_width"] = $parent_product->getWidth();
            $row["item_weight"] = $parent_product->getWeight();

            $row["website_shipping_weight"] = $parent_product->getWeight();
        }

        if($is_parent){
            $row["bullet_point1"]="";
            $row["bullet_point2"]="";
            $row["bullet_point3"]="";
            $row["bullet_point4"]="";
            $row["bullet_point5"]="";
            $row["generic_keywords1"]="";
            $row["generic_keywords2"]="";
            $row["generic_keywords3"]="";
            $row["generic_keywords4"]="";
            $row["generic_keywords5"]="";
            $row["country_of_origin"] = "";
            $row["currency"] = "";
            $row["condition_type"] = "";
            $row["number_of_items"] = "";
        }

        /*end*/
        return $row;
    }//createRow

    /***
     * запись данных в яайл
     * @param $filename - имя шаблона
     * @param $newfile - новое имя файла
     * @param $count_headers - оличество столбуцов
     * @param $data - данные для записи
     * @return string - имя файла
     */
    private function writeXLSXFile($filename, $newfile, $count_headers, $data){

        if (!copy($filename, $newfile)) {
            return "не удалось скопировать $filename...\n";
        }

        $cells = array_slice($this->excelCells,0, $count_headers);

        try {
            $excel = PHPExcel_IOFactory::load($this->filename);
            $excel->setActiveSheetIndexByName("Template");
            $worksheet = $excel->getActiveSheet();

            $ind = 4;
            //внесение днных в книгу
            foreach ($data as $row){

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
            $objWriter->save($newfile);

        } catch (PHPExcel_Reader_Exception $e) {
            Log::error("Ошибка чтения xlsx файла {$e->getMessage()} // {$e->getTraceAsString()}");
        } catch (PHPExcel_Exception $e) {
            Log::error("Ошибка записи xlsx файла  {$e->getMessage()} // {$e->getTraceAsString()}");
        }


    }//writeXLSXFile

    /***
     * получаем данные из файла в виде класса
     * @return array - результирующий массив
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    public function getProductForAds(){

        $ads_data = array();

        //получаем индексы полей заголовка
        try {
            $indexes = self::getHeaderAds();
            $data = self:: parseProductForAds($indexes);
        } catch (PHPExcel_Reader_Exception $e) {
            Log::error("Ошибка чтения файла :"."{$e->getMessage()} // {$e->getTraceAsString()}");
            return array();
        } catch (PHPExcel_Exception $e) {
            Log::error("Ошибка класса Excel :"."{$e->getMessage()} // {$e->getTraceAsString()}");
            array();
        }

        //определяем родительские товары
        foreach ($data as $parent) {
            if($parent[3] == "Parent"){

                $product = new ProductAmazonAds();
                $product->sku = $parent[0];
                $product->title = $parent[1];
                $product->parent_sku = $parent[2];
                $products_array[] = $product;

                unset($product);
            }

           // unset($parent);
        }

        //определяем дочерние товары
        foreach ($products_array as $product){

            foreach ($data as $child){

                if($child[3] == "Child" && $product->sku == $child[2]){
                    $temp = new ProductAmazonAds();
                    $temp->sku = $child[0];
                    $temp->title = $child[1];
                    $temp->parent_sku = $child[2];
                    $product->childs[] = $temp;
                }

            }//if-child

        }//parent

        return $products_array;

    }//ajaxAmazonAdsShowProductInFile

    /***
     * Индексы полей для заголовка
     * @return mixed - массив результатов
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    private function getHeaderAds(){
        $header = self::parseHeaderDataFromFile();

        $need_data = ["item_sku", "item_name", "parent_sku","parent_child"];

        foreach ($need_data as $item){
            $indexes[$item]=array_search($item, $header);
        }

        return $indexes;
    }

    public function createAdsData($result_ads, $parameters ){

        $head = self::getHeaderTemplateAds();

        foreach($head as $item){$header[$item] = "";}

        $ads = array();

        foreach ($result_ads as $product){
            $row = self::createCampaignRow($product,$header , $parameters);
            $ads = array_merge($ads, $row);
        }

        return $ads ;

    }//createAdsData($result_ads)

    /***
     * строка компании
     * @param $product - товар
     * @param $head - массив заголовков
     * @param $parameters - параметры
     * @return mixed - массив
     */
    private function createCampaignRow($product,$head ,$parameters){

        $result = array();

        $camp_name = $product->title." Campaign";

        $row = $head;
        $row["Campaign Name"] = $camp_name;
        $row["Campaign Daily Budget"] = $parameters["campaign_daily_budet"];
        $row["Campaign Start Date"] = (new \DateTime($parameters["campaign_start_date"]))->format('m.d.Y');
        $row["Campaign Targeting Type"] = $parameters["type_keywords"];
        $row["Campaign Status"] = $parameters["category_status"];
        $result[] = $row;
        unset($row);

        foreach ($product->childs as $child){

            $row = $head;
            $group_name = $child->title." Group";
            $row["Campaign Name"] = $camp_name;
            $row["Ad Group Name"] = $group_name;
            $row["Max Bid"] = 0.02;
            $row["Ad Group Status"] = "Enabled";
            $result[] = $row;
            unset($row);
            //если задаем слова вручную
            if($parameters["type_keywords"] == "Manual"){
//                var_dump($parameters["show_keywords"]);
                $keywords = array_diff(explode("\n",str_replace("\r","",$parameters["show_keywords"]) ),[''," "]);
                for($i=0; $i<count($keywords); $i++){
                    $keywords[$i]= preg_replace("/\s{2,}/"," ",$keywords[$i]);
                    if(empty($keywords[$i])) unset($keywords[$i]);
                }

//                print_r($keywords);

                foreach ($keywords as $word){

//                    var_dump($word);

                    $row = $head;
                    $row["Campaign Name"] = $camp_name;
                    $row["Ad Group Name"] = $group_name;
                    $row["Max Bid"] = 0.1;
                    $row["Keyword"] = trim(str_replace("[*]", $child->title, $word));
                    $row["Match Type"] = $parameters["show_match_type"];;
                    $row["Status"] = "Enabled";
                    $result[] = $row;
                    unset($row);
                }
            }

            $row = $head;
            $group_name = $child->title." Group";
            $row["Campaign Name"] = $camp_name;
            $row["Ad Group Name"] = $group_name;
            $row["SKU"] = $child->sku;
            $row["Status"] = "Enabled";
            $result[] = $row;
            unset($row);

        }

      return $result;

    }//createCampaignRow($product,$head )

    /***
     * Поля для массива рекламы
     * @return mixed - массив результатов
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    private function getHeaderTemplateAds(){

        try {
            $excel = PHPExcel_IOFactory::load("uploads/amazon/template-ads/template-ads.xlsx");

            $excel->setActiveSheetIndexByName("Bulk Template");

            $worksheet = $excel->getActiveSheet();

            $temp = $worksheet->toArray();

//            for ($i = 0; $i < count($temp[0]); $i++) {
//                if (empty($temp[$i])) unset($temp[$i]);
//            }

            return array_diff($temp[0], [null]);
        }
        catch (PHPExcel_Reader_Exception $ex){
            return array();
        }
        catch (PHPExcel_Exception $ex){
            return array();
        }
    }


    public function writeAmazonAds($newfile, $data_for_write){

        $cells = array_slice($this->excelCells,0, count(self::getHeaderTemplateAds()));

        try {
            $excel = PHPExcel_IOFactory::load("uploads/amazon/template-ads/template-ads.xlsx");
            $excel->setActiveSheetIndexByName("Bulk Template");
            $worksheet = $excel->getActiveSheet();

            $ind = 2;
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
            $objWriter->save($newfile);

        } catch (PHPExcel_Reader_Exception $e) {
            Log::error("Ошибка чтения xlsx файла {$e->getMessage()} // {$e->getTraceAsString()}");
        } catch (PHPExcel_Exception $e) {
            Log::error("Ошибка записи xlsx файла  {$e->getMessage()} // {$e->getTraceAsString()}");
        }

    }//writeAmazonAds($all_filename, $data_for_write)

}//class