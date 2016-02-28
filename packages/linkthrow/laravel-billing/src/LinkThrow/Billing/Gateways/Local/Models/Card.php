<?php namespace LinkThrow\Billing\Gateways\Local\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Card extends Model
{
    use SoftDeletes;
    protected $connection = 'billinglocal';
    protected $guarded = array('id');
    
    public function customer()
    {
        return $this->belongsTo('LinkThrow\Billing\Gateways\Local\Models\Customer')->withTrashed();
    }
}
