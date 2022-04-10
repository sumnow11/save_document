<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ค้นหา</title>
    
</head>

<body>


    <div class="container-fluid mt-3 p-4 mt-5  ">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 mb-2">
                <input type="text" name="search_text" id="search_text" placeholder="ค้นหา" class="form-control corners shadow search_text" />
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row mt-3">
            <?php if ($this->session->userdata('role') == '0') { ?>
                <div class="col-12 sm-12 col-lg-12  col-xl-8  d-flex pb-2">
                <?php } ?>
                <?php if ($this->session->userdata('role') == '1') { ?>
                    <div class="col-12 sm-12 col-lg-12  col-xl-12  d-flex pb-2">
                    <?php } ?>
                    <div class="card flex-fill w-100 corners shadow">
                        <div class="card-header">
                            <h5 class="mb-0" style="float: left"><i class="fas fa-file-alt"></i> รายการเอกสาร</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div id="result_doc"></div>
                            </div>
                        </div>
                    </div>

                    </div>
                    <?php if ($this->session->userdata('role') == '0') { ?>
                        <div class="col-12 col-lg-12 col-xl-4 sm-12  d-flex category_body">
                            <div class="card flex-fill w-100 corners shadow category_card">
                                <div class="card-header">
                                    <h5 class="mb-0 mt-1" style="float: left"><i class="fas fa-passport"></i> รายชื่อผู้ใช้งาน</h5>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div id="result_user"></div>
                                    </div>


                                </div>

                            </div>

                        </div>
                    <?php } ?>
                </div>
        </div>



</body>
<?php require_once('style/js/pin_.php') ?>
<?php require_once('style/js/search.php') ?>
</html>