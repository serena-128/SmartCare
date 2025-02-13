<?php

namespace App\Repositories;

use App\Models\role;
use App\Repositories\BaseRepository;

/**
 * Class roleRepository
 * @package App\Repositories
 * @version February 12, 2025, 7:57 pm UTC
*/

class roleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'firstname',
        'lastname',
        'roletype',
        'contactnumber',
        'email',
        'employmentstartdate'
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
        return role::class;
    }
}
