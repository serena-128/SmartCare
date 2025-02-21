<?php

namespace App\Repositories;

use App\Models\careplan;
use App\Repositories\BaseRepository;

/**
 * Class careplanRepository
 * @package App\Repositories
 * @version February 21, 2025, 10:53 pm UTC
*/

class careplanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'roleid',
        'medical_history',
        'medications',
        'dietary_preferences',
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
