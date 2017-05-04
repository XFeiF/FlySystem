function getDomain() {
    return "http://localhost/FlySystem/";
}


function addAirline() {
    $airlineName = $('#airlineName').val();
    $url = "index.php?m=Admin&c=Air&a=addAirlines";
    $url2 = $url + "&airlineName=" + $airlineName;
    window.location.href = getDomain() + $url2;

}