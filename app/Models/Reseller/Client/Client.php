<?php

namespace App\Models\Reseller\Client;

use App\Models\Reseller\Client\Traits\Attribute\ClientAttribute;
use App\Models\Reseller\Client\Traits\Relationship\ClientRelationship;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Client extends Model
{
    use ClientAttribute,ClientRelationship,Eloquence;

    protected $table;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('reseller.client_table');
    }
}