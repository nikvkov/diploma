<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 22.11.2017
 * Time: 16:35
 */

namespace App\Http\Controllers;


use App\Project;
use App\Slider;
use App\Blog;
use App\Service;
use Auth;

class IndexController extends MainController
{


    public function index(Slider $slider, Blog $blog){

        $this -> data['slides'] = $slider->getSlides();
        $this -> data['news'] = $blog->getActiveForIndex();

        return view('pages.index', $this -> data);

    }//index()

    public function projectsList(Project $project){

        $this -> data['projects'] = $project->getActive();
        return view('pages.projects_list', $this -> data);

    }//index()

    /**
     * @param $slug
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Route
     */

    public function projectsCart($slug, Project $project){

        if(Auth::check() || $slug = "site-services") {
            $this->data['project'] = $project->getBySlug($slug);
            return view('pages.projects_cart', $this->data);
        }else{
            //если не залогинен показываем страницу login
            return view('auth.login');
        }

    }//index()

    public function about(){

        $this -> data['about'] = json_decode(file_get_contents(storage_path().'/administrator_settings/about.json'));
        return view('pages.about', $this -> data);

    }//index()

    public function contacts(){

        $this -> data['contacts'] = json_decode(file_get_contents(storage_path().'/administrator_settings/contacts.json'));
        return view('pages.contacts', $this -> data);

    }//index()



}