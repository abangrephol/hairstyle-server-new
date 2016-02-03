<?php

namespace App\Models\Master\Category\Attribute;

/**
 * Class CategoryAttribute
 * @package App\Models\Master\Category\Attribute
 */

trait CategoryAttribute{

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->allow('edit-category'))
        {
            return '<a href="' . route('admin.master.category.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->allow('delete-category'))
        {
            return '<a href="' . route('admin.master.category.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
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