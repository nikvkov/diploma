<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 16.11.2017
 * Time: 16:02
 * Описание проектов в админке
 */

return [

    'title' => 'Press',
    'single' => 'record',
    'model' => 'App\Press',
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
            'location' => public_path().'/uploads/press/original/',
            'sizes' => [
                [100,100,'auto', public_path().'/uploads/press/small/',100],
                [500,500,'auto', public_path().'/uploads/press/medium/',100],
            ]
        ],
        'published_at' => ['type' => 'date'],
    ],

    'form_width' => 800

];