<?php

namespace App\Repositories;

use App\Models\stafftask;
use App\Repositories\BaseRepository;

/**
 * Class stafftaskRepository
 * @package App\Repositories
 * @version February 13, 2025, 9:40 am UTC
*/

class stafftaskRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'staffmemberid',
        'taskid',
        'roleintask',
        'startdate',
        'enddate'
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
        return stafftask::class;
    }
}
