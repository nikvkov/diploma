<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function showService($slug,$path, Service $service){

       $this -> data['service'] = $service->getBySlug($path);
       $this -> data['parent_uri'] = $slug;

       return view('services.service_cart', $this -> data);

    }//index()
}
