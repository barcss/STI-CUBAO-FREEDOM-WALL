$(document).ready(function() {
    function fetchPosts() {
        $.ajax({
            url: '../User/Handler/CulArt_Retrieve_Post.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#post_container').html(response.post);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching posts:', error);
            }
        });
    }

    fetchPosts();
})