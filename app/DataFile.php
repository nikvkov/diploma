<?php

namespace App;

use Auth;
use App\Project;
use App\Service;
use DB;
use Illuminate\Database\Eloquent\Model;

class DataFile extends Model
{

    protected  $table = 'datafiles';

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    //получить данные по дням
    function getDataForDaysByUser($id){
        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from datafiles WHERE user_id = ? GROUP BY DATE(created_at)",[$id] );
    }

    function users(){
        return $this->belongsTo('App\User');
    }

    //получить все файлы пользователя
    public function getAllFiles(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> foruser() -> get();

    }//getAllFiles

    //получить все файлы пользователя
    public function getAllFilesForAdmin(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> get();

    }//getAllFiles

    public function getFileForProject($project_id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> foruser() ->forproject($project_id) -> get();

    }//getFileForProject

    public function getFileForService($service_id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('filename') -> foruser() ->forservice($service_id) -> get();

    }//getFileForProject

    //поиск файла
    public function searchFiles($filename){

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
    public function getFilesAtDate(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->currentDate()->get();

    }//getAllNonReadMessages

    //Размер файлов созданных сегодня
    public function getSizeFilesAtDate(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->currentDate()->sum('create_time');

    }//getAllNonReadMessages

    //получить активных пользователей
    public function getActiveUsers(){

      //  return $this->orderBy('user_id')->groupBy('user_id')->take(5)->value('user_id');
        return  DB::table('datafiles')
            ->select(DB::raw('user_id'))
          //  ->where('status', '<>', 1)
            ->orderBy('user_id')
            ->groupBy('user_id')
            ->limit(5)
            ->get();

    }//getActiveUsers

    /*заготови - scope*/

    //все файлы созданные сегодня
    public function scopeCurrentDate($query){
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

    //все файлы по сервису
    public function scopeSearchbyfilename($query, $filename){
        $query->where(['filename'=> $filename]);
    }

}//class
