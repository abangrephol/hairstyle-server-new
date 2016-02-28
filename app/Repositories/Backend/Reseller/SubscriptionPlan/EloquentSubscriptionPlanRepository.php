<?php

namespace App\Repositories\Backend\Reseller\SubscriptionPlan;

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use App\Exceptions\GeneralException;
use App\Models\Reseller\Reseller\Reseller;
use App\Repositories\Backend\Role\RoleRepositoryContract;
use App\Exceptions\Backend\Access\User\UserNeedsRolesException;
use App\Repositories\Frontend\User\UserContract as FrontendUserContract;
use Config;
use LinkThrow\Billing\Facades\Billing;
use LinkThrow\Billing\Gateways\Local\Models\Plan;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentSubscriptionPlanRepository implements SubscriptionPlanContract
{



    /**
     * @param SubscriptionPlanContract $plan
     * @internal param RoleRepositoryContract $role
     * @internal param FrontendUserContract $user
     */
    public function __construct(
    )
    {
        Billing::customer();

    }

    /**
     * @param  $id
     * @param  bool $withRoles
     * @throws GeneralException
     * @return mixed
     */
    public function findOrThrowException($id)
    {

        $plan = Plan::withTrashed()->find($id);


        if (!is_null($plan)) {
            return $plan;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.not_found'));
    }


    public function getSubscriptionPlanPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        $plans = Plan::where('deleted_at',null)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
        return $plans;
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedSubscriptionPlanPaginated($per_page)
    {
        return Plan::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllSubscriptionPlans($order_by = 'id', $sort = 'asc')
    {
        return Plan::orderBy($order_by, $sort)
            ->get();
    }
    /**
     * @param $input
     * @return bool
     * @throws GeneralException
     * @throws UserNeedsRolesException
     */
    public function create($input)
    {

        if ('local' != Config::get('billing.default')) {
            throw new GeneralException('Not configured to use the "local" driver.');
        }
        // Init gateway.
//        Billing::customer();

        $plan = Plan::create(array(
            'key'               => $input['key'],
            'name'              => ucwords($input['name']),
            'amount'            => $input['amount'],
            'interval'          => $input['interval'],
            'trial_period_days' => isset($input['trial']) ? $input['trial_period_days'] : 0,
        ));

        if ($plan->id != null) {

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $plan = $this->findOrThrowException($id);

        if ($plan->update($input)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function updatePassword($id, $input)
    {
        $user = $this->findOrThrowException($id);

        //Passwords are hashed on the model
        $user->password = $input['password'];
        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {

        $plan = $this->findOrThrowException($id);
        if ($plan->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        $user = $this->findOrThrowException($id, true);

        //Detach all roles & permissions
        $user->detachRoles($user->roles);
        $user->detachPermissions($user->permissions);

        try {
            $user->forceDelete();
        } catch (\Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function restore($id)
    {
        $user = $this->findOrThrowException($id);

        if ($user->restore()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark($id, $status)
    {
        if (access()->id() == $id && $status == 0) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user         = $this->findOrThrowException($id);
        $user->status = $status;

        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.mark_error'));
    }

}
