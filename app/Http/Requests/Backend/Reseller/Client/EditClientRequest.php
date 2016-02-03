<?php

namespace App\Http\Requests\Backend\Reseller\Client;

use App\Http\Requests\Request;

/**
 * Class EditUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class EditClientRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-client');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
