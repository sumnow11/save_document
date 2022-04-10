
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <?php

    ?>
    <?php echo link_tag('style/css/nav.css'); ?>
</head>
<script>
    var site_url = '<?php echo site_url() ?>';

</script>
<body>
    <div class="d-none d-md-block">
        <nav class="navbar navbar-up  navbar-expand d-flex flex-column align-item-start navbar-dark bg-dark " id="sidebar">
            <a href="#" class="navbar-brand text-light mt-5">
                <div class="display-5 font-weight-bold">
                    <h1 class="logo">CS DOC</h1>
                </div>
            </a>
            <ul class="navbar-nav d-flex flex-column mt-5 w-100">
                <li class="nav-item w-100 shadow">
                    <a href="<?php echo site_url('user')?>" class="nav-link text-light pl-4">&nbsp<i class="fas fa-home"></i>&nbspหน้าแรก</a>
                </li>
                <li class="nav-item w-100 shadow">
                    <a href="<?php echo site_url('user/profile/') . $user_nav->user_id ?>" class="nav-link text-light pl-4">&nbsp<i class="fas fa-user"></i>&nbspโปรไฟล์</a>
                </li>
                <br>
                <h5 style="font-size:15px; color:#6c757d;">&nbspหมวดหมู่</h5>
                <li class="nav-item  w-100 shadow">
                    <a href="<?php echo site_url('user'); ?>" class="nav-link  text-light pl-4" role="button" >
                        &nbsp<i class="fas fa-file-alt"></i>&nbspเอกสาร</a>
                  
                </li>
                <li class="nav-item w-100 shadow logoutfootter" >
                    <a href="<?php echo site_url('login/logout') ?>" class="nav-link text-light pl-4">&nbsp<i class="fas fa-sign-out-alt"></i>&nbspออกจากระบบ</a>
                </li>

            </ul>
        </nav>
    </div>
    <div class="my-container nav-con">
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg-white shadow">
            <div class="container-fluid col-md-12">
                <a id="menu-btn" type="button" class="col-1 d-none d-md-block" onclick="showlogo()">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <div class="col-10 d-none d-md-block">
                    <ul class="nav justify-content-center ">
                        <li class="nav-item" style="display:none;" id="logo">
                            <a>
                                <h1>CS DOC</h1>
                            </a>
                        </li>
                </div>
                </ul>
                <div class="col-1 d-none d-md-block">
                    <form class="d-flex ">
                    <a href="<?php echo base_url('user/page_search'); ?>" class="mt-1"><h3><i class="fas fa-search"></i></h3></a>
                       &nbsp;&nbsp;
                        <div class="dropstart ">
                           
                        <?php if($user_nav->img!=''){ ?>
                            <img class="dropdown-toggle " src="<?php echo base_url("data_doc/img_user/$user_nav->img"); ?>" role="button" id="dropdownimg" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php }else{ ?>
                                <img class="dropdown-toggle " src="<?php echo base_url("data_doc/img_user/user.png"); ?>" role="button" id="dropdownimg" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php } ?>
                            <ul class="dropdown-menu dropimg" aria-labelledby="dropdownimg">
                                <li><a class="dropdown-item " href="<?php echo site_url('user/profile/') . $user_nav->user_id ?>"><i class="fas fa-user"></i> โปรไฟล์</a></li>
                                <hr>
                                <li><a class="dropdown-item" href="<?php echo site_url('login/logout') ?>"><i class="fas fa-sign-out-alt"></i>ออกจากระบบ</a></li>
                            </ul>
                        </div>
                        
                    </form>
                </div>
                <a class="navbar-brand d-block d-md-none col-1" id="logo" href="<?php echo base_url('user') ?>">
                    <h1>CS DOC</h1>
                </a>
                <a class="col-6"></a>
                <a class="d-block d-md-none col-1"href="<?php echo base_url('user/page_search'); ?>"><h3 class=""><i class="fas fa-search "></i></h3></a>
                <button class="navbar-toggler d-block d-md-none col-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav d-block d-md-none">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('user/profile/') . $user_nav->user_id ?>">โปรไฟล์</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link "role="button"href="<?php echo site_url('user')?>">
                                เอกสาร
                            </a>
                         
                        </li>
                       
                        <hr>
                     
                       
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo site_url('login/logout') ?>" aria-disabled="true">ออกจากระบบ</a>
                        </li>
                    </ul>

                </div>
            </div>
            
        </nav>
    
