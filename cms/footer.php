<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.6
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>
</div>

<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/cms.min.js"></script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="../../js/responsive.bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/sweetalert.min.js"></script>
<script type="text/javascript" src="../../js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap3-wysihtml5.all.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง _MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เิริ่มต้น",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "สุดท้าย"
                }
            }
        });
        $('.table').DataTable({responsive : true});
    });
    $("#sessionClear").click(function(){
        $.post("../../class/session_clear.php",function(data){
            swal("แจ้งเตือน!","คุณออกจากระบบเรียบร้อย","warning")
            $('.confirm').click(function() {
                window.location.href="../index.php";
            });
        });
    });
    function setImage(input,type) 
    { 
        $('#img'+type).attr('src', input.value);
        if (input.files && input.files[0]) {    
            var reader = new FileReader();    
            reader.onload = function (e) { $('#img'+type).attr('src', e.target.result); }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>

</html>
<?php 
    require("../../class/JsControl.php");
?>
