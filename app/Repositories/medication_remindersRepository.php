<?php

namespace App\Repositories;

use App\Models\MedicationReminder;
use App\Repositories\BaseRepository;

class MedicationRemindersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'resident_id',
        'staffmember_id',
        'medication_name',
        'dosage',
        'frequency',
        'time_for_administration'
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return MedicationReminder::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->model->newQuery()->with(['resident', 'staffMember']);

        if (!empty($search)) {
            $query->where($search);
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query->get($columns);
    }
}
