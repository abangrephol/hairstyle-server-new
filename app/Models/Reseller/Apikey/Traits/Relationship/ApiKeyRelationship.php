<?php

namespace App\Models\Reseller\ApiKey\Traits\Relationship;

/**
 * Class ClientRelationship
 * @package App\Models\Reseller\Client\Traits\Relationship
 */
trait ApiKeyRelationship
{
    public function clients()
    {
        return $this->belongsTo(config('reseller.client'),  'client_id');
    }

}