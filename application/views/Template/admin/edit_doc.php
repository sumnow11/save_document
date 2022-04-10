<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขเอกสาร</title>
</head>

<body>

    <div class="container-fluid mt-3 p-4  ">
        <div class="row ">
            <div class="col-12 col-md-12  d-flex ">
                <div class="card flex-fill w-100 corners shadow">
                    <div class="card-header">
                        <h5 class="mb-0">แก้ไขเอกสาร</h5>
                    </div>
                    <div class="card-body px-4 ">
                        <div class="mb-3 row">
                            <form class="row g-3" id="edit_doc" action="<?php echo site_url('doc/edit_doc'); ?>" enctype="multipart/form-data" method="post">
                                <div>
                                    <h5 style="font-size: 15px;float: left">เลขที่เอกสาร</h5>
                                    <input type="text" class="form-control corners shadow " id="number_doc" name="number_doc" placeholder="เลขที่เอกสาร" value="<?php echo $doc->number_doc; ?>" >

                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control corners shadow" name="id" placeholder="id" style="display:none;" value="<?php echo $doc->document_id; ?>" required>
                                    <label for="inputEmail4" class="form-label">ชื่อเอกสาร</label>
                                    <input type="text" class="form-control corners shadow" name="document_name" placeholder="ชื่อเอกสาร" value="<?php echo $doc->document_name; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">ไฟล์เอกสาร</label>
                                    <div class="row">
                                        <div class="col-8">
                                        <input class="form-control corners shadow" type="file" id="formFile" name="pdf" accept="application/pdf">
                                        </div>
                                       
                                        <a class="col-4 mt-1"style="color:#000;" href="<?php echo base_url('admin/page_show_doc/'). $doc->document_id ?>" ><p>ตัวอย่าง</p></a>
                                    </div>

                                </div>

                                <?php $document_in = $doc->document;
                                $document_in = str_replace("<br>", "\n", "$document_in"); ?>

                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">หมายเหตุ</label>
                                    <textarea class="form-control" name="information" rows="5"><?php echo $document_in; ?></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">ประเภทเอกสาร</label>
                                    <select name="category" class="form-select corners shadow" required>
                                        <option value="<?php echo $doc->category_id ?>"><?php echo $doc->Category_name ?></option>
                                        <?php foreach ($category as $c) {
                                            if ($doc->category_id != $c->Category_id) {
                                                if ($c->delete_category == 0) {
                                        ?>

                                                    <option value="<?php echo $c->Category_id ?>"><?php echo $c->Category_name ?></option>
                                        <?php }
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputState" class="form-label ">ความสำคัญ</label>
                                    <select name="important" class="form-select corners shadow" required>
                                        <?php if ($doc->important == '0') { ?>
                                            <option value="0">ทั่วไป</option>
                                            <option value="1">สำคัญ</option>
                                        <?php } elseif ($doc->important == '1') { ?>
                                            <option value="1">สำคัญ</option>
                                            <option value="0">ทั่วไป</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-5 col-xxl-5 col-xl-5 ">
                                    <h5 class="pt-2" style="font-size: 15px;float: left">วันที่</h5>
                                    <input type="date" class="form-control corners shadow" name="day" value="<?php echo $doc->time ?>" required>
                                </div>
                                <div>
                                    <h5 class="pt-1" style="font-size: 15px;float: left">จาก</h5>
                                    <select name="agency" id="agency" class="form-select corners shadow" required>
                                        <option value="<?php echo $doc->agency ?>"><?php echo $doc->agency ?></option>
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
                                <div class="col-md-3">
                                    <label for="inputZip" class="form-label">สิทธิ์การเข้าถึง</label>
                                    <div>
                                        <?php if ($doc->access == 0) { ?>
                                            <input class="form-check-input shadow" type="radio" id="privilege" name="privilege" value="0" onclick="s2() " checked>
                                            <label class="form-check-label ">
                                                ทั้งหมด
                                            </label>
                                            <br>
                                            <input class="form-check-input shadow" type="radio" name="privilege" value="1" onclick="showposition2()">
                                            <label class="form-check-label ">
                                                ระบุ
                                            </label>

                                        <?php } else if ($doc->access == 1) { ?>
                                            <input class="form-check-input shadow" type="radio" id="privilege" name="privilege" value="0" onclick="s2() ">
                                            <label class="form-check-label ">
                                                ทั้งหมด
                                            </label>
                                            <br>
                                            <input class="form-check-input shadow" type="radio" name="privilege" value="1" onclick="showposition2()" checked>
                                            <label class="form-check-label ">
                                                ระบุ
                                            </label>
                                        <?php } ?>

                                    </div>
                                </div>
                                <?php $array_p_id = explode(',', $doc->position_id);
                                $array_u_id = explode(',', $doc->user_id); ?>
                                <?php if ($doc->access == 1) { ?>
                                <div  id="position2">
                                <?php }else{ ?>
                                    <div style="display:none;" id="position2">
                                    <?php } ?>
                                    <hr>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">

                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    <?php if ($array_p_id[0] == 0) { ?>
                                                        <input type="checkbox" class="form-check-input shadow" name="privilege_position" value="1">
                                                    <?php } else if ($array_p_id[0] != 0) { ?>
                                                        <input type="checkbox" class="form-check-input shadow" name="privilege_position" value="1" checked>
                                                    <?php } ?>
                                                    &nbsp ระบุตำแหน่งงาน
                                                </button>
                                            </h2>

                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <?php foreach ($array_p_id as $ap) {
                                                        foreach ($position as $p) {
                                                            if ($p->position_id == $ap) { ?>
                                                                <input type="checkbox" class="form-check-input shadow" id="position_id" name="position_id[]" value="<?php echo $p->position_id; ?>" checked>
                                                                <label class="form-check-label "><?php echo $p->position_name; ?></label><br>
                                                    <?php  }
                                                        }
                                                    } ?>
                                                    <hr>
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
                                                    <?php if ($array_u_id[0] == 0) { ?>
                                                        <input type="checkbox" class="form-check-input shadow" name="privilege_user" value="1">
                                                    <?php } else if ($array_u_id[0] != 0) { ?>
                                                        <input type="checkbox" class="form-check-input shadow" name="privilege_user" value="1" checked>

                                                    <?php } ?>
                                                    &nbsp ระบุบุคคล
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <?php foreach ($array_u_id as $au) {
                                                        foreach ($user_ as $u) {
                                                            if ($u->user_id == $au && $u->delete_user_data == 0) { ?>
                                                                <input type="checkbox" class="form-check-input shadow" id="user_id" name="user_id[]" value="<?php echo $u->user_id  ?>" checked>
                                                                <label class="form-check-label "><?php echo $u->fname; ?>&nbsp;&nbsp;<?php echo $u->lname ?></label><br>
                                                    <?php   }
                                                        }
                                                    } ?>
                                                    <hr>
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
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary corners shadow">บันทึก</button>
                        </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </div>

</body>


</html>
<script type="text/javascript">
    function showposition2() {
        var dp = document.getElementById("position2");
        if (dp.style.display == 'none')
            dp.style.display = 'block';

    }

    function s2() {
        var dp = document.getElementById("position2");
        dp.style.display = 'none';


    }
</script>