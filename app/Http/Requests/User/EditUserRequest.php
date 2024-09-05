<?php

namespace App\Http\Requests\User;

use App\Rules\Password;
use App\Rules\EmailAddress;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->getId()); // @Qweasd123
        return [
            'prefixname' => ['nullable', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'suffixname' => ['nullable', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'unique:users,username,' . $this->getId() . ',id'
            ],
            'email' => [
                'required',
                new EmailAddress(),
                'unique:users,email,' . $this->getId() . ',id'
            ],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'password' => ['required', new Password()],
        ];
    }

    public function getId(): int
    {
        return (int) $this->route('user')->id;
    }
}
