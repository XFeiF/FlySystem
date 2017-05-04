<?php
namespace Home\Controller;
use Think\Controller;

class FlightsController extends BaseController{

    
    public function index(){
        $table_flights = D('flights');
        $today = date('Y-m-d');
        $fullFlightsList = $table_flights->getFullFlightsList('2017-03-25');

        $this->assign('FLY_FULL_FLIGHTS_LIST',$fullFlightsList);

        $this->display('default/flights/flights');
    }

    public function searchFlights($txtDeparture,$txtDestination,$txtDate){

        $condition = array();
        $from = $condition['from'] = I('txtDeparture');
        $to = $condition['to'] = I('txtDestination');
        $mDate = $condition['date'] = I('txtDate');

        $table_flights = D('flights');
        $fullFlightsList = $table_flights->searchFlightsList($from, $to, $mDate);
        $this->assign('FLY_FULL_FLIGHTS_LIST',$fullFlightsList);

        $this->display('default/flights/flights');
    }

    public function getFlightsDetail($flightID){
        if(!$this->isLogin()){
           	$this->error('未登录！',U('Users/signin'));
        }
        
        $table_flights = D('flights');
        $flightDetail = $table_flights->getFlightsDetail($flightID);
        $this->assign('FLY_FLIGHTS_Detail',$flightDetail);
        $this->display('default/flights/placeorder');
    }

}
