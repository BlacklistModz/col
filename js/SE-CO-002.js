$(document).ready(function() {

    var el = document.getElementById('submit_form');
    if (el) {
    	el.addEventListener('submit', function(e) {
    		var form = this;
    		e.preventDefault();

    		var fd = new FormData();
    		var other_data = $(this).serializeArray();
    		$.each(other_data, function(key, input) {
    			fd.append(input.name, input.value);
    		});
    		console.log(other_data);
    		swal({
    			title: "คุณแน่ใจหรือไม่?",
    			text: "ต้องการบันทึกข้อมูล!",
    			type: "warning",
    			showCancelButton: true,
    			confirmButtonColor: '#DD6B55',
    			confirmButtonText: 'ใช่, ตกลง!',
    			cancelButtonText: "ไม่, ยกเลิก!",
    			closeOnConfirm: false,
    			closeOnCancel: true
    		},
    		function(isConfirm) {
    			if (isConfirm) {
    				$.ajax({
    					url: 'corp_info.php',
    					type: 'POST',
    					dataType: 'json',
    					cache: false,
    					contentType: false,
    					processData: false,
    					data: fd,
    					beforeSend: function(bfs) {
    						$(".item").css({"display": "block"});
    						console.log(bfs);
    					},
    				})
    				.done(function(reply) {
    					if (reply == 1) {
    						$(".item").css({"display": "none"});
    						swal("เสร็จสิ้น!", "บันทึกข้อมูลเรียบร้อย", "success");
    						$('.confirm').click(function() {
    							window.location.href="SE-CO-002.php?page=company&sub=coop_02";
    						});
    					} else {
    						$(".item").css({"display": "none"});
    						swal("พบข้อผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง! \n หรือติดต่อสาขาวิชาวิศวกรรมซอฟต์แวร์ \n โทร 054-237399 ต่อ (6000)", "error");
    					}
    				});
    			} 
    		});
    	});
    }

    $("#radio1").click(function(){
        $("#compensation2").attr("disabled", true);
        $("#compensation3").attr("disabled", true);

        $("#compensation2").val("");
        $("#compensation3").val("");
    });

    $("#radio2").click(function(){
        $("#compensation2").attr("disabled", false);

        $("#compensation3").attr("disabled", true);
        $("#compensation3").val("");
    });

    $("#radio3").click(function(){
        $("#compensation3").attr("disabled", false);

        $("#compensation2").attr("disabled", true);
        $("#compensation2").val("");
    });
});