<?php

namespace App\Http\Controllers\Backend\Reseller\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Reseller\Client\CreateClientRequest;
use App\Http\Requests\Backend\Reseller\Client\DeleteClientRequest;
use App\Http\Requests\Backend\Reseller\Client\EditClientRequest;
use App\Http\Requests\Backend\Reseller\Client\StoreClientRequest;
use App\Http\Requests\Backend\Reseller\Client\UpdateClientRequest;
use App\Repositories\Backend\Reseller\Client\ClientContract;
use App\Repositories\Backend\Reseller\Reseller\EloquentResellerRepository;
use App\Repositories\Backend\Reseller\Reseller\ResellerContract;

class ClientController extends Controller{

    protected $client;

    protected $reseller;

    public function __construct
    (
        ClientContract $client,
        ResellerContract $reseller
    )
    {
        $this->client = $client;
        $this->reseller = $reseller;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.reseller.client.index')
            ->withClients($this->client->getClientsPaginated(config('access.users.default_per_page')));
    }


    public function create(CreateClientRequest $request)
    {
        return view('backend.reseller.client.create')
            ->withResellers($this->reseller->getAllResellers('name'));
    }

    public function store(StoreClientRequest $request)
    {

        if(access()->hasRole('Administrator'))
        {
            $reseller_id = $request->only('reseller_id')['reseller_id'];
        }else{
            $reseller_id = access()->id();
        }

        $this->client->create(
            $request->except('assignees_roles', 'permission_user'),
            $reseller_id
        );
        return redirect()->route('admin.reseller.client.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }
    public function edit($id, EditClientRequest $request)
    {
        $client = $this->client->findOrThrowException($id, true);
        $user = $client->clients;

        return view('backend.reseller.client.edit')
            ->withUser($user)
            ->withClient($client)
            ->withResellers($this->reseller->getAllResellers('name'));
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateClientRequest $request)
    {
        if(access()->hasRole('Administrator'))
        {
            $reseller_id = $request->only('reseller_id')['reseller_id'];
        }else{
            $reseller_id = access()->id();
        }
        $this->client->update($id,
            $request->except('assignees_roles', 'permission_user','reseller_id'),
            $reseller_id
        );
        return redirect()->route('admin.reseller.client.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }
    public function destroy($id, DeleteClientRequest $request)
    {
        $this->client->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }
}