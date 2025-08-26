$(document).ready(() => {
  $("#response").on("click", ".delete_post_btn", function () {
    $post_id = $(this).closest(".user_post").data("post-id");
    $.ajax({
      url: "../User/Handler/Post_Hide.php",
      type: "POST",
      data: {
        post_id: $post_id
      },
      success: function () {
        location.reload()
      },
    });
  });
});
