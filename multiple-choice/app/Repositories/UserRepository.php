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

    public function getUserParams($perPage,$sortBy,$searchBy){

        $listUser = $this->model;
        //search by
        if(!empty($searchBy['firstname'])){
            $listUser = $listUser->where('first_name', 'like', '%' . $searchBy['firstname'] . '%');
        }
        if(!empty($searchBy['lastname'])){
            $listUser = $listUser->where('last_name', 'like', '%' . $searchBy['lastname'] . '%');   
        }
        if(!empty($searchBy['email'])){
            $listUser = $listUser->where('email', 'like', '%' . $searchBy['email'] . '%');   
        }

        //order by

        if($sortBy[1]=='lastname'){
             $listUser = $listUser->orderBy('last_name', $sortBy[2]);
        }

        if($sortBy[1]=='firstname'){
             $listUser = $listUser->orderBy('first_name', $sortBy[2]);
        }

        if($sortBy[1]=='email'){
             $listUser = $listUser->orderBy('email', $sortBy[2]);
        }

        return $listUser->paginate($perPage);
    }
}
