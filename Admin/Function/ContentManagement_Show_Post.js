$(document).ready(() => {
  $("#response").on("click", ".retrieve_post_btn", function () {
    $post_id = $(this).closest(".user_post").data("post-id");
    $.ajax({
      url: "../Admin/Handler/ContentManagement_Show_Post.php",
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
