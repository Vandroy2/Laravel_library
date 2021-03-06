<?php

namespace App\Http\Middleware\Admin;

use App\Http\Middleware\RedirectIfAuthenticated as BaseRedirectIfAuthenticated;

class RedirectIfAuthenticated extends BaseRedirectIfAuthenticated
{
    protected function redirectTo()
    {
        return redirect()->route('admin.index');
    }
}

