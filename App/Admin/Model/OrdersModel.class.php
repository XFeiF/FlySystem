<?php
namespace Admin\Model;

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

    private function getFlightOrdersQurey(){
        $sql = "SELECT `fly_orders`.*, `fly_users`.`userID`,`fly_users`.`userName` 
                FROM fly_orders, fly_users
                WHERE `fly_orders`.`status` IN ('已预订','已取票','已付款') 
                     AND `fly_orders`.`userID` = `fly_users`.`userID`
                     AND ";
        return $sql;
    }
    
    public function getFlightOrders($flightID){
        $sql = $this->getFlightOrdersQurey()." `fly_orders`.`flightID` = $flightID ";
        return $this->query($sql);
    }
    

}
