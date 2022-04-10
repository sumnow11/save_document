$(document).ready(function() {
    var email_state = false;
    var phone = false;
    var email_print2="not_taken";
    var phone_print2="not_taken";
    var max_length2=10; 

    $("#edit_phone").keyup(function(){ 
        $(this).val($(this).val().substr(0,10)); 
        var this_length2=max_length2-$(this).val().length; 
        if(this_length2<=0){
          var phone = $("#edit_phone").val();
          var user_id = $('#user_id_edit').val();
          $.ajax({
            url: site_url+'user_information/check_phone',
            type: 'post',
            data: {
    
              'phone': phone,
              'user_id':user_id
            },success:function(response){
              if (response == 'taken') {
                phone_print2=response;
             check_email_phone2(phone_print2);
             $('#edit_phone').parent().removeClass('');
             $('#edit_phone').parent().addClass('form_error');
             $('#edit_phone').siblings("span").text("มีเบอร์โทรศัพท์นี้ในระบบแล้ว กรุณากรอกเบอร์โทรใหม่");
              }else if(response == 'not_taken'){
                phone_print2=response;
               check_email_phone2(phone_print2);
                $('#edit_phone').parent().removeClass('form_error');
                $('#edit_phone').parent().addClass('');
                $('#edit_phone').siblings("span").text("");
              }
            }
          });
         
        }else{
             phone_print2="on";
             check_email_phone2(phone_print2);
             $('#edit_phone').parent().removeClass('');
             $('#edit_phone').parent().addClass('form_error');
             $('#edit_phone').siblings("span").text("กรุณากรอกเบอร์โทรให้ครบ 10 หลัก");
              
        }           
});

$('#edit_email').on('blur', function() {
  var email = $('#edit_email').val();
  var user_id =$('#user_id_edit').val();
  if(email!=''&& email!=null){
    $.ajax({
      url: site_url+'user_information/email_check',
      type: 'post',
      data: {
        'email': email,
        'user_id':user_id
      },
      success: function(response) {
        if (response == 'taken') {
          email_state = false;
          email_print2 = response;
          check_email_phone2(email_print2);
          $('#edit_email').parent().removeClass('');
          $('#edit_email').parent().addClass('form_error');
          $('#edit_email').siblings("span").text("อีเมลนี้มีอยู่ในระบบแล้ว");
        } else if (response == "not_taken") {
          email_print2 = response;
          email_state = true;
          check_email_phone2(email_print2);
          $('#edit_email').parent().removeClass();
          $('#edit_email').parent().addClass('');
          $('#edit_email').siblings("span").text("");
          
        }
      }
    })
  }else{
    email_print2="on";
    $('#edit_email').parent().removeClass('');
    $('#edit_email').parent().addClass('form_error');
    $('#edit_email').siblings("span").text("กรุณากรอก อีเมล");
    check_email_phone2(email_print2);
  }
 
});
function  check_email_phone2(){
  if(email_print2=="not_taken"&& phone_print2=="not_taken"){
  
    $('#subedit').parent().removeClass('notbutton');
    $('#subedit').parent().addClass('subbutton');
  }else{

    $('#subedit').parent().removeClass('subbutton');
    $('#subedit').parent().addClass('notbutton');
  }
}
});