<?php

namespace App\Repositories;

use App\Models\dietaryrestriction;
use App\Repositories\BaseRepository;

/**
 * Class dietaryrestrictionRepository
 * @package App\Repositories
 * @version February 12, 2025, 9:36 pm UTC
*/

class dietaryrestrictionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'foodrestrictions',
        'foodpreferences',
        'allergies',
        'notes',
        'lastupdatedby'
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
        return dietaryrestriction::class;
    }
}
