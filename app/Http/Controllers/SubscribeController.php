<?php

namespace App\Http\Controllers;

use App\PersonData;
use Auth;
use Illuminate\Http\Request;
use App\Subscriber;
use Log;
use Mockery\Exception;


class SubscribeController extends MainController
{

    //получение все email подписчиков
    public function getAllEmails(){

        $subscriber = new Subscriber();

        $emails = $subscriber->getEmails();

        foreach ($emails as $mail){
            echo $mail->email."<br/>";
        }

    }//getAllEmails

    //добавление нового email
    function addNewEmail($email){

        try {
            $subscriber = new Subscriber();
            $subscriber->email = $email;
            $res = $subscriber->save();
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//addNewEmail

    //добавление данных пользователя
    function addUserAdditionalData(){


        $tel = isset($_GET["tel"])?$_GET["tel"]:"";
        $skype = isset($_GET["skype"])?$_GET["skype"]:"";
        $country = isset($_GET["country"])?$_GET["country"]:"";
        $city = isset($_GET["city"])?$_GET["city"]:"";
        $b_date = isset($_GET["b_date"])?$_GET["b_date"]:"";

        //если записи нет - то делаем новую запись
        if(empty(Auth::user()->person)) {
            self::writeRowInTablePersonData(Auth::user()->id, $tel, $skype, $country, $city, $b_date);
        }else{
            //иначе обновляем
            self::updatePersonData($tel, $skype, $country, $city, $b_date);
        }

        $this->data["user"] = Auth::user();
        return view('my-account.person', $this->data);

    }//createAdditionalData

    public function testUser(){

        $temp = view('welcome', $this->data);
        echo $temp;

        exit();
    }

    //записываем данные о пользователе
    private function writeRowInTablePersonData($user_id, $tel, $skype, $country, $city, $b_date) {

        try {
            $row = new PersonData();

            $row->user_id = $user_id;
            $row->tel = $tel;
            $row->skype = $skype;
            $row->country = $country;
            $row->city = $city;
            $row->birth_date = $b_date;
            $row->save();
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//writeRowInTable

    //обновляем данные о пользователе
    private function updatePersonData( $tel, $skype, $country, $city, $b_date) {

        try {

            $row = Auth::user()->person;
            $row->tel = $tel;
            $row->skype = $skype;
            $row->country = $country;
            $row->city = $city;
            $row->birth_date = $b_date;
            $row->save();
        }catch (Exception $ex){
            Log::error($ex->getMessage()." || ".$ex->getTraceAsString());
        }

    }//writeRowInTable

}//class
