<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version October 12, 2018, 1:51 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'first_name',
        'last_name',
        'password',
        'access_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
