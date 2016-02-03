<?php

namespace App\Repositories\Backend\Reseller\Client;
use App\Exceptions\Backend\Access\User\UserNeedsRolesException;
use App\Exceptions\GeneralException;
use App\Models\Access\User\User;
use App\Models\Reseller\Client\Client;
use App\Repositories\Backend\Reseller\Reseller\EloquentResellerRepository;
use App\Repositories\Backend\User\EloquentUserRepository;

/**
 * Interface ClientContract
 * @package App\Repositories\Backend\Reseller\Client
 */
class EloquentClientRepository implements ClientContract
{

    protected $user;

    public function __construct(
        EloquentUserRepository $user
    )
    {
        $this->user = $user;
    }
    /**
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id){

        $user = Client::find($id);
        if (!is_null($user)) {
            return $user;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getClientsPaginated($per_page, $order_by = 'id', $sort = 'asc'){
        if(access()->hasRole('Administrator'))
        {
            return Client::orderBy($order_by, $sort)
                ->paginate($per_page);
        }else{
            $client = Client::search(access()->id(),['reseller_id'],false)
                ->orderBy($order_by, $sort)
                ->paginate($per_page);
            return $client;
        }

    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllClients($order_by = 'id', $sort = 'asc'){
        if(access()->hasRole('Administrator'))
        {
            return Client::orderBy($order_by, $sort)
                ->get();
        }else{
            $client = Client::search(access()->id(),['reseller_id'],false)
                ->orderBy($order_by, $sort)
                ->get();
            return $client;
        }
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function create($input, $reseller_id){
        $user = $this->createUserStub($input);

        if ($user->save()) {
            //User Created, Validate Roles
            $this->validateRoleAmount($user, [2]);

            //Attach new roles
            $user->attachRoles([2]);

            $client = new Client;
            $client->client_id = $user->id;
            $client->reseller_id = $reseller_id;

            $client->save();

            //Send confirmation email if requested
            if (isset($input['confirmation_email']) && $user->confirmed == 0) {
                $this->user->sendConfirmationEmail($user->id);
            }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input, $reseller_id){
        $user = $this->findOrThrowException($id)->clients;
        $this->checkUserByEmail($input, $user);

        if ($user->update($input)) {
            $user->save();

            $client = $this->findOrThrowException($id);
            $client->reseller_id = $reseller_id;
            $client->save();

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id){
        if (auth()->id() == $id) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_self'));
        }

        $client = $this->findOrThrowException($id);
        $user = $this->user->findOrThrowException($client->client_id,true);

        if ($client->delete()) {
            $this->user->delete($client->client_id);
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }

    private function createUserStub($input)
    {
        $user                    = new User;
        $user->name              = $input['name'];
        $user->email             = $input['email'];
        $user->password          = bcrypt($input['password']);
        $user->status            = 1;
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed         = 1;
        return $user;
    }

    private function checkUserByEmail($input, $user)
    {
        //Figure out if email is not the same
        if ($user->email != $input['email']) {
            //Check to see if email exists
            if (User::where('email', '=', $input['email'])->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
            }

        }
    }
    private function validateRoleAmount($user, $roles)
    {
        //Validate that there's at least one role chosen, placing this here so
        //at lease the user can be updated first, if this fails the roles will be
        //kept the same as before the user was updated
        if (count($roles) == 0) {
            //Deactivate user
            $user->status = 0;
            $user->save();

            $exception = new UserNeedsRolesException();
            $exception->setValidationErrors(trans('exceptions.backend.access.users.role_needed_create'));

            //Grab the user id in the controller
            $exception->setUserID($user->id);
            throw $exception;
        }
    }

}
