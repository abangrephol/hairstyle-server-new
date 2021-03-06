<?php

namespace App\Http\Requests\Backend\Reseller\ApiKey;

use App\Http\Requests\Request;

/**
 * Class MarkUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class MarkApiKeyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Get the 'mark' id
        switch ((int) request()->segment(6)) {
            case 0:
                return access()->allow('view-apikey');
            break;

            case 1:
                return access()->allow('view-apikey');
            break;
        }

        return false;
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
