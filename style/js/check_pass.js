$(document).ready(function() {
    var pass
    var pass_c
    var pc = document.getElementById("pc");
    var bp1 = document.getElementById("buton_pin1");
    var bp2 = document.getElementById("buton_pin2");
    var cp = document.getElementById("c_password");
    var max_length = 8;
    $("#input_pin").keyup(function() {
        var this_length = max_length - $(this).val().length;
        if (this_length < 0) {
            
            pass = $('#input_pin').val();
            $('#input_pin').parent().removeClass();
            $('#input_pin').parent().addClass('');
            $('#input_pin').siblings("span").text("");
            
            check_pin(pass);
        } else {
            
            $('#input_pin').siblings("span").text("กรุณากรอกรหัสผ่านมากกว่า 8 ตัวอักษร");
            $('#input_pin').parent().addClass('form_error');
            bp1.style.display = 'block';
            bp2.style.display = 'none';
            cp.style.display = 'none';

        }
    })
    $("#input_pin_c").keyup(function() {
        var this_length = max_length - $(this).val().length;
        if (this_length < 0) {
            pass_c = $('#input_pin_c').val();
            
            $('#input_pin_c').parent().removeClass();
            $('#input_pin_c').parent().addClass('');
            $('#input_pin_c').siblings("span").text("");
            check_pin(pass_c);
        } else {
            
            $('#input_pin_c').siblings("span").text("กรุณากรอกรหัสผ่านมากกว่า 8 ตัวอักษร");
            $('#input_pin_c').parent().addClass('form_error');
            bp1.style.display = 'block';
            bp2.style.display = 'none';
            cp.style.display = 'none';
        }
    })

    function check_pin() {
        if (pass_c == pass) {
            
            bp2.style.display = 'block';
            bp1.style.display = 'none';
            cp.style.display = 'none';
        } else if (pass_c != pass && pass_c != '' && pass_c != null && pass != '' && pass != null) {
            
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

                'n_password': pass
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
    
})
