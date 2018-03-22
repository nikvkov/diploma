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

    //получить данные по выделенным файлам
    function getDataForSelectedFiles($rows_id){

        return  $this->selectedFiles($rows_id)->get();
    }

    //Общий размер выделенных файлов
    function getSizeForSelectedFiles($rows_id){

         return  $this->selectedFiles($rows_id)->sum('size');
    }

    //Общее время создания
    function getCreateTimeForSelectedFiles($rows_id){

        return  $this->selectedFiles($rows_id)->sum('create_time');
    }

    //получить данные по дням
    function getDataForDaysBySelectedUser($rows_id){

        $str = "select count(id) as 'num', DATE(created_at) as 'day' from datafiles WHERE user_id IN (".$rows_id." ) GROUP BY DATE(created_at)";

        return  DB::select($str );
    }

    //олучить все данные по дням
    //получить данные по дням
    function getDataForDays(){
        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from datafiles GROUP BY DATE(created_at)" );
    }

    function users(){
        return $this->belongsTo('App\User');
    }

    function user(){
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
        return $this -> latest() -> get();

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

    //Размер файлов созданных сегодня
    public function getCreateTimeFilesAtUser($id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->byuser($id)->sum('create_time');

    }//getAllNonReadMessages

    //Размер файлов созданных сегодня
    public function getSizeFilesAtUser($id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->byuser($id)->sum('size');

    }//getAllNonReadMessages

    //Размер файлов созданных сегодня
    public function getAllCreateTime(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->all()->sum('create_time');

    }//getAllNonReadMessages

    //Размер файлов созданных сегодня
    public function getAllSize(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->all()->sum('size');

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

    //время работы сервиса по клиенту
    public function getWorkTime($id){
        return $this ->byuser($id)->sum('create_time');
    }//getWorkTime

//    //получить данные по дням
//    function getDataForDaysByUser($id){
//        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from messages GROUP BY DATE(created_at)" );
//    }

    /*заготови - scope*/

    //все файлы созданные сегодня

    public function scopeSelectedFiles($query, $row_id){
        $query->whereRaw("id IN ({$row_id})");
    }

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

    public function scopeByuser($query, $user_id){
        $query->where(['user_id' => $user_id]);
    }

}//class
