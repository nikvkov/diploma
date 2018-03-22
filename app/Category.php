<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected  $table = 'categories';

    public function getByFeedProductType($feed){

        return $this->byfeedtype($feed)->firstOrFail();
    }

    public function getByFilename($filename){

        return $this->byfilename($filename)->firstOrFail();
    }

    /*Заготовки*/
    function scopeByfeedtype($query, $feed){
        $query->where(['feed_product_type' => $feed]);
    }


    function scopeByfilename($query, $filename){
        $query->whereRaw("de LIKE ? OR en LIKE ? OR fr LIKE ? OR es LIKE ? OR it LIKE ?",[$filename,$filename,$filename,$filename,$filename]);
    }

}//class
