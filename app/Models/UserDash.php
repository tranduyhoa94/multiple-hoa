<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserDash
 * @package App\Models
 * @version October 30, 2018, 9:14 am UTC
 *
 * @property integer column_id
 * @property integer sort_no
 * @property integer collapsed
 * @property integer height
 * @property string email
 * @property string widget
 */
class UserDash extends Model
{

    public $table = 'user_dash';
    
    public $timestamps = false;

    public $fillable = [
        'column_id',
        'sort_no',
        'collapsed',
        'height',
        'email',
        'widget'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'column_id' => 'integer',
        'sort_no' => 'integer',
        'collapsed' => 'integer',
        'height' => 'integer',
        'email' => 'string',
        'widget' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
