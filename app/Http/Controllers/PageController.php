<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function root()
    {
        return redirect(config('l5-swagger.routes.api'), 302);
    }
}
