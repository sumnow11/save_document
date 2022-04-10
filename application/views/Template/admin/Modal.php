<?php
$this->load->model('users_models');
$this->load->model('category_models');
$this->load->model('doc_models');
$category =  $this->category_models->show_category();
$position = $this->users_models->show_position();
$user_ = $this->users_models->show_user_();
?>


<div class="modal fade" id="add_doc" tabindex="-1" aria-hidden="true">
    <form id="insert_doc" enctype="multipart/form-data" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มเอกสาร</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div>
                        <h5 style="font-size: 15px;float: left">เลขที่เอกสาร</h5>
                        <input type="text" class="form-control corners shadow " id="number_doc" name="number_doc" placeholder="เลขที่เอกสาร">

                    </div>
                    <div>
                        <h5 style="font-size: 15px;float: left">ชื่อเอกสาร</h5>
                        <input type="text" class="form-control corners shadow " id="document_name" name="document_name" placeholder="ชื่อเอกสาร" required>

                    </div>
                    <div class="row">
                        <div class="col-md-7 col-xxl-7 col-xl-7">
                            <h5 class="pt-2" style="font-size: 15px;float: left">ไฟล์เอกสาร</h5>
                            <input class="form-control corners shadow" type="file" id="pdf" name="pdf" accept="application/pdf" required>

                        </div>
                        <div class="col-md-5 col-xxl-5 col-xl-5 ">
                            <h5 class="pt-2" style="font-size: 15px;float: left">วันที่</h5>
                            <input type="date" class="form-control corners shadow" name="day" required>
                        </div>
                    </div>



                    <div>
                        <h5 class="pt-1" style="font-size: 15px;float: left">หมายเหตุ</h5>
                        <textarea class="form-control corners shadow" name="information" rows="3"></textarea>
                    </div>
                    <div>
                        <h5 class="pt-1" style="font-size: 15px;float: left">ประเภทเอกสาร</h5>
                        <select name="category" id="category" class="form-select corners shadow" required>
                            <option selected disabled value="">เลือกประเภท</option>
                            <?php foreach ($category as $c) {
                                if ($c->delete_category == 0) { ?>
                                    <option value="<?php echo $c->Category_id ?>"><?php echo $c->Category_name ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <div>
                        <h5 class="pt-1" style="font-size: 15px;float: left">จาก</h5>
                        <select name="agency" id="agency" class="form-select corners shadow" required>
                            <option selected disabled value="">เลือกหน่วยงาน</option>
                            <option value="กองกลาง">กองกลาง</option>
                            <option value="กองคลัง">กองคลัง</option>
                            <option value="แผนกยานพาหนะ">แผนกยานพาหนะ</option>
                            <option value="กองนโยบายและแผน">กองนโยบายและแผน</option>
                            <option value="กองพัฒนานักศึกษา">กองพัฒนานักศึกษา</option>
                            <option value="กองบริหารงานบุคคล">กองบริหารงานบุคคล</option>
                            <option value="ศูนย์ศิลปวัฒนธรรม">ศูนย์ศิลปวัฒนธรรม</option>
                            <option value="ศูนย์ประชาสัมพันธ์">ศูนย์ประชาสัมพันธ์</option>
                            <option value="สำนักงานสหกิจศึกษา">สำนักงานสหกิจศึกษา</option>
                            <option value="ศูนย์อนุรักษ์พลังงาน">ศูนย์อนุรักษ์พลังงาน</option>
                            <option value="สำนักงานประกันคุณภาพการศึกษา">สำนักงานประกันคุณภาพการศึกษา</option>
                            <option value="คณะศิลปศาสตร์">คณะศิลปศาสตร์</option>
                            <option value="คณะวิทยาศาสตร์และเทคโนโลยี">คณะวิทยาศาสตร์และเทคโนโลยี</option>
                            <option value="คณะครุศาสตร์อุตสาหกรรม">คณะครุศาสตร์อุตสาหกรรม</option>
                            <option value="คณะครุศาสตร์อุตสาหกรรม">คณะครุศาสตร์อุตสาหกรรม</option>
                            <option value="คณะบริหารธุรกิจ">คณะบริหารธุรกิจ</option>
                            <option value="คณะเทคโนโลยีคหกรรมศาสตร์">คณะเทคโนโลยีคหกรรมศาสตร์</option>
                            <option value="คณะอุตสาหกรรมสิ่งทอ">คณะอุตสาหกรรมสิ่งทอ</option>
                            <option value="วิทยาลัยนานาชาติ">วิทยาลัยนานาชาติ</option>
                            <option value="อื่นๆ">อื่นๆ</option>

                        </select>
                    </div>

                    <div>
                        <h5 class="pt-1" style="font-size: 15px;float: left">ความสำคัญ</h5>
                        <select name="important" id="important" class="form-select corners shadow" required>
                            <option value="0">ทั่วไป</option>
                            <option value="1">สำคัญ</option>
                        </select>
                    </div>

                    <div class="pt-1">
                        <h5 style="font-size: 15px; ">สิทธิ์การเข้าถึง </h5>
                        <div>
                            <input class="form-check-input shadow" type="radio" id="privilege" name="privilege" value="0" onclick="s() " checked>
                            <label class="form-check-label ">
                                ทั้งหมด
                            </label>
                            <br>
                            <input class="form-check-input shadow" type="radio" name="privilege" value="1" onclick="showposition() ">
                            <label class="form-check-label ">
                                ระบุ
                            </label>
                            <br>

                        </div>
                    </div>
                    <div style="display:none;" id="position">
                        <hr>
                        <div class="accordion accordion-flush" id="choose_topic">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <input type="checkbox" class="form-check-input shadow" name="privilege_position" value="1">
                                        &nbsp ระบุตำแหน่งงาน
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#choose_topic">
                                    <div class="accordion-body">
                                        <?php foreach ($position as $p) { ?>
                                            <input type="checkbox" class="form-check-input shadow" id="position_id" name="position_id[]" value="<?php echo $p->position_id; ?>">
                                            <label class="form-check-label "><?php echo $p->position_name; ?></label><br>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        <input type="checkbox" class="form-check-input shadow" name="privilege_user" value="1">
                                        &nbsp ระบุบุคคล
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#choose_topic">
                                    <div class="accordion-body">
                                        <?php foreach ($user_ as $u) {
                                            if ($u->delete_user_data == 0) { ?>
                                                <input type="checkbox" class="form-check-input shadow" id="user_id" name="user_id[]" value="<?php echo $u->user_id  ?>">
                                                <label class="form-check-label "><?php echo $u->fname; ?>&nbsp;&nbsp;<?php echo $u->lname ?></label><br>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>




                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary corners shadow" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" id='insert' class="btn btn-primary corners shadow">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-------------------------------เพิ่มผู้ใช้งาน--------------------------------------------------------------->
<div class="modal fade" id="add_user" tabindex="-1" aria-hidden="true">
    <form enctype="multipart/form-data" id="insert_user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มผู้ใช้งาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div>
                        <label for="inputEmail4" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control corners shadow" name="fname" placeholder="ชื่อ" required>
                    </div>
                    <div>
                        <label for="inputPassword4" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control corners shadow" name="lname" placeholder="นามสกุล" required>
                    </div>
                    <div>
                        <label for="inputAddress" class="form-label">อีเมล</label>
                        <input type="email" class="form-control corners shadow " name="email" id="email" placeholder="name@example.com" required>
                        <span></span>
                    </div>
                    <div class="pt-1">
                        <label for="inputPassword4" class="form-label">เบอร์โทร</label>
                        <input type="number" class="form-control corners shadow" name="phone" id="add_phone" min="0" placeholder="08-1246-XXXX" required>
                        <span></span>  
                    </div>
                    <div class="pt-1">
                        <label for="inputCity" class="form-label">รูปโปรไฟล์</label>
                        <input class="form-control corners shadow" type="file" name="img" accept="image/*">
                    </div>
                    <div class="pt-2 ">
                        <div class="accordion shadow" id="accordionExample">
                            <div class="corners accordion-item">
                                <h5 class="accordion-header" >
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      ตำแหน่งงาน
                                    </button>
                                </h5>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php foreach ($position as $p) { ?>
                                            <input type="checkbox" class="form-check-input shadow"  name="position_id[]" value="<?php echo $p->position_id; ?>">
                                            <label class="form-check-label "><?php echo $p->position_name; ?></label><br>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                       
                        <div class="pt-1">
                            <label for="inputZip" class="form-label">หน้าที่</label>
                            <select name="role" class="form-select corners shadow">
                                <option value="1">สมาชิก</option>
                                <option value="0">ผู้ดูแลระบบ</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer ">
                        <a type="button" class="btn btn-secondary corners shadow" data-bs-dismiss="modal">ยกเลิก</a>
                        <button type="submit" id="submit_pass" class="btn btn-primary corners shadow ">บันทึก</button>
                    </div>
                </div>
            </div>
    </form>
</div>
<!----------------------------------------เพิ่มหมวดหมู่----------------------------------->
<div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="category" aria-hidden="true">
    <form id="insert_category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="category">เพิ่มหมวดหมู่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <h5 style="font-size: 15px;float: left">ชื่อหมวดหมู่เอกสาร</h5> <input type="text" class="form-control corners shadow" name="Category_name" placeholder="หมวดหมู่" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary corners shadow" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary corners shadow">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!------------------------------------------กรอกรหัสผ่าน------------------------------------------------->
<div class="modal fade" id="password_c" tabindex="-1" aria-labelledby="password" aria-hidden="true">
    <form id="password_check">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="password">กรุณากรอกรหัสผ่านของคุณ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <h5 style="font-size: 15px;float: left">รหัสผ่าน</h5> <input type="password" class="form-control corners shadow" name="Category_name" placeholder="รหัสผ่าน" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary corners shadow" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary corners shadow">ตกลง</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!------------------------------------------------แก้ไขหมวดหมู่----------------------------------------------->
<div class="modal fade" id="edit_categorys" tabindex="-1" aria-labelledby="category" aria-hidden="true">
    <form id="edit_category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="category">แก้ไขหมวดหมู่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="text" class="form-control corners shadow" id="Category_id" name="Category_id" placeholder="Category_id" style="display:none;" required>
                        <h5 style="font-size: 15px;float: left">ชื่อหมวดหมู่เอกสาร</h5> <input type="text" class="form-control corners shadow" name="Category_name" id="Category_name" placeholder="หมวดหมู่" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary corners shadow" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary corners shadow">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!--------------------------------------------รายละเอียด--------------------------------------------------------->
<div class="modal fade" id="in_doc" tabindex="-1" aria-labelledby="indoc" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title in_name" id="in_name"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p class="col-3"> เลขที่เอกสาร:</p>
                    <p class="col-9" id="numdoc_in"></p>
                    <hr>
                </div>
                <div class="row">
                    <p class="col-3"> ชื่อ:</p>
                    <p class="col-9" id="name_doc_p"></p>
                    <hr>
                </div>

                <div class="row">
                    <p class="col-3">วันที่:</p>
                    <p class="col-9" id="day_in"></p>
                    <hr>
                </div>
                <div class="row">
                    <p class="col-3">หมวดหมู่:</p>
                    <p class="col-9" id="c_in"></p>
                    <hr>
                </div>
                <div class="row">
                    <p class="col-3">ความสำคัญ:</p>
                    <p class="col-9" id="important_in"></p>
                    <hr>
                </div>
                <div class="row">
                    <p class="col-3">จาก:</p>
                    <p class="col-9" id="agency_in"></p>
                    <hr>
                </div>
                <p>รายละเอียด :</p>
                <p id='info'></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!---------------------------------------------รีเซ็ตรหัส-------------------------->
<div class="modal fade" id="re_pass" tabindex="-1" aria-labelledby="re_pass" aria-hidden="true">
    <form id="re_pass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="category">รีเซ็ตรหัส</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="text" class="form-control corners shadow" id="Category_id" name="Category_id" placeholder="Category_id" style="display:none;" required>
                        <h5 style="font-size: 15px;float: left">ชื่อหมวดหมู่เอกสาร</h5> <input type="text" class="form-control corners shadow" name="Category_name" id="Category_name" placeholder="หมวดหมู่" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary corners shadow" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary corners shadow">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once('style/js/together_js.php') ?>