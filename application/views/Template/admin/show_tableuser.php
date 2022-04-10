<?php
$this->load->model('users_models');
$position = $this->users_models->show_position();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>รายชื่อผู้ใช้งาน</title>
</head>

<body>
    <div class="container-fluid mt-3 p-4">
        <div class="row ">
            <div class="col-12 col-md-12 col-lg-12 col-xxl-12 d-flex ">
                <div class="card flex-fill w-100 corners shadow ">
                    <div class="card-header">
                        <h5 class="mb-0" style="float: left"><i class="fas fa-id-badge"></i> รายชื่อผู้ใช้งาน</h5>
                        <a class="btn btn-success mb-0 corners shadow" data-bs-toggle="modal" data-bs-target="#add_user" type="button" style="float:right; font-size: 15px;margin-right:10px;"><i class="fas fa-plus-circle"></i> เพิ่ม</a>
                    </div>

                    <div class="card-body px-4 ">
                        <div class="mb-3 row">
                            <table id="table_user" class="display" style="width:100%; text-align:center;" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                      
                                        <th></th>
                                        <th class="all"style="width:25%;">ชื่อ</th>
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
                                        <th class="all">จัดการ</th>
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



</html>