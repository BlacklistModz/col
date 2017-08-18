// a href เรียกใช้ผ่านคลาสหรือไอดี
$('.confirmation').click(function(e) {
    var href = $(this).attr('href');

    swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                window.location.href = href;
            }
        });

    return false;
});


$('a').click(function(e){
    e.preventDefault();
    var link = $(this).attr('href');

    swal({
        title: "Are you sure?",
        text: "By clicking 'OK' you will be redirected to the link.",
        type: "warning",
        showCancelButton: true
    },
    function(){
        window.location.href = link;
    });
});

// form เรียกใช้ผ่าน id ของ form นั้นๆ
var el = document.getElementById('form12');
if (el) {
    el.addEventListener('submit', function(e) {
        var form = this;
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: 'Shortlisted!',
                        text: 'Candidates are successfully shortlisted!',
                        type: 'success'
                    }, function() {
                        form.submit();
                    });

                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    });
}
