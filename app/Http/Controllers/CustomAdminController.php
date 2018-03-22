<?php

namespace App\Http\Controllers;

use App\AdminOrder;
use App\DataFile;
use App\Mail\AdminMessageMail;
use App\Mail\SubscribersMail;
use App\Mailing;
use App\Message;
use App\Order;
use App\Project;
use App\Service;
use App\Subscriber;
use App\TypeOrder;
use App\User;
use Auth;
use DateTime;
use Illuminate\Http\Request;
use Log;
use Mail;
use Mockery\Exception;

class CustomAdminController extends MainController
{
    //показать все сообщения
    public function showAllMessages(User $user, Message $message){

        $this->data["messages"]=$message;
        $this->data["users"]=$user;
        $this->data["messages_pagginate"]=$message->getAllPagginate(5);

        return view('administrator.archive_messages', $this->data);

    }//showAllMessages

    //показать сообщения по пользователю
    public function showMessagesByUser($user_id, Message $message){

        if(!isset($user_id) || empty($user_id)){return "Нет данных пользователя!<br/>";}

        $this->data["messages"] = $message->getMessagesByUser($user_id);

        return view('partials.administrator.messages_by_user', $this->data);
    }//showMessagesByUser

    //показать текущее сообщение
    public function showCurrentMessage($message_id, Message $message){

        $current_message = $message->getById($message_id);

        return $current_message->content;

    }//showCurrentMessage

    //удалить текущее сообщение
    public function deleteCurrentMessage($message_id, Message $message){

     //   $current_message = $message->getById($message_id);
     //   $current_message->delete();
        $message->destroy($message_id);

        $this->data["messages"] = $message->allByDesc();

        return view('partials.administrator.messages_by_user', $this->data);

    }//showCurrentMessage

    //удалить выделенные сообщения
    public function deleteSelectedMessages(Message $message){

        if(!isset($_GET["messages"])) return "Ошибка удаления";

        $messages = json_decode($_GET["messages"]);

        foreach ($messages as $item){
            $message->destroy($item);
        }

        $this->data["messages"] = $message->allByDesc();

        return view('partials.administrator.messages_by_user', $this->data);

    }//deleteSelectedMessages

    //создать новое сообщение
    public function createNewMessage(User $user, Message $message){

        $this->data["messages"]=$message;
        $this->data["users"]=$user;
       // $this->data["messages_pagginate"]=$message->getAllPagginate(5);

        return view('administrator.create_new_message', $this->data);

    }//createNewMessage

    //отправить сообщение пользовалелю
    public function sendMessageToUser(User $user){

        if(!isset($_GET["title"]) || !isset($_GET["content"]) || !isset($_GET["user_id"]) ){
            throw new Exception();
        }

        $title = $_GET["title"];
        $content = $_GET["content"];
        $user_id = $_GET["user_id"];
        $is_need_email = $_GET["is_need_email"];

        $this->data["title"] = $title;
        $this->data["content"] = $content;

        //запись о сообщени в базу
        self::writeRowInMessages(0,
            $title,
            view('orders.adminMessage', $this->data),
            $user_id);

        //отправка email сообщения
        if($is_need_email ){
            //отправляем уведомление на почту

            $email = $user->getById($user_id)->email;
            Mail::to($email)->send(new AdminMessageMail($title, $content));


        }//if


    }//sendMessageToUser

    //отправить сообщение выбранным пользователям
    public function sendMessageToSelectedUsers(User $user){

        if(!isset($_GET["title"]) || !isset($_GET["content"]) || !isset($_GET["users_id"]) ){
            throw new Exception();
        }

        $title = $_GET["title"];
        $content = $_GET["content"];
        $users_id = json_decode($_GET["users_id"]);
        $is_need_email = $_GET["is_need_email"];

        $this->data["title"] = $title;
        $this->data["content"] = $content;

        foreach ($users_id as $user_id) {
            //запись о сообщени в базу
            self::writeRowInMessages(0,
                $title,
                view('orders.adminMessage', $this->data),
                $user_id);

            //отправка email сообщения
            if ($is_need_email) {
                //отправляем уведомление на почту

                $email = $user->getById($user_id)->email;
                Mail::to($email)->send(new AdminMessageMail($title, $content));


            }//if
        }

    }//sendMessageToSelectedUsers

    //создать отчет по сообщениям пользователя
    public function createOrderMessageToUser($user_id, Message $message, User $user){

        if(!isset($user_id)) return "Нет данных о пользователе";


        //получаем пользователя по id
        $current_user = $user->getById($user_id);

        if(count($message->getMessagesByUser($user_id))==0) return "У пользователя нет сообщений";

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/messages";
        $file = "(".date("d_M_Y").")".rand()."_".$current_user->name.".csv";

        $filename = $dir."/".$file;

        //записываем данные в файл
        self::createFileOrderForCurrentUserMessages($filename, $current_user, $message);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 3);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderMessageToUser

    //создать отчеты по выделенным пользователям
    function createOrderMessageToSelectedUsers(Message $message, User $user){

        if(!isset($_GET["users_id"])) return "Невозможно получить данные";

        //получаем идентификаторы пользователей
        $users_id = json_decode($_GET["users_id"]);

        //формируем строку для запроса
        $query_users = implode(',',$users_id);

        $data = $message->getMessagesByManyUser($query_users);
        if(count($data)==0) return "У пользователей нет сообщений";

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/messages";
        $file = "(".date("d_M_Y").")".rand()."_many_users.csv";

        $filename = $dir."/".$file;

        //записываем данные в файл
        self::createFileOrderForManyUsersMessages($filename, $query_users, $message, $user);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 3);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);



    }//createOrderMessageToSelectedUsers

    //показать страницу новой рассылки
    function createNewMailing(Subscriber $subscriber){

        $this->data["subscriber"]=$subscriber;

        return view('administrator.create_new_mailing', $this->data);
    }//createNewMailing

    //начало рассылки
    function startMailing(Subscriber $subscriber){

        if(!isset($_GET["title"]) || !isset($_GET["content"]) || !isset($_GET["emails"])) throw new Exception();

        if(empty($_GET["title"]) || empty($_GET["content"]) || empty($_GET["emails"]) ) throw new Exception();

        $title = $_GET["title"];
        $content = $_GET["content"];
        $emails = json_decode($_GET["emails"]);

        $this->data["title"] = $title;
        $this->data["content"] = $content;

        //отправляем уведомление на почту
        foreach ($emails as $item) {
            $email = $item;
            Mail::to($email)->send(new SubscribersMail($title, $content));

        }//foreach

        //запись о сообщени в базу
        self::writeRowInMailings(
            $title,
            view('orders.mailing', $this->data),
            count($emails)
            );


    }//startMailing

    //показать архив сообщений
    function archiveMailing(Mailing $mailing){

        $this->data["mailing"]=$mailing;

        return view('administrator.archive_mailing', $this->data);

    }//archiveMailing

    //показать текущее сообщение
    public function showCurrentMailing($mailing_id, Mailing $mailing){

        $current_message = $mailing->getById($mailing_id);

        return $current_message->content;

    }//showCurrentMessage

    //удалить текущее сообщение
    public function deleteCurrentMailing($mailing_id, Mailing $mailing){

        //   $current_message = $message->getById($message_id);
        //   $current_message->delete();
        $mailing->destroy($mailing_id);

        $this->data["mailing"] = $mailing;

        return view('partials.administrator.all_mailing', $this->data);

    }//showCurrentMessage

    //удалить выделенные рассылки
    public function deleteSelectedMailngs(Mailing $mailing){

        if(!isset($_GET["mailings"])) return "Ошибка удаления";

        $mailings = json_decode($_GET["mailings"]);

        foreach ($mailings as $item){
            $mailing->destroy($item);
        }

        $this->data["mailings"] = $mailing->allByDesc();

        return view('partials.administrator.all_mailing', $this->data);

    }//deleteSelectedMessages

    //создать отчет по текущей рассылке
    public function createOrderCurrentMailing($mailing_id, Mailing $mailing){

        if(!isset($mailing_id)) return "Ошибка создания";

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/mailings";
        $file = "(".date("d_M_Y").")".rand()."_mailing.csv";

        $filename = $dir."/".$file;
        $mailings_id[] = $mailing_id;

        //записываем данные в файл
        self::createFileOrderForCurrentMailing($filename, $mailings_id, $mailing);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 2);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderCurrentMailing

    //отчет по выделенным рассылкам
    public function createOrderSelectedMailing(Mailing $mailing){

        if(!isset($_GET["mailings_id"])) return "Ошибка создания";

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/mailings";
        $file = "(".date("d_M_Y").")".rand()."_mailing.csv";

        $filename = $dir."/".$file;
        $mailings_id = json_decode($_GET["mailings_id"]);

        //записываем данные в файл
        self::createFileOrderForCurrentMailing($filename, $mailings_id, $mailing);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 2);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderSelectedMailing

    //показать страницу пользователя
    public function showUserPage(User $user, DataFile $datafile){

        $this->data["users"]=$user;
        $this->data["datafile"]=$datafile;

         return view('administrator.users_page', $this->data);

    }//showUserPage

    //статистика создания файлов
    public function createOrderStatFiles(User $user, DataFile $dataFile, Project $project, Service $service){

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/users/files";
        $file = "(".date("d_M_Y").")".rand()."_stat_by_create_files.csv";

        $filename = $dir."/".$file;

        //записываем данные в файл
        self::createOrderByCreateFilesForAllUser($filename, $user, $dataFile, $project, $service);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 8);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderStatFiles

    //статистика создания отчетов
    public function createOrderStatOrders(User $user, Order $order, Project $project, Service $service){

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/users/orders";
        $file = "(".date("d_M_Y").")".rand()."_stat_by_create_orders.csv";

        $filename = $dir."/".$file;

        //записываем данные в файл
        self::createOrderByCreateOrdersForAllUser($filename, $user, $order, $project, $service);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 10);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderStatFiles

    //статистика создания соощений
    public function createOrderStatMessages(User $user, Message $message, Project $project, Service $service){

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/users/messages";
        $file = "(".date("d_M_Y").")".rand()."_stat_by_create_messages.csv";

        $filename = $dir."/".$file;

        //записываем данные в файл
        self::createOrderByCreateMessagesForAllUser($filename, $user, $message, $project, $service);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 9);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderStatFiles

    //статистика времени создания файлов
    public function createOrderStatCreatedTime(User $user, DataFile $dataFile){

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/users/creating_time";
        $file = "(".date("d_M_Y").")".rand()."_stat_by_creating_time.csv";

        $filename = $dir."/".$file;

        //записываем данные в файл
        self::createOrderByCreatingTimeForAllUser($filename, $user, $dataFile);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 5);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderStatFiles

    //статистика потекущему пользователю
    public function createOrderByCurrentUser($user_id, User $user, DataFile $dataFile, Order $order, Message $message, Project $project, Service $service){

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/users/current";
        $file = "(".date("d_M_Y").")".rand()."_stat_by_current_user.csv";

        $filename = $dir."/".$file;

        //записываем данные в файл
        self::createOrderByUserId($user_id, $filename, $user, $project, $service);

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 7);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderStatFiles

    //отчет по всем пользователям
    function createOrderBySelectedUsers(User $user, Project $project, Service $service){

        if(!isset($_GET["users_id"])) throw new Exception();

        $users_id = json_decode($_GET["users_id"]);

        //составляем имя файла отчета
        //смена числа генератора
        srand(self::make_seed());
        $dir = "uploads/admin/orders/users/current";
        $file = "(".date("d_M_Y").")".rand()."_stat_by_current_user.csv";

        $filename = $dir."/".$file;

        foreach ($users_id as $user_id) {
            //записываем данные в файл
            self::createOrderByUserId($user_id, $filename, $user, $project, $service);
        }

        //запись строки в базу отчетов админа
        self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 7);

        $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);

    }//createOrderBySelectedUsers

    //получить статистику по текущему пользователю
    function getStatByCurrentUser($user_id, User $user, DataFile $dataFile, Order $order, Message $message){

        //получаем пользователя по id
        $this->data["current_user"] = $user->getById($user_id);
        $this->data["messages"] = $message->getDataForDaysByUser($user_id);
        $this->data["orders"] = $order->getDataForDaysByUser($user_id);
        $this->data["files"] = $dataFile->getDataForDaysByUser($user_id);

       // dd($this->data["files"]);
        return view('administrator.show_stat_message', $this->data);

    }//getStatByCurrentUser

    //статистика по выделенным пользователям
    function getStatBySelectedUser( User $user, DataFile $dataFile, Order $order, Message $message){

        if(!isset($_GET["users_id"])) return "Нет данных о пользователях!";

        $rows_id = implode(',', json_decode($_GET["users_id"]));

        //dd($rows_id);
        //получаем пользователя по id
        $this->data["messages"] = $message->getDataForDaysBySelectedUser($rows_id);
        $this->data["orders"] = $order->getDataForDaysBySelectedUser($rows_id);
        $this->data["files"] = $dataFile->getDataForDaysBySelectedUser($rows_id);

        //dd($this->data["files"]);
        return view('administrator.show_stat_message', $this->data);

    }//getStatBySelectedUser

    //показать страницу файлов
    public function showFilesPage( DataFile $datafile, User $user){

        $this->data["datafile"]=$datafile;
        $this->data["user"]=$user;
        return view('administrator.files_page', $this->data);

    }//showUserPage

    //статистика по выделенным пользователям
    function createOrderBySelectedFiles( User $user, DataFile $dataFile){
        //Log::error($_GET["files_id"]);
        try {
            if (!isset($_GET["files_id"])) return "Нет данных о файлах!";

            $rows_id = implode(',', json_decode($_GET["files_id"]));


            //получаем пользователя по id

            $this->data["files"] = $dataFile;

//dd($rows_id);
            //составляем имя файла отчета
            //смена числа генератора
            srand(self::make_seed());
            $dir = "uploads/admin/orders/files";
            $file = "(" . date("d_M_Y") . ")" . rand() . "_stat_by_selected_files.csv";

            $filename = $dir . "/" . $file;


            //записываем данные в файл
            self::writeOrderBySelectedFiles($filename, $dataFile, $rows_id, $user);

            //запись строки в базу отчетов админа
            self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 1);

            $this->data["filename"] = $filename;

        return view('administrator.download_file', $this->data);
        }
        catch (Exception $ex){

            return $ex->getMessage()."|||".$ex->getTraceAsString();

        }
    }//getStatBySelectedUser

    //показать страницу отчетов пользователя
    function showUserOrdersPage(User $user, Order $order){

        $this->data["order"]=$order;
        $this->data["user"]=$user;
        return view('administrator.user_orders_page', $this->data);

    }//User $user, DataFile $dataFile

    //статистика по выделенным отчетам пользователям
    function createOrderBySelectedUserOrders( User $user, Order $order){
        //Log::error($_GET["files_id"]);
        try {
            if (!isset($_GET["files_id"])) return "Нет данных о файлах!";

            $rows_id = implode(',', json_decode($_GET["files_id"]));


            //получаем пользователя по id

            $this->data["order"] = $order;

//dd($rows_id);
            //составляем имя файла отчета
            //смена числа генератора
            srand(self::make_seed());
            $dir = "uploads/admin/orders/orders";
            $file = "(" . date("d_M_Y") . ")" . rand() . "_stat_by_selected_user_orders.csv";

            $filename = $dir . "/" . $file;


            //записываем данные в файл
            self::writeOrderBySelectedUserOrders($filename, $order, $rows_id, $user);

            //запись строки в базу отчетов админа
            self::writeRowInTableAdminOrder($dir, $file, Auth::user()->id, 4);

            $this->data["filename"] = $filename;

            return view('administrator.download_file', $this->data);
        }
        catch (Exception $ex){

            return $ex->getMessage()."|||".$ex->getTraceAsString();

        }
    }//getStatBySelectedUser

    //показать страницу отчетов пользователя
    function showAdminOrdersPage(User $user, AdminOrder $order, TypeOrder  $typeOrder){

        $this->data["order"]=$order;
        $this->data["user"]=$user;
        $this->data["type_order"]=$typeOrder;
        return view('administrator.admin_orders_page', $this->data);

    }//User $user, DataFile $dataFile

    /**
     * Запись нового сообщения в базу
     * @param $read
     * @param $title
     * @param $content
     * @param $user_id
     */
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

    // рандомизировать микросекундами
    private function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }//make_seed()

    /**
     * Создание файла отчета по сообщениям пользователя
     * @param $filename - имя файла
     * @param $current_user - текущий пользователь
     * @param $user_messages - сообщения пользователя
     */
    private function createFileOrderForCurrentUserMessages($filename, $current_user, $message){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем пользователя
        $info = ["Пользователь :", $current_user->name];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем общее количество сообщений
        $info = ["Всего сообщений :", count($message->getMessagesByUser($current_user->id))];
        //записываем строку
        @fputcsv($fp,  $info);

        //Всего прочитанных
        $info = ["Всего прочитанных сообщений :", count($message->getReadMessagesByUser($current_user->id))];
        //записываем строку
        @fputcsv($fp,  $info);

        //Всего не прочитанных
        $info = ["Всего не прочитанных сообщений :", count($message->getNoReadMessagesByUser($current_user->id))];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СООБЩЕНИЯХ : "];
        @fputcsv($fp,  $info);

        $count = 1;
        //записываем данные о файлах
        foreach ($message->getMessagesByUser($current_user->id) as $row){

            $info = [$count, $row->title, $row->read, (new DateTime($row->created_at))->format('F j, Y')];
            @fputcsv($fp,  $info);

            $count++;
        }//foreach

        //закрываем файл
        fclose($fp);

    }//createFileOrder

    /**
     * Создание файла отчета по сообщениям нескольких пользователей
     * @param $filename
     * @param $query_users
     * @param $message
     * @param $user
     */
    private function createFileOrderForManyUsersMessages($filename, $query_users, $message, $user){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем пользователя
        $info = ["Пользователи :", $query_users];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем общее количество сообщений
        $info = ["Всего сообщений :", count($message->getMessagesByManyUser($query_users))];
        //записываем строку
        @fputcsv($fp,  $info);

        //Всего прочитанных
        $info = ["Всего прочитанных сообщений :", count($message->getReadMessagesByManyUser($query_users))];
        //записываем строку
        @fputcsv($fp,  $info);

        //Всего не прочитанных
        $info = ["Всего не прочитанных сообщений :", count($message->getNoReadMessagesByManyUser($query_users))];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СООБЩЕНИЯХ : "];
        @fputcsv($fp,  $info);

        $count = 1;
        //записываем данные о файлах
        foreach ($message->getMessagesByManyUser($query_users) as $row){

            $info = [$count, $row->title, $row->read, (new DateTime($row->created_at))->format('F j, Y'), $user->getById($row->user_id)->name];
            @fputcsv($fp,  $info);

            $count++;
        }//foreach

        //закрываем файл
        fclose($fp);

    }//createFileOrder

    /**
     * Запись о рассылке в базу
     * @param $title
     * @param $content
     */
    private function writeRowInMailings($title, $content, $count) {

        try {
            $row = new Mailing();

            $row->title = $title;
            $row->content = $content;
            $row->num = $count;

            $row->save();
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//writeRowInTable

    /**
     * Создание файла отчета по текущей рассылке
     * @param $filename - имя файла
     * @param $mailings_id- ид рассылок
     * @param $mailing - класс
     */
    private function createFileOrderForCurrentMailing($filename,$mailings_id, $mailing){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СООБЩЕНИЯХ : "];
        @fputcsv($fp,  $info);

        $info = ["№","Title", "Count", "Date"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($mailings_id as $id) {
            $current_mailing = $mailing;
            $info = [$count, $current_mailing->title, $current_mailing->num, (new DateTime($current_mailing->created_at))->format('F j, Y')];
            @fputcsv($fp, $info);
            $count++;
        }
        //закрываем файл
        fclose($fp);

    }//createFileOrder

    /**
     * Создание отчета по созданию файлов по пользователям
     * @param $filename - имя файла
     * @param $user - пользователь
     * @param $dataFile - файл
     * @param $project - проект
     * @param $service - сервис
     */
    function createOrderByCreateFilesForAllUser($filename, $user, $dataFile , $project, $service){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
//        $info = ["Всего пользователей :", count($user->all())];
//        //записываем строку
//        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего файлов в отчете :", count($dataFile->all())];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ ФАЙЛАХ : "];
        @fputcsv($fp,  $info);

        $info = ["№","Пользователь", "Файл", "Время создания","Размер", "Проект", "Сервис", "Дата создания", "Ссылка"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($dataFile->all() as $file) {

            $info = [$count,
                     ($user->getById($file->user_id))->name,
                     $file->filename,
                     $file->creat_time,
                     $file->size,
                     $project->getById($file->project_id)->title,
                     $service->getById($file->service_id)->title,
                     (new DateTime($file->created_at))->format('F j, Y'),
                     "http://service.local:8000/".$file->directory."/".$file->filename
                     ];
            @fputcsv($fp, $info);
            $count++;
        }
        //закрываем файл
        fclose($fp);

    }//createOrderByCreateFilesForAllUser($filename, $user, $dataFile);

    /**
     * Создание отчета по созданию отчетов
     * @param $filename - имя файла
     * @param $user - пользователь
     * @param $order - отчет
     * @param $project - проект
     * @param $service - сервис
     */
    function createOrderByCreateOrdersForAllUser($filename, $user, $order, $project, $service){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
//        $info = ["Всего пользователей :", count($user->all())];
//        //записываем строку
//        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего файлов в отчете :", count($order->all())];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ ОТЧЕТАХ : "];
        @fputcsv($fp,  $info);

        $info = ["№","Пользователь", "Отчет","Время создания", "Проект", "Сервис", "Дата создания", "Ссылка"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($order->all() as $file) {

            $info = [$count,
                ($user->getById($file->user_id))->name,
                $file->filename,
                $file->create_time,
                $file->project_id==0?"Все": $project->getById($file->project_id)->title,
                $file->service_id==0?"Все":$service->getById($file->service_id)->title,
                (new DateTime($file->created_at))->format('F j, Y'),
                "http://service.local:8000/".$file->directory."/".$file->filename
            ];
            @fputcsv($fp, $info);
            $count++;
        }
        //закрываем файл
        fclose($fp);

    }//createOrderByCreateFilesForAllUser($filename, $user, $dataFile);

    /**
     * Создание отчета по созданию сообщений
     * @param $filename - имя файла
     * @param $user - пользователь
     * @param $message - сообщение
     * @param $project - проект
     * @param $service - сервис
     */
    function createOrderByCreateMessagesForAllUser($filename, $user, $message, $project, $service){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
//        $info = ["Всего пользователей :", count($user->all())];
//        //записываем строку
//        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего файлов в отчете :", count($message->all())];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ СООБЩЕНИЯХ: "];
        @fputcsv($fp,  $info);

        $info = ["№","Пользователь", "Сообщение", "Прочитано", "Дата создания"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($message->all() as $file) {

            $info = [$count,
                ($user->getById($file->user_id))->name,
                 $file->title,
                 $file->read,
                (new DateTime($file->created_at))->format('F j, Y')

            ];
            @fputcsv($fp, $info);
            $count++;
        }
        //закрываем файл
        fclose($fp);

    }//createOrderByCreateFilesForAllUser($filename, $user, $dataFile);

    /**
     * Создание отчета по времени создания файлов
     * @param $filename - имя файла
     * @param $user - пользователь
     * @param $message - сообщение
     * @param $project - проект
     * @param $service - сервис
     */
    function createOrderByCreatingTimeForAllUser($filename, $user, $dataFile){

        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
//        $info = ["Всего пользователей :", count($user->all())];
//        //записываем строку
//        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Общее время работы сервиса :", count($dataFile->getAllCreateTime())];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Общий размер созданных данных :", count($dataFile->getAllSize())];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["Данные времени работы по пользователям: "];
        @fputcsv($fp,  $info);

        $info = ["№","Пользователь", "Время работы", "Размер созданных данных"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($user->all() as $user) {

            $info = [$count,
                $user->name,
                $dataFile->getCreateTimeFilesAtUser($user->id),
                $dataFile->getSizeFilesAtUser($user->id),

            ];
            @fputcsv($fp, $info);
            $count++;
        }
        //закрываем файл
        fclose($fp);

    }//createOrderByCreateFilesForAllUser($filename, $user, $dataFile);

    /**
     * отчет по id пользователя
     * @param $user_id -id пользователя
     * @param $filename - имя файла
     * @param $user - пользователь
     * @param $project - проект
     * @param $service - сервис
     */
    function  createOrderByUserId($user_id, $filename, $user, $project, $service){


        //открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        $cur_user = $user->getById($user_id);

        //записываем дату и время создания
        $info = ["Отчет по пользователю :", $cur_user->name];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего файлов :", count($cur_user->files)];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего отчетов :", count($cur_user->orders)];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего сообщений :", count($cur_user->messages)];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Данные пользователя :"];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Email","Телефон","Skype", "Дата рождения","Страна","Город"];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = [$cur_user->email,
                  isset($cur_user->person)?$cur_user->person->tel:"-",
                  isset($cur_user->person)?$cur_user->person->skype:"-",
                  isset($cur_user->person)?   (new DateTime($cur_user->person->birth_date))->format('F j, Y'):"-",
                  isset($cur_user->person)?$cur_user->person->country:"-",
                  isset($cur_user->person)?$cur_user->person->city:"-",
                ];
        //записываем строку
        @fputcsv($fp,  $info);

        @fputcsv($fp,  ['']);

        //записывем данные о файлах
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ ФАЙЛАХ : "];
        @fputcsv($fp,  $info);

        $info = ["№", "Файл", "Время создания","Размер", "Проект", "Сервис", "Дата создания", "Ссылка"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($cur_user->files as $file) {

            $info = [$count,

                $file->filename,
                $file->creat_time,
                $file->size,
                $project->getById($file->project_id)->title,
                $service->getById($file->service_id)->title,
                (new DateTime($file->created_at))->format('F j, Y'),
                "http://service.local:8000/".$file->directory."/".$file->filename
            ];
            @fputcsv($fp, $info);
            $count++;
        }
        @fputcsv($fp,  ['']);

        //записываем данные об отчетах
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ ОТЧЕТАХ : "];
        @fputcsv($fp,  $info);

        $info = ["№", "Файл", "Время создания","Размер", "Проект", "Сервис", "Дата создания", "Ссылка"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($cur_user->orders as $file) {

            $info = [$count,

                $file->filename,
                $file->create_time,
                $file->project_id==0?"Все": $project->getById($file->project_id)->title,
                $file->service_id==0?"Все":$service->getById($file->service_id)->title,
                (new DateTime($file->created_at))->format('F j, Y'),
                "http://service.local:8000/".$file->directory."/".$file->filename
            ];
            @fputcsv($fp, $info);
            $count++;
        }
        @fputcsv($fp,  ['']);

        //записывем данные о сообщениях
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ СООБЩЕНИЯХ: "];
        @fputcsv($fp,  $info);

        $info = ["№","Сообщение", "Прочитано", "Дата создания"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($cur_user->messages as $file) {

            $info = [$count,

                $file->title,
                $file->read,
                (new DateTime($file->created_at))->format('F j, Y')

            ];
            @fputcsv($fp, $info);
            $count++;
        }
        @fputcsv($fp,  ['']);

        //закрываем файл
        fclose($fp);


    }//createOrderByUserId

    /***
     * отчет по созданным файлам
     * @param $filename - имя файла
     * @param $dataFile - файл
     * @param $rows_id - строка с id файлов
     * @param $user - пользователь
     */
    function writeOrderBySelectedFiles($filename, $dataFile, $rows_id, $user){

//открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего файлов в отчете :", count($dataFile->getDataForSelectedFiles($rows_id))];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем общий размер файлов
        $info = ["Общий размер файлов :",$dataFile->getSizeForSelectedFiles($rows_id), "байт"];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем общее время создания
        $info = ["Общий размер файлов :",$dataFile->getCreateTimeForSelectedFiles($rows_id), "сек"];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ ФАЙЛАХ : "];
        @fputcsv($fp,  $info);

        $info = ["№","Пользователь", "Файл", "Время создания","Размер", "Проект", "Сервис", "Дата создания", "Ссылка"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($dataFile->getDataForSelectedFiles($rows_id) as $file) {

            $info = [$count,
                ($user->getById($file->user_id))->name,
                $file->filename,
                $file->creat_time,
                $file->size,
                $file->project->title,
                $file->service->title,
                (new DateTime($file->created_at))->format('F j, Y'),
                "http://service.local:8000/".$file->directory."/".$file->filename
            ];
            @fputcsv($fp, $info);
            $count++;
        }
        //закрываем файл
        fclose($fp);

    }//writeOrderBySelectedFiles($filename, $dataFile, $user)

    /***
     * отчет по созданным отчетам пользователя
     * @param $filename - имя файла
     * @param $order - отчтет
     * @param $rows_id - строка с id файлов
     * @param $user - пользователь
     */
    function writeOrderBySelectedUserOrders($filename, $order, $rows_id, $user){

//открываем файл на дописывание
        $fp = fopen($filename, 'a');

        //pfgbcsdftv BOM
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        //записываем дату и время создания
        $info = ["Дата :", date("F j, Y, g:i a")];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем дату и время создания
        $info = ["Всего файлов в отчете :", count($order->getDataForSelectedOrders($rows_id))];
        //записываем строку
        @fputcsv($fp,  $info);

        //записываем общее время создания
        $info = ["Общее время создания :",$order->getCreateTimeForSelectedOrders($rows_id), "сек"];
        //записываем строку
        @fputcsv($fp,  $info);

        //записывем общие данные
        $info = ["ПОДРОБНЫЕ ДАННЫЕ О СОЗДАННЫХ ОТЧЕТАХ : "];
        @fputcsv($fp,  $info);

        $info = ["№","Пользователь", "Файл", "Время создания", "Проект", "Сервис", "Дата создания", "Ссылка"];
        @fputcsv($fp,  $info);

        $count=1;
        foreach ($order->getDataForSelectedOrders($rows_id) as $file) {

            $info = [$count,
                ($user->getById($file->user_id))->name,
                $file->filename,
                $file->creat_time,
                $file->project_id==0?"Все":$file->project->title,
                $file->service_id==0?"Все":$file->service->title,
                (new DateTime($file->created_at))->format('F j, Y'),
                "http://service.local:8000/".$file->directory."/".$file->filename
            ];
            @fputcsv($fp, $info);
            $count++;
        }
        //закрываем файл
        fclose($fp);

    }//writeOrderBySelectedFiles($filename, $dataFile, $user)

    /**
     * Запись данных о отчете админа в базу
     * @param $directory - директория
     * @param $filename - имя файла
     * @param $user_id - id пользователя
     * @param $type_order_id - id типа отчета
     */
    private function writeRowInTableAdminOrder($directory, $filename, $user_id, $type_order_id) {

        try {
            $row = new AdminOrder();

            $row->directory = $directory;
            $row->filename = $filename;
            $row->user_id = $user_id;
            $row->type_order_id = $type_order_id;
            $row->save();
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//writeRowInTable



}//class
