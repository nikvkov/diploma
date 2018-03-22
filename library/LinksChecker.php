<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 26.01.2018
 * Time: 13:18
 */

namespace services;

use Log;
use Mockery\Exception;
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

        //убираем / в конце url
        $l = $this->link[strlen($this->link) - 1];
        $url = $l == "/" ? substr($this->link,0,(strlen($this->link) - 1)): $this->link;

        //если ссылка относится к другому домену , то пишем в гол и не делаем проверку
        if(stripos($url,$this->domain_name)===false){Log::warning("Ссылка {$url} относится к другому домену"); return $result;}

        try{

            //получаем содержимое по ссылке
            $file = @file_get_contents($url);

            $headers = $this->parseHeaders($http_response_header);

            if($headers["reponse_code"]!=404) {


/*          альтернативный способ получения разметки
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $file = curl_exec($ch);
            curl_close($ch);                                */

                //получаем структурированный документ
                $document = phpQuery::newDocument($file);

                //выбираем основной контенер
                $container = $document->find('html');

                //преобразуем в объект phpQuery
                $list = pq($container);

                //получаем ссылки
                $arr = $list->find('a');
//              return $arr;
                //перебираем контейнер
                foreach ($arr as $item) {

                    //преобразуем в объект phpQuery
                    $source = pq($item);

                    //получаем аттрибут href
                    $link = $source->attr('href');

                    if ((mb_substr($link, 0, 1) == "/" || stripos($link, "http") !== false) && mb_substr($link, 0, 2) != "//") {

                        if (mb_substr($link, 0, 1) == "/") {
                            $link = $this->domain_name . $link;
                        }

                        $last = $link[strlen($link) - 1];
                        $link = $last == "/" ? substr($link, 0, (strlen($link) - 1)) : $link;

                        //проверяем есть ли значение в массиве
                        //удаляем пробелы и лишние символы
                        $link = htmlentities(trim($link));

                        //добавляем значение в массив
                        $result[$link] = 15;

                    }

                }// foreach

                // $result = array_unique($result);
                }
                return $result;

        }

        catch (Exception $ex){

            Log::error("{$ex->getMessage()} // {$ex->getTraceAsString()}");
            return $result;

        }//try-catch

    }//getLinksArray()

    ///парсим заголовок
    function parseHeaders( $headers )
    {
        $head = array();
        foreach( $headers as $k=>$v )
        {
            $t = explode( ':', $v, 2 );
            if( isset( $t[1] ) )
                $head[ trim($t[0]) ] = trim( $t[1] );
            else
            {
                $head[] = $v;
                if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
                    $head['reponse_code'] = intval($out[1]);
            }
        }
        return $head;
    }//parseHeaders

}//class