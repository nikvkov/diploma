<?php

return ['title' => 'About page',
             'edit_fields' =>[
                 'content'=>[
                      'type'=>'textarea'
                 ],
                 'image'=>[
                     'type'=>'image',
                     'location'=>public_path().'/uploads/about/'
                 ]
             ]
       ];