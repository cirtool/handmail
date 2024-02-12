<?php
 
namespace Cirtool\Handmail\Models;

use Cirtool\Handmail\Facades\Handmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cirtool\Handmail\Traits\HasUuid;
use Cirtool\Handmail\Traits\HasWebview;

class Template extends Model
{
    use HasUuid;
    use HasWebview;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'handmail_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'structure' => '{}',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'structure' => 'array',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (Template &$template) {
            $template->html = $template->webview();
        });
    }

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
