<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Auth\Auth;
use Ububs\Core\Component\Db\Db;
class LoginRepository extends CommonRepository
{

    /**
     * 登录
     * @param  Array $data [username, password]
     * @return Array
     */
    public function login($input)
    {
        $username = $input['account'] ?? '';
        $password = $input['password'] ?? '';
        $remember = $input['remember'] ?? false;
        if (!$username || !$password) {
            return ['code' => ['login', '0001']];
        }
        $result = Auth::guard('admin')->attempt(['username' => $username, 'password' => $password], $remember);
        if (empty($result)) {
            return ['code' => ['login', '0002']];
        }
        return [
            'list' => $result['list'],
            'token' => $result['__UBUBS_TOKEN__'],
            'message' => ['login', '0003']
        ];
    }

    /**
     * 退出
     * @return Array
     */
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return ['message' => ['login', '0004']];
    }
}
