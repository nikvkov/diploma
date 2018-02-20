<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected  $table = 'projects';

    public function galleries(){
        return $this->hasMany('App\Gallery');
    }


    public function files()
    {
        return $this->hasMany('App\DataFile');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }

    public function getActive(){

        return $this->published()->get();

    }

    public function getBySlug($slug){

        return $this->published()->slug($slug)->firstOrFail();

    }

    public function getById($id){

        return $this->published()->getbyid($id)->firstOrFail();

    }

    function scopePublished($query){
        $query->where(['active'=>1]);
    }

    function scopeSlug($query, $slug){
        $query->where(['slug'=>$slug]);
    }

    function scopeGetbyid($query, $id){
        $query->where(['id'=>$id]);
    }

}//class
