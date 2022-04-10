$(document).ready(function() {
    $(document).on('click', '.doc_check', function() {
      var doc_id = $(this).attr("id");

      $('#password_check').on('submit', function(e) {
        pass = $('#pass_check').val();
        e.preventDefault();
        $.ajax({
          url: site_url+'user_information/password_check',
          method: 'post',
          data:{ password:pass },
          beforeSend: function() {
            let timerInterval
            Swal.fire({
              title: 'กำลังโหลด...',

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
            if (response == 'correct') {
            location.replace(site_url+'user/page_show_doc/show__doc/' + doc_id);
            } else if (response == 'incorrect') {
              Swal.fire({
                icon: 'error',
                title: 'รหัสผ่านถูกต้อง...',
                text: 'กรุณาตรวจสอบความถูกต้อง',

              })
            }

          },
          error: function(err) {
            Swal.fire({
              icon: 'error',
              title: 'รหัสผ่านถูกต้อง...',
              text: 'กรุณาตรวจสอบความถูกต้อง',

            })

          }
        });
      });
    });
    $(document).on('click', '.change_password', function() {
        $('#password_check').on('submit', function(e) {
            pass = $('#pass_check').val();
            e.preventDefault();
            $.ajax({
              url: site_url+'user_information/password_check',
              method: 'post',
              data:{ password: pass },
              success: function(response) {
                if (response == 'correct') {
                    $('#password_c').modal('hide');
                    $('#new_password_show').modal('show');
                } else if (response == 'incorrect') {
                  Swal.fire({
                    icon: 'error',
                    title: 'รหัสผ่านถูกต้อง...',
                    text: 'กรุณาตรวจสอบความถูกต้อง',
    
                  })
                }
    
              },
              error: function(err) {
                Swal.fire({
                  icon: 'error',
                  title: 'รหัสผ่านถูกต้อง...',
                  text: 'กรุณาตรวจสอบความถูกต้อง',
    
                })
    
              }
            });
          });
    var pass_n
    var pass_c
    var bp1 = document.getElementById("buton_pin1");
    var bp2 = document.getElementById("buton_pin2");
    var cp = document.getElementById("c_password");
    var max_length = 8;
    $("#pass_n").keyup(function() {
        var this_length = max_length - $(this).val().length;
        if (this_length < 0) {
            
            pass_n = $('#pass_n').val();
            $('#pass_n').parent().removeClass();
            $('#pass_n').parent().addClass('');
            $('#pass_n').siblings("span").text("");
            
            check_pin(pass_n);
        } else {
            
            $('#pass_n').siblings("span").text("กรุณากรอกรหัสผ่านมากกว่า 8 ตัวอักษร");
            $('#pass_n').parent().addClass('form_error');
            bp1.style.display = 'block';
            bp2.style.display = 'none';
            cp.style.display = 'none';

        }
    })
    $("#pass_c").keyup(function() {
        var this_length = max_length - $(this).val().length;
        if (this_length < 0) {
            pass_c = $('#pass_c').val();
            
            $('#pass_c').parent().removeClass();
            $('#pass_c').parent().addClass('');
            $('#pass_c').siblings("span").text("");
            check_pin(pass_c);
        } else {
            
            $('#pass_c').siblings("span").text("กรุณากรอกรหัสผ่านมากกว่า 8 ตัวอักษร");
            $('#pass_c').parent().addClass('form_error');
            bp1.style.display = 'block';
            bp2.style.display = 'none';
            cp.style.display = 'none';
        }
    })

    function check_pin() {
        if (pass_c == pass_n) {
           
            bp2.style.display = 'block';
            bp1.style.display = 'none';
            cp.style.display = 'none';
        } else if (pass_c != pass_n && pass_c != '' && pass_c != null && pass_n != '' && pass_n != null) {
            
            bp1.style.display = 'block';
            bp2.style.display = 'none';
            cp.style.display = 'block';
        } else {
            bp1.style.display = 'block';
            bp2.style.display = 'none';
            cp.style.display = 'none';
        }
    }
    $('#buton_pin2').on('click', function(e) {
        e.preventDefault();
      
        $.ajax({
            url: site_url+'user_information/newPassword',
            type: 'post',
            data: {

                'n_password': pass_n
            },
            beforeSend: function() {
                let timerInterval
                Swal.fire({
                    title: 'กำลังโหลด...',

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
              
                if (response == 'correct') {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                           
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'ตั้งรหัสสำเร็จ',
                        icon: 'success',
                       
                        confirmButtonText: 'ตกลง',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.replace("login"); 
                        }
                    })
                } else if (response == "incorrect") {
                    Swal.fire({
                        icon: 'error',
                        title: 'ตั้งรหัสไม่สำเร็จ...',
                        text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ตั้งรหัสไม่สำเร็จ...',
                        text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',
                    })
                }
            },
            error: function(err) {
               
                Swal.fire({
                    icon: 'error',
                    title: 'ตั้งรหัสไม่สำเร็จ...',
                    text: 'กรุณาตรวจสอบความถูกต้อง หรือ บันทึกใหม่ภายหลัง',

                })

            }
        });
    });
    });
  });
