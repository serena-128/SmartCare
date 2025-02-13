<?php

namespace App\Repositories;

use App\Models\standardtask;
use App\Repositories\BaseRepository;

/**
 * Class standardtaskRepository
 * @package App\Repositories
 * @version February 12, 2025, 9:35 pm UTC
*/

class standardtaskRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'assignedto',
        'description',
        'duedate',
        'prioritylevel',
        'completedby',
        'completiondatetime'
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
        return standardtask::class;
    }
}
