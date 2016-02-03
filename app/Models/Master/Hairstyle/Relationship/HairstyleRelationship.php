<?php

namespace App\Models\Master\Hairstyle\Relationship;


/**
 * Class UserRelationship
 * @package App\Models\Access\User\Traits\Relationship
 */
trait HairstyleRelationship
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

    public function category()
    {
        return $this->belongsTo(config('master.category'),  'category_id');
    }

}