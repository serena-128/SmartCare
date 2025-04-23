<?php

namespace App\Repositories;

use App\Models\feedback;
use App\Repositories\BaseRepository;

/**
 * Class feedbackRepository
 * @package App\Repositories
 * @version April 23, 2025, 11:11 pm UTC
*/

class feedbackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'staff_id',
        'category',
        'subject',
        'message',
        'rating',
        'attachment',
        'is_anonymous'
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
        return feedback::class;
    }
}
