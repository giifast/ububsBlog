<?php
namespace App\Http\Middleware;

use Ububs\Core\Component\Auth\Auth;

class AuthLogin
{
    public function handle()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/backend');
        }
        return true;
    }
}
