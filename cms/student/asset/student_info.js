$(document).ready(function() {
    var counter = $("#count").data("counter");

    $("#addTraining").click(function() {
        // if (counter > 4) {swal("แจ้งเตือน!!!", "ไม่สามารถเพิ่มมากกว่า 4 ช่องได้", "warning");return false;}
        var newTextBoxDiv = $(document.createElement('div'))
        .attr("id", 'trainingBoxDiv' + counter);

        newTextBoxDiv.after().html('<div class="form-group"><label class="control-label col-md-4">หัวข้อการฝึกอบรม (' + counter + ')<span class="required"> * </span></label><div class="col-md-6"><div class="input-group"><input type="text" class="form-control" name="training_topics[]" value="" placeholder="หัวข้อของการฝึกอบรม" required style="margin-bottom: 5px;" /><span class="input-group-btn" style="vertical-align: top;"><input class="btn btn-danger removeTraining" type="button" value="ลบหัวข้อนี้" id="divbox' + counter + '" data-divbox="'+counter+'" /></span></div></div></div><div class="form-group"><label class="control-label col-md-4">หน่วยงานที่ให้การฝึกอบรม<span class="required"> * </span></label><div class="col-md-6"><input type="text" class="form-control" name="training_agency[]" value="" placeholder="หน่วยงานที่ให้การฝึกอบรม" required /></div></div><div class="form-group"><label class="control-label col-md-4">ช่วงเวลาที่ฝึกอบรม (เดือน / ปี)<span class="required"> * </span></label><div class="col-md-6"><input type="text" class="form-control dateMonths" name="training_duration[]" value="" data-date="dtp" placeholder="ช่วงเวลาที่ฝึกอบรม" readonly required /></div></div>');

        newTextBoxDiv.appendTo("#trainingBoxesGroup");
        counter++;
        
    });
    $(document).on("click", "input.removeTraining", function() { //ฟังชั่นลบ Element
        if (counter == 2) {
            swal("ผิดพลาด!!!", "ไม่สามารถลบได้", "error");
            return false;
        }
        counter--;
        var divBox = $(this).data("divbox");
        $("#trainingBoxDiv" + divBox).remove();
    });

    var expcounter = $("#expcount").data("expcounter");
    $("#addExp").click(function() {
        // if (counter > 4) {swal("แจ้งเตือน!!!", "ไม่สามารถเพิ่มมากกว่า 4 ช่องได้", "warning");return false;}
        var newTextBoxDiv = $(document.createElement('div'))
        .attr("id", 'expBoxDiv' + expcounter);

        newTextBoxDiv.after().html('<div class="form-group"><label class="control-label col-md-4">หัวข้อกิจกรรมที่ (' + expcounter + ')<span class="required"> * </span></label><div class="col-md-6"><div class="input-group"><input type="text" class="form-control" name="exp_topics[]" value="" placeholder="หัวข้อประสบการณ์หรือกิจกรรม" style="margin-bottom: 5px;" required /><span class="input-group-btn" style="vertical-align: top;"><input class="btn btn-danger removeExp" type="button" value="ลบกิจกรรมนี้" id="expbox' + expcounter + '" data-expbox="' + expcounter + '" /></span></div></div></div><div class="form-group"><label class="control-label col-md-4">ช่วงเวลา - ปี <span class="required"> * </span></label><div class="col-md-6"><input type="text" class="form-control dateMonths" name="exp_duration[]" value="" data-date="dtp" placeholder="ปีหรือช่วงเวลาการทำกิจกรรม" readonly required /></div></div><div class="form-group"><label class="control-label col-md-4">ความรับผิดชอบ <span class="required"> * </span></label><div class="col-md-6"><input type="text" class="form-control" name="exp_responsibility[]" value="" placeholder="ความรับผิดชอบหรือหน้าที่ในการทำกิจกรรม" required /></div></div><div class="form-group"><label class="control-label col-md-4">ชื่อรางวัล <span class="required"> * </span></label><div class="col-md-6"><input type="text" class="form-control" name="exp_award[]" value="" placeholder="ชื่อรางวัลที่ได้รับ" required /></div></div><div class="form-group"><label class="control-label col-md-4">หน่วยงานที่มอบให้ <span class="required"> * </span></label><div class="col-md-6"><input type="text" class="form-control" name="exp_agency[]" value="" placeholder="หน่วยงานที่มอบให้" required /></div></div><div class="form-group"><label class="control-label col-md-4">วัน/เดือน/ปี ที่ได้รับ <span class="required"> * </span></label><div class="col-md-6"><input type="text" class="form-control dateTimePicker" name="exp_year[]" value="" data-date="dtp" placeholder="วัน/เดือน/ปี ที่ได้รับรางวัล" readonly required /></div></div><div class="form-group"><label class="control-label col-md-4">หมายเหตุ </label><div class="col-md-6"><textarea class="form-control" rows="3" name="exp_note[]" placeholder="หมายเหตุ"></textarea></div></div>');


        newTextBoxDiv.appendTo("#expBoxesGroup");
        expcounter++;
    });
    $(document).on("click", "input.removeExp", function() { //ฟังชั่นลบ Element
        if (expcounter == 2) {
            swal("ผิดพลาด!!!", "ไม่สามารถลบได้", "error");
            return false;
        }
        expcounter--;
        var expBox = $(this).data("expbox");
        $("#expBoxDiv" + expBox).remove();
    });
});

$.validator.addMethod("checkIdCard",function(value, element) {
    var pid = value;
    pid = pid.toString().replace(/\D/g,'');
    if(pid.length == 13) {
        var sum = 0;
        for(var i = 0; i < pid.length-1; i++){
            sum += Number(pid.charAt(i))*(pid.length-i);
        }
        var last_digit = (11 - sum % 11) % 10;
        $(element).val(pid);
        return pid.charAt(12) == last_digit;
    } else {
        return false;
    }
},
"รหัสบัตรประชาชนไม่ถูกต้อง"
);

$('.button-next').on('click',function(){
    var trainingTopics = $("input[name='training_topics[]']").map(function(){return $(this).val();}).get();
    var trainingAgency = $("input[name='training_agency[]']").map(function(){return $(this).val();}).get();
    var trainingDuration = $("input[name='training_duration[]']").map(function(){return $(this).val();}).get();

    $('.showtraining').html('');
    if(trainingTopics != 0){
        $.each(trainingTopics, function( index, value ) {
            var n = index + 1;
            $('.showtraining').append('<div class="form-group"><label class="control-label col-md-6">หัวข้อการฝึกอบรม '+n+' : </label><div class="col-md-4"><p class="form-control-static">'+value+'</p></div></label></div>');
            $('.showtraining').append('<div class="form-group"><label class="control-label col-md-6">หน่วยงานที่ให้การฝึกอบรม :</label><div class="col-md-4"><p class="form-control-static">'+trainingAgency[index]+'</p></div></label></div>');
            $('.showtraining').append('<div class="form-group"><label class="control-label col-md-6">หน่วยงานที่ให้การฝึกอบรม :</label><div class="col-md-4"><p class="form-control-static">'+trainingDuration[index]+'</p></div></label></div>');
        });
    }

    var expTopics = $("input[name='exp_topics[]']").map(function(){return $(this).val();}).get();
    var expDuration = $("input[name='exp_duration[]']").map(function(){return $(this).val();}).get();
    var expResponsibility = $("input[name='exp_responsibility[]']").map(function(){return $(this).val();}).get();
    var expAward = $("input[name='exp_award[]']").map(function(){return $(this).val();}).get();
    var expAgency = $("input[name='exp_agency[]']").map(function(){return $(this).val();}).get();
    var expYear = $("input[name='exp_year[]']").map(function(){return $(this).val();}).get();
    var expNote = $("textarea[name='exp_note[]']").map(function(){return $(this).val();}).get();

    $('.showExp').html('');
    if(expTopics != 0){
        $('.showExp').append('<h3 class="tabset-center">ประสบการณ์การและกิจกรรมนักศึกษา</h3>');
        $.each(expTopics, function( index, value ) {
            var g = index + 1;
            $('.showExp').append('<div class="form-group"><label class="control-label col-md-6">หัวข้อกิจกรรม '+g+' : </label><div class="col-md-4"><p class="form-control-static">'+value+'</p></div></label></div>');
            $('.showExp').append('<div class="form-group"><label class="control-label col-md-6">ช่วงเวลา - ปี :</label><div class="col-md-4"><p class="form-control-static">'+expDuration[index]+'</p></div></label></div>');
            $('.showExp').append('<div class="form-group"><label class="control-label col-md-6">ความรับผิดชอบ :</label><div class="col-md-4"><p class="form-control-static">'+expResponsibility[index]+'</p></div></label></div>');
            $('.showExp').append('<div class="form-group"><label class="control-label col-md-6">ชื่อรางวัล :</label><div class="col-md-4"><p class="form-control-static">'+expAward[index]+'</p></div></label></div>');
            $('.showExp').append('<div class="form-group"><label class="control-label col-md-6">หน่วยงานที่มอบให้ :</label><div class="col-md-4"><p class="form-control-static">'+expAgency[index]+'</p></div></label></div>');
            $('.showExp').append('<div class="form-group"><label class="control-label col-md-6">วัน/เดือน/ปี ที่ได้รับ :</label><div class="col-md-4"><p class="form-control-static">'+expYear[index]+'</p></div></label></div>');
            $('.showExp').append('<div class="form-group"><label class="control-label col-md-6">หมายเหตุ :</label><div class="col-md-4"><p class="form-control-static">'+expNote[index]+'</p></div></label></div>');
        });
    }
});

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
                form.submit();
            } 
        });
    });
}

$(function() {
    $("#cloneDataParent").change(function() {
        if ($("#cloneDataParent:checked").length > 0) {
            bindGroupsParent();
            $(".sync-parent").prop('readonly', true);
        } else {
            unbindGroupsParent();
            $(".sync-parent").prop('readonly', false);
            $("textarea[name='permanent_address']").val('');
            $("input[name='permanent_phone']").val('');

            //ที่อยู่ที่สามารถติดต่อได้
            if ($("#cloneDataAds:checked").length > 0) {
                unbindGroupsParent();
                $('#cloneDataAds').prop('checked', false);
                $("textarea[name='contact_address']").val('');
                $("input[name='contact_phone']").val('');
                $(".sync-address").prop('readonly', false);
            }
        }
    });

    if ($("#cloneDataParent").prop("checked") == true) {
        bindGroupsParent();
        $(".sync-parent").prop('readonly', true);
    }
});


var bindGroupsParent = function() {
    $("textarea[name='permanent_address']").val($("textarea[name='parent_address']").val());
    $("input[name='permanent_phone']").val($("input[name='parent_phone']").val());

    $("textarea[name='parent_address']").keyup(function() {
        $("textarea[name='permanent_address']").val($(this).val());
    });
    $("input[name='parent_phone']").keyup(function() {
        $("input[name='permanent_phone']").val($(this).val());
    });

    // ที่อยู่ที่สามารถติดต่อได้
    if ($("#cloneDataAds").prop("checked") == true) {
        $("textarea[name='contact_address']").val($("textarea[name='permanent_address']").val());
        $("input[name='contact_phone']").val($("input[name='permanent_phone']").val());

        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='contact_address']").val($(this).val());
        });
        $("input[name='parent_phone']").keyup(function() {
            $("input[name='contact_phone']").val($(this).val());
        });
    }
    //

};

var unbindGroupsParent = function() {
    $("textarea[name='parent_address']").unbind("keyup");
    $("input[name='parent_phone']").unbind("keyup");

    if ($("#cloneDataAds").prop("checked") == true) {
        $("textarea[name='permanent_address']").unbind("keyup");
        $("input[name='permanent_phone']").unbind("keyup");
    }

    if ($("#cloneDataFather").prop("checked") == true) {
        $("input[name='emer_name']").val($("input[name='father_name']").val());
        $("textarea[name='emer_address']").val($("textarea[name='parent_address']").val());
        $("input[name='emer_phone']").val($("input[name='father_phone']").val());

        $("input[name='father_name']").keyup(function() {
            $("input[name='emer_name']").val($(this).val());
        });
        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='emer_address']").val($(this).val());
        });
        $("input[name='father_phone']").keyup(function() {
            $("input[name='emer_phone']").val($(this).val());
        });
    }

    if ($("#cloneDataMother").prop("checked") == true) {
        $("input[name='emer_name']").val($("input[name='mother_name']").val());
        $("textarea[name='emer_address']").val($("textarea[name='parent_address']").val());
        $("input[name='emer_phone']").val($("input[name='mother_phone']").val());

        $("input[name='mother_name']").keyup(function() {
            $("input[name='emer_name']").val($(this).val());
        });
        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='emer_address']").val($(this).val());
        });
        $("input[name='mother_phone']").keyup(function() {
            $("input[name='emer_phone']").val($(this).val());
        });
    }
};

$(function() {
    $("#cloneDataAds").change(function() {
        if ($("#cloneDataAds:checked").length > 0) {
            bindGroupsAds();
            $(".sync-address").prop('readonly', true);
        } else {
            unbindGroupsAds();
            $(".sync-address").prop('readonly', false);

            $("textarea[name='contact_address']").val('');
            $("input[name='contact_phone']").val('');
        }
    });

    if ($("#cloneDataAds").prop("checked") == true) {
        bindGroupsAds();
        $(".sync-address").prop('readonly', true);
    }
});


var bindGroupsAds = function() {
    $("textarea[name='contact_address']").val($("textarea[name='permanent_address']").val());
    $("input[name='contact_phone']").val($("input[name='permanent_phone']").val());

    $("textarea[name='permanent_address']").keyup(function() {
        $("textarea[name='contact_address']").val($(this).val());
    });
    $("input[name='permanent_phone']").keyup(function() {
        $("input[name='contact_phone']").val($(this).val());
    });

    if ($("#cloneDataParent").prop("checked") == true) {
        $("textarea[name='contact_address']").val($("textarea[name='parent_address']").val());
        $("input[name='contact_phone']").val($("input[name='parent_phone']").val());

        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='contact_address']").val($(this).val());
        });
        $("input[name='parent_phone']").keyup(function() {
            $("input[name='contact_phone']").val($(this).val());
        });
    }
};

var unbindGroupsAds = function() {
    $("textarea[name='permanent_address']").unbind("keyup");
    $("input[name='permanent_phone']").unbind("keyup");

    if ($("#cloneDataParent").prop("checked") == true) {
        $("textarea[name='parent_address']").unbind("keyup");
        $("input[name='parent_phone']").unbind("keyup");

        // ที่อยู่ตามทะเบียนบ้าน
        // ล้างค่าเดิมออกแล้วใส่ค่าใหม่เข้าไป
        $("textarea[name='permanent_address']").val($("textarea[name='parent_address']").val());
        $("input[name='permanent_phone']").val($("input[name='parent_phone']").val());

        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='permanent_address']").val($(this).val());
        });
        $("input[name='parent_phone']").keyup(function() {
            $("input[name='permanent_phone']").val($(this).val());
        });
    }

    if ($("#cloneDataFather").prop("checked") == true) {

        $("input[name='emer_name']").val($("input[name='father_name']").val());
        $("textarea[name='emer_address']").val($("textarea[name='parent_address']").val());
        $("input[name='emer_phone']").val($("input[name='father_phone']").val());

        $("input[name='father_name']").keyup(function() {
            $("input[name='emer_name']").val($(this).val());
        });
        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='emer_address']").val($(this).val());
        });
        $("input[name='father_phone']").keyup(function() {
            $("input[name='emer_phone']").val($(this).val());
        });
    }

    if ($("#cloneDataMother").prop("checked") == true) {

        $("input[name='emer_name']").val($("input[name='mother_name']").val());
        $("textarea[name='emer_address']").val($("textarea[name='parent_address']").val());
        $("input[name='emer_phone']").val($("input[name='mother_phone']").val());

        $("input[name='mother_name']").keyup(function() {
            $("input[name='emer_name']").val($(this).val());
        });
        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='emer_address']").val($(this).val());
        });
        $("input[name='mother_phone']").keyup(function() {
            $("input[name='emer_phone']").val($(this).val());
        });
    }
};

$(function() {
    $("#cloneDataFather").change(function() {
        if ($("#cloneDataFather:checked").length > 0) {
            bindGroupsFather();
            $(".sync-emer").prop('readonly', true);

            if ($("#cloneDataMother").prop("checked") == true) {
                $('#cloneDataMother').prop('checked', false);
            }

        } else {
            unbindGroupsFather();
            $(".sync-emer").prop('readonly', false);
            $("input[name='emer_name']").val('');
            $("textarea[name='emer_address']").val('');
            $("input[name='emer_phone']").val('');

        }
    });

    if ($("#cloneDataFather").prop("checked") == true) {
        bindGroupsFather();
        $(".sync-emer").prop('readonly', true);
    }
});


var bindGroupsFather = function() {
    $("input[name='emer_name']").val($("input[name='father_name']").val());
    $("textarea[name='emer_address']").val($("textarea[name='parent_address']").val());
    $("input[name='emer_phone']").val($("input[name='father_phone']").val());

    $("input[name='father_name']").keyup(function() {
        $("input[name='emer_name']").val($(this).val());
    });
    $("textarea[name='parent_address']").keyup(function() {
        $("textarea[name='emer_address']").val($(this).val());
    });
    $("input[name='father_phone']").keyup(function() {
        $("input[name='emer_phone']").val($(this).val());
    });
};

var unbindGroupsFather = function() {
    $("input[name='father_name']").unbind("keyup");
    $("textarea[name='parent_address']").unbind("keyup");
    $("input[name='father_phone']").unbind("keyup");

    if ($("#cloneDataParent").prop("checked") == true) {
        // $("textarea[name='parent_address']").unbind("keyup");
        $("input[name='parent_phone']").unbind("keyup");

        // ที่อยู่ตามทะเบียนบ้าน
        // ล้างค่าเดิมออกแล้วใส่ค่าใหม่เข้าไป
        $("textarea[name='permanent_address']").val($("textarea[name='parent_address']").val());
        $("input[name='permanent_phone']").val($("input[name='parent_phone']").val());

        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='permanent_address']").val($(this).val());
        });
        $("input[name='parent_phone']").keyup(function() {
            $("input[name='permanent_phone']").val($(this).val());
        });
    }

    if ($("#cloneDataAds").prop("checked") == true) {
        if ($("#cloneDataParent").prop("checked") == true) {
            // $("textarea[name='permanent_address']").unbind("keyup");
            // $("input[name='permanent_phone']").unbind("keyup");

            $("textarea[name='contact_address']").val($("textarea[name='parent_address']").val());
            $("input[name='contact_phone']").val($("input[name='parent_phone']").val());

            $("textarea[name='parent_address']").keyup(function() {
                $("textarea[name='contact_address']").val($(this).val());
            });
            $("input[name='parent_phone']").keyup(function() {
                $("input[name='contact_phone']").val($(this).val());
            });
        }
    }
};

$(function() {
    $("#cloneDataMother").change(function() {
        if ($("#cloneDataMother:checked").length > 0) {
            bindGroupsMother();
            $(".sync-emer").prop('readonly', true);

            if ($("#cloneDataFather").prop("checked") == true) {
                $('#cloneDataFather').prop('checked', false);
            }

        } else {
            unbindGroupsMother();
            $(".sync-emer").prop('readonly', false);
            $("input[name='emer_name']").val('');
            $("textarea[name='emer_address']").val('');
            $("input[name='emer_phone']").val('');

        }
    });

    if ($("#cloneDataMother").prop("checked") == true) {
        bindGroupsMother();
        $(".sync-emer").prop('readonly', true);
    }
});


var bindGroupsMother = function() {
    $("input[name='emer_name']").val($("input[name='mother_name']").val());
    $("textarea[name='emer_address']").val($("textarea[name='parent_address']").val());
    $("input[name='emer_phone']").val($("input[name='mother_phone']").val());

    $("input[name='mother_name']").keyup(function() {
        $("input[name='emer_name']").val($(this).val());
    });
    $("textarea[name='parent_address']").keyup(function() {
        $("textarea[name='emer_address']").val($(this).val());
    });
    $("input[name='mother_phone']").keyup(function() {
        $("input[name='emer_phone']").val($(this).val());
    });
};

var unbindGroupsMother = function() {
    $("input[name='mother_name']").unbind("keyup");
    $("textarea[name='parent_address']").unbind("keyup");
    $("input[name='mother_phone']").unbind("keyup");

    if ($("#cloneDataParent").prop("checked") == true) {
        // $("textarea[name='parent_address']").unbind("keyup");
        $("input[name='parent_phone']").unbind("keyup");

        // ที่อยู่ตามทะเบียนบ้าน
        // ล้างค่าเดิมออกแล้วใส่ค่าใหม่เข้าไป
        $("textarea[name='permanent_address']").val($("textarea[name='parent_address']").val());
        $("input[name='permanent_phone']").val($("input[name='parent_phone']").val());

        $("textarea[name='parent_address']").keyup(function() {
            $("textarea[name='permanent_address']").val($(this).val());
        });
        $("input[name='parent_phone']").keyup(function() {
            $("input[name='permanent_phone']").val($(this).val());
        });
    }

    if ($("#cloneDataAds").prop("checked") == true) {
        if ($("#cloneDataParent").prop("checked") == true) {
            // $("textarea[name='permanent_address']").unbind("keyup");
            // $("input[name='permanent_phone']").unbind("keyup");

            $("textarea[name='contact_address']").val($("textarea[name='parent_address']").val());
            $("input[name='contact_phone']").val($("input[name='parent_phone']").val());

            $("textarea[name='parent_address']").keyup(function() {
                $("textarea[name='contact_address']").val($(this).val());
            });
            $("input[name='parent_phone']").keyup(function() {
                $("input[name='contact_phone']").val($(this).val());
            });
        }
    }
};

$("body").on("focus", "input[data-date='dtp']", function() {
    $(".dateTimePicker").datepicker({ autoclose: true, maskInput: true, format: "dd/mm/yyyy" });
    $(".dateYear").datepicker({ autoclose: true, maskInput: true, format: "yyyy", viewMode: "years", minViewMode: "years" });
    $(".dateMonths").datepicker({ autoclose: true, maskInput: true, format: "MM yyyy", viewMode: "months", minViewMode: "months" });
});

// Function for Load Majors

// ~cooplpru
var URL = window.location.origin + '/col/'
 
var sel_majors = $(".js-select-majors");
$.fn.extend({
    setMajor: function( fid, id=0 ){
        $.ajax({
            type: "GET",
            url: "fn/majors.php",
            data: ({ id:fid }),
            dataType: "json",
            success: function(json){
                sel_majors.html("");
                $.each(json, function(index, value) {
                    if( id==value.major_id ) {
                        sel_majors.append( $('<option>', {value: value.major_id, text: value.major_name, "data-id":value.major_id, "selected":1}) );
                    }
                    else{
                        sel_majors.append( $('<option>', {value: value.major_id, text: value.major_name, "data-id":value.major_id}) );
                    }
                });
            }
        });
    } 
});

var fid = $(".js-select-faculty").val();
$(this).setMajor( fid );

var mid = $(".js-input-majors").val();
if( mid != 0 && mid != "" ){
    $(this).setMajor( fid, mid );
}

$(".js-select-faculty").change(function(){
    $(this).setMajor( $(this).val() );
});


//DateTimePicker
$(".dateTimePicker").datepicker( {
    dateFormat:"dd/mm/yy", 
    yearRange: "-100:+0", 
    changeMonth: true,
    changeYear: true,
} );