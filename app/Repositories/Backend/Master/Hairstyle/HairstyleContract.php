<?php

namespace App\Repositories\Backend\Master\Hairstyle;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
interface HairstyleContract
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
    public function getHairstylesPaginated($per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllHairstyles($order_by = 'id', $sort = 'asc');

    /**
     * @param  $input
     * @return mixed
     */
    public function create($input,$request);

    /**
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input,$request);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);

}
