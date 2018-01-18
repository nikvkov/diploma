<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 22.11.2017
 * Time: 16:22
 */

namespace App\Http\Controllers;


use \App\Menu;

class MainController extends Controller
{

    protected $data;
    public function __construct(Menu $menuModel){

        $this->data = [];

        $this->data['menu']['left'] =  $menuModel->getLeftMenu();
        $this->data['menu']['right'] = $menuModel->getRightMenu();

    }//__construct

}//class