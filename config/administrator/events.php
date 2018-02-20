<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 16.11.2017
 * Time: 16:02
 * Описание проектов в админке
 */

return [

    'title' => 'Event',
    'single' => 'event',
    'model' => 'App\Event',
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
        'body' => ['type' => 'wysiwyg'],
        'start_date' => ['type' => 'date'],
        'end_date' => ['type' => 'date'],
        'image' => [
            'type' => 'image',
            'location' => public_path().'/uploads/events/original/',
            'sizes' => [
                [100,100,'auto', public_path().'/uploads/events/small/',100],
                [500,500,'auto', public_path().'/uploads/events/medium/',100],
                [1000,800,'auto', public_path().'/uploads/events/large/',100]
            ]
        ],
    ],

    'form_width' => 800

];