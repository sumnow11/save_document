<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>รายงาน</title>
</head>



<body>

    <div class="container-fluid mt-5 p-4">
        <div class="row ">
            <div class="col-12 col-md-12  d-flex ">
                <div class="card flex-fill w-100 corners shadow">
                    <div class="card-header ">
                        <ul class="nav nav-pills mb-0" style="float: left" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-doc" type="button" role="tab" aria-controls="pills-home" aria-selected="true">รายงานเอกสาร</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-report" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">รายงานเอกสารรายบุคล</button>
                            </li>
                            <li>
                                <button class="nav-link" id="pillss-category-tab" data-bs-toggle="pill" data-bs-target="#pills-category" type="button" role="tab" aria-controls="pills-category" aria-selected="false">หมวดหมู่</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-doc" role="tabpanel" aria-labelledby="pills-doc-tab">
                            <div class="row">
                                <h4 class="mt-5" style="text-align: center">รายงานเอกสาร</h4>
                            </div>

                            <hr>
                                <!--<a class="pull-right btn btn-primary btn-xs" href="<?php echo base_url('report/generateXls'); ?>"><i class="fa fa-file-excel-o"></i> Export Data</a> !-->
                            <div class="row mt-2 p-3 ">
                                <div class="col-md-5">
                                    <input type="date" name="day_s" id="day_s" class="form-control corners shadow ">
                                </div>
                                <div class="col-md-1">
                                    <h5 style="text-align:center;">ถึง</h5>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="day_e" id="day_e" class="form-control corners shadow col-5">
                                </div>
                                <div class="col-md-1 mt-1 ">
                                    <a type="button" id="report_h" class=" btn btn-primary corners shadow ">ค้นหา</a>
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

                            <div id="num_doc" class="mb-5">


                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-report" role="tabpanel" aria-labelledby="pills-report-tab">
                            <div class="row">
                                <h4 class="mt-5" style="text-align: center">รายงานเอกสาร</h4>
                            </div>

                            <hr>


                            <div class="row mt-2 p-3 ">
                                <div class="p-2 mt-2 mb-2">
                                    <select name="user_u" id="user_id_re" class="form-select corners shadow" required>
                                        <option selected disabled value="">เลือกผู้ใช้งาน</option>
                                        <?php foreach ($user as $d) {
                                            if ($d->delete_user_data == 0) { ?>
                                                <option value="<?php echo $d->user_id ?>"><?php echo $d->fname ?>&nbsp;&nbsp; <?php echo $d->lname ?> </option>
                                        <?php  }
                                        } ?>
                                    </select>
                                </div>
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
                                    <button id="report_u" class=" btn btn-primary corners shadow " style="pointer-events: none; background-color:#6c757d;">ค้นหา</ิ>
                                </div>

                            </div>


                            <div class="row mt-2 p-3">


                            </div>

                            <div id="num_user_doc" class="mb-5">


                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab">
                            <div class="row">
                                <h4 class="mt-5" style="text-align: center">รายงานเอกสาร</h4>
                            </div>

                            <hr>


                            <div class="row mt-2 p-3 ">
                                <div class="p-2 mt-2 mb-2">
                                    <select name="user_u" id="category_id_re" class="form-select corners shadow" required>
                                        <option selected disabled value="">เลือกหมวดหมู่</option>
                                        <?php foreach ($category as $c) {
                                            if ($c->delete_category	 == 0) { ?>
                                                <option value="<?php echo $c->Category_id ?>"><?php echo $c->Category_name ?></option>
                                        <?php  }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="day_s" id="day_s_c" class="form-control corners shadow ">
                                </div>
                                <div class="col-md-1">
                                    <h5 style="text-align:center;">ถึง</h5>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="day_e" id="day_e_c" class="form-control corners shadow col-5">
                                </div>
                                <div class="col-md-1 mt-1 ">
                                    <button id="report_c" class=" btn btn-primary corners shadow " style="pointer-events: none; background-color:#6c757d;">ค้นหา</ิ>
                                </div>

                            </div>


                            <div class="row mt-2 p-3">


                            </div>

                            <div id="num_c_doc" class="mb-5">


                            </div>
                        </div>
                    </div>

                </div>


            </div>


        </div>
    </div>







</body>

<script type="text/javascript" src="<?php echo base_url('style/js/report_h.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('style/js/report_u.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('style/js/report_c.js'); ?>"></script>
<script type="text/javascript">
    $(document).on('click', '#pills-home-tab', function(e) {
        $('#num_user_doc').css('display', 'none');
    });

    $(document).on('click', '#pills-profile-tab', function(e) {
        $('#num_user_doc').css('display', 'block');
    });
    $('#user_id_re').change(function() {
        var user_id = $('#user_id_re').val();
        if (user_id == '') {
            $('#report_u').css('pointer-events', 'none');
            $('#report_u').css('background-color', '#6c757d');
        } else {
            $('#report_u').css('pointer-events', 'auto');
            $('#report_u').css('background-color', '#0d6efd');
        }
    })

    $('#category_id_re').change(function(){
        var category_id=$('#category_id_re').val();
        if(category_id==''){
        $('#report_c').css('pointer-events','none');
        $('#report_c').css('background-color','#6c757d');
        }else{
            $('#report_c').css('pointer-events','auto');
            $('#report_c').css('background-color','#0d6efd');
        }
    })
</script>

</html>

