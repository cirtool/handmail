<?php

namespace Cirtool\Handmail\Traits;

use Cirtool\Handmail\Facades\Handmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @mixin Model
 */
trait HasStructure
{
    /**
     * Get template structure with default values.
     */
    protected function structure(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $output = json_decode($value, associative: true);

                foreach ($output['blocks'] as &$block) {
                    $blockField = Handmail::findBlock($block['name'])->context($block);
                    
                    foreach ($blockField->getFields() as $key => $field) {
                        if (! array_key_exists($key, $block['items'])) {
                            $block['items'][$key] = $field->data([
                                'model' => $block['model'] . '.items.' . $field->name
                            ])->toArray();
                        }
                    }
                }

                $layout = Handmail::findLayout($output['layout']['name'])
                    ->context($output['layout']);

                foreach ($layout->getFields() as $key => $field) {
                    if (! array_key_exists($key, $output['layout']['items'])) {
                        $output['layout']['items'][$key] = $field->data([
                            'model' => 'layout.items.' . $field->name
                        ])->toArray();
                    }
                }

                return $output;
            },
        );
    }
}
