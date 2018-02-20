<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $table = 'orders';

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    //получить все файлы пользователя
    public function getAllOrders(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> foruser() -> get();

    }//getAllFiles

    //получить все файлы пользователя
    public function getAllOrdersForAdmin(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> get();

    }//getAllFiles

    public function getOrdersForProject($project_id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> foruser() ->forproject($project_id) -> get();

    }//getOrderForProject

    public function getOrderForService($service_id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> foruser() ->forservice($service_id) -> get();

    }//getOrderForProject

    //поиск файла
    public function searchOrders($filename){

        // return $this -> orderBy('filename') -> foruser() ->searchbyfilename($filename) -> get();
        return $this::whereRaw('user_id = ? and filename LIKE ?', [Auth::user()->id, $filename])->latest()->get();

    }//searchFiles

    //среднее время создания
    public function getAvgCreateTime(){

        return $this->foruser()->avg('create_time');

    }

    //среднее время создания
    public function getSumCreateTime(){

        return $this->foruser()->sum('create_time');

    }

    //дата последнего составления
    public function getLastTime(){

        return $this->foruser()->max('created_at');

    }

    //получить все cообщения
    public function getOrdersAtDate(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->currentDate()->get();

    }//getAllNonReadMessages

    //Размер файлов созданных сегодня
    public function getSizeOrdersAtDate(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->currentDate()->sum('create_time');

    }//getAllNonReadMessages

    function getDataForDaysByUser($id){
        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from orders WHERE user_id = ? GROUP BY DATE(created_at)",[$id] );
    }

    /*заготови - scope*/

    //все файлы созданные сегодня
    public function scopeCurrentDate($query){
       // $query->whereRaw('created_at BETWEEN (NOW()-INTERVAL 48 HOUR) AND (NOW() - INTERVAL 24 HOUR)');
        $query->whereRaw('DATE(created_at) = CURDATE()');
    }

    //все файлы пользователя
    public function scopeForuser($query){
        $query->where(['user_id' => Auth::user()->id]);
    }

    //все файлы по проекту
    public function scopeForproject($query, $project_id){
        $query->where(['project_id' => $project_id]);
    }

    //все файлы по сервису
    public function scopeForservice($query, $service_id){
        $query->where(['service_id' => $service_id]);
    }

}//class
