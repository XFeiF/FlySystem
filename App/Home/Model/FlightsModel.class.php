<?php
namespace Home\Model;

class FlightsModel extends BaseModel{

        private function getBasicQuery(){
                $basic = "SELECT `fly_airlines`.`airlineName`, `fly_flightlines`.*, `fly_flights`.* 
                                FROM `fly_airlines` 
                                LEFT JOIN `fly_flightlines` ON `fly_flightlines`.`airlineID` = `fly_airlines`.`airlineID` 
                                LEFT JOIN `fly_flights` ON `fly_flights`.`flightName` = `fly_flightlines`.`flightName`";
                return $basic;
        }

        public function getFullFlightsList($whichDay){
                $sql = $this->getBasicQuery()." WHERE `fly_flights`.`dateOfDeparture`>='$whichDay' ";
                return $this->query($sql);
        }

        public function searchFlightsList($from, $to, $mDate){
                if($mDate==null)$mDate = '2017-03-25';
                $sql = $this->getBasicQuery()." WHERE `departure` LIKE '%$from%' AND `destination` LIKE '%$to%' AND `dateOfDeparture` = '$mDate' "; 
                return $this->query($sql);
                
        }

        public function getFlightsDetail($flightID){
                $sql = $this->getBasicQuery()." WHERE `flightID` = $flightID ";
                return $this->query($sql);
        }

        public function getSingleFlight($flightID){
                $sql = "SELECT * FROM `fly_flights` WHERE `flightID`=$flightID";
                
                $rd = $this->query($sql);
                return $rd[0];
        }

         public function minusTickets($flightID){
                $pre = $this->getSingleFlight($flightID);
                $pre['ticketLeftNum'] = $pre['ticketLeftNum'] - 1;
                $this->save($pre);
        }

        public function addTickets($flightID){
                $flight = array();
                $flight['flightID'] = $flightID;
                $pre = $this->getSingleFlight($flightID);
                $flight['ticketLeftNum'] = $pre['ticketLeftNum'] + 1;
                $this->save($flight);
        }

    

}
