<?php
namespace App\Http\Controllers\Common;

use Ububs\Core\Http\Interaction\Request;
use App\Repositories\Common\FileRepository;

class FileController extends BaseController
{
    public function upload($type)
    {
        $file = Request::file();
        $result = FileRepository::getInstance()->upload($type, $file);
        return $this->response($result);
    }
}