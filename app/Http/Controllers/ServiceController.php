<?php

namespace App\Http\Controllers;


use App\DataFile;
use App\Mail\CheckSiteEnded;
use App\Mail\LinksCheckEndedMail;
use App\Mail\SitemapEndedMail;
use App\Message;
use App\Service;

use App\Menu;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
//use Illuminate\Support\Facades\Mail;
use Log;
use Mockery\Exception;
use services\LinksChecker;
//use services\SiteChesker;
//use Illuminate\Support\Facades\Mail;
//use \Illuminate\Mail\Message;
use Mail;
//use App\Mail\CheckSiteEnded;


class ServiceController extends MainController
{
    public function showService($slug,$path, Service $service){

        $this -> data['service'] = $service->getBySlug($path);
        $this -> data['parent_uri'] = $slug;
        return view('services.service_cart', $this->data);

    }//showService

    public function ajaxBadLinks(){

       if(isset($_POST["checkedRadioStep2"])){

          if($_POST["checkedRadioStep2"]=="from_area"){

              return view('partials.services.bad-links.step2-area');

          }//if area
          if($_POST["checkedRadioStep2"]=="from_file"){

              return view('partials.services.bad-links.step2-file');

          }//if files

           if($_POST["checkedRadioStep2"]=="show_all_files"){

              //здесь получаем текущего пользователя из $_POST['currentUser']
               $directory = "uploads/users/";
               if(Auth::check()){$directory.=Auth::user()->id."/";}
               $directory.= "bad-links";
               $files = self::getExistFile($directory);
               $this->data["files"] = $files;
               $this->data["directory"] = $directory;
               return view('partials.services.bad-links.step2-show-exist-file', $this->data);

           }//if files

       }//if

       if(isset($_POST["get_bad_links_from_area"])){

            //получаем строку в json формате
            $json = $_POST["get_bad_links_from_area"];
            $is_need_email = isset($_POST["is_need_email"])?$_POST["is_need_email"]:false;
            $need_email = isset($_POST["need_email"])?$_POST["need_email"]:false;

            //преобразуем json в массив
            $links = json_decode($json);

            //удаление дубликатов
            $links = array_unique($links);

           //получаем случайное имя файла
           //смена числа генератора
           srand(self::make_seed());

           //получаем имя файла для записи
           $directory = "uploads/users/";
           if(Auth::check()){$directory.=Auth::user()->id."/bad-links";}
           $filename ="(".date("d_M_Y").")".rand()."checked_links.csv";

            $all_filename = $directory."/".$filename;
            //начинаем проверку ссылок из массива
            $time1 = time();
            $result = self::checkLinks($links, $all_filename);
            $time2 = time();

            //если пользователь авторизован делаем запись в базу
           if(Auth::check()) {
               //делаем запись о файле в таблицу
               self::writeRowInTable($directory,
                   $filename,
                   ($time2 - $time1),
                   filesize($all_filename),
                   Auth::user()->id,
                   7,
                   3);

           }//if


            $this->data["result"] = $result;
            $this->data["file"] = $all_filename;

           if($is_need_email && !empty($need_email)){
               //отправляем уведомление на почту
               Mail::to($need_email)->send(new LinksCheckEndedMail($all_filename));


           }//if

           //записываем данные о сообщении
           if(Auth::check()){

               $this->data["filename"] = $all_filename;

               //запись о сообщении
               self::writeRowInMessages(0,
                   "Проверка ссылок",
                   view('orders.checkLinksOrder', $this->data),
                   Auth::user()->id);

           }//if

            return view('partials.services.bad-links.return_checked_links', $this->data);

       }//get_bad_links_from_area

       //получение ответа сервера в формате json
       if(isset($_POST["get_bad_links_from_area_to_json"])){

            //получаем строку в json формате
            $json = $_POST["get_bad_links_from_area_json"];

            //преобразуем json в массив
            $links = json_decode($json);

            //удаление дубликатов
            $links = array_unique($links);

            //получаем случайное имя файла
            //смена числа генератора
            srand(self::make_seed());

            //получаем имя файла для записи
            $filename = "uploads/users/";
            if(Auth::check()){$filename.=Auth::user()->id."/";}
            $filename = "bad-links/(".date("d_M_Y").")".rand()."ckecked_links.csv";

            //начинаем проверку ссылок из массива
            $result = self::checkLinks($links, $filename);

            echo json_encode($result);

       }//get_bad_links_from_area


    }//ajaxBadLinks()

    //обработка ссылок из файла
    public function ajaxLoadFile(){

        $uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR;
        if(Auth::check()){$uploaddir.=Auth::user()->id.DIRECTORY_SEPARATOR;}
        $uploaddir.='bad-links'.DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR;

        //загружаем файл на сервер
        $filename = self::copy_uploaded_file($uploaddir);

        //читаем данные из файла
        $links = self::readDataFromFile($filename);

        //получаем случайное имя файла
        //смена числа генератора
        srand(self::make_seed());

        //получаем имя файла для записи
        $directory = "uploads/users/";
        if(Auth::check()){$directory.=Auth::user()->id."/bad-links";}
        $filename="(".date("d_M_Y").")".rand()."checked_links.csv";

        $all_filename = $directory."/".$filename;

        //начинаем проверку ссылок из массива
        $time1 = time();
        $result = self::checkLinks($links, $all_filename);
        $time2 = time();

        //если пользователь авторизован делаем запись в базу
        if(Auth::check()) {
            //делаем запись о файле в таблицу
            self::writeRowInTable($directory,
                $filename,
                ($time2 - $time1),
                filesize($all_filename),
                Auth::user()->id,
                7,
                3);
        }//if

        $this->data["result"] = $result;
        $this->data["file"] = $all_filename;

        //записываем данные о сообщении
        if(Auth::check()){

            $this->data["filename"] = $all_filename;

            //запись о сообщении
            self::writeRowInMessages(0,
                "Проверка ссылок",
                view('orders.checkLinksOrder', $this->data),
                Auth::user()->id);

        }//if

        return view('partials.services.bad-links.return_checked_links', $this->data);

    }//ajaxLoadFile()

    //получение ссылок сайта
    public function ajaxGetAllLinks(){

        if(!isset($_POST["main_uri"]) || empty($_POST["main_uri"])){
            echo "Укажите правильный адрес!";
            exit();
        }
        $uri = $_POST["main_uri"];
        $is_check_images = isset($_POST["is_check_images"])?$_POST["is_check_images"]:false;
        $is_check_mining = isset($_POST["is_check_mining"])?$_POST["is_check_mining"]:false;
        $is_need_email = isset($_POST["is_need_email"])?$_POST["is_need_email"]:false;
        $need_email = isset($_POST["need_email"])?$_POST["need_email"]:"";

//        print_r($_POST);

        try {

            set_time_limit(180000);
            //получаем название файла с результом
            $filename = self::get_all_links($uri, $is_check_images, $is_check_mining);



            if($is_need_email && !empty($need_email)){
                //отправляем уведомление на почту
                Mail::to($need_email)->send(new CheckSiteEnded($filename, $uri));
            }

            //записываем данные о сообщении
            if(Auth::check()){

                $this->data["filename"] = $filename;
                $this->data["uri"] = $uri;

                //запись о сообщении
                self::writeRowInMessages(0,
                    "Проверка сайта",
                    view('orders.checkFileOrder', $this->data),
                    Auth::user()->id);

            }//if

        }catch (Exception $ex){
            echo $ex->getTraceAsString()."\n".$ex->getMessage();
        }
//        var_dump($filename);
        $this->data["filename"] = $filename;
        // вывод данных во фронтэнд
        return view('partials.services.get-links.return_filename', $this->data);

    }//ajaxGetAllLinks()

    //показать данные из файла
    public function showDataFromFile(){

        if(!isset($_POST["filename"])){
            return "Ошибка чтения данных!";
        }//if

        $filename = $_POST["filename"];
        $is_need_email = isset($_POST["is_need_email"])?$_POST["is_need_email"]:false;
        $need_email = isset($_POST["need_email"])?$_POST["need_email"]:false;

        $this->data["filename"] = $filename;
        $this->data["dataFromFile"] = self::getDataFromFile($filename);

        //var_dump($this->data["dataFromFile"]);

        if($is_need_email && !empty($need_email)){
            //отправляем уведомление на почту
            Mail::to($need_email)->send(new LinksCheckEndedMail($filename));
        }

        return view('partials.services.get-links.return_data_from_file', $this->data);

    }//showDataFromFile

    //показать все файлы
    public function showAllFiles(){

        //здесь получаем текущего пользователя из $_POST['currentUser']
        $directory = "uploads/users/";
        if(Auth::check()){$directory.=Auth::user()->id.DIRECTORY_SEPARATOR;}
        $directory.="all-links";
        $files = self::getExistFile($directory);
        $this->data["directory"] = $directory;
        $this->data["files"] = $files;
        return view('partials.services.get-links.show-exist-file', $this->data);

    }//showAllFiles

    //выбор шага 2 для выбора ссылок карты сайта
    public function sitemapStep2(){

        if(isset($_POST["checkedRadioStep2"]))  {

            if($_POST["checkedRadioStep2"]=="from_area"){
                return view('partials.services.sitemap-generator.step2-area');
            }
            if($_POST["checkedRadioStep2"]=="from_file"){
                return view('partials.services.sitemap-generator.step2-upload-file');
            }
            if($_POST["checkedRadioStep2"]=="show_check_site_files"){

                $directory = "uploads/users/";
                if(Auth::check()){$directory.=Auth::user()->id.DIRECTORY_SEPARATOR;}
                $directory.="all-links";

                $files = self::getExistFile($directory);
                $this->data["files"] = $files;

                return view('partials.services.sitemap-generator.step2-exist-check-file', $this->data);
            }
            if($_POST["checkedRadioStep2"]=="show_all_files"){
                return view('partials.services.sitemap-generator.step2-show-all-files');
            }

        }//if

    }//sitemapStep2

    //выбор шага 3 для выбора ссылок карты сайта
    public function sitemapStep3(){

        if(isset($_POST["get_sitemap_from_area"])){

            //получаем строку в json формате
            $json = $_POST["get_sitemap_from_area"];


            //преобразуем json в массив
            $links = json_decode($json);

            //удаление дубликатов
            $links = array_unique($links);

            $this->data["links"] = $links;

            return view('partials.services.sitemap-generator.show_step3', $this->data);

        }//get_sitemap_from_area

        //получаем данные из json
        if(isset($_POST["data_links_xml"])){

            $is_need_email = isset($_POST["is_need_email"])?$_POST["is_need_email"]:false;
            $need_email = isset($_POST["need_email"])?$_POST["need_email"]:false;

            //получаем JSON из запроса
            $json = $_POST["data_links_xml"];

            //преобразуем JSoN в массив
            $data = json_decode($json);

            //получаем разметку
            $xml = self::create_xml_file($data);

            //записываем разметку в файл
            $filename = self::write_xml_file($xml);

            $this->data["filename"] = $filename;

            if($is_need_email && !empty($need_email)){
                //отправляем уведомление на почту
                Mail::to($need_email)->send(new SitemapEndedMail($filename, "XML"));
            }

            //записываем данные о сообщении
            if(Auth::check()){

                $this->data["filename"] = $filename;
                $this->data["type"] = "XML";

                //запись о сообщении
                self::writeRowInMessages(0,
                    "Карта сайта",
                    view('orders.sitemapOrder', $this->data),
                    Auth::user()->id);

            }//if

            // вывод данных во фронтэнд
            return view('partials.services.sitemap-generator.return_filename', $this->data);

        }//if

        //получаем данные из json
        if(isset($_POST["data_links_html"])){

            $is_need_email = isset($_POST["is_need_email"])?$_POST["is_need_email"]:false;
            $need_email = isset($_POST["need_email"])?$_POST["need_email"]:false;

            //получаем JSON из запроса
            $json = $_POST["data_links_html"];

            //преобразуем JSoN в массив
            $data = json_decode($json);

//            print_r($data); exit();

            //получаем разметку
            $html = self::create_html_file($data);

//            return $html;

            //записываем разметку в файл
            $filename = self::write_html_file($html);

            $this->data["filename"] = $filename;

            if($is_need_email && !empty($need_email)){
                //отправляем уведомление на почту
                Mail::to($need_email)->send(new SitemapEndedMail($filename, "HTML"));
            }

            //записываем данные о сообщении
            if(Auth::check()){

                $this->data["filename"] = $filename;
                $this->data["type"] = "HTML";

                //запись о сообщении
                self::writeRowInMessages(0,
                    "Карта сайта",
                    view('orders.sitemapOrder', $this->data),
                    Auth::user()->id);

            }//if

            // вывод данных во фронтэнд
            return view('partials.services.sitemap-generator.return_filename', $this->data);

        }//if

    }//sitemapStep3

    //загрузка файла для создания карты сайта
    public function ajaxLoadFileForSitemap(){

        $uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR;
        if(Auth::check()){$uploaddir.=Auth::user()->id.DIRECTORY_SEPARATOR;}
        $uploaddir.='sitemap'.DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR;

        //загружаем файл на сервер
        $filename = self::copy_uploaded_file($uploaddir);

        //читаем данные из файла
        $links = self::readDataFromFile($filename);

        //удаление дубликатов
        $links = array_unique($links);

        $this->data["links"] = $links;

        return view('partials.services.sitemap-generator.show_step3', $this->data);

    }//ajaxLoadFileForSitemap

    //загрузка ссылок из ранее созданного файла
    public function sitemapStep3ForExistFile(){

        if(!isset($_POST["filename"])){
            return "Выберите ранеесозданный файл проверки ссылок сайта!";
        }

        $filename = "uploads/users/";
        if(Auth::check()){$filename.=Auth::user()->id.DIRECTORY_SEPARATOR;}
        $filename.="all-links/".$_POST["filename"];

//        return $filename;

        //читаем данные из файла
        $links = self::readDataFromFileCSV($filename);

//        print_r($links); exit();

        //удаление дубликатов
        $links = array_unique($links);

        $this->data["links"] = $links;

        return view('partials.services.sitemap-generator.show_step3', $this->data);

    }//sitemapStep3ForExistFile

    //показать ранее созданные файлы
    public function sitemapStep3ShowCteatedFiles(){

        if(!isset($_POST["typeFiles"])){
            return "Что-то пошло не так!";
        }

        $type = $_POST["typeFiles"];

       // print_r($_POST);

        if($type == "xml"){

            //задаем директорию
            $directory = "uploads/users/";
            if(Auth::check()){$directory.=Auth::user()->id.DIRECTORY_SEPARATOR;}
            $directory.="sitemap/xml";

            //получаем файлы в директории
            $files = self::getExistFile($directory);
//            print_r($files); exit();
            $this->data["files"] = $files;
            $this->data["directory"] = $directory;
            return view('partials.services.sitemap-generator.step2-show-exist-file', $this->data);
        }
        if($type == "html"){

            //задаем директорию
            $directory = "uploads/users/";
            if(Auth::check()){$directory.=Auth::user()->id.DIRECTORY_SEPARATOR;}
            $directory.="sitemap/html";

            //получаем файлы в директории
            $files = self::getExistFile($directory);
//            print_r($files); exit();
            $this->data["files"] = $files;
            $this->data["directory"] = $directory;
            return view('partials.services.sitemap-generator.step2-show-exist-file', $this->data);

        }
//        if($type = "all"){
//
//        }

    }//sitemapStep3ShowCteatedFiles

    /**
     * проверка ссылок из массива
     * @param $links - массив ссылок для проверки
     * @param $filename - имя файла для записи
     * @return array - результирующий массив с результатами проверки
     */
    private function checkLinks($links, $filename){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        $result = array();
        $count=1;
        foreach ($links as $link){

            $http_code = get_headers($link)[0];
            $info = array("pos"=>$count,"uri"=>$link, "http_code"=>$http_code);
            $result[] = $info;

            //записываем строку
            @fputcsv($fp,  $info);
            $count++;
        }//foreach

        //закрываем файл
        fclose($fp);

        return $result;

    }//checkLinks

    // рандомизировать микросекундами
    private function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }//make_seed()

    /**
    * @return $uploadfile string - имя закачанного файла
    */
    private function copy_uploaded_file($uploaddir){

        //Получаем корневую директорию сайта и назначаем папку для загрузки файлов
       // $uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR.'bad-links'.DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR;

        //Считываем загружаемый файл
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $out = "Файл корректен и был успешно загружен.\n";
        } else {
            $out = "Ошибка загрузки документа ! Возможная атака с помощью файловой загрузки!\n";
            echo $out;
            exit;
        }

        return $uploadfile;

    }//copy_uploaded_file()

    /**
     * чтение данных из файла
     * @param $filename -имя файла
     * @return array - массив ссылок
     */
    private function readDataFromFile($filename){

        //открываем файл для чтения
        $fp = fopen($filename, "r"); // Открываем файл в режиме чтения

        $result = array();

        if ($fp)
        {
            while (!feof($fp))
            {
                //читаем строку
                $text = fgets($fp);

                //удаляем пробелы
                $text = preg_replace('/\s/', '', $text);
                if(!empty($text)){
                    $result[]=$text;
                }
            }
        }
        else {echo "Ошибка при открытии файла";exit;}
        fclose($fp);

        //удаляем дубликаты
        $result = array_unique($result);

        return $result;

    }//readDataFromFile

    /**
     * Чтение ссілок из файла csv
     * @param $filename - имя файла для чтения
     * @return array - массив ссылок
     */
    private function readDataFromFileCSV($filename){

        $arr = array();
        $handle = fopen($filename, "r");
        while (($data = fgetcsv($handle)) !== FALSE) {
          $arr[] = $data[0];
        }
        fclose($handle);

       // unset($arr[0]);
        $arr = array_slice($arr,1);

        return $arr;

    }//readDataFromFileCSV

     //выбрать файлы из каталога пользователя
    /**
     * выбрать все файлы из каталога
     * @param $directory - каталог для проверки
     * @return array -
     */
    private function getExistFile($directory){
        $files = scandir($directory);
        unset ($files[array_search('temp', $files)]);
        unset ($files[array_search('.', $files)]);
        unset ($files[array_search('..', $files)]);
        return $files;
    }//getExistFile

    /**
     * получаем данные по сайту
     * @param $link - сайт для проверки
     * @param $is_check_images - проверять ли картинки
     * @param $is_check_mining - проверить ли сайт на майнинг
     * @return string - возвращаем имя файла для проверки
     */
    private function get_all_links($link, $is_check_images, $is_check_mining){
      //  $result = array();

        //убираем / в конце url
        $l = $link [strlen($link ) - 1];
        $link = $l == "/" ? substr($link ,0,(strlen($link ) - 1)): $link;

        //задаем GET параметр для curl запроса
        $url = 'http://service.local:8000/ajax-request/get-all-links/'.base64_encode($link).'/'.base64_encode($link);

        //инициализация curl
        $ch = curl_init();

        //задаем ссылку с get параметром
        curl_setopt($ch, CURLOPT_URL, $url );
        //передавать заголовки
       // $headers = array("X-CSRF-Token:yBweOTqG9Px2EIYElbKH6FPxuCyrTwgl3XlTmx7M");
//        curl_setopt($ch, CURLOPT_HEADER, 1);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Просим вернуть вместе с ответом заголовки
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //сообщаем серверу, что нас интересует только заголовки
        curl_setopt($ch, CURLOPT_NOBODY, 0);
       // curl_setopt($ch, CURLOPT_POST, true);
       // curl_setopt($ch, CURLOPT_POSTFIELDS, 'link='.$link.'&domain='.$link);

        //получаем ответ
        $data = curl_exec($ch);
        $data = base64_decode($data);
        $data = substr($data,0, stripos($data,'}')+1 );

        /*отмечаем, что ссылка проверена*/
        $data = (array)  json_decode($data);
        $data[$link] = 30;

//        return $data;

        $data = json_encode($data);

        //получаем случайное имя файла
        //смена числа генератора
        srand(self::make_seed());

        //формируем имя
        $tempFile = "uploads/users/";
        if(Auth::check()){$tempFile.=Auth::user()->id."/";}
        $tempFile.="all-links/temp/".'temp'.rand();
        //запись данных во временный файл
        self::writeJSONToTempFile($tempFile, $data);

        //информация о заголовках
        $file = @file_get_contents($link);
        $info = self::parseHeaders($http_response_header);

        //записываем результат в файл
        //составляем имя файла в формате имя(url).sv
        $directory = "uploads/users/";
        if(Auth::check()){$directory.=Auth::user()->id."/";}
        $directory.="all-links";

        $filename = date("d_M_Y")."(".substr($link,strpos($link,"://")+3).")".rand().".csv";
        $all_filename = $directory."/".$filename;

        $time1 = time();
        //записываем заголовок
        $headers = array_merge(array('Link'), array_reverse(array_keys($info)));
        self::writeHeaderCSV($all_filename, $headers);
        self::writeCSVfile($all_filename, $link, $info);

        //заксываем curl
        curl_close($ch);

        self::get_next_link($tempFile, $all_filename, $link);

        //удаляем переменные
        unset($info);
        unset($data);

        //удаляем временный файл
        unlink($tempFile);

        $time2 = time();

        //если пользователь авторизован делаем запись в базу
        if(Auth::check()) {
            //делаем запись о файле в таблицу
            self::writeRowInTable($directory,
                $filename,
                ($time2 - $time1),
                filesize($all_filename),
                Auth::user()->id,
                7,
                3);
        }//if

        return $all_filename;
    }//get_all_links


    /**
     * запись данных в csv файл
     * @param $filename - имя файла
     * @param $link - ссылка
     * @param $info - параметры ответа
     */
    private function writeCSVfile($filename, $link, $info){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        $info[] = $link;
        $info = array_reverse($info);

        //записываем строку
        @fputcsv($fp,  $info);

        //закрываем файл
        fclose($fp);

    }//writeCSVfile

    /**
     * Записываем заголовок CSV файла
     * @param $filename - имя файла
     * @param $header - заголовки
     */
    private function writeHeaderCSV($filename, $header){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем строку
        @fputcsv($fp,  $header);

        //закрываем файл
        fclose($fp);

    }//writeHeaderCSV

    /**
     * запись массива ссылок во временный файл
     * @param $tempFile - имя веменного файла
     * @param $data - данные в формате JSON
     */
    private function writeJSONToTempFile($tempFile, $data){

        file_put_contents($tempFile, $data);

    }//writeJSONToTempFile

    /**
     * Парсим заголовки
     * @param $headers
     * @return mixed
     */
    private function parseHeaders( $headers )
    {
        $head = array();
        foreach( $headers as $k=>$v )
        {
            $t = explode( ':', $v, 2 );
            if( isset( $t[1] ) )
                $head[ trim($t[0]) ] = trim( $t[1] );
            else
            {
                $head[] = $v;
                if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
                    $head['reponse_code'] = intval($out[1]);
            }//if-else
        }//foreach

        // Connection	Content-Type	Date	Server	reponse_code
        $hd["server_responce"] =  isset($head[0])?$head[0]:'-';
        $hd["responce_code"] = isset($head["reponse_code"])?$head["reponse_code"]:'-';
        $hd["Date"] = isset( $head["Date"])?$head["Date"]:'-';
        $hd["Server"] = isset($head["Server"])?$head["Server"]:'-';
        $hd["X-Powered-By"] = isset($head["X-Powered-By"])?$head["X-Powered-By"]:'-';
        $hd["Set-Cookie"] = isset($head["Set-Cookie"])?$head["Set-Cookie"]:'-';
        $hd["Expires"] = isset($head["Expires"])?$head["Expires"]:'-';
        $hd["Cache-Control"] = isset($head["Cache-Control"])?$head["Cache-Control"]:'-';
        $hd["Pragma"] = isset($head["Pragma"])?$head["Pragma"]:'-';
        $hd["Vary"] = isset($head["Vary"])?$head["Vary"]:'-';
        $hd["Content-Length"] = isset($head["Content-Length"])?$head["Content-Length"]:'-';
        $hd["Connection"] = isset($head["Connection"])?$head["Connection"]:'-';
        $hd["Content-Type"] = isset($head["Content-Type"])?$head["Content-Type"]:'-';

        return $hd;
    }//parseHeaders

    /**
     * Циклическая проверка ссылок
     * @param $tempFile - имя текущего временного файла
     * @param $filename - имя файла отчета
     * @param $original_link - доменное имя(оригинальное имя)
     */
    private function get_next_link($tempFile, $filename, $original_link){

        //временный счетчик
        $count = 1;

        while(true){
            //читаем данные из временного файла
            $links = (array) json_decode(file_get_contents($tempFile));

            while(true) {

                //берем первую ссылку массива
                $link = array_search(15, $links);
                if(stripos($link,".png")!==false  ||
                    stripos($link,".eps")!==false ||
                    stripos($link,".jpg")!==false ||
                    stripos($link,".csv")!==false ||
                    stripos($link,".pdf")!==false) $links[$link]=30;
                else break;
            }

            //если в файле не осталось ссылок для проверки то заканчиваем проверку
            if($link===false || empty($links) || count($links)==0) break;

            //задаем GET параметр для curl запроса
            $url = 'http://service.local:8000/ajax-request/get-all-links/'.base64_encode($link).'/'.base64_encode($original_link);

            //инициализация curl
            $ch = curl_init();

            //задаем ссылку с get параметром
            curl_setopt($ch, CURLOPT_URL, $url);
            //передавать заголовки
            //curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_POST, 1);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, 'apikey=' . $api_key.'&domain_name='.$original_link);

            //получаем ответ
            $data = curl_exec($ch);

            $data = base64_decode($data);
            $data = substr($data,0, stripos($data,'}')+1 );

            //преобразуем ответ в массив
            $data = (array)json_decode($data);

            //объединяем записанный и текущий массив ссылок
            self::mergeArray($links, $data);

            //отмечаем, что ссылка проверена
            $links[$link] = 30;

            //запись данных во временный файл
            self::writeJSONToTempFile($tempFile, json_encode($links));

            //информация о заголовках
            $file = @file_get_contents($link);
            $info = self::parseHeaders($http_response_header);

            //записываем результат в файл
            self::writeCSVfile($filename, $link, $info);

            //заксываем curl
            curl_close($ch);

            //временный или постоянный ограничитель
            if($count == 500) break;

            //увеличиваем счетчик
            $count++;

        }//while

    }//get_next_link

    /**
     * добавление ссылок в массив
     * @param $links - массив ссылок из файла
     * @param $data - массив ссылок из запроса
     */
    private function mergeArray(&$links, $data){

        $keys = array_keys($data);

        foreach ($keys as $item){

            if(!array_key_exists($item, $links)){

                $links[$item] = 15;

            }//if

        }//foreach

    }// mergeArray

    /**
     * чтение данных из файла
     * @param $filename - мя файла для чтения
     * @return array - результирующий массив
     */
    private function getDataFromFile($filename){

        $row = 0;
        $arr = array();

        $handle = fopen($filename, "r");
        while (($data = fgetcsv($handle)) !== FALSE) {

            $temp["num"] = $row;
            $temp["link"] = $data[0];
            $temp["Content-Type"] = $data[1];
            $temp["Connection"] = $data[2];
            $temp["Content-Length"] = $data[3];
            $temp["Vary"] = $data[4];
            $temp["Pragma"] = $data[5];
            $temp["Cache-Control"] = $data[6];
            $temp["Expires"] = $data[7];
            $temp["Set-Cookie"] = $data[8];
            $temp["X-Powered-By"] = $data[9];
            $temp["Server"] = $data[10];
            $temp["Date"] = $data[11];
            $temp["responce_code"] = $data[12];
            $temp["server_responce"] = $data[13];
            $arr[]=$temp;

            $row++;

        }//while
        fclose($handle);

        $arr = array_slice($arr,1);

        return $arr;

    }//getDataFromFile

    /**
     * Создание XML разметки
     * @param $data- массив ссылок для формирования xml
     * @return mixed - возвращаем разметку
     */
    private function create_xml_file($data){

        //создаем новый экземпляр класса XMLWriter
        $xml = new \XMLWriter();

        //использование памяти для вывода строки
        $xml->openMemory();

        //установка версии XML в первом теге документа
        $xml->startDocument();

        $xml->startElement("sitemapindex");
        $xml->writeAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

        foreach ($data as $link){

            $xml->startElement("url");

            $xml->writeElement("loc", $link[0]);
            $xml->writeElement("changefreq", $link[2]);
            $xml->writeElement("priority", $link[1]);

            $xml->endElement();
        }//foreach

        //$xml->endElement();
        //закрытие корневого элемента
        $xml->endElement();

        //вывод данных
        $text = $xml->outputMemory();

        return $text;

    }//create_xml_file

    /**
     * создание HTML разметки
     * @param $data - массив ссылок для формирования html
     * @return mixed - возвращаем разметку
     */
    private function create_html_file($data){

        $text = "<!DOCTYPE html>";
        $text.= "<html><head>
    <meta charset='UTF-8'>
    <title>dLogic</title></head><body>";

        foreach ($data as $link){

            $text.="<a href='".$link."'>".$link."</a><br/>";

        }

        $text.="</body></html>";

        return $text;

    }//create_html_file

    /**
     * Запись xml разметки в файл
     * @param $xml - xml разметка
     * @return string - возвращаем имя файла
     */
     private function write_xml_file($xml){

        //получаем случайное имя файла
        //смена числа генератора
        srand(self::make_seed());

        //формируем имя
        $directory = "uploads/users/";
        if(Auth::check()){$directory.=Auth::user()->id."/";}
        $directory.="sitemap/xml";

        $filename = 'sitemap_'.date("d_M_Y").'_'.rand().'.xml';
        $all_filename = $directory."/".$filename;

        $time1 = time();
        $fp = fopen($all_filename, "a");
        //записываем данные
        fwrite($fp, $xml);
        fclose($fp);
        $time2 = time();
         //если пользователь авторизован делаем запись в базу
         if(Auth::check()) {
             //делаем запись о файле в таблицу
             self::writeRowInTable($directory,
                 $filename,
                 ($time2 - $time1),
                 filesize($all_filename),
                 Auth::user()->id,
                 9,
                 3);
         }//if

        return $all_filename;

    }//write_xml_file

    /**
     * запись данных в файл
     * @param $html- xml данные для записи
     * @return string - возвращаем имя файла
     */
     private function write_html_file($html){

        //получаем случайное имя файла
        //смена числа генератора
        srand(self::make_seed());

        //формируем имя
        $directory = "uploads/users/";
        if(Auth::check()){$directory.=Auth::user()->id."/";}
        $directory.="sitemap/html";
        $filename = 'sitemap_'.date("d_M_Y").'_'.rand().'.html';
        $all_filename = $directory."/".$filename;

        $time1 = time();
        $fp = fopen($all_filename, "a");
        //записываем данные
        fwrite($fp, $html);
        fclose($fp);
        $time2 = time();
         //если пользователь авторизован делаем запись в базу
         if(Auth::check()) {
             //делаем запись о файле в таблицу
             self::writeRowInTable($directory,
                 $filename,
                 ($time2 - $time1),
                 filesize($all_filename),
                 Auth::user()->id,
                 9,
                 3);
         }//if

        return $all_filename;
    }//write_html_file

    /**
     * Запись данных о файле в базу
     * @param $directory - директория
     * @param $filename - имя файла
     * @param $create_time - время создания
     * @param $size - размер
     * @param $user_id - id пользователя
     * @param $service_id - id сервиса
     */
     private function writeRowInTable($directory, $filename, $create_time, $size, $user_id, $service_id, $project_id) {

         try {
             $row = new DataFile();

             $row->directory = $directory;
             $row->filename = $filename;
             $row->create_time = $create_time;
             $row->size = $size;
             $row->user_id = $user_id;
             $row->service_id = $service_id;
             $row->project_id = $project_id;
             $row->save();
         }catch (Exception $ex){
             Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
         }

     }//writeRowInTable

    private function writeRowInMessages($read, $title, $content, $user_id) {

        try {
            $row = new Message();

            $row->read = $read;
            $row->title = $title;
            $row->content = $content;
            $row->user_id = $user_id;

            $row->save();
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//writeRowInTable

}//class
