<?php

namespace App\Models\Master\Category;

use App\Models\Master\Category\Attribute\CategoryAttribute;
use App\Models\Master\Category\Relationship\CategoryRelationship;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Category extends Model
{
    use CategoryAttribute,CategoryRelationship,Eloquence;

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
        $this->table = config('master.category_table');
    }
}