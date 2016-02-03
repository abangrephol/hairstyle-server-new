<?php

namespace App\Http\Controllers\Backend\Reseller\ApiKey;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Reseller\ApiKey\DeleteApiKeyRequest;
use App\Http\Requests\Backend\Reseller\ApiKey\EditApiKeyRequest;
use App\Http\Requests\Backend\Reseller\ApiKey\StoreApiKeyRequest;
use App\Http\Requests\Backend\Reseller\ApiKey\UpdateApiKeyRequest;
use App\Models\Reseller\ApiKey\ApiKey;
use App\Repositories\Backend\Reseller\ApiKey\ApiKeyContract;
use App\Repositories\Backend\Reseller\Client\EloquentClientRepository;

class ApiKeyController extends Controller{

    protected $apikey;

    protected $client;

    public function __construct
    (
        ApiKeyContract $apikey,
        EloquentClientRepository $client
    )
    {
        $this->apikey = $apikey;
        $this->client = $client;
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
        return view('backend.reseller.apikey.create')
            ->withClients($this->client->getAllClients('id'))
            ->withApi($this->apikey->generateAPI());


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

}