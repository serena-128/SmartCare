<?php

namespace App\Repositories;

use App\Models\dose;
use App\Repositories\BaseRepository;

/**
 * Class doseRepository
 * @package App\Repositories
 * @version February 12, 2025, 9:31 pm UTC
*/

class doseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'name',
        'dosage',
        'frequency',
        'startdate',
        'enddate',
        'prescribedby',
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
        return dose::class;
    }
}
