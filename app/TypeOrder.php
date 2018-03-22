<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOrder extends Model
{
    protected  $table = 'type_orders';

    public function adminOrders(){
        return $this->hasMany('App\AdminOrder');
    }

    public function getById($id){

        // return $this->getbyid($id)->firstOrFail();
        return $this->whereRaw('id = ?',[$id])->firstOrFail();

    }


}//class
