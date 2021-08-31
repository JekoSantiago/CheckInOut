
$("document").ready(function () {

    var monitoringTable = $('#monitoringTable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        order: [[ 2, "asc" ]],
        ajax      : {
            url: WebURL + '/monitoring',
            method: 'POST',
            data: function (data) {
                var DateFrom = $('#dateFrom').val();
                var DateTo = $('#dateTo').val();
                var Employee = $('#employeeID').val();
                data.DateFrom = DateFrom;
                data.DateTo = DateTo;
                data.Employee = Employee;
            },
            dataType: 'json',
        },
        columns   :[
            {data:"Employee"},
            {data:"Location"},
            {data:"InsertDate"},
            {data:"TimeIN"},
            {render:function(data,type,row){
                var inType =""
                if(row.TimeIN !== null)
                {
                    if (row.isQRCodeIN==1){ inType = "QR"}
                    else if (row.ModeTypeIN==3){ inType = "Selfie"}
                    else if (row.ModeTypeIN==4){ inType = "Manual"}
                    else if (row.isQRCodeIN==0){ inType = "Facial Recognition"}
                }
                return inType;
            }},
            {data:"TimeOUT"},
            {render:function(data,type,row){
                var outType =""
                if(row.TimeOUT !== null)
                {
                    if (row.isQRCodeOUT==1){ outType = "QR"}
                    else if (row.ModeTypeOUT==3){ outType = "Selfie"}
                    else if (row.ModeTypeOUT==4){ outType = "Manual"}
                    else if (row.isQRCodeOUT==0){ outType = "Facial Recognition"}
                }
                return outType;
            }},
            {data:"TotalMinutes"}
        ],

        language: {
            emptyTable: 'No data available.',
        },
    });

    $(".df").on('change',function(){
        var token = $('#globalToken').val()
        var dateFrom = $('#dateFrom').val();
        var dateTo = $('#dateTo').val();
        var posLvl = $('#posID').val();

        if(posLvl < 5)
        {
            $.ajax({
                url:WebURL+'/emp-get',
                    type:'POST',
                    data:{token,dateFrom,dateTo},
                    dataType: 'text',
                    cache: false,
                    success: function (data) {
                        // console.log(data);
                        $('#employeeID').html(data);
                    },
                    error: function () {
                        console.log('error');
                    }
            })
        }
        });


});
