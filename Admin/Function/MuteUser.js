$("#users_container").on("click", "#mute", function () {
  $user_id = $(this).closest(".user-data").data("user-id");
  $("#user_mute").removeClass("d-none").addClass("d-block");
  $("#user_profile_record").removeClass("d-flex").addClass("d-none");
  $.ajax({
    url: "../Admin/Handler/MuteUser.php",
    dataType: "Json",
    type: "GET",
    data: {
      account_id: $user_id,
    },
    success: function (response) {
      console.log(response);
      if (response.is_muted) {
        $("#user_status span").html("Muted");
      } else {
        $("#user_status span").html("Active");
      }
    },
    error: function (xhr) {
      console.log("mute user " + xhr.status);
      console.log("failed");
    },
  });

  $.ajax({
    url: "../Admin/Handler/RetrieveUserProfileInfo.php",
    dataType: "Json",
    type: "GET",
    data: {
      user_id: $user_id,
    },
    success: function (response) {
      $("#profile_color").css("background-color", response.user_profile_color);
      $("#profile_full_name").html(response.user_fullname);
      $("#profile_display_name").html(response.user_display_name);
    },
    error: function (xhr) {
      console.log("stats " + xhr.status);
      console.log("failed");
    },
  });

  $("#user_mute").on("click", "#mute_user_btn", function () {
    console.log("mute user button clicked");
    console.log($user_id);
    $.ajax({
      url: "../Admin/Handler/UserManagement_MuteStatusUpdate.php",
      dataType: "Json",
      type: "POST",
      data: {
        account_id: $user_id,
        status: 1,
      },
      success: function (response) {
        if (response.success) {
          $("#user_status span").html("Muted");
        }
      },
      error: function (xhr) {
        console.log("toggle mute user " + xhr.status);
        console.log("failed");
      },
      comlete: function () {
        $("#user_status span").html("Muted");
      }
    });
  });

  $("#user_mute").on("click", "#unmute_user_btn", function () {
    console.log("mute user button clicked");
    console.log($user_id);
    $.ajax({
      url: "../Admin/Handler/UserManagement_MuteStatusUpdate.php",
      dataType: "Json",
      type: "POST",
      data: {
        account_id: $user_id,
        status: 0,
      },
      success: function (response) {
        if (response.success) {
          $("#user_status span").html("Active");
        }
      },
      error: function (xhr) {
        console.log("toggle mute user " + xhr.status);
        console.log("failed");
      },
      comlete: function () {
                 $("#user_status span").html("Active");

      }
    });
  });
});
