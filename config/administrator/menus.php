<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 16.11.2017
 * Time: 16:02
 * Описание меню в админке
 */

return [

    'title' => 'Menus',
    'single' => 'item',
    'model' => 'App\Menu',
    //то, что выводится в админку
    'columns' =>[
        'id',
        'active',
        'weight',
        'title',
        'position',
    ],
    //редактируемые поля
    'edit_fields' => [

                      //поле => тип
        'active' => ['type' => 'bool'],
        'weight' => ['type' => 'number'],
        'title' => ['type' => 'text'],
        'url' => ['type' => 'text'],
        'position' => ['type' => 'enum',
                       'options' => ['left' , 'right', 'footer']
                       ],
    ],

    //поля фильтрации
    'filters' => [
        //поле => тип
        'active' => ['type' => 'bool'],
        'title' => ['type' => 'text'],
        'position' => ['type' => 'enum',
            'options' => ['left' , 'right', 'footer']
        ]
    ]

];