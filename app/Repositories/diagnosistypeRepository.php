<?php

namespace App\Repositories;

use App\Models\diagnosistype;
use App\Repositories\BaseRepository;

/**
 * Class diagnosistypeRepository
 * @package App\Repositories
 * @version March 25, 2025, 6:17 pm UTC
*/

class diagnosistypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
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
        return diagnosistype::class;
    }
}
