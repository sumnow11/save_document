<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="269680187771-hre72fcbchbqjvfhpcafas7kv5t668hr.apps.googleusercontent.com">
    <?php echo link_tag('style/css/login.css'); ?>
    <?php echo link_tag('style/css/style.css'); ?>
  
    <title>เข้าสู่ระบบ</title>
</head>
<script>
      var site_url = '<?php echo site_url() ?>';
</script>
<body>
    <div class="container">
        <div class="row px-3">
            <div class="col-lg-5 col-xl-5 card flex-row mx-auto px-0">

                <div class="card-body">
                    <h3 class="title text-center mt-4">
                        CS DOC
                    </h3>
                    <p>ตั้งรหัสของคุณ</p>
                    <div></div>
                    <div class="text-center " id="pin">
                        <input type="password" id="input_pin" class="form-control corners shadow">
                        <span style="color:#ff1111;"></span>
                    </div>
                    <div id="pc" class="pt-2" style="">
                        <p class='mt-1'>ยีนยันรหัสของคุณ</p>
                        <div class="text-center " id="pin_c">
                            <input type="password" id="input_pin_c" class="form-control corners shadow">
                            <span style="color:#ff1111;"></span>
                        </div>
                    </div>
                    <h5 id="c_password" class="mt-2 text-center" style="color:#ff1111;display:none;">รหัสไม่ตรงกัน</h5>
                    <div class="mb-3 mt-3">
                        <button type="button" class="btn btn-primary buton_pin" id="buton_pin1" style="pointer-events: none; background-color: #6c757d;">ยืนยัน</button>
                        <button type="button" class="btn btn-primary buton_pin" id="buton_pin2" style="display:none;">ยืนยัน</button>
                    </div>
                </div>


            </div>

        </div>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src=<?php echo base_url('style/bootstrap/js/bootstrap.bundle.min.js'); ?>></script>
<script type="text/javascript" src=<?php echo base_url('style/sweetalert/package/dist/sweetalert2.all.min.js'); ?>></script>
<script type="text/javascript" src=<?php echo base_url('style/js/check_pass.js'); ?>></script>
<script type="text/javascript">
      
   
</script>