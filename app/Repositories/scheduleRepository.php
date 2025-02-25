<?php

namespace App\Repositories;

use App\Models\schedule;
use App\Repositories\BaseRepository;

/**
 * Class scheduleRepository
 * @package App\Repositories
 * @version February 25, 2025, 6:32 pm UTC
*/

class scheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'roleid',
        'staffmemberid',
        'shiftdate',
        'starttime',
        'endtime',
        'shifttype'
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
        return schedule::class;
    }
}
