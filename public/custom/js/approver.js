$('document').ready(function () {


    var tbl_approval = $('#tbl_approval').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax      : {
            url: WebURL + '/approval-get',
            method: 'POST',
            data: function (data) {
                var DateFrom = $('#dateFrom').val();
                var DateTo = $('#dateTo').val();
                var Status = $('#isApproved').val();
                var Employee = $('#employeeID').val();
                data.DateFrom = DateFrom;
                data.DateTo = DateTo;
                data.Status = Status;
                data.Employee = Employee;
            },
            dataType: 'json',
        },
        columns   :[
            {render:function(data, type, row){

                var action = (row.Status==0) ? '<a href="javascript:void(0) "class="approve text-primary"><i class="material-icons">done</i></a> &nbsp; <a href="javascript:void(0) "class="decline text-danger"><i class="material-icons">block</i></a>' : ' ' ;
                return action;
            }},
            {data:"FullName"},
            {data:"Location"},
            {data:"InsertDate"},
            {data:"LogType", render:function(data, type, row){
                var type = (data == 1) ? 'IN':'OUT'
                return type;
            }},
            {data:"Time"},
            {data:"Date"},
            {data:"IoR", render:function(data, type, row){
                return (row.ModeTypeID == 3) ? '<a href="javascript:void(0) "class="photo text-primary"><i class="material-icons">photo</i></a>' : data;
            }},
            {data:"Status",render:function(data, type, row){
                if(data==0){status = 'Pending'}
                else if (data==1){status = 'Approved'}
                else if (data==2){status = 'Declined'}
                return status;
            }},
            {data:"ApprovedBy"},
            {data:"ApprovedDate"},
            {data:"Remarks"}
        ],
        language: {
            emptyTable: 'No data available.',
        },
    });

    $('body').on('click','.approve',function(e){
        var data = tbl_approval.row( $(this).parents('tr') ).data();
        console.log(data);
        var ID = data['ID'];
        var Employee = data['Employee_ID'];
        var Location = data['Location_ID'];
        var Mode = data['ModeTypeID'];
        var LogTime = data['Date'] + ' ' + data['Time'];
        var Type = data['LogType'];
        var Status = 1;
        var LocationName =  data['Location'];
        var FullName = data['FullName']

        var s1 = "Approving the "
        var s2  = (Mode == 3) ? "Selfie" : "Manual Log"
        var title = s1.concat(s2);
        swal({
            title: "Enter your PIN" ,
            icon: "warning",
            content: {
                element: "input",
                attributes: {
                  placeholder: "****",
                  type: "password"
                }},
            button: {
                    text: "Submit",
                    closeModal: false,
                  },
            dangerMode: true,
          }).then((PIN) => {
            if (PIN)
            {
                $.post(WebURL + '/pin-check',{PIN:PIN},function(data){
                    if(data == 1)
                    {
                        swal({
                            title: title ,
                            text: FullName,
                            icon: "warning",
                            content: {
                                element: "input",
                                attributes: {
                                  placeholder: "Input Remarks",
                                }},
                            button: {
                                    text: "Submit",
                                    closeModal: false,
                            },
                            dangerMode: true,
                        }).then((remarks) => {
                            if (remarks)
                            {
                                $.ajax({
                                    url:WebURL+'/approve',
                                        type:'POST',
                                        data:{ID,Employee,Location,Mode,LogTime,Type,remarks,Status},
                                        dataType: 'json',
                                        cache: false,
                                        success: function (data) {
                                            if(data.num>=0)
                                            {
                                                swal({
                                                    title: data.msg,
                                                    icon: "success",
                                                    text: " ",
                                                    timer: 3000,
                                                    buttons: false
                                                  });
                                                console.log('success');
                                                tbl_approval.ajax.reload();
                                            }

                                            else
                                            {
                                                swal({
                                                    title: 'Warning!',
                                                    text: data.msg,
                                                    icon: "warning",
                                                  });
                                                 console.log('warning');

                                            }


                                        },
                                        error: function () {
                                            console.log('error');
                                        }
                                })
                            }
                            else
                            {
                                swal("Warning!", "Please input a remark", "warning");
                            }
                        })
                    }
                    else
                    {
                        swal({
                            title: "Warning!",
                            text: "Wrong PIN",
                            icon: "warning",
                            confirmButtonText: "Ok",
                            confirmButtonColor: '#3085d6',
                            allowOutsideClick: false,
                        });
                    }

                })
            }
            else
            {
                swal("Warning!", "Please input pin", "warning");
            }
        })
    })

    $('body').on('click','.decline',function(e){
        var data = tbl_approval.row( $(this).parents('tr') ).data();
        console.log(data);
        var ID = data['ID'];
        var Employee = data['Employee_ID'];
        var Location = data['Location_ID'];
        var Mode = data['ModeTypeID'];
        var LogTime = data['Date'] + ' ' + data['Time'];
        var Type = data['LogType'];
        var FullName = data['FullName'];
        var Status = 2;

        var s1 = "Declining the "
        var s2  = (Mode == 3) ? "Selfie" : "Manual Log"
        var title = s1.concat(s2);
        swal({
            title: "Enter your PIN" ,
            icon: "warning",
            content: {
                element: "input",
                attributes: {
                  placeholder: "****",
                  type: "password"
                }},
            button: {
                    text: "Submit",
                    closeModal: false,
                  },
            dangerMode: true,
          }).then((PIN) => {
            if (PIN)
            {
                $.post(WebURL + '/pin-check',{PIN:PIN},function(data){
                    if(data == 1)
                    {
                        swal({
                            title: title ,
                            text: FullName,
                            icon: "warning",
                            content: {
                                element: "input",
                                attributes: {
                                  placeholder: "Input Remarks",
                                }},
                            button: {
                                    text: "Submit",
                                    closeModal: false,
                            },
                            dangerMode: true,
                        }).then((remarks) => {
                            if (remarks)
                            {
                                $.ajax({
                                    url:WebURL+'/approve',
                                        type:'POST',
                                        data:{ID,Employee,Location,Mode,LogTime,Type,remarks,Status},
                                        dataType: 'json',
                                        cache: false,
                                        success: function (data) {
                                            if(data.num>=0)
                                            {
                                                swal({
                                                    title: data.msg,
                                                    icon: "success",
                                                    text: " ",
                                                    timer: 3000,
                                                    buttons: false
                                                  });
                                                console.log('success');
                                                tbl_approval.ajax.reload();
                                            }

                                            else
                                            {
                                                swal({
                                                    title: 'Warning!',
                                                    text: data.msg,
                                                    icon: "warning",
                                                  });
                                                 console.log('warning');

                                            }


                                        },
                                        error: function () {
                                            console.log('error');
                                        }
                                })
                            }
                            else
                            {
                                swal("Warning!", "Please input a remark", "warning");
                            }
                        })
                    }
                    else
                    {
                        swal({
                            title: "Warning!",
                            text: "Wrong PIN",
                            icon: "warning",
                            confirmButtonText: "Ok",
                            confirmButtonColor: '#3085d6',
                            allowOutsideClick: false,
                        });
                    }

                })
            }
            else
            {
                swal("Warning!", "Please input pin", "warning");
            }
        })
    })


    $('body').on('click','.photo',function(e){
        var data = tbl_approval.row( $(this).parents('tr') ).data();

        console.log(data);
        var img = data.IoR
        $('#pic').html('<img src="'+img+'"  width="400" height="500"/ class = "center">');

        $('#modalApprove').modal('show');
    })

















});
