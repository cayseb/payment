<?php

declare(strict_types=1);

namespace App\Http\Controllers\Registration;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'email.required'=> 'Поле обязатльно',
            'email.email'=> 'это почта',
            'password.confirmed'=> 'пароли отличаются',
        ];
    }
}
