<?php
namespace Admin\Model;

class AirlinesModel extends BaseModel{

    private function getAirlinesQuery(){
        $sql = "SELECT `airlineID`, `airlineName` FROM `fly_airlines`";
        return $sql;
    }

    public function getAllAirlines(){
        $sql = $this->getAirlinesQuery();
        return $this->query($sql);
    }

    public function getAirlineID($airlineName){
         $sql = $this->getAirlinesQuery()." WHERE `airlineName` = '$airlineName' ";
         $rd = $this->query($sql);
         
        if($rd ) return $rd[0]['airlineID'];
    }

    public function getAirlineName($airlineID){
         $sql = $this->getAirlinesQuery()." WHERE `airlineID` = $airlineID ";
         $rd = $this->query($sql);
        if($rd ) return $rd[0]['airlineName'];
    }

    public function addAirline($airlineName){
        $newA = array();
        $newA['airlineName'] = $airlineName;
        $rd = $this->add($newA);
        if($rd) return true;
        return false;    
    }

    public function airlineExisted($airlineName){
        $sql = $this->getAirlinesQuery()." WHERE `airlineName` = '$airlineName' ";
        if($this->query($sql)) return true;
        return false;
    }

    public function getMonthIncome($year, $month){
        $income = 0;
        $flightTable = D('Admin/Flights');
        $data = $flightTable->getMonthIncomeData($year,$month);
        //var_dump($data);
        for($i = 0; $i < count($data); $i++){
            $income += ($data[$i]['ticketNum']-$data[$i]['ticketLeftNum'])*$data[$i]['price'];
        }
        return $income;

    }

    public function getYearIncome($year){
        $income = 0;
        $year = intval($year);
        $flightTable = D('Admin/Flights');
        $data = $flightTable->getYearIncomeData($year);
        //var_dump($data);
        for($i = 0; $i < count($data); $i++){
            $income += ($data[$i]['ticketNum']-$data[$i]['ticketLeftNum'])*$data[$i]['price'];
            //echo $income;
        }
        return $income;
    }


    
}
