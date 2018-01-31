<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected  $table = 'menus';

    //получаем элементы меню
    //левое
    public function getLeftMenu(){

      //  return $this::where(['active' => '1', 'position' => 'left'])->get();
        return $this -> orderBy('weight') -> published() -> left() -> get();

    }//getLeftMenu()

    //правое
    public function getRightMenu(){

      //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('weight') -> published() -> right() -> get();

    }//getLeftMenu()

    //футер
    public function getFooterMenu(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this -> orderBy('weight') -> published() -> footer() -> get();

    }//getLeftMenu()

    /*заготови - scope*/
    public function scopePublished($query){
        $query->where(['active' => '1']);
    }

    public function scopeLeft($query){
        $query->where(['position' => 'left']);
    }

    public function scopeRight($query){
        $query->where(['position' => 'right']);
    }

    public function scopeFooter($query){
        $query->where(['position' => 'footer']);
    }

}//class
