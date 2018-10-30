<?php

namespace App\Repositories;

use App\Models\UserDash;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserDashRepository
 * @package App\Repositories
 * @version October 30, 2018, 9:14 am UTC
 *
 * @method UserDash findWithoutFail($id, $columns = ['*'])
 * @method UserDash find($id, $columns = ['*'])
 * @method UserDash first($columns = ['*'])
*/
class UserDashRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'column_id',
        'sort_no',
        'collapsed',
        'height',
        'email',
        'widget'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserDash::class;
    }
}
