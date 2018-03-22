<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 09.03.2018
 * Time: 19:17
 */

namespace services;


class GoogleTranslate
{

    // AIzaSyAZckbG5WLccOuBhDu2poCeOQCRebZ4-S0
    public static function getTranslate($text, $from, $to){

        if($from=="ru"){
            $responce0 = file_get_contents("http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".urlencode($text)."&langpair=ru|en");

            $json = json_decode($responce0,true);

            if($json["responseStatus"]==200){
                $responce1 = file_get_contents("http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".urlencode($json['responseData']['translatedText'])."&langpair=en|".$to);
                $json = json_decode($responce1,true);
                if($json["responseStatus"]==200){
                    return $json['responseData']['translatedText'];
                }
                else{
                    return json_encode(array());
                }
            }
            else{
                return json_encode(array());
            }



        }else {

            $responce = file_get_contents("http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=" . urlencode($text) . "&langpair=" . $from . "|" . $to);

            $json = json_decode($responce, true);

            if ($json["responseStatus"] == 200) {
                return $json['responseData']['translatedText'];
            } else {
                return json_encode(array());
            }
        }
    }

    public  static  function translate($text, $source, $target){
        $apiKey = 'AIzaSyAZckbG5WLccOuBhDu2poCeOQCRebZ4-S0';
       // $text = 'Hello world!';
        $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source='.$source.'&target='.$target;

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);
        $responseDecoded = json_decode($response, true);
        $responseCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);      //Here we fetch the HTTP response code
        curl_close($handle);

        if($responseCode != 200) {
            echo 'Fetching translation failed! Server response code:' . $responseCode . '<br>';
            echo 'Error description: ' . $responseDecoded['error']['errors'][0]['message'];
        }
        else {
          //  echo 'Source: ' . $text . '<br>';
           return $responseDecoded['data']['translations'][0]['translatedText'];
        }
    }
}//class