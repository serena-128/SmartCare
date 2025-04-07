<?php

namespace App\Repositories;

use App\Models\staff_profiles;
use App\Repositories\BaseRepository;

/**
 * Class staff_profilesRepository
 * @package App\Repositories
 * @version April 7, 2025, 5:37 pm UTC
*/

class staff_profilesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'staff_role',
        'profile_picture',
        'bio'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return staff_profiles::class;
    }
}
