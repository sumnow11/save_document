
    
    $(document).on('click', '#report_h', function(e) {
        e.preventDefault();
        var day_s = $('#day_s').val();
        var day_e = $('#day_e').val();
      
        $.ajax({
            url: site_url+'report/report_h',
            type: 'post',
            data:{
                day_s : day_s,
                day_e :day_e 
            }, success: function(data) {
                   
                    $('#num_doc').html(data);
                }

        })
    });
    function printWindow() {
        var printReadyEle = document.getElementById("re_prin");
        var cod = '<HTML>\n<HEAD>\n';
    
        if (document.getElementsByTagName != null) {
            var sheadTags = document.getElementsByTagName("head");
            if (sheadTags.length > 0)
                cod += sheadTags[0].innerHTML;
        }
        cod += '<style>.print_button{display: none;}</style>'
        cod += '</HEAD>\n<BODY>\n';
        if (printReadyEle != null) {
            cod += printReadyEle.innerHTML;
        }
        cod += '\n</form>\n</BODY>\n</HTML>';
        var printWin1 = window.open();
        printWin1.document.open();
        printWin1.document.write(cod);
        printWin1.document.close();
        setTimeout(function(){
            printWin1.print(); 
        }, 1000);
        
    }
    $(document).on('click', '#excel_button', function(e) {
        e.preventDefault();
        var day_s = $('#day_s').val();
        var day_e = $('#day_e').val();
       
        $.ajax({
            url: site_url+'report/generateXls',
            type: 'post',
            data:{
                day_s : day_s,
                day_e :day_e 
            }

        })
    });
