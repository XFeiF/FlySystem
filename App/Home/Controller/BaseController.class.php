<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{
    public function isLogin(){
        $USER = session('FLY_USER');
        if (!empty($USER) && $USER['userID']!='') {
            //var_dump($USER);
            $this->assign('FLY_USER',$USER);
            return true;
        }
        if (isset($_COOKIE["userName"])) {
            $this->assign('userName',$_COOKIE["userName"]);
        }else{
            $this->assign('userName','');
        }
        return false;
    }
}