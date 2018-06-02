<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Common\BaseController;
use App\Repositories\Backend\LoginRepository;
use Ububs\Core\Http\Interaction\Request;

class AuthController extends BaseController
{

    public function backend()
    {
        $this->display('backend');
    }

    public function backendLogin()
    {
        $input  = Request::post();
        $result = LoginRepository::getInstance()->login($input);
        return $this->response($result);
    }

    public function backendLogout()
    {
        $result = LoginRepository::getInstance()->logout();
        return $this->response($result);
    }

    public function frontend()
    {
        $this->display('frontend');
    }

}
