$(document).ready(function () {

    const FOLLOWER_STATE = "Follow this user" ;

    $('#btn-ajax').click(function () {
        $.ajax({
            method: 'POST',
            url: '/user/'+$(this).data('user'),

            data: 'user='+$(this).data('user')

        }).done(function (jqXHR) {
            /*var user = response.user;*/
            console.log(jqXHR);
            if(jqXHR) {
                $('#btn-ajax').text('followed');

                $('#btn-ajax').addClass('btn btn-success');
            } else {
                $('#btn-ajax').text(FOLLOWER_STATE);
                $('#btn-ajax').removeClass('btn btn-success');
                $('#btn-ajax').addClass('btn btn-default');
            }

        });
    });

});