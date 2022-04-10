<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $doc->document_name ?></title>
</head>

<body>

    <div class="content">
        <?php
        if ($this->session->userdata('user_d') != '0') {
            redirect("login");
        }
        if ($doc->position_id == '') {
            redirect("login");
        } ?>

        <div class="embed-container">
            <iframe src="<?php echo base_url('style/pdfjs/web/viewer.html?file='); ?><?php echo base_url('data_doc/doc/') . $doc->doc_pdf; ?>" frameborder="0"></iframe>
        </div>

    </div>

</body>


</html>