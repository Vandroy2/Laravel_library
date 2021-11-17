<?php

namespace App\Http\Middleware\Admin;

use App\Http\Middleware\RedirectIfAuthenticated as BaseRedirectIfAuthenticated;

class RedirectIfAuthenticated extends BaseRedirectIfAuthenticated {
    /**
     * @return string
     */
    protected function redirectTo(): string
    {
        return route('admin.index');
    }
}
