<?php

namespace App\Http\Requests\Backend\Master\Frame;

use App\Http\Requests\Request;

class StoreFrameRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-frame');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required',
            'user_id' =>'required_if:default,1'
        ];
    }
}