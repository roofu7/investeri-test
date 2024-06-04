<?php

namespace App\Forms;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;

class LoginForm
{
    public static function make(): FormBuilder
    {
        return FormBuilder::make(
            route('login'),
        )->fields([
            Email::make('почта', 'email')->required(),
            Password::make('пароль', 'password')->required(),
        ])->buttons([
            ActionButton::make('регистрация', route('register'))
                ->secondary(),
        ])->submit('войти', ['class' => 'btn btn-primary']);
    }
}
