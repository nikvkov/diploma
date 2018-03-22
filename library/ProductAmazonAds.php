<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 12.03.2018
 * Time: 14:02
 */

namespace services;


class ProductAmazonAds
{

    //идентификатор в amazon
    public $sku;

    //название
    public $title;

    //родительский sku
    public $parent_sku;

    //дочерние товары
    public $childs = array();

}//class