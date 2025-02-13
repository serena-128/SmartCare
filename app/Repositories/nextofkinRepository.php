<?php

namespace App\Repositories;

use App\Models\nextofkin;
use App\Repositories\BaseRepository;

/**
 * Class nextofkinRepository
 * @package App\Repositories
 * @version February 12, 2025, 8:22 pm UTC
*/

class nextofkinRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'residentid',
        'firstname',
        'lastname',
        'relationshiptoresident',
        'contactnumber',
        'email',
        'address'
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
        return nextofkin::class;
    }
}
