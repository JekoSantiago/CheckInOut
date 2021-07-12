$(document).ready(function() {
    $.ajax({
        url:WebURL+'/dc-get',
            type:'GET',
            dataType: 'text',
            cache: false,
            success: function (data) {
                // console.log(data);
                $('#DC').html(data);
            },
            error: function () {
                console.log('error');
            }
    })



    var tbl_logsheet = $('#tbl_logsheet').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax      : {
            url: WebURL + '/logsheet-get',
            method: 'POST',
            data: function (data) {
                var DateFrom = $('#dateFrom').val();
                var DateTo = $('#dateTo').val();
                var Status = $('#isApproved').val();

                data.DateFrom = DateFrom;
                data.DateTo = DateTo;
                data.Status = Status;
            },
            dataType: 'json',
        },
        columns   :[
            {render:function(data, type, row)
                {
                   var edit = (row.DC_ID>0 && row.Status==0) ? '<a href="javascript:void(0) "class="editls text-warning"><i class="material-icons">edit</i></a>' : ' ' ;
                    return edit;
                }
            },
            {data:"EmployeeNo"},
            {data:"Location"},
            {data:"InsertDate"},
            {data:"Type"},
            {data:"Time"},
            {data:"Date"},
            {data:"IoR", render:function(data, type, row){
                return (row.ModeTypeID == 3) ? '<a href="javascript:void(0) "class="photo text-primary"><i class="material-icons">photo</i></a>' : data;
            }},
            {data:"Status",
            render:function(data, type, row){
                var status = (row.Status == 0) ? "Pending" : (row.Status == 1) ? "Approved" : "Declined";
                return status;
            }},
            {data:"ApprovedBy"},
            {data:"Update"},
            {data:"Remarks"}
        ],
        language: {
            emptyTable: 'No data available.',
        },
    });

    $('#BtnFilterSubmit').on('click', function(){
        tbl_logsheet.ajax.reload()
    })

    $('body').on('click','.editls',function(e){
        var data = tbl_logsheet.row( $(this).parents('tr') ).data();
        console.log(data);
        $('#submit').hide();
        $('#update').show();
        $('#modalLogsheet').modal('show')

        var id = data['Logsheet_ID'];
        var DC = data['DC_ID'];
        var store = data['Location_ID'];
        var date = data['Date'];
        var time = data['Time'];
        var type = (data['Type']=='IN') ? 1:0;
        var reason = data['Reason'];

        $('#LogID').val(id);
        $('#DC').val(DC);
        $.ajax({
            url:WebURL+'/stores-get',
                type:'POST',
                data:{DC},
                dataType: 'text',
                cache: false,
                success: function (data) {
                    // console.log(data);
                    $('#store').html(data);
                    $('#store').val(store);
                },
                error: function () {
                    console.log('error');
                }
        })
        $('#logdate').val(date);
        $('#logtime').val(time);
        $('#logtype').val(type);
        $('#reason').text(reason);

    })


    $('#addLS').on('click',function(){
        $('#submit').show();
        $('#update').hide();
    })

    $("#modalLogsheet").on('shown.bs.modal', function () {

        $('#store').select2({
            dropdownParent: $('#modalLogsheet'),
        });
        $('.nosearch').select2({
            minimumResultsForSearch: Infinity,
        });

   });

   $("#DC").on('change',function(){
    var token = $('#globalToken').val()
    var DC = $('#DC').val();
    $.ajax({
        url:WebURL+'/stores-get',
            type:'POST',
            data:{token,DC},
            dataType: 'text',
            cache: false,
            success: function (data) {
                // console.log(data);
                $('#store').html(data);
            },
            error: function () {
                console.log('error');
            }
    })


    });

    $('#submit').on('click',function(){

        var DC = $('#DC').val();
        var Location_ID = $('#store').val();
        var date = $('#logdate').val()
        var time = $('#logtime').val()
        var TimeLog = date + " " + time;
        var type = $('#logtype').val();
        var reason = $('#reason').val();
        var error = false;
        var Location =  $("#store option:selected").html();

        console.log(Location);
        if(DC==0)
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a DC",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }

        else if (Location_ID == 0)
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a store",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }
        else if (date=="")
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a date",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }
        else if (time=="")
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a time",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }
        else if (reason=="")
        {
            error = true;
            swal({
                title: "Error",
                text: "Please input a reason",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }


        if(error == false)
        {
            swal({
                title: "Are you sure?",
                text: "Filling a logsheet " + (type==1 ? 'IN' : 'OUT') ,
                icon: "warning",
                buttons: {
                    confirm : {text:'Submit',className:'bg-primary'},
                    cancel : 'No'
                },
                dangerMode: true,
              })
              .then((ok) => {
                if (ok) {
                    $('#load').show();
                    $('#submit').hide();
                    $('#close').prop('disabled', true)
                    $.ajax({
                        url:WebURL+'/logsheet-save',
                            type:'POST',
                            data:{DC,Location_ID,TimeLog,type,reason,Location},
                            dataType: 'json',
                            cache: false,
                            success: function (data) {
                                if(data.num>=0)
                                {
                                    $.post(WebURL + '/logsheet-email',{type:type,Location:Location,reason:reason,TimeLog:TimeLog})
                                    $('#load').hide();
                                    $('#close').prop('disabled', false)
                                    swal({
                                        title: "Success!",
                                        text: data.msg,
                                        icon: "success",
                                        timer: 3000,
                                        buttons: false
                                      });
                                     console.log('success');
                                     $('#modalLogsheet').modal('hide');
                                     tbl_logsheet.ajax.reload()
                                }

                                else
                                {
                                    $('#load').hide();
                                    $('#close').prop('disabled', false)
                                    swal({
                                        title: "Warning!",
                                        text: data.msg,
                                        icon: "warning",
                                      });
                                     console.log('warning');
                                     $('#modalLogsheet').modal('hide');
                                }


                            },
                            error: function () {
                                console.log('error');
                            }
                    })
                }
              });
        }

    });

    $('#update').on('click',function(){

        var id = $('#LogID').val();
        var DC = $('#DC').val();
        var Location_ID = $('#store').val();
        var date = $('#logdate').val()
        var time = $('#logtime').val()
        var TimeLog = date + " " + time;
        var type = $('#logtype').val();
        var reason = $('#reason').val();
        var error = false;

        if(DC==0)
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a DC",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }

        else if (Location_ID == 0)
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a store",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }
        else if (date=="")
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a date",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }
        else if (time=="")
        {
            error = true;
            swal({
                title: "Error",
                text: "Please select a time",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }
        else if (reason=="")
        {
            error = true;
            swal({
                title: "Error",
                text: "Please input a reason",
                icon: "warning",
                timer: 2000,
                buttons: false
              });
        }


        if(error == false)
        {
            swal({
                title: "Are you sure?",
                text: "Updating the filled logsheet",
                icon: "warning",
                buttons: {
                    confirm : {text:'Submit',className:'bg-primary'},
                    cancel : 'No'
                },
                dangerMode: true,
              })
              .then((ok) => {
                if (ok) {

                    $.ajax({
                        url:WebURL+'/logsheet-update',
                            type:'POST',
                            data:{id,DC,Location_ID,TimeLog,type,reason},
                            dataType: 'json',
                            cache: false,
                            success: function (data) {
                                if(data.num>=0)
                                {
                                    swal({
                                        title: "Success!",
                                        text: data.msg,
                                        icon: "success",
                                        timer: 3000,
                                        buttons: false
                                      });
                                     console.log('success');
                                     $('#modalLogsheet').modal('hide');
                                     tbl_logsheet.ajax.reload()
                                }

                                else
                                {
                                    swal({
                                        title: "Warning!",
                                        text: data.msg,
                                        icon: "warning",
                                      });
                                     console.log('warning');
                                     $('#modalLogsheet').modal('hide');
                                }


                            },
                            error: function () {
                                console.log('error');
                            }
                    })
                }
              });
        }

    });

    $('body').on('click','.photo',function(e){
        var data = tbl_logsheet.row( $(this).parents('tr') ).data();

        console.log(data);
        var img = data.IoR
        $('#pic').html('<img src="'+img+'"  width="400" height="500"/ class = "center">');

        $('#modalPic').modal('show');
    })


});
