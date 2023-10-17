<?php

use Cirtool\Handmail\Form\BlockField;

test('instance block', function () {
    $block = new BlockField([
        'name' => 'blocks.0',
        'fields' => [
            [
                'name' => 'title',
                'type' => 'text',
                'default' => 'Hello World'
            ]
        ]
    ]);

    dd($block->data());

    expect($block->data())->not()->toBeEmpty();
});
