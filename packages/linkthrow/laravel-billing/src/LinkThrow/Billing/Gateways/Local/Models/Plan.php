<?php namespace LinkThrow\Billing\Gateways\Local\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Plan extends Model
{
    use SoftDeletes;
    protected $connection = 'billinglocal';
    protected $guarded = array('id');
    
    public function addInterval(Carbon $date)
    {
        switch ($this->interval) {
            case 'yearly':
                $date->addYear();
                break;
                
            case 'quarterly':
                $date->addMonths(3);
                break;
                
            case 'weekly':
                $date->addWeek();
                break;
                
            case 'monthly':
            default:
                $date->addMonth();
        }
        
        return $date;
    }

    public function getEditButtonAttribute()
    {
        if(access()->allow('view-subscription'))
        {
            return '<a href="' . route('admin.reseller.subscription.plan.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->allow('view-subscription'))
        {
            return '<a href="' . route('admin.reseller.subscription.plan.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
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
