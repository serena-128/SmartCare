<?php

namespace App\Repositories;

use App\Models\staffmember;
use App\Repositories\BaseRepository;

/**
 * Class staffmemberRepository
 * @package App\Repositories
 * @version February 25, 2025, 6:30 pm UTC
*/

class staffmemberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reportsto',
        'firstname',
        'lastname',
        'role',
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
        return staffmember::class;
    }
}
