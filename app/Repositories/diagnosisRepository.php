<?php

namespace App\Repositories;

use App\Models\diagnosis;
use App\Repositories\BaseRepository;

/**
 * Class diagnosisRepository
 * @package App\Repositories
 * @version February 12, 2025, 9:37 pm UTC
*/

class diagnosisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'diagnosis',
        'vitalsigns',
        'treatment',
        'testresults',
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
        return diagnosis::class;
    }
}
