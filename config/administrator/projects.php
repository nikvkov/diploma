<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 16.11.2017
 * Time: 16:02
 * Описание проектов в админке
 */

return [

    'title' => 'Projects',
    'single' => 'project',
    'model' => 'App\Project',
    //то, что выводится в админку
    'columns' =>[
        'id',
        'active',
        'title',
    ],
    //редактируемые поля
    'edit_fields' => [

        //поле => тип
        'active' => ['type' => 'bool'],
        'title' => ['type' => 'text'],
        'slug' => ['type' => 'text'],
        'content' => ['type' => 'wysiwyg'],
        'image' => [
            'type' => 'image',
            'location' => public_path().'/uploads/project/original/',
            'sizes' => [
                [500,500,'auto', public_path().'/uploads/project/medium/',100],
                [1000,800,'auto', public_path().'/uploads/project/large/',100]
            ]
        ],
    ],

    'form_width' => 800

];