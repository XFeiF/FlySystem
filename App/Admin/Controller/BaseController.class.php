<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    public function isLogin(){
        $USER = session('FLY_ADMIN');
        if (!empty($USER) && $USER['userName']!='') {
            //var_dump($USER);
            $this->assign('FLY_ADMIN',$USER);
            return true;
        }
        return false;
    }

    public function isLogged(){
        if(!$this->isLogin()){
            $this->error('未登录！', U('Index/index'));
        }
    }
}