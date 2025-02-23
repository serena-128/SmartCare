<?php

namespace App\Repositories;

use App\Models\medication_reminders;
use App\Repositories\BaseRepository;

/**
 * Class medication_remindersRepository
 * @package App\Repositories
 * @version February 23, 2025, 10:10 pm UTC
*/

class medication_remindersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'resident_id',
        'staffmember_id',
        'medication_name',
        'dosage',
        'frequency',
        'time_for_administration'
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
        return medication_reminders::class;
    }
}
