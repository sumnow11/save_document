<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์</title>
</head>

<body>
    <style type="text/css">
        @media all and (min-height: 1080px) {
            .fillwidth {
                width: 100px;
                height: 600px;
                min-width: 100%;
                min-height: 100%;
            }
        }

        @media all and (max-height: 1079px) {
            .fillwidth {
                width: 100px;
                height: 400px;
                min-width: 100%;
                min-height: 100%;
            }
        }
    </style>
    <div class="container-fluid mt-3 p-4  ">

        <div class="col-12 col-md-12 col-lg-12 col-xxl-12 d-flex ">
            <div class="card flex-fill w-100 corners shadow">
                <div class="card-header ">
                    <ul class="nav nav-pills mb-0" style="float: left" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-pofile" type="button" role="tab" aria-controls="pills-home" aria-selected="true">โปรไฟล์</button>
                        </li>
                       
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-report" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">รายงาน</button>
                        </li>
                    

                    </ul>
                    <div class="dropdown" style="float:right">
                        <a class="dropdown text-secondary" type="button" id="dropprofile" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropprofile">
                            <?php if ($this->session->userdata('role') == '0') { ?>
                                <li><a class="dropdown-item" href="<?php echo base_url("admin/page_edit_user/") . $user->user_id ?>">แก้ไข</a></li>
                            <?php } ?>
                            <?php if ($this->session->userdata('role') == '1') { ?>
                                <li><a class="dropdown-item" href="<?php echo base_url("user/page_edit_profile/") . $user->user_id ?>">แก้ไข</a></li>
                                <li><a class="dropdown-item change_password" data-bs-toggle="modal" data-bs-target="#password_c">เปลี่ยนรหัส</a></li>
                            <?php }
                            if ($this->session->userdata('role') == '0' && $this->session->userdata('user_id') != $user->user_id) { ?>
                                <li><a class="dropdown-item reset_Password" id="<?php echo $user->user_id ?>">รีเซ็ตรหัส</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-pofile" role="tabpanel" aria-labelledby="pills-pofile-tab">
                        <div class="row">
                            <div class="col-md-7 col-lg-7 col-xxl-7 mt-1 ">
                                <div class=" mb-3 content">
                                    <div class="card-body d-block d-md-none">
                                        <?php if ($user->img != '') { ?>
                                            <img class="fillwidth shadow" style="border-radius: 50%; " src="<?php echo base_url("data_doc/img_user/$user->img"); ?>">
                                        <?php } else { ?>
                                            <img class="fillwidth shadow" style="border-radius: 50%; " src="<?php echo base_url("data_doc/img_user/user.png"); ?>">
                                        <?php } ?>

                                    </div>
                                    <div class="p-4">
                                        <div class="row">

                                            <div class="col-md-5 col-lg-5 col-xxl-5">
                                                <h5>ชื่อ - สกุล </h5>
                                            </div>
                                            <div class="col-md-7 text-secondary">
                                                <?php echo $user->fname; ?>&nbsp<?php echo $user->lname; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-5 col-lg-5 col-xxl-5">
                                                <h5>ตำแหน่ง</h5>
                                            </div>
                                            <div class="col-md-7 text-secondary">

                                                <?php $array_p_id = explode(',', $user->position_id);
                                                foreach ($array_p_id as $ur) {
                                                    foreach ($show_position as $p) {
                                                        if ($ur == $p->position_id) {
                                                            $position_r[] = $p->position_name;
                                                        }
                                                    }
                                                }
                                                array_unique($position_r);
                                                $position_id_r = implode(',', $position_r);
                                                unset($position_r);
                                                echo  $position_id_r; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-5 col-lg-5 col-xxl-5">
                                                <h5>อีเมล</h5>
                                            </div>
                                            <div class="col-md-7 text-secondary">
                                                <?php echo $user->email; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-5 col-lg-5 col-xxl-5">
                                                <h5>เบอร์โทร</h5>
                                            </div>
                                            <div class="col-md-7 col-lg-7 col-xxl-7 text-secondary">
                                                <?php echo $user->phone; ?>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>
                            <div class="col-md-5 col-lg-5 mt-1 d-none d-md-block">
                                <div class="text-center ">
                                    <div class="card-body  ">
                                        <?php if ($user->img != '') { ?>
                                            <img class="fillwidth " src="<?php echo base_url("data_doc/img_user/$user->img"); ?>">
                                        <?php } else { ?>
                                            <img class="fillwidth " src="<?php echo base_url("data_doc/img_user/user.png"); ?>">
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="tab-pane fade" id="pills-report" role="tabpanel" aria-labelledby="pills-report-tab">
                        <div class="row ">
                            <div class="col-12 col-md-12  d-flex ">
                                <div class="card flex-fill w-100 shadow">
                                    <div class="row">
                                        <h4 class="mt-5" style="text-align: center">รายงานเอกสาร ของ <?php echo $user->fname; ?>&nbsp<?php echo $user->lname; ?></h4>
                                    </div>

                                    <hr>

                                    <div class="row mt-2 p-3 ">
                                        <input type="text" class="form-control corners shadow" id="user_id_re" name="id" placeholder="id" style="display:none;" value="<?php echo $user->user_id; ?>" required>
                                        <input type="text" class="form-control corners shadow" id="position_id_r" name="position_id"  style="display:none" placeholder="id"  value="<?php echo $user->position_id; ?>" required>
                                        <div class="col-md-5">
                                            <input type="date" name="day_s" id="day_s_u" class="form-control corners shadow ">
                                        </div>
                                        <div class="col-md-1">
                                            <h5 style="text-align:center;">ถึง</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="date" name="day_e" id="day_e_u" class="form-control corners shadow col-5">
                                        </div>
                                        <div class="col-md-1 mt-1 ">
                                            <a type="button" id="report_u" class=" btn btn-primary corners shadow ">ค้นหา</a>
                                        </div>

                                    </div>
                                    <div class="row mt-2 p-3">

                                        <div class="col-md-2" style="display: none">
                                            <input type="checkbox" class="form-check-input shadow" id="check_c" name="check_c" value="" checked>
                                            <label class="form-check-label ">หมวดหมู่</label><br>
                                        </div>
                                        <div class="col-md-2" style="display: none">
                                            <input type="checkbox" class="form-check-input shadow" id="user_id" name="user_id[]" value="" checked>
                                            <label class="form-check-label ">รายชื่อเอกสาร</label><br>
                                        </div>
                                    </div>

                                    <div id="num_user_doc" class="mb-5">


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<?php ##require_once('style/js/pin_.php') 
?>
<script type="text/javascript" src=<?php echo base_url('style/js/check_pass_doc_edit.js'); ?>></script>
<script type="text/javascript" src="<?php echo base_url('style/js/report_u.js');?>"></script>
</html>