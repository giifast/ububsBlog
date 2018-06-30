<?php
namespace App\Http\Middleware;

use Ububs\Core\Component\Auth\Auth;

class AuthLogin
{
    public function handle()
    {
        if (!Auth::getInstance('admin')->checkLogin()) {
            return redirect('/backend');
        }
        return true;
    }
}
