<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 06.03.2018
 * Time: 20:42
 */

namespace services;

/***
 * Class Product - класс с данными о товаре
 * @package services
 */
class Product
{

    /*Поля класса*/
    private $title;                 //название

    private $SKU;                   //уникальный идентификатор товара(для связывания вариаций с родительсктм товаром)

    private $price;                 //цена

    private $attribute_name;        //наименование аттрибута товара

    private $attribute_value;       //значение аттрибута товара

    private $permalink;             //ссылка на страницу

    private $image_url;             //ссылки на изображения (массив)

    private $parent_SKU;            //уникальный идентификатор товара родительского товара (null - если нет вариаций)

    private $category;              //категория товара

    private $EAN;                   //уникальный идентификатор товара (например, штрих-код)

    private $seo;                   //seo-описание

    private $device_name;           //название устройства для аксессуара (например, Acer Liquid E3)

    private $release_year;          //год выпуска


    //размеры
    private $weight;                //вес

    private $length;                //длина

    private $width;                 //ширина

    private $height;

    /**
     * Product constructor.
     * @param $title
     * @param $SKU
     * @param $permalink
     * @param $price
     * @param $attribute_name
     * @param $attribute_value
     * @param $image_url
     * @param $parent_SKU
     * @param $category
     * @param $EAN
     * @param $seo
     * @param $device_name
     * @param $release_year
     * @param $weight
     * @param $length
     * @param $width
     * @param $height
     */
    public function __construct($title, $SKU, $permalink, $price, $attribute_name, $attribute_value, $image_url, $parent_SKU, $category, $EAN, $seo, $device_name, $release_year, $weight, $length, $width, $height)
    {
        $this->title = $title;
        $this->SKU = $SKU;
        $this->permalink = $permalink;
        $this->price = $price;
        $this->attribute_name = $attribute_name;
        $this->attribute_value = $attribute_value;

        $this->image_url = $image_url;
        $this->parent_SKU = $parent_SKU;
        $this->category = $category;
        $this->EAN = $EAN;
        $this->seo = $seo;
        $this->device_name = $device_name;
        $this->release_year = $release_year;
        $this->weight = $weight;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }                //высота


    /*Переопределенные методы*/
    public function __toString()
    {
        return $this->title;

    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSKU()
    {
        return $this->SKU;
    }

    /**
     * @param mixed $SKU
     */
    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getAttributeName()
    {
        return $this->attribute_name;
    }

    /**
     * @param mixed $attribute_name
     */
    public function setAttributeName($attribute_name)
    {
        $this->attribute_name = $attribute_name;
    }

    /**
     * @return mixed
     */
    public function getAttributeValue()
    {
        return $this->attribute_value;
    }

    /**
     * @param mixed $attribute_value
     */
    public function setAttributeValue($attribute_value)
    {
        $this->attribute_value = $attribute_value;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * @param mixed $image_url
     */
    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    /**
     * @return mixed
     */
    public function getParentSKU()
    {
        return $this->parent_SKU;
    }

    /**
     * @param mixed $parent_SKU
     */
    public function setParentSKU($parent_SKU)
    {
        $this->parent_SKU = $parent_SKU;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getEAN()
    {
        return $this->EAN;
    }

    /**
     * @param mixed $EAN
     */
    public function setEAN($EAN)
    {
        $this->EAN = $EAN;
    }

    /**
     * @return mixed
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * @param mixed $seo
     */
    public function setSeo($seo)
    {
        $this->seo = $seo;
    }

    /**
     * @return mixed
     */
    public function getDeviceName()
    {
        return $this->device_name;
    }

    /**
     * @param mixed $device_name
     */
    public function setDeviceName($device_name)
    {
        $this->device_name = $device_name;
    }

    /**
     * @return mixed
     */
    public function getReleaseYear()
    {
        return $this->release_year;
    }

    /**
     * @param mixed $release_year
     */
    public function setReleaseYear($release_year)
    {
        $this->release_year = $release_year;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @param mixed $permalink
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
    }//__toString


}//class