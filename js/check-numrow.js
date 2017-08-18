$(document).ready(function() {
    $('#username').focusout(function() {
        var check = userFail();
        check.success(function(dataUser) {
            var useName = $.trim($("#username").val());
            if (dataUser == "failUser") {
                $('.message-user').html('<i class="fa fa-times" aria-hidden="true"></i> ไอดี "' + useName + '" ไม่สามารถใช้ได้ กรุณาใช้ชื่ออื่น !').css({ "color": "red", "font-size": "14px" });
                $("input[name='username']").css({ "background-color": "#F44336", "color": "#fff", "border": "1px solid red", "margin-bottom": "3px" });
                $("#btnSubmit").hide();
                $(".msg-show").html('<i class="fa fa-user-times" aria-hidden="true"></i> กรุณากรอกชื่อผู้ใช้ให้ถูกต้อง !').show();
            } else {
                $('.message-user').html('').css({ "color": "", "font-size": "" });
                $("input[name='username']").css({ "background-color": "", "color": "", "border": "", "margin-bottom": "" });

                $("#btnSubmit").show();
                $(".msg-show").html('').show();
            }
        });
    });

    $('#email').focusout(function() {
        var check = emailFail();
        check.success(function(dataEmail) {
            var useMail = $.trim($("#email").val());
            if (dataEmail == "failEmail") {
                $('.message-email').html('<i class="fa fa-times" aria-hidden="true"></i> อีเมล์ "' + useMail + '" ไม่สามารถใช้ได้ กรุณาใช้ชื่ออื่น !').css({ "color": "red", "font-size": "14px" });
                $("input[name='email']").css({ "background-color": "#F44336", "color": "#fff", "border": "1px solid red", "margin-bottom": "3px" });
                $("#btnSubmit").hide();
                $(".msg-show").html('<i class="fa fa-envelope" aria-hidden="true"></i> กรุณากรอกอีเมล์ให้ถูกต้อง !').show();
            } else {
                $('.message-email').html('').css({ "color": "", "font-size": "" });
                $("input[name='email']").css({ "background-color": "", "color": "", "border": "", "margin-bottom": "" });

                $("#btnSubmit").show();
                $(".msg-show").html('').show();
            }
        });
    });

    $("#confirm_pass").keyup(checkPassMatch);
    $("#password").keyup(checkPassMatch);
});

function userFail() {
    return $.ajax({
        type: 'POST',
        data: { username: $('#username').val() },
        url: 'class/username_check.php'
    });
}

function emailFail() {
    return $.ajax({
        type: 'POST',
        data: { email: $('#email').val() },
        url: 'class/email_check.php'
    });
}

function checkPassMatch() {
    var password = $("#password").val();
    var confirm_pass = $("#confirm_pass").val();
    if (password != confirm_pass) {
        $(".message-pass").html('<i class="fa fa-times" aria-hidden="true"></i> กรุณากรอกรหัสผ่านให้ตรงกัน !').css({ "color": "red", "font-size": "14px" });
        $("#password").css({ "background-color": "#F44336", "color": "#fff", "border": "1px solid red", "margin-bottom": "3px" });
        $("#confirm_pass").css({ "background-color": "#F44336", "color": "#fff", "border": "1px solid red", "margin-bottom": "3px" });
        document.getElementById("btnSubmit").disabled = true;
    } else {
        $(".message-pass").html('');
        $("#password").css({ "background-color": "", "color": "", "border": "", "margin-bottom": "" });
        $("#confirm_pass").css({ "background-color": "", "color": "", "border": "", "margin-bottom": "" });
        document.getElementById("btnSubmit").disabled = false;
    }
}
