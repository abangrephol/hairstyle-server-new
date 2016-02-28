<?php namespace LinkThrow\Billing\Gateways\Local\Models\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends Model
{
    use SoftDeletes;
    protected $connection = 'billinglocal';
    protected $table = 'invoice_items';
    protected $guarded = array('id');
    protected $dates = array('period_started_at', 'period_ends_at');
    
    public function invoice()
    {
        return $this->belongsTo('LinkThrow\Billing\Gateways\Local\Models\Invoice')->withTrashed();
    }
    
    public function subscription()
    {
        return $this->belongsTo('LinkThrow\Billing\Gateways\Local\Models\Subscription')->withTrashed();
    }
}
