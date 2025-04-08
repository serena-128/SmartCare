<?php

namespace App\Repositories;

use App\Models\StaffProfile;
use App\Repositories\BaseRepository;

/**
 * Class StaffProfilesRepository
 * @package App\Repositories
 * @version April 7, 2025, 5:37 pm UTC
*/

class StaffProfilesRepository extends BaseRepository
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
     *
     * @return string
     */
    public function model()
    {
        return StaffProfile::class;
    }
}
