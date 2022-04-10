<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>หมวดหมู่</title>
</head>

<body>

    <div class="container-fluid mt-3 p-4  ">
        <div class="row ">
            <div class="col-12 col-md-12  d-flex ">
                <div class="card flex-fill w-100 corners shadow">
                    <div class="card-header">
                        <h5 class="mb-0 mt-1" style="float: left"><i class="fas fa-passport"></i> รายการหมวดหมู่</h5>
                        <a class="btn btn-success mb-0 corners shadow " data-bs-toggle="modal" data-bs-target="#add_category" type="button" style="float:right; font-size: 15px;margin-right:10px;"><i class="fas fa-plus-circle"></i> เพิ่ม</a>
                    </div>
                 
                    <div class="card-body px-4 ">
                        <div class="mb-3 row">
                            <table id="table_category" class="display" style="width:100%; text-align:center;">
                                <thead>
                                    <tr>
                                      
                                        <th class="all">ประเภท</th>
                                        <th >วันที่</th>
                                        <th class='all'>จัดการ</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</body>



</html>