<?php

namespace App\Models\Reseller\Reseller;

use App\Models\Reseller\Reseller\Traits\Attribute\ResellerAttribute;
use App\Models\Reseller\Reseller\Traits\Relationship\ResellerRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sofa\Eloquence\Eloquence;

/**
 * Class User
 * @package App\Models\Access\User
 */
class Reseller extends Authenticatable
{

    use SoftDeletes, ResellerAttribute, ResellerRelationship, Eloquence;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function __construct()
    {
        $this->table = config('reseller.reseller_table');
    }
}
