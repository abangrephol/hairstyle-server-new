<?php

namespace App\Http\Controllers\Backend\Reseller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Reseller\Reseller\CreateResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\DeleteResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\EditResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\StoreResellerRequest;
use App\Http\Requests\Backend\Reseller\Reseller\UpdateResellerRequest;
use App\Repositories\Backend\Reseller\Reseller\ResellerContract;
use App\Repositories\Backend\Role\RoleRepositoryContract;


class ResellerController extends Controller{

    protected $reseller;

    protected $role;

    public function __construct
    (
        ResellerContract $reseller,
        RoleRepositoryContract $role
    )
    {
        $this->reseller = $reseller;
        $this->role = $role;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.reseller.index')
            ->withUsers($this->reseller->getResellerPaginated(config('access.users.default_per_page'), 1));
    }

    public function create(CreateResellerRequest $request)
    {
        return view('backend.reseller.create');
    }

    public function store(StoreResellerRequest $request)
    {
        $this->reseller->create(
            $request->except('assignees_roles', 'permission_user')
        );
        return redirect()->route('admin.reseller.users.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * @param $id
     * @param EditResellerRequest $request
     * @return mixed
     */
    public function edit($id, EditResellerRequest $request)
    {
        $user = $this->reseller->findOrThrowException($id, true);
        return view('backend.reseller.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->lists('id')->all());
    }

    /**
     * @param $id
     * @param UpdateResellerRequest $request
     * @return mixed
     */
    public function update($id, UpdateResellerRequest $request)
    {
        $this->reseller->update($id,
            $request->except('assignees_roles', 'permission_user')
        );
        return redirect()->route('admin.reseller.users.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param $id
     * @param DeleteResellerRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteResellerRequest $request)
    {
        $this->reseller->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }
}