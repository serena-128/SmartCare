<?php

namespace App\Repositories;

use App\Models\resident;
use App\Repositories\BaseRepository;

/**
 * Class residentRepository
 * @package App\Repositories
 * @version February 11, 2025, 11:35 am UTC
*/

class residentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'firstname',
        'lastname',
        'dateofbirth',
        'gender',
        'roomnumber',
        'admissiondate'
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
        return resident::class;
    }
}
