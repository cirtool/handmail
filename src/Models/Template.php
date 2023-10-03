<?php
 
namespace Cirtool\Handmail\Models;
 
use Illuminate\Database\Eloquent\Model;
use Cirtool\Handmail\Traits\HasUuid;
 
class Template extends Model
{
    use HasUuid;
    
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
        'structure' => '[]',
    ];
}
