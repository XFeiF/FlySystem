function checkUser() {
    var userName = document.getElementById("userName").value;
    var userPasswd = document.getElementById("userPasswd").value;

    if (userName == "") {
        alert("用户名不能为空");
        return false;
    }
    if (userPasswd == "") {
        alert("密码不能为空");
        return false;
    } else {
        return true;
    }
}

function submitForm() {
    if (checkUser())
        $('form').submit();
}