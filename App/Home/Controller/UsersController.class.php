<?php
namespace Home\Controller;
use Think\Controller;
class UsersController extends BaseController{

    private function getMe(){
        return session('FLY_USER');
    }

    public function signin(){
        if($this->isLogin()){
            $this->redirect(U('Index/index'));        
        }
        $this->display('default/signin');
    }

   

    public function signinCheck(){
        $rs = array();
	    $rs["status"]= 1;
		$m = D('Home/Users');
		$res = $m->checkLogin();
		if (!empty($res)){
			if($res['userPhone'] != ''){
				session('FLY_USER',$res);
                //var_dump($res);
                $this->redirect(U('Flights/index'));
			}else if($res['status'] == 2){
				$this->error('密码错误！',U('Users/signin'));
			}
		}
		
	    // echo json_encode($rs);
    }

    public function logout(){
        session('FLY_USER',null);
		setcookie("userName", null);
		$this->display('default/home');
    }



	public function signup(){
        $this->display('default/signup');
    }

	public function signupSubmit(){
        $m = D('Home/Users');
        $rs = $m->signUp();
        if ($rs['status'] > 0) {
            $user = $m->get($rs['userId']);
            if(!empty($user)) session('FLY_USER',$user);
            $url = U('Users/signin');
            $this->success('注册成功',$url);
        } else{
            $url = U('Users/signup');
            $this->error($rs['msg'],$url);
        }
	}

    private function checkLogin(){
        if(!$this->isLogin()){
           	$this->error('未登录！',U('Users/signin'));
        }
    }

    public function center(){
       $this->checkLogin();

        $this->display('default/user/center');
    }

    public function placeOrder($flightID){
        $this->checkLogin();

        $me = $this->getMe();
        $myID = $me['userID'];

        $orders = D('Home/Orders');
        $rs = $orders->placeOrder($myID, $flightID);
        if($rs){
            $this->showOrders();
        }else{
            $this->error('预定失败，请重试',U('Flights/getFlightsDetail', array('flightID'=>$flightID)));
        }

    }

    public function showOrders(){
        $this->checkLogin();

        $this->assign('FLY_MY_ORDERS',"");

        $me = $this->getMe();
        $myID = $me['userID'];

        $orders = D('Home/Orders');

        $myOrders = $orders->getUserOrderedOrders($myID);
        $myPaidOrders = $orders->getUserPaidOrders($myID);
        $myCanceledOrders = $orders->getUserCancledOrders($myID);

        $this->assign('FLY_MY_ORDERS',$myOrders);
        $this->assign('FLY_MY_PAID_ORDERS',$myPaidOrders);
        $this->assign('FLY_MY_CANCLED_ORDERS',$myCanceledOrders);
        $this->display('default/user/order');
    }

    public function showTickets(){
        $this->checkLogin();

        $me = $this->getMe();

        $myID = $me['userID'];
        $orders = D('Home/Orders');
        
        $myTickets = $orders->getUserCheckinTickets($myID);
        $myBounceTickets = $orders->getUserBounceTicket($myID);

        $this->assign('FLY_MY_TICKETS',$myTickets);
        $this->assign('FLY_MY_BOUNCE_TICKETS',$myBounceTickets);

        $this->display('default/user/tickets');
        
    }

    public function payForOrder($orderID){
        $this->checkLogin();

        $orders = D('Home/Orders');

        
        $res = $orders->payForOrder($orderID);

        if($res){
            $this->showOrders();
        }else{echo "付款失败";}
    }

    public function cancelOrder($orderID){
        $this->checkLogin();


        $orders = D('Home/Orders');

        $res = $orders->cancelOrder($orderID);
        if($res){
            $this->showOrders();
        }else{
            echo "取消失败";
        }
    }

    public function takeTicket($orderID){
        $this->checkLogin();
        
        $orders = D('Home/Orders');

        $res = $orders->takeTicket($orderID);
        if($res){
            $this->showTickets();
        }else{
            echo "取票失败";
        }
    }

    public function bounceTicket($orderID){
        $this->checkLogin();
        
        $orders = D('Home/Orders');

        $res = $orders->bounceTicket($orderID);
        if($res){
            $this->showTickets();
        }else{
            echo "取票失败";
        }
    }

    

}
