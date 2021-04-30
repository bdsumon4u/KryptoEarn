<?php

namespace App\Http\Requests\Admin;

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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:35'],
            'email' => ['required', 'string', 'email', 'max:85', $this->unique()],
            'phone' => ['nullable', 'string', 'max:20', $this->unique()],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:60'],
            'country' => ['required', 'string', 'max:60'],
            'timezone' => ['required', 'string', 'max:60'],
        ];
    }

    public function unique(): string
    {
        $user = $this->route('user');
        return 'unique:users,id,'.$user->id;
    }
}
