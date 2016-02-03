<?php

namespace App\Models\Reseller\Reseller\Traits\Attribute;

/**
 * Class UserAttribute
 * @package App\Models\Access\User\Traits\Attribute
 */
trait ResellerAttribute
{

    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        return ! app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @return string
     */
    public function getConfirmedLabelAttribute()
    {
        if ($this->isConfirmed())
            return "<label class='label label-success'>Yes</label>";
        return "<label class='label label-danger'>No</label>";
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return gravatar()->get($this->email, ['size' => 50]);
    }

    /**
     * @param $provider
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }

        }

        return false;
    }

    /**
     * @return bool
     */
    public function isActive() {
        return $this->status == 1;
    }

    /**
     * @return bool
     */
    public function isConfirmed() {
        return $this->confirmed == 1;
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-users')) {
            return '<a href="' . route('admin.reseller.users.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getChangePasswordButtonAttribute()
    {
        if (access()->allow('change-user-password')) {
            return '<a href="' . route('admin.reseller.users.change-password', $this->id) . '" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.backend.access.users.change_password') . '"></i></a>';
        }

        return '';
    }


    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-users')) {
            return '<a href="' . route('admin.reseller.users.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        //$this->getChangePasswordButtonAttribute() . ' ' .
        $this->getDeleteButtonAttribute();
    }
}