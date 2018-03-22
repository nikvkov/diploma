<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected  $table = 'messages';

    public function user(){
        return $this->belongsTo('App\User');
    }


    //получить все cообщения
    public function getAllMessages(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> latest() -> foruser()->get();

    }//getAllNonReadMessages

    //получить все cообщения
    public function getById($id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> byid($id)->firstOrFail();

    }//getAllNonReadMessages

    //получить все не прочитанные сообщения
    public function getAllNonReadMessages(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('title') -> foruser()->noread()-> get();

    }//getAllNonReadMessages

    //получить все не прочитанные сообщения
    public function getAllReadMessages(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('title') -> foruser()->read()-> get();

    }//getAllNonReadMessages

    //поиск файла
    public function searchMessages($title){

        // return $this -> orderBy('filename') -> foruser() ->searchbyfilename($filename) -> get();
        return $this::whereRaw('user_id = ? and (title LIKE ? or content LIKE ?)', [Auth::user()->id, $title, $title])->latest()->get();

    }//searchFiles

    //получить все cообщения
    public function getMessagesAtDate(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->currentDate()->get();

    }//getAllNonReadMessages

    //Размер файлов созданных сегодня
    public function getSizeMessagesAtDate(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->currentDate()->sum('create_time');

    }//getAllNonReadMessages

    public function getAllPagginate($pages){

        //return $this->published()->latest()->get();
        return $this->latest()->paginate($pages);
    }

    /*ДЛЯ АДМИНА*/
    public function getMessagesByUser($user_id){
        return $this ->byuser($user_id)->latest()->get();
    }

    public function getMessagesByManyUser($users_id){

        $part1 = "select * from messages WHERE user_id IN ( ";
        $part2 = " )  ";

        return  DB::select($part1.$users_id.$part2);

    }

    public function getReadMessagesByManyUser($users_id){

        $part1 = "select * from messages WHERE user_id IN ( ";
        $part2 = " ) AND 'read' = 1 ";

        return  DB::select($part1.$users_id.$part2);

    }

    public function getNoReadMessagesByManyUser($users_id){

        $part1 = "select * from messages WHERE user_id IN ( ";
        $part2 = " ) AND 'read' = 0 ";

        return  DB::select($part1.$users_id.$part2);

    }

    public function allByDesc(){
        return $this ->latest()->get();
    }

    //получить данные по дням
    function getDataForDays(){
        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from messages GROUP BY DATE(created_at)" );
    }

    //получить данные по дням
    function getDataForDaysByUser($id){
        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from messages WHERE user_id = ? GROUP BY DATE(created_at)",[$id] );
    }

    //получить данные по дням
    function getDataForDaysBySelectedUser($rows_id){
        return  DB::select("select count(id) as 'num', DATE(created_at) as 'day' from messages WHERE user_id IN ({$rows_id}) GROUP BY DATE(created_at)" );
    }

    //прочитанные сообщения пользователя
    public function getReadMessagesByUser($user_id){
        return $this ->byuser($user_id)->read()->latest()->get();
    }

    //не прочитанные сообщения пользователя
    public function getNoReadMessagesByUser($user_id){
        return $this ->byuser($user_id)->noread()->latest()->get();
    }

    /**********************************************************/

    /*заготови - scope*/
    //все файлы созданные сегодня
    public function scopeCurrentDate($query){
        $query->whereRaw('DATE(created_at) = CURDATE()');
    }

    public function scopeRead($query){
        $query->where(['read' => '1']);
    }

    public function scopeNoread($query){
        $query->where(['read' => '0']);
    }

    //все файлы пользователя
    public function scopeForuser($query){
        $query->where(['user_id' => Auth::user()->id]);
    }

    public function scopeByid($query, $id){
        $query->where(['id' => $id]);
    }

    public function scopeByuser($query, $user_id){
        $query->where(['user_id' => $user_id]);
    }

}//class
