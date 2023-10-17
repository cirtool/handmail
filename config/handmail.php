<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Panel Configuration
    |--------------------------------------------------------------------------
    |
    | Handmail comes with a panel to create, edit and test templates and
    | mails in real time, usually you should keep this working with
    | your current system instead use your own implementation.
    |
    */

    'panel' => [
        'is_active' => true,
        'middlewares' => 'web'
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocks Discovering
    |--------------------------------------------------------------------------
    |
    | To create templates or mails, you will need block configurations (TOML)
    | and views (Blade), please see the documentation about.
    |
    */

    'blocks' => [
        'path' => resource_path('views/handmail'),
        'field' => \Cirtool\Handmail\Form\BlockField::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Available Fields
    |--------------------------------------------------------------------------
    |
    | Mail blocks configuration are composed by fields. You can add or change
    | any fields packed with Handmail.
    |
    */
    
    'fields' => [
        'text' => \Cirtool\Handmail\Form\TextField::class
    ]
];
