<?php

namespace App\Repositories;

use App\Models\careplan;
use App\Repositories\BaseRepository;

/**
 * Class careplanRepository
 * @package App\Repositories
 * @version February 12, 2025, 9:34 pm UTC
*/

class careplanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'roleid',
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
