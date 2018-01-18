<?php

return ['title' => 'Contacts',
    'edit_fields' =>[
        'content'=>[
            'type'=>'textarea'
        ],
        'image'=>[
            'type'=>'image',
            'location'=>public_path().'/uploads/contacts/'
        ]
    ]
];