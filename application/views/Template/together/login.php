<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="269680187771-hre72fcbchbqjvfhpcafas7kv5t668hr.apps.googleusercontent.com">
    <?php echo link_tag('style/css/login.css'); ?>
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
                    <h1 class="title text-center mt-4">
                        CS DOC
                    </h1>
                    <div class="row justify-content-center align-self-center g-signin2" data-onsuccess="onSignIn" onclick="onSign()" data-width=" 200% "></div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once('style/js/login.php') ?>
</html>