<?php

namespace App\Repositories;

use App\Models\EmergencyAlert;
use App\Repositories\BaseRepository;

/**
 * Class EmergencyAlertRepository
 * @package App\Repositories
 * @version February 13, 2025, 10:29 pm UTC
 */

class EmergencyAlertRepository extends BaseRepository
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
        return EmergencyAlert::class;
    }

    /**
     * Get all emergency alerts with resident and staff details
     */
    public function allWithRelations()
    {
        return $this->model->with(['resident', 'triggeredBy', 'resolvedBy'])->get();
    }
}
