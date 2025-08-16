$(document).ready(function() {
    function fetchPosts() {
        $.ajax({
            url: '../User/Handler/PrgApp_Retrieve_Post.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#response').html(response.post);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching posts:', error);
            }
        });
    }

    fetchPosts();
})