<?php

namespace App\Repositories;

use App\Models\appointment;
use App\Repositories\BaseRepository;

/**
 * Class appointmentRepository
 * @package App\Repositories
 * @version February 12, 2025, 9:29 pm UTC
*/

class appointmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'staffmemberid',
        'date',
        'time',
        'reason',
        'location'
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
        return appointment::class;
    }
}
