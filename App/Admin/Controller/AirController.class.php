<?php
namespace Admin\Controller;
use Think\Controller;
class AirController extends BaseController {
    
    public function airlines(){
        $this->showAirlines();
        $this->display('default/airlines');
    }

    public function flightlines(){
        $this->showFlightlines();
        $this->display('default/flightlines');
    }

    public function flights(){
        $this->showFlights();
        $this->display('default/flights');
    }

     public function ordersInfo(){
         $flightID = $_GET['flightID'];
         $this->showOrdersInfo($flightID);
         $this->display('default/ordersInfo');
    }

    public function addAirlines(){
        //var_dump($_GET) ;
        $airlineName = $_GET['airlineName'];
        $air = D('Admin/Airlines');
        if($air->airlineExisted($airlineName)){
            $this->error('已注册！',U('Admin/Air/airlines'));
        }
        if($air->addAirline($airlineName)){
            $this->success($airlineName.'注册成功',U('Admin/Air/airlines'));
        }else{
            $this->error('注册失败，请重试',U('Admin/Air/airlines'));
        }
        
    }

    
    
    public function addFlightlines(){
        //  var_dump($_GET);
        $fl = $_GET;

        $flightlines_t = D('Admin/Flightlines');
        $air = D('Admin/Airlines');
        if($flightlines_t->flightlineExisted($fl['flightName'])){
            $this->error('航线已存在！',U('Admin/Air/flightlines'));
        }
        $airlineName = $fl['airlineName'];
        $airlineID =  $air->getAirlineID($airlineName);
        // echo $airlineID;
        if(!$airlineID){
            $this->error('航空公司不存在！',U('Admin/Air/flightlines'));
        }else{
            $fl['airlineID'] = $airlineID;
            unset($fl['airlineName']);
        }
       
        // var_dump($fl);
        if($flightlines_t->addFlightline($fl)){
            $this->success('航线'.$fl['flightName'].'添加成功',U('Admin/Air/flightlines'));
        }else{
            $this->error('航线'.$fl['flightName'].'添加失败，请重试',U('Admin/Air/flightlines'));
        }
    }
    

    public function addFlights(){
        $flights = $_GET;
        
        $flights_t = D('Admin/Flights');

        if($flights_t->flightsExisted($flights)){
            $this->error('班机已存在！',U('Admin/Air/flights'));
        }
        if($flights_t->addFlight($flights)){
            $this->success('班机添加成功',U('Admin/Air/flights'));
        }else{
            $this->error('班机添加失败，请重试',U('Admin/Air/flights'));
        }

    }


    private function showAirlines(){
        $this->isLogged();
        $airline_t = D('Admin/Airlines');
        $airlineList = $airline_t->getAllAirlines();
        $this->assign("FLY_AIRLINES_LIST",$airlineList);
    }

    private function showFlightlines(){
        $this->isLogged();
        $flightlines_t = D('Admin/Flightlines');
        $air = D('Admin/Airlines');
        $flightlineList = $flightlines_t->getAllFlightlines();
        $num = count($flightlineList);
        for($i = 0; $i < $num; $i++){
            $f = $flightlineList[$i];
            $airlineID = $flightlineList[$i]['airlineID'];
            $airlineName = $air->getAirlineName($airlineID);
            $flightlineList[$i]['airlineName'] = $airlineName;
        }
        $this->assign("FLY_FLIGHTLINES_LIST",$flightlineList);
    }

    private function showFlights(){
        $this->isLogged();
        $flights_t = D('Admin/Flights');
        $flightsList = $flights_t->getAllFlights();
        $this->assign("FLY_FLIGHTS_LIST",$flightsList);
    }

    private function showOrdersInfo($flightID){
        $this->isLogged();
        $this->assign('flightID', $flightID);
        $flights_t = D('Admin/Flights');
        $orders_t = D('Admin/Orders');

        $F = $flights_t->getSingleFlight($flightID);
        //var_dump($F);
        $fullRate =(1-floatval($F['ticketLeftNum'])/floatval($F['ticketNum']))*100;
       
        $Info = $orders_t->getFlightOrders($flightID);
       // var_dump($Info);

        $this->assign("f",$F);
        $this->assign('fullRate',$fullRate);
        $this->assign("FLY_FLIGHT_ORDER",$Info);
        
    }

}