<?php
namespace Home\Model;

class OrdersModel extends BaseModel{

    
    private function getBasicQuery(){
        $sql = "SELECT `fly_orders`.`orderID`, `fly_flightlines`.*, `fly_flights`.* 
                FROM `fly_flights` 
                    LEFT JOIN `fly_orders` ON `fly_orders`.`flightID` = `fly_flights`.`flightID` 
                    LEFT JOIN `fly_users` ON `fly_orders`.`userID` = `fly_users`.`userID` 
                    LEFT JOIN `fly_flightlines` ON `fly_flights`.`flightName` = `fly_flightlines`.`flightName` ";

        return $sql;
    }

    private function getBasicOrderQuery(){
        $sql = "SELECT `fly_orders`.*, `fly_airlines`.`airlineName`, `fly_flights`.*, `fly_flightlines`.*, `fly_users`.`userName`,`fly_users`.`userPhone`
            FROM `fly_flights`
            LEFT JOIN `fly_orders` ON `fly_orders`.`flightID` = `fly_flights`.`flightID`
            LEFT JOIN `fly_users` ON `fly_orders`.`userID` = `fly_users`.`userID`
            LEFT JOIN `fly_flightlines` ON `fly_flights`.`flightName` = `fly_flightlines`.`flightName`
            LEFT JOIN `fly_airlines` ON `fly_flightlines`.`airlineID` = `fly_airlines`.`airlineID`";
                    
        return $sql;
    }
    

    public function getUserOrderedOrders($UID){
        $sql = $this->getBasicOrderQuery()." WHERE `fly_orders`.`userID` = $UID and `fly_orders`.`status` = '已预订'";
        return $this->query($sql);
    }

    public function getUserCancledOrders($UID){
        $sql = $this->getBasicOrderQuery()." WHERE `fly_orders`.`userID` = $UID and `fly_orders`.`status` = '已取消'";
        return $this->query($sql);
    }

    public function getUserPaidOrders($UID){
        $sql = $this->getBasicOrderQuery()." WHERE `fly_orders`.`userID` = $UID and `fly_orders`.`isPaid` = 1 and `fly_orders`.`isCheckin` != 1";
        return $this->query($sql);        
    }

    public function getUserCheckinTickets($UID){
        $sql = $this->getBasicOrderQuery()." WHERE `fly_orders`.`userID` = $UID and `fly_orders`.`isCheckin` = 1";
        return $this->query($sql);        
    }

    public function getUserBounceTicket($UID){
        $sql = $this->getBasicOrderQuery()." WHERE `fly_orders`.`userID` = $UID and `fly_orders`.`status` = '已退票'";
        return $this->query($sql);  
    }

    public function getSingleOrder($orderID){
         $sql = "SELECT * FROM `fly_orders` WHERE `orderID`=$orderID";
                
         $rd = $this->query($sql);
         return $rd[0];
    }
    

    public function payForOrder($orderID){
        $payOrder =$this->getSingleOrder($orderID);
        $payOrder['orderID'] = $orderID;
        $payOrder['status'] = '已付款';
        $payOrder['isPaid'] = 1;
        $payOrder['paydate'] = date("Y-m-d");
        return $this->save($payOrder);
    }

    public function cancelOrder($orderID){
        $payOrder = $this->getSingleOrder($orderID);
        $payOrder['orderID'] = $orderID;
        $payOrder['status'] = '已取消';
        $payOrder['isPaid'] = 0;
        if($this->save($payOrder)){
            $this->addTickets($payOrder['flightID']);
            return true;
        }
        return false;
    }

    public function takeTicket($orderID){
        $payOrder = $this->getSingleOrder($orderID);
        $payOrder['orderID'] = $orderID;
        $payOrder['status'] = '已取票';
        $payOrder['isCheckin'] = 1;
        return $this->save($payOrder);
    }

    public function bounceTicket($orderID){
        $payOrder = $this->getSingleOrder($orderID);

        $payOrder['orderID'] = $orderID;
        $payOrder['status'] = '已退票';
        $payOrder['isCheckin'] = 0;
        $payOrder['isPaid'] = 0;
        $payOrder['paydate'] = null;
        $this->addTickets($payOrder['flightID']);

        return $this->save($payOrder);
    }

    public function placeOrder($userID, $flightID){
        $order = array();
        $order['userID'] = $userID;
        $order['flightID'] = $flightID;
        //todo: 这里可以做一个是否订过相同航班的判断
        $order['status'] = '已预订';
        $this->minusTickets($flightID);     

        return $this->add($order);
    }

    private function minusTickets($flightID){
        $flightTable = D('Home/Flights');
        $flightTable->minusTickets($flightID);
    }

    private function addTickets($flightID){
        $flightTable = D('Home/Flights');
        $flightTable->addTickets($flightID);
    }

}
