<?php

namespace App\Http\Controllers;

use App\DataFile;
use App\EventByUser;
use App\Message;
use App\Order;
use App\Project;
use App\Service;
use Auth;
use App\Event;
use Illuminate\Http\Request;
use Log;
use Mockery\Exception;

class MyAccountController extends MainController
{
    public function showMyAccountDashboard(DataFile $dataFile, Message $message, EventByUser $event){

        //проверяем авторизацию пользователя
        if (Auth::check())
        {
            //если авторизирован показываем кабинет
            //return "Прошел : ".Auth::user()->name;
            $this->data["user"] = Auth::user();
            $this->data["all_files"] = $dataFile->getAllFiles();
            $this->data["project1"] = $dataFile->getFileForProject(1);
            $this->data["project2"] = $dataFile->getFileForProject(2);
            $this->data["project3"] = $dataFile->getFileForProject(3);
            $this->data["message"] = $message;
            $this->data["event"] = $event;
            return view('my-account.index', $this->data);
        }else{
            //если не залогинен показываем страницу login
            return view('auth.login');
        }

    }//showMyAccountDashboard

    //показать данные по всем файлам
    public function showDataFromAllFIle(DataFile $dataFile){

        try {

            $this->data["files"] = $dataFile->getAllFiles();
            return view('my-account.show_files_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//showDataFromAllFIle

    //показать данные по файлам в проекте
    public function showDataFromFIleInProject(DataFile $dataFile){
        try {
        if(!isset($_GET["project"])){
            return "";
        }

            $this->data["files"] = $dataFile->getFileForProject($_GET["project"]);
            return view('my-account.show_files_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//showDataFromFIleInProject

    //показать данные по файлам в сервисе
    public function showDataFromFIleInService(DataFile $dataFile){
        try {
            if(!isset($_GET["service"])){
                return "";
            }

            $this->data["files"] = $dataFile->getFileForService($_GET["service"]);
            return view('my-account.show_files_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//showDataFromFIleInService

    //показать детализацию по проекту
    public function showDetailData(Project $project, Service $service){

        if(!isset($_GET["ind"])){
            return "";
        }//if

        $ind = $_GET["ind"];
        if($ind ==0) {
            $this->data["services"] = $service->getActive();
        }else{
            $temp = $project->getById($ind);
            $this->data["services"] = $temp->services;
        }

        return view('my-account.show_detail_data', $this->data);

    }//showDetailData

    //создать отчет по все файлам
    public function createOrderForAllFile(DataFile $dataFile){

        //получаем случайное имя файла
        //смена числа генератора
        srand(self::make_seed());

        //получаем данные из базы
        $data = $dataFile->getAllFiles();

        $directory = "uploads".DIRECTORY_SEPARATOR."users".DIRECTORY_SEPARATOR;
        if(Auth::check()){$directory.=Auth::user()->id.DIRECTORY_SEPARATOR;}
        $directory .= "orders";
        $filename = 'order_'.date("d_M_Y").'_'.rand().'.csv';
        $all_filename = $directory.DIRECTORY_SEPARATOR.$filename;

        //создаем файла
        $time1 = time();
        self::createFileOrder($data, $all_filename);
        $time2 = time();
        //если пользователь авторизован делаем запись в базу
        if(Auth::check()) {
            $this->writeRowInTableOrder($directory,
                $filename,
                ($time2 - $time1),
                Auth::user()->id,
                0,
                0);
        }
        $this->data["filename"] = $all_filename;
        return view('my-account.show_return_order', $this->data);

    }//cteateOrderForAllFile

    //создать отчет по файлам проекта
    public function createOrderForProjectFile(DataFile $dataFile){

        try {
            if(!isset($_GET["project"])){
                return ":(";
            }

            $data = $dataFile->getFileForProject($_GET["project"]);

            if(count($data)==0) return "Файлы не найдены!";

            $directory = "uploads".DIRECTORY_SEPARATOR."users".DIRECTORY_SEPARATOR;
            if(Auth::check()){$directory.=Auth::user()->id.DIRECTORY_SEPARATOR;}
            $directory .= "orders";
            $filename = 'order_'.date("d_M_Y").'_'.rand().'.csv';

            $all_filename = $directory.DIRECTORY_SEPARATOR.$filename;

            //создаем файла
            $time1 = time();
            self::createFileOrder($data, $all_filename);
            $time2 = time();
            //если пользователь авторизован делаем запись в базу
            if(Auth::check()) {
                $this->writeRowInTableOrder($directory,
                    $filename,
                    ($time2 - $time1),
                    Auth::user()->id,
                    0,
                    $_GET["project"]);
            }

            $this->data["filename"] = $all_filename;

            return view('my-account.show_return_order', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//createOrderForProjectFile

    //создать отчет по файлам сервиса
    public function createOrderForServiceFile(DataFile $dataFile , Service $service){

        try {
            if(!isset($_GET["service"])){
                return ":(";
            }

            $data = $dataFile->getFileForService($_GET["service"]);

            if(count($data)==0) return "Файлы не найдены!";

            $directory = "uploads".DIRECTORY_SEPARATOR."users".DIRECTORY_SEPARATOR;
            if(Auth::check()){$directory.=Auth::user()->id.DIRECTORY_SEPARATOR;}
            $directory .= "orders";
            $filename = 'order_'.date("d_M_Y").'_'.rand().'.csv';

            $all_filename = $directory.DIRECTORY_SEPARATOR.$filename;

            //создаем файла
            $time1 = time();
            self::createFileOrder($data, $all_filename);
            $time2 = time();
            //если пользователь авторизован делаем запись в базу
            if(Auth::check()) {
                $this->writeRowInTableOrder($directory,
                    $filename,
                    ($time2 - $time1),
                    Auth::user()->id,
                    $_GET["service"],
                    $service->getById($_GET["service"])->project->id);
            }

            $this->data["filename"] = $all_filename;

            return view('my-account.show_return_order', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//createOrderForProjectFile

    //поиск файла
    public function searchFile(DataFile $dataFile){

        if(!isset($_GET["filename"]) || empty($_GET["filename"])){
            return "Укажите имя файла!";
        }

        try {

            $filename = '%'.$_GET["filename"].'%';
            $this->data["files"] = $dataFile->searchFiles($filename);

            if(count($this->data["files"]) == 0) return "Данные не найдены!";
            return view('my-account.show_files_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//searchFile

    //отображение страницы
    public function showPage(DataFile $dataFile, Order $order, Message $message, EventByUser $event){

        if(!isset($_GET["page"])){
            return ":)";
        }

        $this->data["user"] = Auth::user();
        $this->data["message"] = $message;
        $this->data["event"] = $event;

        switch ($_GET["page"]){
            case "orders":

                $this->data["all_orders"] = $order->getAllOrders();
                $this->data["project1"] = $order->getOrdersForProject(1);
                $this->data["project2"] = $order->getOrdersForProject(2);
                $this->data["project3"] = $order->getOrdersForProject(3);

//var_dump($this->data["all_orders"]);
                return view('my-account.orders', $this->data);

            case "files":

                $this->data["all_files"] = $dataFile->getAllFiles();
                $this->data["project1"] = $dataFile->getFileForProject(1);
                $this->data["project2"] = $dataFile->getFileForProject(2);
                $this->data["project3"] = $dataFile->getFileForProject(3);

                return view('my-account.files', $this->data);

            case "statistic":

                $this->data["files_stat"] = $dataFile->getDataForDaysByUser(Auth::user()->id);
                $this->data["orders_stat"] = $order->getDataForDaysByUser(Auth::user()->id);

                $this->data["files"] = $dataFile;
                $this->data["orders"] = $order;

                return view('my-account.statistic', $this->data);

            case "person":

                return view('my-account.person', $this->data);

            case "message":

                return view('my-account.message', $this->data);

            case "events":
//
//                $data = $event ->getAllEvents();
//
//                foreach ($data as $item){
//                    echo ((new Event())->getById($item->event_id))->title."<br/>";
//                }

              //  var_dump($data);
                return view('my-account.events', $this->data);
//var_dump($this->data["message"]->getAllMessages());
        }

    }//showPage

    //показать данные по всем отчетам
    public function showDataFromAllOrder(Order $dataFile){

        try {

            $this->data["orders"] = $dataFile->getAllOrders();
            return view('my-account.show_orders_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//showDataFromAllFIle

    //показать данные по файлам в проекте
    public function showDataFromOrderInProject(Order $dataFile){
        try {
            if(!isset($_GET["project"])){
                return "";
            }

            $this->data["orders"] = $dataFile->getOrdersForProject($_GET["project"]);
            return view('my-account.show_orders_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//showDataFromFIleInProject

    //показать детализацию по сервисам
    public function showDetailDataForOrder(Project $project, Service $service){

        if(!isset($_GET["ind"])){
            return "";
        }//if

        $ind = $_GET["ind"];
        if($ind ==0) {
            $this->data["services"] = $service->getActive();
        }else{
            $temp = $project->getById($ind);
            $this->data["services"] = $temp->services;
        }

        return view('my-account.show_detail_data_for_order', $this->data);

    }//showDetailDataForOrder

    //показать отчеты по сервису
    public function showDataFromOrderInService(Order $dataFile){

        try {
            if(!isset($_GET["service"])){
                return "";
            }

            $this->data["orders"] = $dataFile->getOrderForService($_GET["service"]);
            return view('my-account.show_orders_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//showDataFromOrderInService

    //поиск отчета
    public function searchOrder(Order $dataFile){

        if(!isset($_GET["filename"]) || empty($_GET["filename"])){
            return "Укажите название отчета!";
        }

        try {

            $filename = '%'.$_GET["filename"].'%';
            $this->data["orders"] = $dataFile->searchOrders($filename);

            if(count($this->data["orders"]) == 0) return "Данные не найдены!";
            return view('my-account.show_orders_data', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//searchFile

    //показать тело сообщения
    public function getMessageBody(Message $message){

         if(!isset($_GET["ind"])){
             return "Нет данных";
         }

         $data = $message->getById($_GET["ind"]);

         //отмечаем сообщение как прочитанное
         $data->read = 1;
         $data->save();

         return $data->content;

    }//getMessageBody

    //показать тело сообщения
    public function getEventBody(Event $message, EventByUser $byUser){

        if(!isset($_GET["ind"])){
            return "Нет данных";
        }

        $event = $message->getById($_GET["ind"]);

        $temp_user = $byUser->getByEventId($event->id);
        //отмечаем сообщение как прочитанное
        $temp_user->read = 1;
        $temp_user->save();

        $this->data["content"] = $event;

        return view('my-account.show_event_body', $this->data);

    }//getMessageBody

    //поиск сообщения
    public function searchMessage(Message $dataFile){

        if(!isset($_GET["filename"]) || empty($_GET["filename"])){
            return "Укажите название отчета!";
        }

        try {

            $filename = '%'.$_GET["filename"].'%';
            $this->data["message"] = $dataFile->searchMessages($filename);

            if(count($this->data["message"]) == 0) return "Данные не найдены!";
            return view('my-account.show_search_messages', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//searchFile

    //показать прочитанные события
    public function searchReadEvents(EventByUser $event){

        $this->data["event"] = $event->getAllReadEvents();

        return view('my-account.show_search_events', $this->data);

    }//searchReadEvents

    //показать не прочитанные события
    public function searchNoReadEvents(EventByUser $event){

        $this->data["event"] = $event->getAllNonReadEvents();

        return view('my-account.show_search_events', $this->data);

    }//searchReadEvents

    //поиск события
    public function searchEvent(EventByUser $byUser, Event $event){

        if(!isset($_GET["filename"]) || empty($_GET["filename"])){
            return "Укажите название события!";
        }

        try {

            $filename = '%'.$_GET["filename"].'%';
            $events = $event->searchEvents($filename);

//var_dump($events);

            if(count($events) == 0) return "Данные не найдены!";

            $event_by_user = $byUser->getAllEvents();

//var_dump($event_by_user);

            $result = array();
            foreach ($events as $item){

                foreach($event_by_user as $temp){
                    if($item->id == $temp->event_id){
                        $result[]=$temp;
                    }
                }

            }

            if(count($result) == 0) return "Данные не найдены!";

            $this->data["event"] = $result;

//var_dump($this->data["event"]);

            return view('my-account.show_search_events', $this->data);
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//searchFile

    //показать прочитанные сообщения
    public function searchReadMessages(Message $message){

        $this->data["message"] = $message->getAllReadMessages();

        return view('my-account.show_search_messages', $this->data);

    }//searchReadEvents

    //показать не прочитанные сообщения
    public function searchNoReadMessages(Message $message){

        $this->data["message"] = $message->getAllNonReadMessages();

        return view('my-account.show_search_messages', $this->data);

    }//searchReadEvents



    /**
     * Запись данных о отчете в базу
     * @param $directory - директория
     * @param $filename - имя файла
     * @param $create_time - время создания
     * @param $user_id - id пользователя
     * @param $service_id - id сервиса
     */
    private function writeRowInTableOrder($directory, $filename, $create_time, $user_id, $service_id, $project_id) {

        try {
            $row = new Order();

            $row->directory = $directory;
            $row->filename = $filename;
            $row->create_time = $create_time;
            $row->user_id = $user_id;
            $row->service_id = $service_id;
            $row->project_id = $project_id;
            $row->save();
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//writeRowInTable

    // рандомизировать микросекундами
    private function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }//make_seed()

    /**
     * Создание файла отчета
     * @param $data
     * @param $all_filename
     */
    private function createFileOrder($data, $all_filename){

        //открываем файл на дописывание
        $fp = fopen($all_filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем пользователя
        $info = ["Пользователь :", Auth::check()?Auth::user()->name : "Гость"];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем количество файлов
        $info = ["Файлов в отчете :", count($data)];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["Данные о созданных файлах : "];
        @fputcsv($fp,  $info);

        $count = 1;
        //записываем данные о файлах
        foreach ($data as $file){

            $info = [$count, $file->filename, $file->service->title, $file->project->title, $file->create_time, $file->created_at,
                    "http://service.local:8000".DIRECTORY_SEPARATOR.$file->directory.DIRECTORY_SEPARATOR.$file->filename];
            @fputcsv($fp,  $info);

            $count++;
        }//foreach

        //закрываем файл
        fclose($fp);

    }//createFileOrder




}//class
