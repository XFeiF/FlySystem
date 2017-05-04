<?php
namespace Admin\Model;

class FlightsModel extends BaseModel{

    private function getFlightsQuery(){
        $sql = "SELECT * FROM `fly_flights` ";
        return $sql;
    }

    private function getSingleFlightQuery(){
        $basic = "SELECT `fly_airlines`.`airlineName`, `fly_flightlines`.*, `fly_flights`.* 
                                FROM `fly_airlines` 
                                LEFT JOIN `fly_flightlines` ON `fly_flightlines`.`airlineID` = `fly_airlines`.`airlineID` 
                                LEFT JOIN `fly_flights` ON `fly_flights`.`flightName` = `fly_flightlines`.`flightName`";
                return $basic;
    }

    public function getAllFlights(){
        $sql = $this->getFlightsQuery();
        return $this->query($sql);
    }


    public function addFlight($data){
        if($this->add($data)) return true;
        return false;
    }

    public function flightsExisted($flight){
        $flightName = $flight['flightName'];
        $dateOfDeparture = $flight['dateOfDeparture'];
        $sql = $this->getFlightsQuery()." WHERE `flightName` = $flightName and `dateOfDeparture` = $dateOfDeparture ";
        if($this->query($sql)) return true;
        return false;
    }

    public function getSingleFlight($flightID){
        $sql = $this->getSingleFlightQuery()."WHERE `fly_flights`.`flightID` = $flightID";
        $rd =  $this->query($sql);
        return $rd[0]; 
    }

    public function getMonthIncomeData($year, $month){
        $from = $this->getMonthYearString($year,$month);
        $to = $this->getMonthYearString($year, $month+1);
        $where = " WHERE `dateOfDeparture` < '$to' AND `dateOfDeparture`>'$from' ";
        $sql = $this->getFlightsQuery().$where;
        return $this->query($sql);
    }

    public function getYearIncomeData($year){
        $from = $year;
        $to = $year + 1;
        $where = " WHERE `dateOfDeparture` < '$to' AND `dateOfDeparture`> '$from' ";
        $sql = $this->getFlightsQuery().$where;
        return $this->query($sql);
    }
    

}
