
  //----------------------------------------เช็คอีเมลและเบอร์โทร----------------------------------------------
  $(document).ready(function() {
    var email_state = false;
    var phone = false;
    var email_print;
    var phone_print;
    var max_length=10; 
    $("#add_phone").keyup(function(){ 
           var a =$("#add_phone").val($(this).val().substr(0,10)); 
            var this_length=max_length-a.val().length; 
            if(this_length<=0){
              var phone = $("#add_phone").val();
              $.ajax({
                url: site_url+'user_information/check_phone',
                type: 'post',
                data: {
        
                  'phone': phone
                },success:function(response){
                  if (response == 'taken') {
                    phone_print=response;
                 check_email_phone(phone_print);
                 $('#add_phone').parent().removeClass('');
                 $('#add_phone').parent().addClass('form_error');
                 $('#add_phone').siblings("span").text("มีเบอร์โทรศัพท์นี้ในระบบแล้ว กรุณากรอกเบอร์โทรใหม่");
                  }else if(response == 'not_taken'){
                    phone_print=response;
                    check_email_phone(phone_print);
                    $('#add_phone').parent().removeClass();
                    $('#add_phone').parent().addClass('');
                    $('#add_phone').siblings("span").text("");
                  }
                }
              });
             
            }else{
                 phone_print="on";
                 check_email_phone(phone_print);
                 $('#add_phone').parent().removeClass('');
                 $('#add_phone').parent().addClass('form_error');
                 $('#add_phone').siblings("span").text("กรุณากรอกเบอร์โทรให้ครบ 10 หลัก");
                  
            }           
    });
    $('#email').on('blur', function() {
      var email = $('#email').val();
      if(email!=''&& email!=null){
        $.ajax({
          url: site_url+'user_information/email_check',
          type: 'post',
          data: {
            'email': email
          },
          success: function(response) {
            if (response == 'taken') {
              email_state = false;
              email_print = response;
              check_email_phone(email_print);
              $('#email').parent().removeClass('');
              $('#email').parent().addClass('form_error');
              $('#email').siblings("span").text("อีเมลนี้มีอยู่ในระบบแล้ว");
            } else if (response == "not_taken") {
              email_print = response;
              email_state = true;
              check_email_phone(email_print);
              $('#email').parent().removeClass();
              $('#email').parent().addClass('');
              $('#email').siblings("span").text("");
              
            }
          }
        })
      }else{
        email_print="on";
        $('#email').parent().removeClass('');
        $('#email').parent().addClass('form_error');
        $('#email').siblings("span").text("กรุณากรอก อีเมล");
        check_email_phone(email_print);
      }
     
    });
    function  check_email_phone(){
      if(email_print=="not_taken"&& phone_print=="not_taken"){
       
        
        $('#submit_pass').parent().removeClass('notbutton');
        $('#submit_pass').parent().addClass('subbutton');
      }else{
        $('#submit_pass').parent().removeClass('subbutton');
        $('#submit_pass').parent().addClass('notbutton');
      }
    }
    
  });
  //----------------------------------------เช็ครหัสหน้าเอกสารสำคัญ----------------------------------------------
 
  
  //-------------------------------------เพิ่มเอกสาร------------------------------------------------------
  $(document).ready(function() {

    $('#insert_doc').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: site_url+'doc/add_doc',
        method: 'post',
        data: $('#insert_doc').serialize(),
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function() {
          let timerInterval
          Swal.fire({
            title: 'กำลังอัปโหลด...',

            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          })
        },
        success: function(response) {


          $.ajax({
            url: site_url+'report/report_doc',
            method: "POST",
            dataType: "json",
            success: function(data) {
             
              $('#doc_total').html(data.doc_total);


            }
          });

          $('#insert_doc')[0].reset();
          $('#add_doc').modal('hide');
          $('#table_doc').DataTable().ajax.reload();

          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'success',
            title: 'บันทึกเอกสารสำเร็จ'
          })

        },
        error: function(err) {
          Swal.fire({
            icon: 'error',
            title: 'บันทึกไม่สำเร็จ...',
            text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

          })

        }
      });
    });
  });
  //---------------------------------เพิ่มผู้ใช้งาน-------------------------------------
  $(document).ready(function() {
    $('#insert_user').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: site_url+'user_information/add_user',
        method: 'post',
        data: $('#insert_user').serialize(),
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function() {
          let timerInterval
          Swal.fire({
            title: 'กำลังอัปโหลด...',

            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          })
        },
        success: function(response) {
          
          if (response == "taken_email") {
            Swal.fire({
              icon: 'error',
              title: 'บันทึกไม่สำเร็จ...',
              text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

            })

          } else if (response == "error_pass") {
            Swal.fire({
              icon: 'error',
              title: 'บันทึกไม่สำเร็จ...',
              text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

            })

          }else if (response == "on_position") {
            Swal.fire({
              icon: 'error',
              title: 'บันทึกไม่สำเร็จ...',
              text: 'กรุณา ระบุตำแหน่งงาน',

            })

          } else {

            $.ajax({
              url: site_url+'report/report_user',
              method: "POST",
              dataType: "json",
              success: function(data) {
                
                $('#user_total').html(data.user_total);


              }
            })

            $('#insert_user')[0].reset();
            $('#add_user').modal('hide');
            $('#table_user').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'บันทึกผู้ใช้งานสำเร็จ'
            })

          }

        },
        error: function(err) {
          Swal.fire({
            icon: 'error',
            title: 'บันทึกไม่สำเร็จ...',
            text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

          })

        }
      });
    });
  });
  //-----------------------เพิ่มหมวดหมู่-----------------------------------------------
  $(document).ready(function() {
    $('#insert_category').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: site_url+'category/add_category',
        method: 'post',
        data: $('#insert_category').serialize(),

        beforeSend: function() {
          let timerInterval
          Swal.fire({
            title: 'กำลังอัปโหลด...',

            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          })
        },
        success: function(response) {

          $.ajax({
            url: site_url+'report/report_category',
            method: "POST",
            dataType: "json",
            success: function(data) {
             
              $('#Category_total').html(data.Category_total);


            }
          })

          $('#insert_category')[0].reset();
          $('#category_table_index').DataTable().ajax.reload();
          $('#table_category').DataTable().ajax.reload();
          $('#add_category').modal('hide');
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'success',
            title: 'บันทึกหมวดหมู่สำเร็จ'
          })

        },
        error: function(err) {
          Swal.fire({
            icon: 'error',
            title: 'บันทึกไม่สำเร็จ...',
            text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

          })

        }
      });
    });
  });
  //--------------------------ยกเลิกเอกสาร-----------------------------------
  function delete_doc(document_id) {
    Swal.fire({
      icon: 'warning',
      title: 'คุณต้องการยกเลิกเอกสารนี้ หรือ ไม่',
      showConfirmButton: false,
      showDenyButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      denyButtonText: 'ตกลง',
    }).then((result) => {
      if (result.isDenied) {
        $.ajax({
          type: 'post',
          url: site_url+'doc/delete_doc',
          data: {
            document_id: document_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {

            $.ajax({
              url: site_url+'report/report_doc',
              method: "POST",
              dataType: "json",
              success: function(data) {
               
                $('#doc_total').html(data.doc_total);


              }
            })

            $('#table_doc').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ยกเลิกเอกสารสำเร็จ',

            })

          },
          error: function(err) {
            Swal.fire({
              icon: 'error',
              title: 'ยกเลิกเอกสารไม่สำเร็จ...',


            })

          }
        })
      }
    })

  }
  //--------------------------ลบผู้ใช้งาน-----------------------------------
  function delete_user(user_id) {
    Swal.fire({
      icon: 'warning',
      title: 'คุณต้องการยกเลิกผู้ใช้งานนี้',
      showConfirmButton: false,
      showDenyButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      denyButtonText: 'ลบ',
    }).then((result) => {
      if (result.isDenied) {
        $.ajax({
          type: 'post',
          url: site_url+'user_information/delete_user',
          data: {
            user_id: user_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {


            $.ajax({
              url: site_url+'report/report_user',
              method: "POST",
              dataType: "json",
              success: function(data) {
               
                $('#user_total').html(data.user_total);


              }
            })

            $('#table_user').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ยกเลิกเอกผู้ใช้งานสำเร็จ',

            })

          },
          error: function(err) {
            Swal.fire({
              icon: 'error',
              title: 'ยกเลิกผู้ใช้งานไม่สำเร็จ...',


            })

          }
        })
      }
    })

  }
  //--------------------------ลบหมวดหมู่-----------------------------------
  function delete_category(Category_id) {
    Swal.fire({
      icon: 'warning',
      title: 'คุณต้องการลบหมวดหมู่เอกสารนี้',
      showConfirmButton: false,
      showDenyButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      denyButtonText: 'ลบ',
    }).then((result) => {
      if (result.isDenied) {
        $.ajax({
          type: 'post',
          url: site_url+'category/delete_category',
          data: {
            Category_id: Category_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {

            $.ajax({
              url: site_url+'report/report_category',
              method: "POST",
              dataType: "json",
              success: function(data) {
               
                $('#Category_total').html(data.Category_total);


              }
            })

            $('#table_category').DataTable().ajax.reload();
            $('#category_table_index').DataTable().ajax.reload();
            $('#delete_table_category').DataTable().ajax.reload();
            $('#table_doc').DataTable().ajax.reload();

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ลบหมวดหมู่สำเร็จ',

            })

          },
          error: function(err) {
            Swal.fire({
              icon: 'error',
              title: 'ลบหมวดหมู่ไม่สำเร็จ...',


            })

          }
        })
      }
    })

  }

  //----------------------------------ลบเอกสารถาวร--------------------------------

  function delete_doc_p(document_id) {
    Swal.fire({
      icon: 'warning',
      title: 'ลบเอกสารถาวร',
      text: 'คุณต้องการลบเอกสารนี้ หรือ ไม่ ?',
      showConfirmButton: false,
      showDenyButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      denyButtonText: 'ลบ',
    }).then((result) => {
      if (result.isDenied) {
        $.ajax({
          type: 'post',
          url: site_url+'doc/delete_doc_permanent',
          data: {
            document_id: document_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {
           
            $('#delete_tabledoc').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ลบเอกสารสำเร็จ',

            })

          
        },
          error: function(err) {
            Swal.fire({
              icon: 'error',
              title: 'ลบเอกสารไม่สำเร็จ...',


            })

          }
        })
      }
    })

  }
  //----------------------------------ลบผู้ใช้งานถาวร--------------------------------

  function delete_user_p(user_id) {
    Swal.fire({
      icon: 'warning',
      title: 'ลบผู้ใช้งานถาวร',
      text: 'คุณต้องการลบผู้ใช้งานนี้ หรือ ไม่ ?',
      showConfirmButton: false,
      showDenyButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      denyButtonText: 'ลบ',
    }).then((result) => {
      if (result.isDenied) {
        $.ajax({
          type: 'post',
          url: site_url+'user_information/delete_user_permanent',
          data: {
            user_id: user_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {
            $('#delete_table_user').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ลบผู้ใช้งานสำเร็จ',

            })

          },
          error: function(err) {
            Swal.fire({
              icon: 'error',
              title: 'ลบผู้ใช้งานไม่สำเร็จ...',


            })

          }
        })
      }
    })

  }
  //----------------------------------ลบหมวดหมู่ถาวร--------------------------------

  function delete_category_p(Category_id) {
    Swal.fire({
      icon: 'warning',
      title: 'ลบหมวดหมู่ถาวร',
      text: 'คุณต้องการลบหมวดหมู่นี้ หรือ ไม่ ?',
      showConfirmButton: false,
      showDenyButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      denyButtonText: 'ลบ',
    }).then((result) => {
      if (result.isDenied) {
        $.ajax({
          type: 'post',
          url: site_url+'category/delete_category_p',
          data: {
            Category_id: Category_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {
            $('#delete_table_category').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ลบผู้ใช้งานสำเร็จ',

            })

          },
          error: function(err) {
            Swal.fire({
              icon: 'error',
              title: 'ลบผู้ใช้งานไม่สำเร็จ...',


            })

          }
        })
      }
    })

  }
  //----------------------------------กู้คืนเอกสาร--------------------------------

  function recovery_doc(document_id) {
    Swal.fire({
      icon: 'warning',
      title: 'ต้องการยุติการยกเลิกเอกสารนี้ หรือ ไม่ ?',

      showConfirmButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      confirmButtonText: 'ยืนยัน',

    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'post',
          url: site_url+'doc/recovery_doc',

          data: {
            document_id: document_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {
           
            $('#table_doc').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ยุติการยกเลิกเอกสารสำเร็จ',

            })

          },
          error: function(err) {
            
            Swal.fire({
              icon: 'error',
              title: 'ยุติการยกเลิกเอกสารไม่สำเร็จ...',


            })

          }
        })
      }
    })

  }
  //----------------------------------กู้คืนผู้ใช้งาน--------------------------------

  function recovery_user(user_id) {
    Swal.fire({
      icon: 'warning',
      title: 'ต้องการยุติการยกเลิกผู้ใช้งานนี้ หรือ ไม่ ?',

      showConfirmButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      confirmButtonText: 'ยืนยัน',

    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'post',
          url: site_url+'user_information/user_recovery',

          data: {
            user_id: user_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {
           
            $('#table_user').DataTable().ajax.reload();
          

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'ยุติการยกเลิกผู้ใช้งานสารสำเร็จ',

            })

          },
          error: function(err) {
           
            Swal.fire({
              icon: 'error',
              title: 'ยุติการยกเลิกผู้ใช้งานไม่สำเร็จ...',


            })

          }
        })
      }
    })


  }
  //----------------------------------กู้คืนหมวดหมู่--------------------------------

  function recover_category(Category_id) {
    Swal.fire({
      icon: 'warning',
      title: 'ต้องการกู้คืนหมวดหมู่นี้ หรือ ไม่ ?',

      showConfirmButton: true,
      showCancelButton: true,
      cancelButtonText: 'ยกเลิก',
      confirmButtonText: 'ยืนยัน',

    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'post',
          url: site_url+'category/recover_category',

          data: {
            Category_id: Category_id
          },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังดำเนินการ...',

              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },
          success: function(response) {
            
            $('#table_category').DataTable().ajax.reload();
            $('#category_table_index').DataTable().ajax.reload();
            $('#delete_table_category').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'กู้คืนหมวดหมู่สำเร็จ',

            })

          },
          error: function(err) {
           
            Swal.fire({
              icon: 'error',
              title: 'กู้คืนหมวดหมู่่ไม่สำเร็จ...',


            })

          }
        })
      }
    })
  }
  
  //--------------------------------แก้ไขเอกสาร---------------------------------------
  $(document).ready(function() {
    $('#edit_doc').on('submit', function(e) {
      e.preventDefault();
      Swal.fire({
        icon: 'question',
        title: 'บันทึก ?',

        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: 'ยกเลิก',
        confirmButtonText: 'ยืนยัน',

      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: site_url+'doc/edit_doc',
            method: 'post',
            data: $('#edit_doc').serialize(),
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
              let timerInterval
              Swal.fire({
                title: 'กำลังอัปโหลด...',

                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              })
            },
            success: function(response) {
              $('#table_doc').DataTable().ajax.reload();
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: 'บันทึกเอกสารสำเร็จ'
              })

            },
            error: function(err) {
              Swal.fire({
                icon: 'error',
                title: 'บันทึกไม่สำเร็จ...',
                text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

              })

            }
          });
        }
      });
    });
  });
  //-------------------------------------แก้ไขผู้ใช้งาน--------------------------------------
  $(document).ready(function() {
    $('#edit_user').on('submit', function(e) {
      e.preventDefault();
      Swal.fire({
        icon: 'question',
        title: 'บันทึก ?',

        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: 'ยกเลิก',
        confirmButtonText: 'ยืนยัน',

      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({

            url: site_url+'user_information/edit_user',
            method: 'post',
            data: $('#edit_user').serialize(),
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
              let timerInterval
              Swal.fire({
                title: 'กำลังอัปโหลด...',

                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              })
            },
            success: function(response) {
              if(response=='not_position'){
                Swal.fire({
                  icon: 'error',
                  title: 'บันทึกไม่สำเร็จ...',
                  text: 'กรุณาระบุตำแหน่งงาน',
  
                })
              }else if(response!='not_position'){
              $('#table_doc').DataTable().ajax.reload();
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: 'บันทึกสำเร็จ'
              })

            } },
            error: function(err) {
              Swal.fire({
                icon: 'error',
                title: 'บันทึกไม่สำเร็จ...',
                text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

              })

            }
          });
        }
      });
    });
  });
  //------------------------------------------------แก้ไขหมวดหมู่---------------------------
  $(document).on('click', '.edit_categorys', function() {
    var category_id = $(this).attr("id");
    $.ajax({
      url: site_url+'category/category_id',
      method: "POST",
      data: {
        category_id: category_id
      },
      dataType: "json",
      success: function(data) {
        $('#edit_categorys').modal('show');
        $('#Category_id').val(data.Category_id);
        $('#Category_name').val(data.Category_name);
        $('#action');
      }
    })
  });
  //----------------------------------------------รายละเอียดเอกสาร----------------------------------
  $(document).on('click', '.in_doc', function() {
    var document_id = $(this).attr("id");
    $.ajax({
      url: site_url+'doc/in_doc',
      method: "POST",
      data: {
        document_id: document_id
      },
      dataType: "json",
      success: function(data) {
       
        $('#in_doc').modal('show');
        $('#in_name').html("<b>" + data.document_name + "</b>");
        $('#numdoc_in').html("<p>" + data.number_doc + "</p>");
        $('#name_doc_p').html("<p>" + data.document_name + "</p>");
        $('#day_in').html("<p>" + data.time + "</p>");
        $('#c_in').html("<p>" + data.Category_name + "</p>");
        if (data.important == 0) {
          $('#important_in').html("<p class='badge bg-success corners shadow'>ทั่วไป</p>");
        } else if (data.important == 1) {
          $('#important_in').html("<p class='badge btn-warning corners shadow'><i class='fas fa-lock'></i>สำคัญ</p>");
        } else {}
        $('#agency_in').html("<p>" + data.agency + "</p>");
        $('#info').html("<p>" + data.document + "</p>");
        $('#action');
      }
    })
  });
  //------------------------------------------------แก้ไขหมวดหมู่บันทึก-----------------------
  $(document).ready(function() {
    $('#edit_category').on('submit', function(e) {
      e.preventDefault();
      Swal.fire({
        icon: 'question',
        title: 'บันทึก ?',

        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: 'ยกเลิก',
        confirmButtonText: 'ยืนยัน',

      }).then((result) => {
        if (result.isConfirmed) {
          var Category_id = $('#Category_id').val();
          var Category_name = $('#Category_name').val();
          $.ajax({
            url: site_url+'category/edit_category',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            processData: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
              let timerInterval
              Swal.fire({
                title: 'กำลังอัปโหลด...',

                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              })
            },
            success: function(response) {
              
              $('#edit_categorys').modal('hide');
              $('#edit_category')[0].reset();
              $('#table_category').DataTable().ajax.reload();
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: 'บันทึกหมวดหมู่สำเร็จ'
              })

            },
            error: function(err) {
              Swal.fire({
                icon: 'error',
                title: 'บันทึกไม่สำเร็จ...',
                text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

              })

            }
          });
        }
      });
    });
  });
  //----------------------------------------รีเซ็ครหัสผ่าน-------------------------------------------------
  $(document).on('click', '.reset_Password', function() {
        var user_id = $(this).attr("id");
        Swal.fire({
            icon: 'warning',
            title: 'รีเซ็ตรหัส....',
            text: 'คุณต้องการรีเซ็ตรหัสผู้ใช้งานนี้ หรือ ไม่ ?',
            showConfirmButton: false,
            showDenyButton: true,
            showCancelButton: true,
            cancelButtonText: 'ยกเลิก',
            denyButtonText: 'ตกลง',
          }).then((result) => {
              if (result.isDenied) {
                $.ajax({
                  url: site_url+'user_information/reset_Password',
                  method: "POST",
                  data: {
                    user_id: user_id
                  },

                  beforeSend: function() {
                    let timerInterval
                    Swal.fire({
                      title: 'กำลังอัปโหลด...',

                      timerProgressBar: true,
                      didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                      },
                      willClose: () => {
                        clearInterval(timerInterval)
                      }
                    })
                  },
                  success: function(data) {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })

                    Toast.fire({
                      icon: 'success',
                      title: 'รีเซ็ตรหัสผ่านสำเร็จ'
                    })

                  },
                  error: function(err) {
                   
                    Swal.fire({
                      icon: 'error',
                      title: 'รีเซ็ตรหัสผ่านไม่สำเร็จ...',
                      text: 'กรุณารีเซ็ตรหัสผ่านใหม่ภายหลัง',

                    })

                  }
                })
              }
            });
              });


              
