<?php


namespace App\Http\Middleware\Admin;

use App\Http\Middleware\RedirectifAuthenticated as BaseRedirectIfAuthenticated;

class RedirectifAuthenticated extends BaseRedirectIfAuthenticated
{
    /**
     * @return string
     */
    protected function redirectTo(): string
    {
        return route('admin.index');
    }
}
