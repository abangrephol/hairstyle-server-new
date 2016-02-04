<?php

namespace App\Models\Reseller\ApiKey;

use App\Models\Reseller\ApiKey\Traits\Attribute\ApiKeyAttribute;
use App\Models\Reseller\ApiKey\Traits\Relationship\ApiKeyRelationship;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class ApiKey extends Model
{
    use ApiKeyAttribute,ApiKeyRelationship,Eloquence;

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
        $this->table = config('reseller.apikey_table');
    }
}