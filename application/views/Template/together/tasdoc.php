<?php

$this->load->model('category_models');
$category =  $this->category_models->show_category();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เอกสาร</title>
</head>

<body>
    <div class="container-fluid mt-3 p-4">
        <div class="row ">
            <div class="col-12 col-md-12 col-xxl-12 d-flex ">
                <div class="card  w-100 corners shadow">
                    <div class="card-header">
                        <h5 class="mb-0" style="float: left"><i class="fas fa-file-alt"></i> รายการเอกสาร</h5>
                        <?php if ($this->session->userdata('role') == '0') { ?>
                            <span style="float:right;">
                            <span class="badge rounded-pill bg-danger shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspถูกยกเลิก</p>
                        </span>
                        <span style="float:right;">
                            <span class="badge rounded-pill bg-primary  shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspปกติ</p>
                        </span>
                        <a class="btn btn-success mb-0 corners shadow" data-bs-toggle="modal" data-bs-target="#add_doc" type="button" style="float:left; font-size: 12px;margin-right:10px;"><i class="fas fa-plus-circle"></i> เพิ่ม</a>
                        <?php }else if ($this->session->userdata('role') == '1') {  ?>
                            <span style="float:right;">
                            <span class="badge rounded-pill bg-primary shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspอ่าน</p>
                        </span>
                        <span style="float:right;">
                            <span class="badge rounded-pill bg-dark shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspยังไม่อ่าน</p>
                        </span>
                            
                            <?php } ?>
                    </div>
                            
                    <div class="card-body px-4 ">
                        <div class="mb-3 row">
                            <table id="table_doc" class="display" style="width:100%; text-align:center;">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">ลำดับ</th>
                                        <th style="width:10%;">เลขที่เอกสาร</th>
                                        <th class="all">เอกสาร</th>
                                        <th style="width:20%; text-align:center;">ประเภท:<select id="doc_category" class="form-select corners" style="text-align:center;">
                                                <option selected value="">ทั้งหมด</option>
                                                <?php foreach ($category as $c_n) {
                                                    if ($c_n->delete_category == 0) { ?>
                                                        <option value="<?php echo $c_n->Category_id ?>"><?php echo $c_n->Category_name ?></option>
                                                <?php }
                                                } ?>

                                            </select></th>
                                        <th style="width:5%;">วันที่</th>
                                        <?php if ($this->session->userdata('role') != '0') { ?>
                                            <th style="width:5%;">ความสำคัญ</th>
                                        <?php } ?>
                                        <th class="all" style="width:20%;">จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</body>
<?php ##require_once('style/js/pin_.php') ?>
<script type="text/javascript" src=<?php echo base_url('style/js/check_pass_doc_edit.js'); ?>></script>
</html>