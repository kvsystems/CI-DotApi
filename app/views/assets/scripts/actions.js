$('#singleButtonAuthorization').on('click', function () {
        $.post('/api/authorization', {
            userName: $("input[name='login']").val(),
            userPassword: $("input[name='password']").val()
        })
        .done(function(response){

            $.cookie('session', response.session,{ expires: 1 });

            $('#receivedMessage').css({"color":"green"});
            $('#receivedMessage').html(
                response.level +
                ': '
                + response.message
            );

            $( "#singleButtonAuthorization" ).hide();
            $( "#singleButtonAccess" ).hide();

            setTimeout(function() {
                window.location.href = "/dashboard";
            }, 1000);

        })
        .fail(function(response) {
            $('#receivedMessage').css({"color":"red"});
            $('#receivedMessage').html(
                response.responseJSON.level +
                ': '
                + response.responseJSON.message
            );
        });
});

$('#singleButtonLogOut').on('click', function () {
    $.post('/api/logout', {
        session: $.cookie('session')
    });
    $.removeCookie('session', { path: '/' });
    setTimeout(function() {
        window.location.href = "/dashboard";
    }, 1000);
});