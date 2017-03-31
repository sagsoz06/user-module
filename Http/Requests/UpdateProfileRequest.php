<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;
use Modules\User\Contracts\Authentication;

class UpdateProfileRequest extends BaseFormRequest
{
    public function rules()
    {
        $userId = app(Authentication::class)->id();
        $oldPassword = app(Authentication::class)->user()->password;

        return [
            'email' => "required|email|unique:users,email,{$userId}",
            'old_password' => 'old_password:'.$oldPassword,
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return trans('user::users.form');
    }

    public function messages()
    {
        return [
            'old_password' => trans('user::users.old password error')
        ];
    }
}
