<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 16.11.2017
 * Time: 16:02
 * Описание проектов в админке
 */

return [

    'title' => 'Blog',
    'single' => 'record',
    'model' => 'App\Blog',
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
        'body' => ['type' => 'wysiwyg'],
        'image' => [
            'type' => 'image',
            'location' => public_path().'/uploads/blog/original/',
            'sizes' => [
                [100,100,'auto', public_path().'/uploads/blog/small/',100],
                [500,500,'auto', public_path().'/uploads/blog/medium/',100],
                [1000,800,'auto', public_path().'/uploads/blog/large/',100]
            ]
        ],
    ],

    'form_width' => 800

];