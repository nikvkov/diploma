<?php
return [
    'title' => 'Users',
    'single' => 'user',
    'model' => 'App\User',
    //то, что выводится в админку
    'columns' =>[
        'id',
        'email'
    ],
    //редактируемые поля
    'edit_fields' => [

                     //поле => тип
        'email' => ['type' => 'text'],
    ],

    'filters' => [

        //поле => тип
        'email' => ['type' => 'text'],

    ]
];