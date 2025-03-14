<?php

namespace App\Repositories;

use App\Models\emergencyalert;
use App\Repositories\BaseRepository;

/**
 * Class emergencyalertRepository
 * @package App\Repositories
 * @version March 14, 2025, 1:57 am UTC
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
