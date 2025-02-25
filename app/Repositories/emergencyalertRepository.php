<?php

namespace App\Repositories;

use App\Models\emergencyalert;
use App\Repositories\BaseRepository;

/**
 * Class emergencyalertRepository
 * @package App\Repositories
 * @version February 13, 2025, 10:29 pm UTC
*/

class emergencyalertRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'triggeredbyid',
        'alerttype',
        'alerttimestamp',
        'status',
        'resolvedbyid'
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
        return emergencyalert::class;
    }
}
