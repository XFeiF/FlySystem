function getDomain() {
    return "http://localhost/FlySystem/";
}


function addFlight() {
    $flightName = $('#flightName').val();
    $dateOfDeparture = $('#dateOfDeparture').val();
    $dateOfArrival = $('#dateOfArrival').val();
    $price = $('#price').val();
    $ticketNum = $('#ticketNum').val();
    $ticketLeftNum = $('#ticketNum').val();
    
    $url = "index.php?m=Admin&c=Air&a=addFlights";
    $url2 = $url + "&flightName=" + $flightName 
                 + "&dateOfDeparture="+ $dateOfDeparture
                 + "&dateOfArrival="+$dateOfArrival
                 + "&price="+$price
                 + "&ticketNum="+$ticketNum
                 + "&ticketLeftNum="+$ticketLeftNum;
    window.location.href = getDomain() + $url2;

}