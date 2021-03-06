<?php namespace LinkThrow\Billing\Gateways\Local\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Coupon extends Model
{
    use SoftDeletes;
    protected $connection = 'billinglocal';
    protected $guarded = array('id');
}
