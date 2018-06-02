<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Common\BaseController;
use App\Repositories\Backend\LogRepository;

class CommonController extends BaseController
{

    public $responseWidget = [
        'LOG' => 'recordLog',
    ];

    public function recordLog($result, $data)
    {
        $filterCode     = isset($result['code']) ? $result['code'] : $result['message'];
        $responseResult = [
            'status'  => isset($result['code']) ? 0 : 1,
            'message' => $this->filterResultMessage($filterCode),
        ];
        LogRepository::getInstance()->record($responseResult, $data);
    }
}
