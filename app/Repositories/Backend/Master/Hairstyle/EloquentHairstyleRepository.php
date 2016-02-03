<?php

namespace App\Repositories\Backend\Master\Hairstyle;
use App\Exceptions\GeneralException;
use App\Models\Master\Hairstyle\Hairstyle;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
class EloquentHairstyleRepository implements  HairstyleContract
{
    /**
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id){
        if (! is_null(Hairstyle::find($id))) {
            return Hairstyle::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.master.category.not_found'));
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getHairstylesPaginated($per_page, $order_by = 'id', $sort = 'asc'){
        if(access()->hasRole('Administrator'))
        {
            return Hairstyle::orderBy($order_by, $sort)
                ->paginate($per_page);
        }else{
            return Hairstyle::where('user_id',access()->id())
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
    public function getAllHairstyles($order_by = 'id', $sort = 'asc'){

    }

    /**
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function create($input,$request){
        $hairstyle = new Hairstyle;
        $hairstyle->name = $input['name'];
        $hairstyle->description = $input['description'];

        $files = array(
            'image' => $request->file('image')
        );

        $filenames = array();
        foreach($files as $fieldname=>$file){
            // checking file is valid.
            if ($file->isValid()) {
                $destinationPath = 'uploads/hairstyles'; // upload path
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renameing image
                //$fileName = $request->file('image')->getClientOriginalName(); // renameing image
                $file->move($destinationPath, $fileName); // uploading file to given path
                $filenames[$fieldname] = $fileName;
            }
            else {
                throw new GeneralException('Upload File error.');
            }
        }

        $hairstyle->image = $filenames['image'];

        $hairstyle->default = isset($input['default']) ? 1 : 0;

        $hairstyle->Xpoint = $input['Xpoint'];
        $hairstyle->Ypoint = $input['Ypoint'];

        $hairstyle->category_id = $input['category_id'];

        if($hairstyle->default)
            $hairstyle->user_id = access()->id();
        else
            $hairstyle->user_id = $input['user_id'];

        if($hairstyle->save())
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
    public function update($id, $input,$request){
        $hairstyle = $this->findOrThrowException($id);
        $hairstyle->name = $input['name'];
        $hairstyle->description = $input['description'];

        $files = array(
            'image' => $request->file('image')
        );

        $filenames = array(
            'image' => $hairstyle->image
        );

        foreach($files as $fieldname=>$file){
            if (!empty($file)) {
                // checking file is valid.
                if ($file->isValid()) {
                    $destinationPath = 'uploads/frames'; // upload path
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111,99999).'.'.$extension; // renameing image
                    //$fileName = $request->file('image')->getClientOriginalName(); // renameing image
                    $file->move($destinationPath, $fileName); // uploading file to given path
                    $filenames[$fieldname] = $fileName;
                }
                else {
                    throw new GeneralException('Upload File error.');
                }
            }

        }

        $hairstyle->image = $filenames['image'];

        $hairstyle->Xpoint = $input['Xpoint'];
        $hairstyle->Ypoint = $input['Ypoint'];

        $hairstyle->category_id = $input['category_id'];

        $hairstyle->default = isset($input['default']) ? 1 : 0;
        if($hairstyle->default)
            $hairstyle->user_id = access()->id();
        else
            $hairstyle->user_id = $input['user_id'];

        if($hairstyle->save())
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
        $frame = $this->findOrThrowException($id);
        if($frame->delete()) return true;

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));

    }

}
