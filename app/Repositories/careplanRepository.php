<?php

namespace App\Repositories;

use App\Models\careplan;
use App\Repositories\BaseRepository;

/**
 * Class careplanRepository
 * @package App\Repositories
 * @version March 13, 2025, 11:17 pm UTC
*/

class careplanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'staffmemberid',
        'caregoals',
        'caretreatment',
        'notes'
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
        return careplan::class;
    }
}
