
    $(document).ready(function() {
    //----------------ตารางเอกสารที่ถูกลบ------------------------------------------------
        $('#delete_tabledoc').DataTable({
            "order": [0, 'desc'],
            responsive: true,
            "ajax": {
                url: site_url+'doc/delete_tabledoc',
                type: 'post',
            },

            "lengthMenu": [5, 10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ รายการ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า",


                },
                "aria": {
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก",
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย"
                }
            }

        });
//-------------------------------------ตารางหมวดหมู่-------------------------------
        $('#table_category').DataTable({
            responsive: true,
            "ajax": site_url+'category/table_category',
            type: 'post',


            "lengthMenu": [5, 10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ รายการ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า",


                },
                "aria": {
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก",
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย"
                }
            }

        });
//-------------------------------------------ตารางหมวดหมู่ที่ลบ-------------------------------
        $('#delete_table_category').DataTable({
            responsive: true,
            "ajax": site_url+'category/delete_table_category',
            type: 'post',

            "lengthMenu": [5, 10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ รายการ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า",


                },
                "aria": {
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก",
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย"
                }
            }

        });

//------------------------------------ตารางผู้ใช้ที่ถูกลบ-------------------------------------------
        $('#delete_table_user').DataTable({
            "order": [0, 'desc'],
            responsive: true,
            "ajax":site_url+'user_information/delete_table_user',
            type: 'post',

            "lengthMenu": [5, 10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ รายการ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า",


                },
                "aria": {
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก",
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย"
                }
            }

        });
//------------------------------ค้นหา-----------------------------------------------
        $('#search').DataTable({
            "order": [0, 'desc'],
            "lengthMenu": [5, 10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ รายการ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า",


                },
                "aria": {
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก",
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย"
                }
            }

        });

    
//---------------------------------------------ตารางเอกสาร-----------------------------
   
    $('#table_doc').DataTable().destroy();
    $('#table_doc').DataTable( {
        
        responsive: true,   
        "ajax": {
        url:site_url+'doc/tabledoc',
        type : 'POST',
    },  
        "lengthMenu": [5,10, 25, 50, 100 ],
        "language": {   
            "decimal":        "",
            "emptyTable":     "ไม่มีรายการข้อมูล",
            "info":           " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            "infoEmpty":      "ไม่มีรายการข้อมูล",
            "infoFiltered":   "(กรองจากทั้งหมด _MAX_ รายการ)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "แสดง  _MENU_ รายการ",
            "loadingRecords": "กำลังโหลดข้อมูล...",
            "processing":     "กำลังประมวลผล...",
            "search":         "ค้นหา:",
            "zeroRecords":    "ไม่พบรายการที่ค้นหา",
            "paginate": {
            "first":      "หน้าแรก",
            "last":       "หน้าสุดท้าย",
            "next":       "ถัดไป",
            "previous":   "ก่อนหน้า",
		
			
            },
            "aria": {
                "sortDescending": ": เรียงข้อมูลจากมากไปน้อย",
                "sortAscending":  ": เรียงข้อมูลจากน้อยไปมาก"
            }               
        }       
       
    } );
        $('#doc_category').change(function() {
            var Category_id = $('#doc_category').val();
            $('#table_doc').DataTable().destroy();
            $('#table_doc').DataTable({
               
                responsive: true,
                "ajax": {
                    url: site_url+'doc/tabledoc',
                    data: {
                        Category_id: Category_id
                    },
                    type: 'POST',
                },
                "lengthMenu": [5,10, 25, 50, 100],
                "language": {
                    "decimal": "",
                    "emptyTable": "ไม่มีรายการข้อมูล",
                    "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "infoEmpty": "ไม่มีรายการข้อมูล",
                    "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "แสดง  _MENU_ รายการ",
                    "loadingRecords": "กำลังโหลดข้อมูล...",
                    "processing": "กำลังประมวลผล...",
                    "search": "ค้นหา:",
                    "zeroRecords": "ไม่พบรายการที่ค้นหา",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "ถัดไป",
                        "previous": "ก่อนหน้า",


                    },
                    "aria": {
                        "sortDescending": ": เรียงข้อมูลจากมากไปน้อย",
                        "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก"
                    }
                }


            });
        });
    

   //---------------------------------------------ตารางผู้ใช้งาน-----------------------------------------------
        
        $('#table_user').DataTable().destroy();
        $('#table_user').DataTable({
            
            responsive: true,
            "ajax": {
                url: site_url+'user_information/table_user',
                type: 'POST',
            },
            "lengthMenu": [5,10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ รายการ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า",


                },
                "aria": {
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย",
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก"
                }
            }

        });

    

        $('#position_i').change(function() {
            var position_id = $('#position_i').val();
          
        $('#table_user').DataTable().destroy();
        $('#table_user').DataTable({
            responsive: true,
            "ajax": {
                url: site_url+'user_information/table_user',
                data: {
                    position_id: position_id
                },
                type: 'post'
            },

            "lengthMenu": [5, 10, 25, 50, 100],
            "language": {
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": " _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ รายการ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า",


                },
                "aria": {
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก",
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย"
                }
            }
        });

    });
});
