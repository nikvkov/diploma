<?php

namespace App\Http\Controllers;

use App\Service;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use services\LinksChecker;



class AjaxController extends MainController
{
   public function getAllLinks($link, $domain){

       $link = base64_decode($link);
       $domain = base64_decode($domain);

       echo base64_encode(json_encode(self::get_links($link, $domain)));

   }//getAllLinks

    /**
     * получить ссылки на странице
     * @param $link - ссылка из get запроса
     * @param $domain_name - доменное имя
     */
    private function get_links($link,$domain_name ){

        $new_seach = new LinksChecker($link, $domain_name);
        $result = $new_seach->getLinksArray();

       // $str = json_encode($result);

       // return $str;

        return $result;

    }//get_links

}//class
