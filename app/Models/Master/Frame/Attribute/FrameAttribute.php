<?php

namespace App\Models\Master\Frame\Attribute;

/**
 * Class CategoryAttribute
 * @package App\Models\Master\Category\Attribute
 */

trait FrameAttribute{

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->allow('edit-frame'))
        {
            return '<a href="' . route('admin.master.frame.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->allow('delete-frame'))
        {
            return '<a href="' . route('admin.master.frame.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
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