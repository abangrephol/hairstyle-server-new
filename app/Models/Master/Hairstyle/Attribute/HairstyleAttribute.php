<?php

namespace App\Models\Master\Hairstyle\Attribute;

/**
 * Class CategoryAttribute
 * @package App\Models\Master\Category\Attribute
 */

trait HairstyleAttribute{

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->allow('edit-hairstyle'))
        {
            return '<a href="' . route('admin.master.hairstyle.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->allow('delete-hairstyle'))
        {
            return '<a href="' . route('admin.master.hairstyle.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute().
        $this->getDeleteButtonAttribute();
    }


}