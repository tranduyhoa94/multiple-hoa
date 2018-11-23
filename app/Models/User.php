<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lcobucci\JWT\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 * @version October 12, 2018, 1:51 am UTC
 *
 * @property string email
 * @property string first_name
 * @property string last_name
 * @property string password
 * @property string access_token
 */
class User extends Authenticatable
{

    public $table = 'users';
    
    public $fillable = [
        'email',
        'first_name',
        'last_name',
        'password',
        'access_token',
        'address',
        'shipping'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'password' => 'string',
        'access_token' => 'string',
        'address' => 'string',
        'shipping' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function generateAccessToken(){
        $token =(string)(new Builder())->setId('4f1g23a12aa', true) 
                        ->setIssuedAt(time())
                        ->setExpiration(time() + 1209600) 
                        ->set('first_name',$this->first_name)
                        ->set('last_name',$this->last_name)
                        ->set('email',$this->email) 
                        ->set('id',$this->id) 
                        ->getToken();

        return $token;
    }

    
}
