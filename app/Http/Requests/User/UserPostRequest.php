<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Models\User;

class UserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role == User::ROLE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required'
        ];
    }
}
