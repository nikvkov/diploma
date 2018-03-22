<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected  $table = 'subscribers';

    //получаем почту подписчиков
    public function getAllEmails(){

        //  return $this::where(['active' => '1', 'position' => 'left'])->get();
        return $this -> orderBy('email') -> get();

    }//getEmails()

}//class
