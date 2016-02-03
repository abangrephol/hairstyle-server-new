<?php

namespace App\Http\Requests\Backend\Reseller\Client;

use App\Http\Requests\Request;

/**
 * Class DeleteUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class DeleteClientRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-client');
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
