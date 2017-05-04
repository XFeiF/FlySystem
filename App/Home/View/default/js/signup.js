var phoneReg = /^1[3|4|5|7|8]\d{9}$/;
var passwdReg = /^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,22}$/;

$(document).ready(function() {
    $('#signup').click(function() {
        var flag = true;
        var phone = $('#txtMobile').next('p');
        var name = $('#txtUserName').next('p');
        var password = $('#txtPassword').next('p');
        var same = $('#txtCfmPassword').next('p');
        phone.hide();
        name.hide();
        password.hide();
        same.hide();
        if ($('#txtMobile').val() === "" || !phoneReg.test($('#txtMobile').val())) {
            phone.text('请输入有效的手机号码!');
            phone.show();
            flag = false;
        }

        if ($('#txtUserName').val().length < 2) {
            name.text('用户名至少由2位字符组成!');
            name.show();
            flag = false;
        }

        if ($('#txtPassword').val() === "" || !passwdReg.test($('#txtPassword').val())) {
            password.text('密码至少为六位的数字字符组合!')
            password.show();
            flag = false;
        } else if ($('#txtCfmPassword').val() !== $('#txtPassword').val()) {
            same.text('两次输入的密码不一致!');
            password.show();
            flag = false;
        }

        if (flag) {

            // $.ajax({
            //     type: "POST",
            //     url: "index.php?m=Home&c=Users&a=signupSubmit",
            //     //url: "../Register/UserRegister",
            //     data: {
            //         userPhone: $("#txtMobile").val(),
            //         userName: $("#txtUserName").val(),
            //         userPassword: $("#txtPassword").val(),
            //     },

            //     success: function(data) {

            //         if (data.success) {
            //             console.alert(data.msg);
            //             window.location.href = "{:U('User/Login')}";
            //         } else {
            //             console.alert(data.msg);

            //         }
            //     },
            //     error: function(jqXHR, textStatus, errorThrown) {
            //         alert("发生错误：" + jqXHR.status + "  " + textStatus + "  " + errorThrown);
            //     },
            // });
            $('#signupForm').submit();
        }


    })
})