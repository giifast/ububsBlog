<?php
namespace App\Repositories\Backend;

use FwSwoole\DB\DB;

class UserRepository extends CommonRepository
{
    public function lists($input)
    {
        $result['lists'] = DB::table('user')->limit(0, 10)->get();
        $result['total'] = DB::table('user')->count();
        return $result;
    }
}
