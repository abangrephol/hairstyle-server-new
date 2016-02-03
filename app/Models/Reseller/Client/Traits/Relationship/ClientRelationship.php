<?php

namespace App\Models\Reseller\Client\Traits\Relationship;

/**
 * Class ClientRelationship
 * @package App\Models\Reseller\Client\Traits\Relationship
 */
trait ClientRelationship
{
    public function clients()
    {
        return $this->belongsTo(config('auth.providers.users.model'),  'client_id');
    }

    public function reseller()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'reseller_id');
    }
}