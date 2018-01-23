<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected  $table = 'services';

    public function project(){
        return $this->belongsTo('App\Project');
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
}
