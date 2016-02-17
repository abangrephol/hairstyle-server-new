<?php

namespace App\Http\Requests\Backend\Reseller\ApiKey;

use App\Http\Requests\Request;

/**
 * Class CreateUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class CreateApiKeyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-apikey');
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