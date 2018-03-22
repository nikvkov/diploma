<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //создаем папки
        self::createCatalogs();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //создание каталогов для пользователя
    private function createCatalogs(){
        //получаем последний id
        $id = User::max("id");

        $main_path = "uploads/users/".($id+1);
        mkdir($main_path, 0750);

        //папки для отчетов
        $orders =  $main_path."/orders";
        mkdir($orders, 0750);

        //папки для проекта проверки ссылок
        $all_links =  $main_path."/all-links";
        mkdir($all_links, 0750);

        $all_links_temp =  $main_path."/all-links/temp";
        mkdir($all_links_temp, 0750);

        //папки для проекта сбора ссылок
        $bad_links =  $main_path."/bad-links";
        mkdir($bad_links, 0750);

        $bad_links_temp =  $main_path."/bad-links/temp";
        mkdir($bad_links_temp, 0750);

        //папки для проекта создания карты сайта
        $sitemap =  $main_path."/sitemap";
        mkdir($sitemap, 0750);
        $sitemap_temp =  $main_path."/sitemap/temp";
        mkdir($sitemap_temp, 0750);
        $sitemap_xml =  $main_path."/sitemap/xml";
        mkdir($sitemap_xml, 0750);
        $sitemap_html =  $main_path."/sitemap/html";
        mkdir($sitemap_html, 0750);

        //папки для проекта maeketplace
        $marketplace_amazon =  $main_path."/marketplace-amazon";
        mkdir($marketplace_amazon, 0750);

        $marketplace_amazon_temp =  $main_path."/marketplace-amazon/temp";
        mkdir($marketplace_amazon_temp, 0750);

        $marketplace_amazon_de =  $main_path."/marketplace-amazon/de";
        mkdir($marketplace_amazon_de, 0750);

        $marketplace_amazon_en =  $main_path."/marketplace-amazon/en";
        mkdir($marketplace_amazon_en, 0750);

        $marketplace_amazon_fr =  $main_path."/marketplace-amazon/fr";
        mkdir($marketplace_amazon_fr, 0750);

        $marketplace_amazon_es =  $main_path."/marketplace-amazon/es";
        mkdir($marketplace_amazon_es, 0750);

        $marketplace_amazon_it =  $main_path."/marketplace-amazon/it";
        mkdir($marketplace_amazon_it, 0750);

        $adwertising = $main_path."/adwertising";
        mkdir($adwertising, 0750);

        $amazon_ads =  $adwertising ."/amazon-sponsored-products";
        mkdir($amazon_ads, 0750);

        $amazon_ads_temp =  $adwertising ."/amazon-sponsored-products/temp";
        mkdir($amazon_ads_temp, 0750);

        $google_merchant =  $adwertising ."/google-merchant-center";
        mkdir($google_merchant, 0750);

        $google_merchant_temp =  $adwertising ."/google-merchant-center/temp";
        mkdir($google_merchant_temp, 0750);

        $yandex_market =  $main_path."/marketplace-yandex";
        mkdir($yandex_market, 0750);

        $yandex_market_temp =  $main_path."/marketplace-yandex/temp";
        mkdir($yandex_market_temp, 0750);

        $yandex_direct =  $adwertising ."/yandex-direct";
        mkdir( $yandex_direct, 0750);

        $yandex_direct_temp =  $adwertising ."/yandex-direct/temp";
        mkdir($yandex_direct_temp, 0750);

    }//createCatalogs

}//class
