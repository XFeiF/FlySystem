window.onload = function() {
    //设置年份的选择 
    var myDate = new Date();
    var startYear = myDate.getFullYear() - 10; //起始年份 
    var endYear = myDate.getFullYear(); //结束年份 
    var obj = document.getElementById('myYear')
    for (var i = startYear; i <= endYear; i++) {
        obj.options.add(new Option(i, i));
    }


    function GetQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }
    var urlYear = GetQueryString('year');
    if (urlYear) {
        obj.value = urlYear;
    } else {
        obj.options[obj.options.length - 1].selected = 1;
    }




}