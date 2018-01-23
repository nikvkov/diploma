<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 16.11.2017
 * Time: 16:02
 * Описание галереи в админке
 */

return [

    'title' => 'Services',
    'single' => 'service',
    'model' => 'App\Service',
    //то, что выводится в админку
    'columns' =>[
        'id',
        'active',
        'image' => [
            'output' => '<img src="/uploads/services/small/(:value)" />',
        ],
        'title',
//        'short_text'
    ],
    //редактируемые поля
    'edit_fields' => [

        //поле => тип
        'project' => [
            'type' => 'relationship',
            'name_field' => 'title'
        ],
        'active' => ['type' => 'bool'],
        'weight' => ['type' => 'number'],
        'short_text' => ['type' => 'text'],
        'title' => ['type' => 'text'],
        'slug' => ['type' => 'text'],
        'content' => ['type' => 'wysiwyg'],
        'image' => [
            'type' => 'image',
            'location' => public_path().'/uploads/services/original/',
            'sizes' => [
                [100,100,'auto', public_path().'/uploads/services/small/',100],
                [500,500,'auto', public_path().'/uploads/services/medium/',100],
                [1000,800,'auto', public_path().'/uploads/services/large/',100]
            ]
        ],

    ],
    'form_width' => 800
];