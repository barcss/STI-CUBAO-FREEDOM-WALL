<?php
include('../../Database/db_connect.php');
$post_id = $_POST['post_id'];
$show = 0;
$query = 'UPDATE user_post SET is_hidden = ? WHERE post_id = ?';
$stmt = mysqli_prepare($conn_contents, $query);
mysqli_stmt_bind_param($stmt, 'ii',$hide,$post_id );
echo mysqli_stmt_execute($stmt) ? 'siccess' : 'failed';

?>