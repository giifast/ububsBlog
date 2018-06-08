<?php
namespace App\Http\Controllers\Common;

use App\Repositories\Common\FileRepository;
use Ububs\Core\Http\Interaction\Request;
use Ububs\Core\Http\Interaction\Response;
use Ububs\Core\Component\Db\Db;
class FileController extends BaseController
{
    public function upload($type, $module)
    {
        $file   = Request::file();
        $result = FileRepository::getInstance()->upload($type, $module, $file);
        return $this->response($result);
    }

    public function getKey($module, $id)
    {
    	$result = FileRepository::getInstance()->getKey($module, $id);
        return $this->response($result);
    }

    public function download()
    {
        $input = $this->request('get');
    	$result = FileRepository::getInstance()->download($input);
        return $this->response($result);
    }
}
