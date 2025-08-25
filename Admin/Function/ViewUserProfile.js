$('#users_container').on('click', '#profile', function() {
    $user_id = $(this).closest('.user-data').data('user-id')
    $('#user_profile_record').removeClass('d-none').addClass('d-flex')
    $('#user_mute').removeClass('d-block').addClass('d-none');

    $.ajax({
        url: '../Admin/Handler/RetrieveUserProfileInfo.php',
        dataType: 'Json',
        type: 'GET',
        data: {
            user_id: $user_id
        },
        success: function(response){
            $('#profile_color').css("background-color", response.user_profile_color)
            $('#profile_full_name').html(response.user_fullname)
            $('#profile_display_name').html(response.user_display_name)
            $('#profile_total_post span').html(response.user_total_post)
            $('#profile_total_comment span').html(response.user_total_comment)
            $('#profile_total_message span').html(response.user_total_chat)
            $('#profile_total_like span').html(response.user_total_like)
        },
        error: function(xhr){
            console.log('stats ' + xhr.status)
            console.log('failed')
        }
    })
})
