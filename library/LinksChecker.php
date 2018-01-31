<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 26.01.2018
 * Time: 13:18
 */

namespace services;

use phpQuery;


/***
* Class LinksChecker
* Класс для сбора ссылок по указанному url
*/

class LinksChecker
{

    //ссылка
    private $link;

    //доменное имя
    private $domain_name;

    /**
     * LinksChecker constructor.
     * @param $link
     */
    public function __construct($link, $domain_name)
    {

        $this->link = $link;
        $this->domain_name = $domain_name;

    }//c_tor

    //функция получения ссылок со страницы
    public function getLinksArray(){


        $result = array();
        // $result[]=$this->link;

        //убираем / в конце url
        $l = $this->link[strlen($this->link) - 1];
        $url = $l == "/" ? substr($this->link,0,(strlen($this->link) - 1)): $this->link;

        try{

            //получаем содержимое по ссылке
            $file = @file_get_contents($url);

            //получаем структурированный документ
            $document = phpQuery::newDocument($file);

            //выбираем основной контенер
            $container = $document->find('html');

            //преобразуем в объект phpQuery
            $list = pq($container);

            //получаем ссылки
            $arr = $list->find('a');


            //перебираем контейнер
            foreach ($arr as $item){

                //преобразуем в объект phpQuery
                $source = pq($item);

                //получаем аттрибут href
                $link = $source->attr('href');

                if ($link{0} == "/" || strpos($link, "http") === true) {

                    $link = $this->domain_name . $link;
                    $last = $link[strlen($link) - 1];
                    $link = $last == "/" ? substr($link, 0, (strlen($link) - 1)) : $link;

                    //проверяем есть ли значение в массиве
                    if (!in_array($link, $result) &&
                        strpos($link, $url) >= 0) {

                        //удаляем пробелы и лишние символы
                        $link = htmlentities(trim($link));

                        //добавляем значение в массив
                        $result[$link] = 15;

                    }//if

                }//if

            }// foreach

            // $result = array_unique($result);

            return $result;

        }

        catch (Exception $ex){

            return "Ошибка чтения";

        }//try-catch

    }//getLinksArray()

}//class