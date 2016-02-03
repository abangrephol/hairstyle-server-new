<?php

namespace App\Models\Master\Category\Relationship;


/**
 * Class UserRelationship
 * @package App\Models\Access\User\Traits\Relationship
 */
trait CategoryRelationship
{

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function owner()
    {
        return $this->belongsTo(config('auth.providers.users.model'),  'user_id');
    }

}