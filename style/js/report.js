
    $('#Category_total').ready(function() {
        $.ajax({
            url: site_url+'report/report_category',
            method: "POST",
            dataType: "json",
            success: function(data) {
             
                $('#Category_total').html(data.Category_total);


            }
        })
    });

    $('#doc_total').ready(function() {
        $.ajax({
            url: site_url+'report/report_doc',
            method: "POST",
            dataType: "json",
            success: function(data) {
                
                $('#doc_total').html(data.doc_total);


            }
        })
    });

    $('#user_total').ready(function() {
        $.ajax({
            url: site_url+'report/report_user',
            method: "POST",
            dataType: "json",
            success: function(data) {
             
                $('#user_total').html(data.user_total);


            }
        })
    });

    
    $('#docChart').ready(function() {
        var doc_Chart;
        $.ajax({
            url: site_url+'report/chart_doc',
            type: "POST",
            dataType: "json",

            success: function(doc) {
                docChart(doc);
            }
        });
       
       
        function docChart(doc) {
            
            var d_x = [];
            var d_y = [];
            for (var i = 0; i < doc.length; i++) {
                d_x.push(doc[i].x);
                d_y.push(doc[i].y);

            }

           
            const ctx = document.getElementById('docChart');
            doc_Chart = new Chart(ctx, {
                type: 'bar',
                data: {

                    labels: d_x,
                    datasets: [{
                        label: 'จำนวนเอกสาร',
                        data: d_y,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        $('#doc_year').change(function() {
            var year = $(this).val();
           
            $.ajax({
                url: site_url+'report/chart_doc',
                type: "POST",
                dataType: "json",
                data: {
                    year: year
                },
                success: function(doc) {
                    if(doc !=""){
                        doc_Chart.destroy();
                    }
                    docChart(doc);
                

                }
            });

        });
    });
  
