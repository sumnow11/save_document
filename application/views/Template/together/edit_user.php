<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสมาชิก</title>
</head>

<body>

    <div class="container-fluid mt-3 p-4  ">
        <div class="row ">
            <div class="col-12 col-md-12  d-flex ">
                <div class="card flex-fill w-100 corners shadow">
                    <div class="card-header ">
                        <h5 class="mb-0 ">แก้ไขสมาชิก</h5>
                    </div>
                    <div class="card-body px-4 mt-0">
                        <div class="mb-3 row">
                            <form class="row g-3" id="edit_user" enctype="multipart/form-data" method="post">
                                <div class="col-md-6">
                                    <input type="text" class="form-control corners shadow" id="user_id_edit" name="id" placeholder="id" style="display:none;" value="<?php echo $user->user_id; ?>" required>
                                    <label for="inputEmail4" class="form-label">ชื่อ</label>
                                    <input type="text" class="form-control corners shadow" name="fname" placeholder="ชื่อ" value=<?php echo $user->fname; ?> required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">นามสกุล</label>
                                    <input type="text" class="form-control corners shadow" name="lname" placeholder="นามสกุล" value=<?php echo $user->lname; ?> required>
                                    
                                </div>
                                <?php if ($this->session->userdata('role') == '0') { ?>
                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">อีเมล</label>
                                        <input id="edit_email" type="email" class="form-control corners shadow" name="email" placeholder="name@example.com" value=<?php echo $user->email; ?> required>
                                        <span></span>
                                    </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">เบอร์โทร</label>
                                    <input type="number" id="edit_phone" class="form-control corners shadow" name="phone" min="0" placeholder="08-1246-XXXX" value=<?php echo $user->phone; ?> required>
                                    <span></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">รูปโปรไฟล์</label>
                                    <input class="form-control corners shadow" type="file" id="formFile" name="img" accept="image/*">
                                </div>
                                <?php if ($this->session->userdata('role') == '0') {
                                    $array_u_p_id = explode(',', $user->position_id);
                                ?>
                                    <div class="col-md-4">
                                        <div class="pt-4 ">
                                            <div class="accordion shadow" id="accordionExample">
                                                <div class="corners accordion-item">
                                                    <h5 class="accordion-header">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            ตำแหน่งงาน
                                                        </button>
                                                    </h5>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <?php
                                                            foreach ($array_u_p_id as $up) {
                                                                foreach ($position as $p) {
                                                                    if ($p->position_id == $up) { ?>
                                                                        <input type="checkbox" class="form-check-input shadow" name="position_id[]" value="<?php echo $p->position_id; ?>" checked>
                                                                        <label class="form-check-label "><?php echo $p->position_name; ?></label><br>
                                                            <?php }
                                                                }
                                                            }
                                                            ?>
                                                            <hr>
                                                            <?php foreach ($position as $p) { ?>
                                                                <input type="checkbox" class="form-check-input shadow" name="position_id[]" value="<?php echo $p->position_id; ?>">
                                                                <label class="form-check-label "><?php echo $p->position_name; ?></label><br>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputZip" class="form-label">หน้าที่</label>
                                        <select name="role" class="form-select corners shadow">
                                            <?php if ($user->role == 0) { ?>
                                                <option value="0">ผู้ดูแลระบบ</option>
                                                <option value="1">สมาชิก</option>

                                            <?php } else { ?>
                                                <option value="1">สมาชิก</option>
                                                <option value="0">ผู้ดูแลระบบ</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary corners shadow"id="subedit">บันทึก</button>
                        </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </div>
</body>

<script type="text/javascript" src="<?php echo base_url('style/js/check_edit.js');?>"></script>
</html>
