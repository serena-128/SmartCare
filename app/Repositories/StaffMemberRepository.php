<?php

namespace App\Repositories;

use App\Models\StaffMember;
use App\Repositories\BaseRepository;

/**
 * Class StaffMemberRepository
 * @package App\Repositories
 * @version February 12, 2025, 9:27 pm UTC
*/

class StaffMemberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reportsto',
        'firstname',
        'lastname',
        'staff_role',
        'contactnumber',
        'email',
        'startdate'
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
        return StaffMember::class;
    }
}
