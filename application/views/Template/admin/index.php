<?php
$this->load->model('users_models');
$this->load->model('category_models');
$this->load->model('doc_models');
$category =  $this->category_models->show_category();
$position = $this->users_models->show_position();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ระบบบันทึกเอกสาร</title>
</head>

<body>


    <div class="container-fluid mt-3 p-4 mt-5  ">
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="card  corners shadow mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">เอกสาร</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="badge bg-dark  corners ">
                                                <i class="fas fa-file-alt" style="font-size:1.25rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                
                                        <h3 id="doc_total"></h3>
                                  

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card corners shadow mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ผู้ใช้งาน</h5>
                                        </div>


                                        <div class="col-auto">
                                            <div class="badge bg-dark  corners ">
                                                <i class="fas fa-users" style="font-size:1.25rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                 
                                    <h3 id="user_total"></h3>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card corners shadow mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">หมวดหมู่</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="badge bg-dark  corners ">
                                                <i class="fas fa-passport" style="font-size:1.25rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 id="Category_total"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-xxl-12 mt-5">
                <div class="card flex-fill w-100 corners shadow mb-2">
                    <div class="card-header">
                        <h5 class="card-title mb-0">จำนวนเอกสารเข้ารายปี</h5>
                    </div>
                    <div class="card-body py-3">
                        <select id="doc_year" class="form-select corners" style="text-align:center;">
                            <option selected value="">ทั้งหมด</option>
                            <?php foreach ($year as $y) { ?>
                                    <option value="<?php echo $y->year ?>"><?php echo $y->year ?></option>
                           
                           <?php } ?>

                        </select>
                        <div class="chart chart-sm">
                            <canvas id="docChart" width="400" height="150"></canvas>
                            <script>

                            </script>
  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 sm-12 col-lg-12  col-xl-12  d-flex pb-2">
                <div class="card flex-fill w-100 corners shadow">
                    <div class="card-header">
                        <h5 class="mb-0" style="float:left"><i class="fas fa-file-alt"></i> รายการเอกสาร&nbsp&nbsp</h5>
                        <span style="float:right;">
                            <span class="badge rounded-pill bg-danger shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspถูกยกเลิก</p>
                        </span>
                        <span style="float:right;">
                            <span class="badge rounded-pill bg-primary  shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspปกติ</p>
                        </span>
                        <a class="btn btn-success mb-0 corners shadow" data-bs-toggle="modal" data-bs-target="#add_doc" type="button" style="float:left; font-size: 12px;margin-right:10px;"><i class="fas fa-plus-circle"></i> เพิ่ม</a>
                    </div>
                    <div class="card-body px-4 ">
                        <div class="mb-3 row ">
                            <table id="table_doc" class="display" style="width:100%; text-align:center;">
                                <thead>
                                    <tr>
                                    <th style="width:5%;">ลำดับที่</th>
                                    <th style="width:10%;">เลขที่เอกสาร</th>
                                        <th class="all" style="width:25%;">เอกสาร</th>
                                        <th  style="width:25%; text-align:center;">ประเภท:<select id="doc_category" class="form-select corners" style="text-align:center;">
                                                <option selected value="">ทั้งหมด</option>
                                                <?php foreach ($category as $c_n) {
                                                    if ($c_n->delete_category == 0) { ?>
                                                        <option value="<?php echo $c_n->Category_id ?>"><?php echo $c_n->Category_name ?></option>
                                                <?php }
                                                } ?>

                                            </select></th>

                                        <th style="width:10%;">วันที่</th>
                                        <th class="all"style="width:15%;">จัดการ</th>
                                    </tr>
                                </thead>

                            </table>
                         
                      
                        </div>


                    </div>

                </div>
                                                
            </div>
           
            <div class="col-12 col-md-12  d-flex pt-4">

                <div class="card flex-fill w-100 corners shadow">
                    <div class="card-header">
                        <h5 class="mb-0" style="float: left"><i class="fas fa-id-badge"></i> รายชื่อผู้ใช้งาน &nbsp</h5>
                        <a class="btn btn-success mb-0 corners shadow" data-bs-toggle="modal" data-bs-target="#add_user" type="button" style="float:left; font-size: 12px;margin-right:10px;"><i class="fas fa-plus-circle"></i> เพิ่ม</a>
                        <span style="float:right;"class="d-none d-md-block">
                            <span class="badge rounded-pill bg-danger shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspถูกยกเลิก</p>
                        </span>
                        <span style="float:right;"class="d-none d-md-block">
                            <span class="badge rounded-pill bg-primary  shadow corners mt-1" style="float: left; font-size:10px;">&nbsp</span>
                            <p style="float:right;font-size:15px;margin-right:10px;">&nbspปกติ</p>
                        </span>
                    </div>
                    <div class="card-body px-4 ">
                        <div class="mb-3 row ">
                            <table id="table_user" class="display" style="width:100%; text-align:center;" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                       
                                        <th></th>
                                        <th class="all" style="width:25%;">ชื่อ</th>
                                        <th>อีเมล</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th class="all" style="width:25%; text-align:center;">ตำแหน่ง:<select id="position_i" class="form-select corners" style="text-align:center;">
                                                <option selected value="">ทั้งหมด</option>
                                                <?php foreach ($position as $p) { ?>

                                                    <option value="<?php echo $p->position_id ?>"><?php echo $p->position_name ?></option>
                                                <?php
                                                } ?>

                                            </select></th>
                                        <th>วันที่</th>
                                        <th>หน้าที่</th>
                                        <th class="all" style="text-align:left;">จัดการ</th>
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
<script type="text/javascript" src="<?php echo base_url('style/js/report.js');?>"></script>
</html>