<?php

namespace App\Repositories\Backend\Master\Frame;
use App\Exceptions\GeneralException;
use App\Models\Master\Frame\Frame;

/**
 * Interface RoleRepositoryContract
 * @package App\Repositories\Role
 */
class EloquentFrameRepository implements  FrameContract
{
    /**
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id){
        if (! is_null(Frame::find($id))) {
            return Frame::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.master.category.not_found'));
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getFramesPaginated($per_page, $order_by = 'id', $sort = 'asc'){
        if(access()->hasRole('Administrator'))
        {
            return Frame::orderBy($order_by, $sort)
                ->paginate($per_page);
        }else{
            return Frame::where('user_id',access()->id())
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
    public function getAllFrames($order_by = 'id', $sort = 'asc'){

    }

    /**
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function create($input,$request){
        $frame = new Frame;
        $frame->name = $input['name'];
        $frame->description = $input['description'];

        $files = array(
            'image_layout' => $request->file('image_layout'),
            'image_background' => $request->file('image_background'),
            'image_foreground' => $request->file('image_foreground'),
            'image_preview' => $request->file('image_preview')
        );

        $filenames = array();
        foreach($files as $fieldname=>$file){
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

        $frame->image_layout = $filenames['image_layout'];
        $frame->image_background = $filenames['image_background'];
        $frame->image_foreground = $filenames['image_foreground'];
        $frame->image_preview = $filenames['image_preview'];

        $frame->default = isset($input['default']) ? 1 : 0;


        if($frame->default)
            $frame->user_id = access()->id();
        else
            $frame->user_id = $input['user_id'];

        if($frame->save())
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
        $frame = $this->findOrThrowException($id);
        $frame->name = $input['name'];
        $frame->description = $input['description'];

        $files = array(
            'image_layout' => $request->file('image_layout'),
            'image_background' => $request->file('image_background'),
            'image_foreground' => $request->file('image_foreground'),
            'image_preview' => $request->file('image_preview')
        );

        $filenames = array(
            'image_layout' => $frame->image_layout,
            'image_background' => $frame->image_background,
            'image_foreground' => $frame->image_foreground,
            'image_preview' => $frame->image_preview
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

        $frame->image_layout = $filenames['image_layout'];
        $frame->image_background = $filenames['image_background'];
        $frame->image_foreground = $filenames['image_foreground'];
        $frame->image_preview = $filenames['image_preview'];

        $frame->default = isset($input['default']) ? 1 : 0;
        if($frame->default)
            $frame->user_id = access()->id();
        else
            $frame->user_id = $input['user_id'];

        if($frame->save())
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
