<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Auth\Auth;
use FwSwoole\Core\Request;
use Ububs\Core\Component\Db\Db;

class LogRepository extends CommonRepository
{
    const TABLE_NAME = 'admin_log';

    private static $recordTypeMessage = [
        'LOGIN'  => 1,
        'DELETE' => 2,
        'UPDATE' => 3,
        'STORE'  => 4,
    ];

    public static function record($result, $data)
    {
        $type = isset($data['type']) ? strtoupper($data['type']) : '';
        if ($type === '' || !isset(self::$recordTypeMessage[$type])) {
            return false;
        }
        $params     = isset($data['params']) ? json_encode($data['params']) : '';
        $message    = isset($data['message']) ? json_encode($data['message']) : ($result['message'] ? $result['message'] : '');
        $createData = [
            'admin_id'      => Auth::guard()->id(),
            'action'        => Request::getPathInfo(),
            'type'          => self::$recordTypeMessage[$type],
            'request_method' => Request::getMethod(),
            'params'        => $params,
            'status'        => $result['status'],
            'message'       => $message,
        ];
        DB::table(self::TABLE_NAME)->create($createData);
        return true;
    }
}
