<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 16.11.2017
 * Time: 16:02
 * Описание галереи в админке
 */

return [

    'title' => 'Galleries',
    'single' => 'image',
    'model' => 'App\Gallery',
    //то, что выводится в админку
    'columns' =>[
        'id',
        'active',
        'image' => [
            'output' => '<img src="/uploads/images/small/(:value)" />',
        ],
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
        'alt' => ['type' => 'text'],
        'title' => ['type' => 'text'],
        'image' => [
            'type' => 'image',
            'location' => public_path().'/uploads/images/original/',
            'sizes' => [
                [100,100,'auto', public_path().'/uploads/images/small/',100],
                [500,500,'auto', public_path().'/uploads/images/medium/',100],
                [1000,800,'auto', public_path().'/uploads/images/large/',100]
            ]
        ],

    ],

];