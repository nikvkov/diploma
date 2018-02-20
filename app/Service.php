<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected  $table = 'services';

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function files()
    {
        return $this->hasMany('App\DataFile');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function getActive(){

        return $this->published()->get();

    }

    public function getAvgFile(){

        return $this->files->avg('create_time');

    }

    public function getAvgOrder(){

        return $this->orders->avg('create_time');

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
}
