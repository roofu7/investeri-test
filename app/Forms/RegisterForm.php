<?php

namespace App\Forms;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;

class RegisterForm
{
    public static function make(): FormBuilder
    {
        return FormBuilder::make(
            route('register'),
        )->fields([
            Text::make('имя', 'name')->required(),
            Email::make('почта', 'email')->required(),
            Password::make('пароль', 'password')->required(),
            PasswordRepeat::make('повторить пароль', 'password confirmation')->required(),
        ])->submit('регистрация', ['class' => 'btn btn-primary w-full']);
    }
}
