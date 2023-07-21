<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatedUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'jenis_kelamin' => 'required',
            'foto' => 'mimes:jpeg,bmp,png|max:1024',
        ];
    }
}
