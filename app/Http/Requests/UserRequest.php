<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'docType' => 'required',
            'document' => 'required | min: 8 | max: 10',
            'name' => 'required | min: 6 | max: 20',
            'lastName' => 'required | min: 6 | max: 20',
            'email' => 'required | email',
            'password' => 'required | confirmed | min: 6',
        ];
    }
}
