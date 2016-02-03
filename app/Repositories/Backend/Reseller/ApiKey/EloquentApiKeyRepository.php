<?php

namespace App\Repositories\Backend\Reseller\ApiKey;
use App\Exceptions\GeneralException;
use App\Models\Reseller\ApiKey\ApiKey;

/**
 * Interface ClientContract
 * @package App\Repositories\Backend\Reseller\Client
 */
class EloquentApiKeyRepository implements  ApiKeyContract
{
    /**
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id)
    {
        $apikey = ApiKey::find($id);
        if (!is_null($apikey)) {
            return $apikey;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getApiKeysPaginated($per_page, $order_by = 'id', $sort = 'asc')
    {
        if(access()->hasRole(1))
        {
            return ApiKey::orderBy($order_by, $sort)
                ->paginate($per_page);
        }else{
            return ApiKey::search(access()->id(),['clients.reseller_id'],false)
                ->orderBy($order_by, $sort)
                ->paginate($per_page);
        }
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllApiKeys($order_by = 'id', $sort = 'asc')
    {
        if(access()->hasRole(1))
        {
            return ApiKey::orderBy($order_by, $sort)
                ->with('clients')
                ->get();
        }else{
            return ApiKey::search(access()->id(),['clients.reseller_id'],false)
                ->with('clients')
                ->orderBy($order_by, $sort)
                ->get();
        }
    }

    /**
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function create($input)
    {
        $apikey = new ApiKey;
        $apikey->imei = $input['imei'];
        $apikey->api = $input['api'];
        $apikey->client_id = $input['client_id'];

        if ($apikey->save()) {

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input)
    {
        $apikey = $this->findOrThrowException($id);
        if($apikey->update($input))
        {
            $apikey->save();
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id)
    {
        $apikey = $this->findOrThrowException($id);

        if($apikey->delete()){
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }

    public function generateAPI(){
        $unique = false;
        $api = "";
        while(!$unique){
            $api = str_random(20);
            $count = ApiKey::where('api', '=', $api)->count();
            if($count == 0) $unique = true;
        }
        return $api;
    }

}
