$(document).ready(function() {
    $("#btnLoginModal").click(function() {
        $("#loginModal").modal();
    });
});
$("#sessionClear").click(function() {
    $.post("class/session_clear.php", function(data) {
        swal({ title: "แจ้งเตือน!", text: "คุณออกจากระบบเรียบร้อย", type: "warning", showConfirmButton: false })
        setTimeout(function() { location.href = 'index.php?page=home' }, 3000);
    });
});
$(function() {
    function scroll_fn() {
        document_height = $(document).height();
        scroll_so_far = $(window).scrollTop();
        window_height = $(window).height();
        max_scroll = document_height - window_height;
        scroll_percentage = scroll_so_far / (max_scroll / 100);
        $('.boder_load #webload').width(scroll_percentage + '%');
        $('.boder_load-right #webloadright').width(scroll_percentage + '%');
    }
    $(window).scroll(function() {
        scroll_fn();
    });
    $(window).resize(function() {
        scroll_fn();
    });
});

$(document).on('click', '#close-preview', function() {
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function() {
            $('.image-preview').popover('show');
        },
        function() {
            $('.image-preview').popover('hide');
        });
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type: "button",
        text: 'ปิด',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class", "close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>รูปตัวอย่าง</strong>" + $(closebtn)[0].outerHTML,
        content: "ยังไม่ได้เลือกรูป",
        placement: 'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function() {
        $('.image-preview').attr("data-content", "").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("เลือกรูป");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function() {
        var img = $('<img/>', {
            id: 'dynamic',
            width: "100%",
            height: "auto"
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function(e) {
            $(".image-preview-input-title").text("เปลี่ยนรูป");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
});
