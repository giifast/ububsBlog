<?php

namespace App\Http\Middleware;

use Ububs\Core\Component\Auth\Auth;
use Ububs\Core\Http\Interaction\Request;

class AuthCheckMethod
{
    public $codeMessage = [
        400 => '未授权',
    ];

    public function handle()
    {
        $userInfos = Auth::getInstance('admin')->user();
        if (!isset($userInfos['account'])) {
            return 400;
        }
        $method = Request::getMethod();
        if ($method !== 'GET' && $userInfos['account'] !== 'admin') {
            return 400;
        }
        return true;
    }
}
