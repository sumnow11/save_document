
  var i = 0;
function onSign() {
 i = 1;
}
function onSignIn(googleUser) {
  var urlpass='login/process';
  if(i==1){
    
      $.ajax({
        type: 'post',
        url: site_url+urlpass,
        data: {
          email:googleUser.getBasicProfile().getEmail()
        },
        success: function(response) {
         if(response=="login_success"){
          location.replace("login"); 
         }else if(response=="not success"){
          Swal.fire({
            icon: 'error',
            title: 'ไม่มีผู้ใช้งานนี้อยู่ในระบบ...',
            text: 'กรุณาตรวจสอบความถูกต้องของ Email ของท่าน',
          })
         }
         else{
          Swal.fire({
            icon: 'error',
            title: 'ไม่มีผู้ใช้งานนี้อยู่ในระบบ...',
            text: 'กรุณาตรวจสอบความถูกต้องของ Email ของท่าน',
          })
         }
            },
        error: function(err) {
          Swal.fire({
            icon: 'error',
            title: 'เข้าสู้ระบบไม่สำเร็จ',
            text: 'กรุณาเข้าสู้ระบบใหม่อีกครั้งภายหลัง',

          })

        }
      })
    }
  }
