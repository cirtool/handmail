<?php
 
namespace Cirtool\Handmail\Models;

use Cirtool\Handmail\Facades\Handmail;
use Cirtool\Handmail\Traits\HasStructure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cirtool\Handmail\Traits\HasUuid;
use Cirtool\Handmail\Traits\HasWebview;

class Template extends Model
{
    use HasUuid;
    use HasStructure;
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
}
