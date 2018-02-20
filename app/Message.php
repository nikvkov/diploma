<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected  $table = 'messages';

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

}//class
