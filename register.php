<?php include("header.php"); ?>
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<style type="text/css">
    .btn-msg {
        color: red;
    }
    .image-preview-input {
        position: relative;
        overflow: hidden;
        margin: 0px;
    }
    .image-preview-input input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .image-preview-input-title {
        margin-left:2px;
    }
    .close {
        color: red !important;
    }
    @media (max-width: 991px) {
        .mail-text {
            text-align: left !important;
        }
    }
    @media (min-width: 992px) {
        .mail-text {
            padding-top: 0px !important;
        }
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php?page=home"><i class="fa fa-home"></i></a>
                </li>
                <li class="active">
                    ลงทะเบียนสถานประกอบการ
                </li>
            </ul>
            <div class="search-section">
                <div class="title">
                    ลงทะเบียนสถานประกอบการ
                </div>
            </div>
            <div class="portlet light">
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form_register" method="POST" enctype="multipart/form-data">
                        <div class="form-wizard">
                            <div class="form-body">
                                <h3 class="block headtext-set-center">ข้อมูลสถานประกอบการ</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-4">ชื่อสถานประกอบการ
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="corp_name" placeholder="กรอกชื่อสถานประกอบการ" title="กรุณากรอกชื่อสถานประกอบให้ถูกต้อง" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">ชื่อผู้ติดต่อ
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" placeholder="กรอกชื่อ-นามสกุลของท่าน" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Username
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="username" id="username" class="form-control reply-fail" maxlength="16" minlength="5" pattern="^[a-zA-Z0-9]{5,16}$" title="ภาษาอังกฤษ/ตัวเลข เท่านั้น" placeholder="กรอก Username (ไอดีผู้ใช้)" required />
                                        <span class="message-user"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Password
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="กรอกรหัสผ่าน" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Confirm Password
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" placeholder="ใส่รหัสผ่านเดิมอีกครั้ง" required />
                                        <span class="message-pass"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">โทรศัพท์
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" class="form-control" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรให้ถูกต้อง" placeholder="เบอร์โทรที่สามารถติดต่อท่านได้" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">โทรสาร (Fax)
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="fax" class="form-control" placeholder="กรอกเบอร์แฟ็กซ์" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 mail-text">อีเมล์ (E-mail) <span class="required">*</span><br/>
                                    <span class="required">(โปรดใช้อีเมล์จริงสำหรับการยืนยันตัวตน) </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="email" name="email" id="email" class="form-control reply-fail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="กรอกอีเมล" title="กรุณากรอกอีเมล์ให้ถูกต้อง" required />
                                        <span class="message-email"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">รูปประจำตัว
                                        <span class="required"></span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-group image-preview">
                                            <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger image-preview-clear" style="display:none;">
                                                    <i class="fa fa-times" aria-hidden="true"></i> ลบ
                                                </button>
                                                <div class="btn btn-primary image-preview-input">
                                                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                                                    <span class="image-preview-input-title">เลือกรูป</span>
                                                    <input type="file" accept="image/gif,image/jpeg,image/jpg,image/png" name="picture" id="img" />
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="btn-msg"><span class="msg-show"></span></h4>
                                    <button type="submit" id="btnSubmit" class="btn green button-submit"> สมัครลงทะเบียน <i class="fa fa-check"></i></button>
                                    <input type="hidden" name="checkRegister" value="1" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php") ?>
<script type="text/javascript" src="js/check-numrow.js"></script>
<script type="text/javascript" src="js/register.js"></script>