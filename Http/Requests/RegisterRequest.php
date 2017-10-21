<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:50',
            'last_name'  => 'required|min:2|max:50',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|confirmed|min:3',
        ];
    }

    public function attributes()
    {
        return trans('user::users.form');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return trans('validation');
    }
}
