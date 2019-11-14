<?php
namespace App\Http\Controllers\Common;

use Ububs\Core\Http\AbstractInterface\Controller;
use Ububs\Core\Http\Interaction\Request;
use Ububs\Core\Http\Interaction\Response;

class BaseController extends Controller
{

    protected function response($result, $params = [])
    {
        $response = [];
        if (is_array($result)) {
            // 表示错误返回
            if (isset($result['code']) && count($result['code']) === 2) {
                $response = [
                    'status'  => false,
                    'message' => $this->filterResultMessage($result['code']),
                ];
            } else {
                $response['status'] = true;
                $message            = $result['message'] ?? '';
                unset($result['message']);
                if (!empty($result)) {
                    $response['data'] = $result;
                }
                if ($message !== '' && count($message) === 2) {
                    $response['message'] = $this->filterResultMessage($message);
                }
            }
        } else {
            $response['status'] = !!$result;
        }
        return Response::json($response);
    }

    protected function filterResultMessage($result)
    {
        $message     = '';
        $codeMessage = array_values($result);
        if (count($codeMessage) === 2) {
            $message = config('code.' . $codeMessage[0])[$codeMessage[1]];
        }
        return $message;
    }

    public function request($type = 'all')
    {
        $result = [];
        switch (strtoupper($type)) {
            case 'GET':
                $result = Request::get();
                break;

            case 'POST':
                $result = Request::post();
                break;

            case 'ALL':
                $result = Request::input($type);
                break;

            default:
                # code...
                break;
        }
        return $result;
    }
}
