<?php

return [
    'panel' => [
        'is_active' => true,
        'middlewares' => 'web'
    ],
    'fields' => [
        'text' => \Cirtool\Handmail\Form\TextField::class
    ],
    'block_field' => \Cirtool\Handmail\Form\BlockField::class
];
