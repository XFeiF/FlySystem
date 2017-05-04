<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {

    
    public function index(){
        $this->display('default/login');
    }

    public function loginCheck(){
        $admin = $_POST;
        if($admin['userName'] == 'admin' && $admin['userPasswd'] == 'asdfqwer1'){
            session('FLY_ADMIN',$admin);
            $this->redirect(U('Admin/Index/home'));
        }else{
            $this->error('用户不存在或密码错误！',U('Admin/Index/index'));
        }
    }

     public function logout(){
        session('FLY_USER',null);
		setcookie("userName", null);
		$this->display('default/login');
    }

    public function home(){
        $this->isLogged();
        $this->display('default/home');
    }

    public function users(){
        $this->isLogged();
        $user_t = D('Admin/Users');
        $userList = $user_t->getAllUsers();
        $this->assign("FLY_USERS_LIST",$userList);

        $this->display('default/users');
    }

    public function income(){
        $this->isLogged();
        $year = I('year');
        if(!$year) $year = date('Y');
        $income = $this->getYearAllIncome($year);
        $this->assign('F_INCOME', $income);
        $this->display('default/income');
    }

    private function monthIncome($year,$month){
        $this->isLogged();
        $air = D('Admin/Airlines');
        $income = $air->getMonthIncome($year, $month);
        return $income;
    }

    private function yearIncome($year){
        $air = D('Admin/Airlines');
        $income = $air->getYearIncome($year);
        return $income;
    }

    private function getYearAllIncome($year){
        $income = array();
        $sum = 0;
        for($i=1; $i<=12;$i++){
            $income[$i] = $this->monthIncome($year, $i);
            $sum += $income[$i]; 
        }
        $income[0] = $sum;
        return $income;
    }

    

   
}