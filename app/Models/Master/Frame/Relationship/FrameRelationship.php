<?php

namespace App\Models\Master\Frame\Relationship;


/**
 * Class UserRelationship
 * @package App\Models\Access\User\Traits\Relationship
 */
trait FrameRelationship
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