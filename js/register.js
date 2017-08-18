$(document).ready(function() {
    var el = document.getElementById('form_register');
    if (el) {
        el.addEventListener('submit', function(e) {
            var form = this;
            e.preventDefault();

            var fd = new FormData();
            var file_data = $('#img').prop('files')[0];
            fd.append("picture", file_data);

            var other_data = $(this).serializeArray();
            $.each(other_data, function(key, input) {
                fd.append(input.name, input.value);
            });
            console.log(other_data,file_data);
            swal({
                title: "ต้องการลงทะเบียน?",
                text: "ข้าพเจ้ายอมรับว่าข้อมูลทุกอย่างเป็นความจริง",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'ใช่, ตกลง!',
                cancelButtonText: "ไม่, ยกเลิก!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: 'check_register.php',
                        type: 'POST',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fd,
                        beforeSend: function(bfs) {
                            $(".page-loader").css({"display": "block"});
                            console.log(bfs);
                        },
                    })
                    .done(function(reply) {
                        if (reply == 1) {
                            $(".page-loader").css({"display": "none"});
                            swal("ลงทะเบียนเรียบร้อย!", "กรุณายืนยันบัญชีผ่านอีเมล์ของท่าน \n ระบบจะส่งอีเมลให้ภายใน 3-5 นาที \n หรือ โทร 054-237399 ต่อ (6000)", "success");
                            $('.confirm').click(function() {
                                window.location.href="index.php?page=home";
                            });
                        } else if (reply == 2) {
                            $(".page-loader").css({"display": "none"});
                            swal("ลงทะเบียนเรียบร้อย!", "เกิดปัญหาในระบบยืนยันบัญชีของอีเมล์ \n กรุณาติดต่อสาขาวิชาวิศวกรรมซอต์แวร์ \n หรือ โทร 054-237399 ต่อ (6000)", "warning");
                            $('.confirm').click(function() {
                                window.location.href="index.php?page=home";
                            });
                        } else if (reply == 3) {
                            $(".page-loader").css({"display": "none"});
                            swal("พบข้อผิดพลาด!", "Username ไม่สามารถใช้ได้ กรุณาลองใหม่อีกครั้ง!", "error");
                        } else if (reply == 4) {
                            $(".page-loader").css({"display": "none"});
                            swal("พบข้อผิดพลาด!", "E-mail ไม่สามารถใช้ได้ กรุณาลองใหม่อีกครั้ง!", "error");
                        } else {
                            $(".page-loader").css({"display": "none"});
                            swal("พบข้อผิดพลาด!", "ไม่สามารถลงทะเบียนได้ กรุณาลองใหม่อีกครั้ง!", "error");
                        }
                    });
                } 
            });
        });
    }
});