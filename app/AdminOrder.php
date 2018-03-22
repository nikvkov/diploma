<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminOrder extends Model
{
    protected  $table = 'admin_orders';

    public function typeOrder(){
        return $this->belongsTo('App\TypeOrder');
    }

    //получить данные по дням
    function getDataForDays(){
        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from admin_orders GROUP BY DATE(created_at)" );
    }

    //получить данные по типам
    function getDataForType(){
        return  DB::select("select count(id) as 'num', type_order_id  from admin_orders GROUP BY type_order_id" );
    }

    //получить все файлы пользователя
    public function getAllOrdersForAdmin(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> latest() -> get();

    }//getAllFiles

}
