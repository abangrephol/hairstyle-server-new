<?php

namespace App\Models\Reseller\ApiKey\Traits\Attribute;

/**
 * Class CategoryAttribute
 * @package App\Models\Master\Category\Attribute
 */

trait ApiKeyAttribute{

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->allow('edit-apikey'))
        {
            return '<a href="' . route('admin.reseller.apikey.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->allow('delete-apikey'))
        {
            return '<a href="' . route('admin.reseller.apikey.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }
        return '';
    }
    public function getStatusButtonAttribute()
    {
        switch ($this->billingIsActive()) {
            case 0:
                if (access()->allow('view-apikey')) {
                    return '<a href="' . route('admin.reseller.apikey.mark', [$this->id, 1]) . '" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.backend.access.users.activate') . '"></i></a> ';
                }

                break;

            case 1:
                if (access()->allow('view-apikey')) {
                    return '<a href="' . route('admin.reseller.apikey.mark', [$this->id, 0]) . '" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.backend.access.users.deactivate') . '"></i></a> ';
                }

                break;

            default:
                return '';
            // No break
        }

        return '';
    }

    public function getChangePlanButtonAttribute()
    {
        if (access()->allow('view-apikey')) {
            return '<a href="' . route('admin.reseller.apikey.changeplan', $this->id) . '" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="' .'Change Plan'. '"></i></a> ';
        }

        return '';
    }
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute().
        $this->getStatusButtonAttribute().
        $this->getChangePlanButtonAttribute().
        $this->getDeleteButtonAttribute();
    }


}