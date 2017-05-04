<?php
namespace Admin\Model;

class UsersModel extends BaseModel{

	private function getUserQuery(){
		$sql = "SELECT `userID`, `userName`, `userPhone` FROM `fly_users`";
		return $sql;
	}


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


     public function getAllUsers(){
		 $sql = $this->getUserQuery();
		 return $this->query($sql);
	 }


	 
}
