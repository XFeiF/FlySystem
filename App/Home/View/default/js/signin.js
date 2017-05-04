        $(document).ready(function() {
            $(document).keydown(function(event) {
                if (event.keyCode == 13) {
                    submitForm();
                }
            });
            $(".sign_list_text span").click(function() {
                $(this).hide();
                $(this).next('input').focus();
            })
            if ($("#txtUserName").val() != "") {
                $("#txtUserName").prev("span").hide();
            }
            if ($("#txtPassword").val() != "") {
                $("#txtPassword").prev("span").hide();
            }
            var error = 0;
            if (error > 0) {
                switch (error) {
                    case 1:
                        $("#ListMsg").html("用户名或者密码不能为空");
                        break;
                    case 2:
                        $("#ListMsg").html("账号不存在或未绑定");
                        break;
                    case 36006:
                        $("#ListMsg").html("用户名或手机号不存在");
                        break;
                    case 36007:
                        $("#ListMsg").html("密码错误");
                        break;
                    default:
                        $("#ListMsg").html("用户名或者密码错误");
                        break;

                }
            }
        });

        function submitForm() {
            if ($.trim($("#txtUserPhone").val()) == "" || $.trim($("#txtUserName").val()) == "通行证") {
                $("#ListMsg").html("请输入手机号");
                $("#txtUserName").focus();
                return false;
            }
            if ($.trim($("#txtPassword").val()) == "" || $.trim($("#txtPassword").val()) == "不少于六位密码") {
                $("#ListMsg").html("请输入密码");
                $("#txtPassword").focus();
                return false;
            }

            $('form').submit();
        }