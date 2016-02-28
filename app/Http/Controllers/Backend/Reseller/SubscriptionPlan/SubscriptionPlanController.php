<?php

namespace App\Http\Controllers\Backend\Reseller\SubscriptionPlan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Reseller\Reseller\CreateResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\DeleteResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\EditResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\StoreResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\UpdateResellerRequest;
use App\Http\Requests\Backend\Reseller\SubscriptionPlan\CreateSubscriptionPlanRequest;
use App\Http\Requests\Backend\Reseller\SubscriptionPlan\DeleteSubscriptionPlanRequest;
use App\Http\Requests\Backend\Reseller\SubscriptionPlan\EditSubscriptionPlanRequest;
use App\Http\Requests\Backend\Reseller\SubscriptionPlan\StoreSubscriptionPlanRequest;
use App\Http\Requests\Backend\Reseller\SubscriptionPlan\UpdateSubscriptionPlanRequest;
use App\Repositories\Backend\Reseller\Reseller\ResellerContract;
use App\Repositories\Backend\Reseller\SubscriptionPlan\EloquentSubscriptionPlanRepository;
use App\Repositories\Backend\Reseller\SubscriptionPlan\SubscriptionPlanContract;
use App\Repositories\Backend\Role\RoleRepositoryContract;


class SubscriptionPlanController extends Controller{

    protected $plan;

    public function __construct
    (
        SubscriptionPlanContract $plan
    )
    {
        $this->plan = $plan;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.reseller.subscriptionplan.index')
            ->withPlans($this->plan->getSubscriptionPlanPaginated(config('access.users.default_per_page'), 1));
    }

    public function create(CreateSubscriptionPlanRequest $request)
    {
        return view('backend.reseller.subscriptionplan.create');
    }

    public function store(StoreSubscriptionPlanRequest $request)
    {
        $this->plan->create(
            $request->all()
        );
        return redirect()->route('admin.reseller.subscription.plan.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * @param $id
     * @param EditResellerRequest $request
     * @return mixed
     */
    public function edit($id, EditSubscriptionPlanRequest $request)
    {
        $plan = $this->plan->findOrThrowException($id, true);
        return view('backend.reseller.subscriptionplan.edit')
            ->withPlan($plan);
    }

    /**
     * @param $id
     * @param UpdateResellerRequest $request
     * @return mixed
     */
    public function update($id, UpdateSubscriptionPlanRequest $request)
    {
        $this->plan->update($id,
            $request->all()
        );
        return redirect()->route('admin.reseller.subscription.plan.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param $id
     * @param DeleteResellerRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteSubscriptionPlanRequest $request)
    {
        $this->plan->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }
}