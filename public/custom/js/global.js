$('document').ready(function () {

    var activityTimeout = setTimeout(inActive, SESSION_LIFETIME);
    function resetActive(){
        clearTimeout(activityTimeout);
        activityTimeout = setTimeout(inActive, SESSION_LIFETIME);
    }

    function inActive()
    {
        alert("Session already expired. Please login again!.");
        window.location = LOGOUT_URL;
    }

    $(document).bind('mousemove keyup click keypress blur change scroll',function(){
        resetActive();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




});
