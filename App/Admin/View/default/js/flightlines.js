function getDomain() {
    return "http://localhost/FlySystem/";
}


function addFlightline() {
    $flightName = $('#flightName').val();
    $departure = $('#departure').val();
    $destination = $('#destination').val();
    $timeOfFly = $('#timeOfFly').val();
    $timeOfArrival = $('#timeOfArrival').val();
    $airlineName = $('#airlineName').val();

    $url = "index.php?m=Admin&c=Air&a=addFlightlines";
    $url2 = $url + "&flightName=" + $flightName +
        "&departure=" + $departure +
        "&destination=" + $destination +
        "&timeOfFly=" + $timeOfFly +
        "&timeOfArrival=" + $timeOfArrival +
        "&airlineName=" + $airlineName;
    window.location.href = getDomain() + $url2;

}