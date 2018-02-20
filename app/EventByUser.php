<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class EventByUser extends Model
{
    protected  $table = 'event_by_users';

    //получить все cообщения
    public function getAllEvents(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> foruser()->get();
       // return $this -> foruser()->hasOne('App\Event');

    }//getAllNonReadMessages

    public function event(){
        return $this->belongsTo('App\Event');
    }

    //получить все cообщения
    public function getById($id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> byid($id)->firstOrFail();

    }//getAllNonReadMessages

    //получить все cообщения
    public function getByEventId($id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this ->foruser()-> byeventid($id)->firstOrFail();

    }//getAllNonReadMessages

    //получить все не прочитанные сообщения
    public function getAllNonReadEvents(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> latest()-> foruser()->noread()-> get();

    }//getAllNonReadMessages

    //получить все не прочитанные сообщения
    public function getAllReadEvents(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> latest() -> foruser()->read()-> get();

    }//getAllNonReadMessages

    /*заготови - scope*/
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

    public function scopeByeventid($query, $id){
        $query->where(['event_id' => $id]);
    }

}//class
