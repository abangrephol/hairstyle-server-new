<?php

namespace App\Http\Controllers\Backend\Reseller\ApiKey;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Reseller\ApiKey\DeleteApiKeyRequest;
use App\Http\Requests\Backend\Reseller\ApiKey\EditApiKeyRequest;
use App\Http\Requests\Backend\Reseller\ApiKey\MarkApiKeyRequest;
use App\Http\Requests\Backend\Reseller\ApiKey\StoreApiKeyRequest;
use App\Http\Requests\Backend\Reseller\ApiKey\UpdateApiKeyRequest;
use App\Models\Reseller\ApiKey\ApiKey;
use App\Repositories\Backend\Reseller\ApiKey\ApiKeyContract;
use App\Repositories\Backend\Reseller\Client\EloquentClientRepository;
use App\Repositories\Backend\Reseller\SubscriptionPlan\EloquentSubscriptionPlanRepository;

class ApiKeyController extends Controller{

    protected $apikey;

    protected $client;

    protected $plan;

    public function __construct
    (
        ApiKeyContract $apikey,
        EloquentClientRepository $client,
        EloquentSubscriptionPlanRepository $plan
    )
    {
        $this->apikey = $apikey;
        $this->client = $client;
        $this->plan = $plan;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.reseller.apikey.index')
            ->withApikeys($this->apikey->getApiKeysPaginated(config('reseller.default_per_page')));
    }

    public function create()
    {
        $plans = $this->plan->getAllSubscriptionPlans();
        return view('backend.reseller.apikey.create')
            ->withClients($this->client->getAllClients('id'))
            ->withApi($this->apikey->generateAPI())
            ->withPlans($plans);


    }

    public function store(StoreApiKeyRequest $request)
    {
        $this->apikey->create($request->all());

        return redirect()->route('admin.reseller.apikey.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    public function edit($id, EditApiKeyRequest $request)
    {
        $apikey = $this->apikey->findOrThrowException($id);

        return view('backend.reseller.apikey.edit')
            ->withApikey($apikey)
            ->withClients($this->client->getAllClients('id'));
    }

    public function update($id, UpdateApiKeyRequest $request)
    {
        $this->apikey->update($id,$request->all());

        return redirect()->route('admin.reseller.apikey.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    public function destroy($id, DeleteApiKeyRequest $request)
    {
        $this->apikey->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }

    public function mark($id, $status, MarkApiKeyRequest $request)
    {
        $this->apikey->mark($id, $status);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.updated'));
    }
    public function changePlan($id, EditApiKeyRequest $request)
    {

        $apikey = $this->apikey->findOrThrowException($id);
        $currentSubInfo = $apikey->subscription()->toArray();
        $plans = $this->plan->getAllSubscriptionPlans();
        return view('backend.reseller.apikey.changeplan')
            ->withApikey($apikey)
            ->withSubinfo($currentSubInfo)
            ->withPlans($plans);
    }

    public function change($id, EditApiKeyRequest $request)
    {
        $this->apikey->change($id,$request->all());

        return redirect()->route('admin.reseller.apikey.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }
}