<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected  $table = 'projects';

    public function galleries(){
        return $this->hasMany('App\Gallery');
    }

    public function getActive(){

        return $this->published()->get();

    }

    public function getBySlug($slug){

        return $this->published()->slug($slug)->firstOrFail();

    }

    function scopePublished($query){
        $query->where(['active'=>1]);
    }

    function scopeSlug($query, $slug){
        $query->where(['slug'=>$slug]);
    }

}//class
