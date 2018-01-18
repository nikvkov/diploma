<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected  $table = 'blogs';

    public function getActive(){

        //return $this->published()->latest()->get();
        return $this->published()->latest()->paginate(3);
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
