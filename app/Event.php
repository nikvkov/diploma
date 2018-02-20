<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected  $table = 'events';

    //получить все cообщения
    public function getById($id){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> byid($id)->firstOrFail();

    }//getAllNonReadMessages

    public function scopeByid($query, $id){
        $query->where(['id' => $id]);
    }

    //поиск файла
    public function searchEvents($title){

        // return $this -> orderBy('filename') -> foruser() ->searchbyfilename($filename) -> get();
        return $this::whereRaw('title LIKE ? or body LIKE ?', [$title, $title])->latest()->get();

    }//searchFiles

}//class
