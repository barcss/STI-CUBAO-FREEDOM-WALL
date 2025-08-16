<?php
function getPostLike($post_id)
{
    require '../../Database/db_connect.php';
    $query = 'SELECT COUNT(*) AS total_likes FROM like_post WHERE post_id = ?';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total_likes);
    mysqli_stmt_fetch($stmt);
    return $total_likes;
}

function getPostCommentCount($post_id)
{
    require '../../Database/db_connect.php';
    $query = 'SELECT COUNT(*) AS total_comment FROM comment_post WHERE post_id = ?';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $comment_post);
    mysqli_stmt_fetch($stmt);
    return $comment_post;
}

function getPostReplyCount($post_id)
{
    require '../../Database/db_connect.php';
    $query = 'SELECT COUNT(*) AS total_reply FROM reply_comment_post WHERE post_id = ?';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total_reply);
    mysqli_stmt_fetch($stmt);
    return $total_reply;
}

function getUserDisplayName($account_id)
{
    require '../../Database/db_connect.php';
    $query = 'SELECT display_name FROM accounts WHERE account_id = ?';
    $stmt = mysqli_prepare($conn_accounts, $query);
    mysqli_stmt_bind_param($stmt, 'i', $account_id);
    mysqli_execute($stmt);
    $posterDisplayName = 'unknown';

    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $posterDisplayName = $row['display_name'];
    }

    return $posterDisplayName;
}
 

function checkUserLikePost($post_id, $account_id)
{
    require '../../Database/db_connect.php';
    $query = 'SELECT like_id FROM like_post WHERE account_id = ? AND post_id = ?';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $account_id, $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return true;
    }
    return false;
}
?>