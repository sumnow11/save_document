<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เอกสาร</title>
</head>

<body>
    <div class="container-fluid mt-3 p-4">
        <div class="row ">
            <div class="col-12 col-md-12 col-xxl-12 d-flex ">
                <div class="card  w-100 corners shadow">
                    <div class="card-header">
                        <h5 class="mb-0" style="float: left"><i class="fas fa-file-alt"></i> รายการเอกสาร</h5>
                        <a class="btn btn-success mb-0 corners shadow" data-bs-toggle="modal" data-bs-target="#add_doc" type="button" style="float:right; font-size: 15px;margin-right:10px;"><i class="fas fa-plus-circle"></i> เพิ่ม</a>
                    </div>

                    <div class="card-body px-4 ">
                        <div class="mb-3 row">
                            <table id="example" class="table display" style="width:100%; text-align:center;">
                                <thead>
                                    <tr>
                                        <th class="d-none d-md-table-cell">ID</th>
                                        <th>เอกสาร</th>
                                        <th class="d-none d-xl-table-cell">ประเภท</th>
                                        <th class="d-none d-xl-table-cell">วันที่</th>
                                        <th class="d-none d-md-table-cell">ความสำคัญ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($doc as $d) {
                                        if ($d->delete_doc_data == 0) { 
                                            $i=3;
                                             ?>
                                            <tr>

                                                <td class="d-none d-md-table-cell"> <?php echo $d->document_id ?></td>
                                                <td><a href="<?php echo site_url('admin/show_doc/') . $d->document_id ?>"><?php echo $d->document_name ?></a> </td>
                                                <td class="d-none d-xl-table-cell"> <?php echo $d->Category_name ?></td>
                                                <td class="d-none d-xl-table-cell"> <?php echo $d->time ?></td>
                                                <?php if ($d->important == 0) { ?>
                                                    <td class="d-none d-md-table-cell"> <span class="badge bg-success corners shadow">ทั่วไป </span></td>
                                                <?php } elseif ($d->important == 1) { ?>
                                                    <td class="d-none d-md-table-cell"> <span class="badge btn-warning corners shadow"><i class="fas fa-lock"></i> สำคัญ </span></td>
                                                <?php } ?>
                                                <td> <a type="button" class="btn btn-primary corners shadow d-none d-xl-table-cell" href="<?php echo site_url('admin/show_doc/') . $d->document_id ?>" style="font-size: 15px;"><i class="fas fa-book-open"></i></a>
                                                    <a type="button" class="btn btn-warning corners shadow " href="<?php echo site_url('admin/edit_doc/') . $d->document_id; ?>" style="font-size: 15px;"><i class="fas fa-edit"></i></a>
                                                    <a type="button" class="btn btn-success corners shadow d-none d-xl-table-cell" href="<?php echo site_url('doc/delete_doc/') . $d->document_id; ?>" style="font-size: 15px;"><i class="fas fa-download"></i></a>
                                                    <a type="button" class="btn btn-danger corners shadow"  style="font-size: 15px;"  onclick="delete_doc(<?php echo $d->document_id ?>)"><i class="fas fa-trash"></i></a>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</body>



</html>