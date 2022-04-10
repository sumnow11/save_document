<!------------------------------------------กรอกรหัสผ่าน------------------------------------------------->
<div class="modal fade" id="password_c" tabindex="-1" aria-labelledby="password" aria-hidden="true">
    <form id="password_check">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="password">กรุณากรอกรหัสของคุณ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="password"  id="pass_check" class="form-control corners shadow">
                    </div>
                    <button type="submit"style="float: right;" class="mt-3 btn btn-dark form-control corners shadow">ตกลง</button>
                </div>

                <div class="modal-footer">
                    <p style="color: #6c757d">หมายเหตุ:กรณีที่ลืมรหัส กรุณาติดต่อเจ้าหน้าที่ (08-XXXX-XXXX)</p>
                </div>
            </div>
        </div>
    </form>
</div>




<!----------------------------------------เปลี่ยนรหัส-------------------------------------------------------------->
<div class="modal fade" id="new_password_show" tabindex="-1" aria-labelledby="password" aria-hidden="true">
    <form id="password_new">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="password">เปลี่ยนรหัสผ่าน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span style="color:#ff1111;"></span>
                </div>
                <div class="modal-body">

                    <div>
                        <h5 style="font-size: 15px;float: left " class="mt-1">รหัสผ่านใหม่</h5>
                        <div class="text-center " id="pin_n">
                        <input type="password"  id="pass_n" class="form-control corners shadow">
                        <span style="color:#ff1111;"></span>
                        </div>

                    </div>
                    <br>
                    <div id="pc" >
                        <h5 style="font-size: 15px;float: left" class="mt-1">ยืนยันรหัสผ่าน</h5>
                        <div class="text-center " id="pin_c">
                        <input type="password"  id="pass_c" class="form-control corners shadow">
                        <span style="color:#ff1111;"></span>
                        </div>
                    </div>
                    <h5 id="c_password" class="mt-2 text-center" style="color:#ff1111;display:none;">รหัสไม่ตรงกัน</h5>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary corners shadow" data-bs-dismiss="modal">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary corners shadow" id="buton_pin1" style=" pointer-events: none; background-color: #6c757d;">ยืนยัน</button>
                    <button type="submit" class="btn btn-primary corners shadow" id="buton_pin2" style="display:none;">ยืนยัน</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!----------------------------------------------------------รายละเอียด--------------------------------->
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