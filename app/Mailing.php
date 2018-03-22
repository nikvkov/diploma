<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{

    protected  $table = 'mailings';

    /********Для админа********/
    public function allByDesc(){
        return $this ->latest()->get();
    }

    //получить данные по дням
    function getDataForDays(){
        return  DB::select("select sum(num) as 'number', DATE(created_at) as 'day' from mailings GROUP BY DATE(created_at)" );
    }

    //получить все cообщения
    public function getById($id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> byid($id)->firstOrFail();

    }//getAllNonReadMessages


    /***Заготовки*/
    public function scopeByid($query, $id){
        $query->where(['id' => $id]);
    }

}//Mailing
