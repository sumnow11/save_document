


<script>
    
    $(document).ready(function() {

        load_data();

        function load_data(query) {
            $.ajax({
                url: "<?php echo site_url('search/search_doc'); ?>",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result_doc').html(data);
                }
            })
        }

        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });

      
    });

$(document).ready(function() {

load_data_user();

function load_data_user(query) {
    $.ajax({
        url: "<?php echo site_url('search/search_user'); ?>",
        method: "POST",
        data: {
            query: query
        },
        success: function(data) {
            $('#result_user').html(data);
        }
    })
}

$('.search_text').keyup(function() {
    var search = $(this).val();
    if (search != '') {
        load_data_user(search);
    } else {
        load_data_user();
    }
});
});
</script>