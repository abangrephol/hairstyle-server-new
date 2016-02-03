<?php

namespace App\Models\Master\Hairstyle;

use App\Models\Master\Hairstyle\Attribute\HairstyleAttribute;
use App\Models\Master\Hairstyle\Relationship\HairstyleRelationship;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Hairstyle extends Model
{
    use HairstyleAttribute,HairstyleRelationship,Eloquence;

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
        $this->table = config('master.hairstyle_table');
    }
}