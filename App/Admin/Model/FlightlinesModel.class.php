<?php
namespace Admin\Model;

class FlightlinesModel extends BaseModel{
    
    private function getFlQuery(){
        $sql = "SELECT * FROM `fly_flightlines` ";
        return $sql;
    }

    public function getAllFlightlines(){
        $sql = $this->getFlQuery();
        return $this->query($sql);
    }


    public function getFlightlineName($airlineID){
        $sql = $this->getFlQuery()." WHERE `airlineID` = $airlineID ";
        return $this->query($sql);
    }

    public function addFlightline($data){
        if($this->add($data)) return true;
        return false;
    }

    public function flightlineExisted($flightName){
        $sql = $this->getFlQuery()." WHERE `flightName` = $flightName ";
        if($this->query($sql)) return true;
        return false;
    }

}
