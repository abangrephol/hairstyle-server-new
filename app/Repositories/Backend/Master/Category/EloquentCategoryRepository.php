<?php

namespace App\Repositories\Backend\Master\Category;
use App\Exceptions\GeneralException;
use App\Models\Master\Category\Category;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
class EloquentCategoryRepository implements  CategoryContract
{
    /**
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id){
        if (! is_null(Category::find($id))) {
            return Category::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.master.category.not_found'));
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getCategoriesPaginated($per_page, $order_by = 'id', $sort = 'asc'){
        if(access()->hasRole('Administrator'))
        {
            return Category::orderBy($order_by, $sort)
                ->paginate($per_page);
        }else{
            return Category::where('user_id',access()->id())
                ->orWhere('default',1)
                ->orderBy($order_by, $sort)
                ->paginate($per_page);
        }

    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllCategories($order_by = 'id', $sort = 'asc'){
        return Category::where('user_id',access()->id())
            ->orWhere('default',1)
            ->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function create($input){
        $category = new Category;
        $category->name = $input['name'];
        $category->description = $input['description'];
        $category->default = isset($input['default']) ? 1 : 0;
        if($category->default)
            $category->user_id = access()->id();
        else
            $category->user_id = $input['user_id'];

        if($category->save())
        {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.create_error'));

    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function update($id, $input){
        $category = $this->findOrThrowException($id);
        $category->name = $input['name'];
        $category->description = $input['description'];
        $category->default = isset($input['default']) ? 1 : 0;
        if($category->default)
            $category->user_id = access()->id();
        else
            $category->user_id = $input['user_id'];

        if($category->save())
        {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function destroy($id){
        $category = $this->findOrThrowException($id);
        if($category->delete()) return true;

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));

    }

}
