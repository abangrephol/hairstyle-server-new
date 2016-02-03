<?php

namespace App\Models\Master\Frame;

use App\Models\Master\Frame\Attribute\FrameAttribute;
use App\Models\Master\Frame\Relationship\FrameRelationship;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Frame extends Model
{
    use FrameAttribute,FrameRelationship,Eloquence;

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
        $this->table = config('master.frame_table');
    }
}