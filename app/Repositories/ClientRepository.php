<?php

namespace App\Repositories;

use App\Models\Client;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ClientRepository
 * @package App\Repositories
 * @version September 28, 2017, 5:47 pm CST
 *
 * @method Client findWithoutFail($id, $columns = ['*'])
 * @method Client find($id, $columns = ['*'])
 * @method Client first($columns = ['*'])
*/
class ClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'num_document',
        'phone',
        'mail',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Client::class;
    }
}
