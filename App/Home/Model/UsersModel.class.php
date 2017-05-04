<?php
namespace Home\Model;

class UsersModel extends BaseModel{


     public function get($userID=0){
	 	$userId = intval($userId?$userId:I('id',0));
		$user = $this->where("userID=".$userId)->find();
		return $user;
	 }

     public function getUserInfo($userPhone,$userPassword){
		$userPassword = md5($userPassword);
	 	$a_user = $this->where(" userPhone ='%s' AND userPassword ='%s' ",array($userPhone,$userPassword))->find();
	    return $a_user;
	 }


     /**
	 * 用户登录验证
	 */
	public function checkLogin(){
		$rv = array('status'=>2);
		$userPhone = I('txtUserPhone' );
		$userPwd = I('txtPassword' );
        $sql = " userPhone='".$userPhone."'";
		$userList = $this->where($sql)->select();
		if(!empty($userList)){
			$a_user = $userList[0];
			if($a_user['userPassword']!=md5($userPwd)) return $rv;

			$rv = $a_user;
		    //记住密码
			setcookie("userPhone", $userPhone, time()+3600*24*90);
			$loginKey = md5($a_user['userPassword']);
			setcookie("userPassword", $loginKey, time()+3600*24*90);
		}
		 return $rv;
	}


    /**
	 * 查询用户手机是否被注册
	 */
    public function checkUserPhone($userPhone){
    	$rd = array('status'=>36006);
		$sql =" userPhone='".$userPhone."'";
		$a_user = $this->where($sql)->count();
	    if($a_user==0) $rd['status'] = 1;//未被注册
	    return $rd;
	}


    /**
    * 新会员注册
    */
    public function signUp(){
    	$data = array();
    	$data['userName'] = I('txtUserName','');
    	$data['userPassword'] = md5(I("txtPassword"));
    	$data['userPhone'] = I("txtMobile");
    	$userPhone = $data['userPhone'];
        //检测账号是否存在
        $crs = $this->checkUserPhone($userPhone);
        if($crs['status']!=1){
	    	$rd['status'] = -2;
	    	$rd['msg'] = ($crs['status']==-2)?"不能使用该手机号":"该手机号已被注册";
	    	return $rd;
	    }

        //添加到数据库
		$rs = $this->add($data);
		if(false !== $rs){
			$rd['status']= 1;
			$rd['userId']= $rs;
	    }
		return $rd;
    }

    /**
	  * 查询登录名是否存在
	  */
	 public function checkLoginKey($loginName,$id = 0){

	 }


	 
}
