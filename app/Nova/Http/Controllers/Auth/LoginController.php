<?php

namespace App\Nova\Http\Controllers\Auth;

use Laravel\Nova\Http\Controllers\LoginController as NovaLoginController;

class LoginController extends NovaLoginController
{
    public function username()
    {
        return 'username';
    }
}
