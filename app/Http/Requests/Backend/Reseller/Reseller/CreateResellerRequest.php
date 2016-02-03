<?php

namespace App\Http\Requests\Backend\Reseller\Reseller;

use App\Http\Requests\Request;

/**
 * Class CreateUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class CreateResellerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-reseller');
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
