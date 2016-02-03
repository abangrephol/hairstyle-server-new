<?php

namespace App\Repositories\Backend\Reseller\Client;

/**
 * Interface ClientContract
 * @package App\Repositories\Backend\Reseller\Client
 */
interface ClientContract
{
    /**
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id);

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getClientsPaginated($per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllClients($order_by = 'id', $sort = 'asc');

    /**
     * @param  $input
     * @return mixed
     */
    public function create($input, $reseller_id);

    /**
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input, $reseller_id);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);

}
