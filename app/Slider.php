<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected  $table = 'slides';

    public function getSlides(){

        return $this->orderBy('weight')->where(['active' => '1'])->get();

    }//getSlides()

}//class
