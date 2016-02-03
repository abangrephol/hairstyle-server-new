<?php

namespace App\Http\Requests\Backend\Reseller\ApiKey;

use App\Http\Requests\Request;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class UpdateApiKeyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-apikey');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imei'                  => 'required',
            'api'                 => 'required'
        ];
    }
}
