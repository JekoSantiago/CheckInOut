$(document).ready(function() {


    Webcam.set({
        width: 400,
        height: 400,
        image_format: 'jpeg',
        jpeg_quality: 100,
    });

    Webcam.attach( '#my_camera' );

    navigator.geolocation.getCurrentPosition(allowCallback, deniedCallBack)

    function allowCallback(position)
    {
        $('#lat').val(position.coords.latitude);
        $('#long').val(position.coords.longitude);


    }

    function deniedCallBack(error)
    {
        switch(error.code)
        {
            case error.PERMISSION_DENIED:
                $('#lat').val("");
                $('#long').val("");
            break;
            case error.POSITION_UNAVAILABLE:
                $('#lat').val("");
                $('#long').val("");
            break;
            case error.TIMEOUT:
                $('#lat').val("");
                $('#long').val("");
            break;
            case error.UNKNOWN_ERROR:
                $('#lat').val("");
                $('#long').val("");
            break;
        }
    }

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            $('#modalSelfie').modal('show');
            $('#pic').html('<img src="'+data_uri+'"  width="400" height="500"/ class = "center">');

        } );
    }

    $('#snap').on('click',function(){
        take_snapshot();
    })

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



    $("#modalSelfie").on('shown.bs.modal', function () {

        $('#store').select2({
            dropdownParent: $('#modalSelfie'),
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
        var image = $(".image-tag").val();
        var Location_ID = $('#store').val();
        var long = $('#long').val();
        var lat = $('#lat').val();
        var logtype = $('#logtype').val();
        var Location =  $("#store option:selected").html();
        var error = false;

        if (Location_ID == 0)
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

        if(error == false)
        {
            swal({
                title: "Are you sure?",
                text: "Submitting a Selfie for Check " + (logtype==1 ? 'IN' : 'OUT') ,
                icon: "warning",
                //buttons: ["No", "Submit"],
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

                    $.post(WebURL + '/selfie-email',{logtype:logtype,Location:Location})
                    $.ajax({
                        url:WebURL+'/selfie-save',
                            type:'POST',
                            data:{image,Location_ID,long,lat,logtype,Location},
                            dataType: 'json',
                            cache: false,
                            success: function (data) {
                                if(data.num>=0)
                                {
                                    $('#close').prop('disabled', false)
                                    $('#load').hide();
                                    $('#submit').show();
                                    swal({
                                        title: data.msg,
                                        text: (logtype==1 ? "Don't forget to Check Out!" : 'Have a safe travel!'),
                                        icon: "success",
                                        timer: 3000,
                                        buttons: false
                                      });
                                     console.log('success');
                                     $('#modalSelfie').modal('hide');
                                }

                                else
                                {
                                    $('#close').prop('disabled', false)
                                    $('#load').hide();
                                    $('#submit').show();
                                    swal({
                                        title: 'Warning!',
                                        text: data.ms,
                                        icon: "warning",
                                      });
                                     console.log('warning');
                                     $('#modalSelfie').modal('hide');
                                }


                            },
                            error: function () {
                                console.log('error');
                            }
                    })
                }
              });
        }

   })



});
