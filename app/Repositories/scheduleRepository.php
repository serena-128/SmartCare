<?php

namespace App\Repositories;

use App\Models\schedule;
use App\Repositories\BaseRepository;

/**
 * Class scheduleRepository
 * @package App\Repositories
 * @version March 10, 2025, 9:45 am UTC
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
        'shifttype',
        'requested_shift_id',
        'shift_status',
        'request_reason',
        'approved_by'
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
