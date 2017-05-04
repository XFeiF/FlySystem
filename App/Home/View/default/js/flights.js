$(document).ready(function() {

});

function getYMD() {
    var mydate = new Date();
    var str = mydate.getFullYear() + "-";
    str += (mydate.getMonth() + 1) + "-";
    str += mydate.getDate();
    return str;
}

function getDomain() {
    return "http://localhost/FlySystem/";
}


function searchFlights() {
    $dep = $('#txtDeparture').val();
    $des = $('#txtDestination').val();
    $indate = $('#indate').val();
    $indate = $indate == "" ? getYMD() : $indate;
    $url = "index.php?m=Home&c=flights&a=searchFlights";
    $url2 = $url + "&txtDeparture=" + $dep + "&txtDestination=" + $des + "&txtDate=" + $indate;
    // $.get($url, {
    //     txtDeparture: $dep,
    //     txtDestination: $des,
    //     txtDate: $indate,
    // }, function() {
    //     window.location.href = "http://localhost/FlySystem/" + $url2;
    // });
    window.location.href = getDomain() + $url2;

}