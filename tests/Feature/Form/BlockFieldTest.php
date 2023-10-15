<?php

use Cirtool\Handmail\Form\BlockField;

test('instance block', function () {
    $block = BlockField::setupFromArray([
        'title' => [
            'type' => 'text',
            'default' => 'Hello World'
        ]
    ]);

    expect($block->data)->not()->toBeEmpty();
});
