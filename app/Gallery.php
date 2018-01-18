<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected  $table = 'galleries';

    public function project(){
        return $this->belongsTo('App\Project');
    }

}
