<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 22.11.2017
 * Time: 16:35
 */

namespace App\Http\Controllers;


use App\Project;
use App\Blog;

class BlogController extends MainController
{


    public function index(Blog $blog){

        $this -> data['records'] = $blog->getActive();

        return view('blog.index', $this -> data);

    }//index()

    public function cart($slug, Blog $blog){

        $this -> data['record'] = $blog->getBySlug($slug);

        return view('blog.cart', $this -> data);

    }//index()


}