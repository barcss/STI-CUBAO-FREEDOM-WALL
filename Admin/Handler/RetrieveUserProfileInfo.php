<?php
session_start();
include('../../Database/db_connect.php');
include('../../Session/AdminSessionChecker.php');

$user_id = $_GET['user_id'];

$query = "SELECT account.*, 
        COUNT(DISTINCT user_post.post_id) AS total_post, 
        COUNT(DISTINCT comment_post.comment_id) AS total_comment,
        COUNT(DISTINCT public_chat.chat_id) AS total_chat,
        COUNT(DISTINCT like_post.like_id) AS total_like

        FROM user_accounts.accounts as account 
        LEFT JOIN contents.like_post as like_post
        ON account.account_id = like_post.account_id
        LEFT JOIN contents.public_chat as public_chat 
        ON account.account_id = public_chat.account_id
        LEFT JOIN contents.user_post as user_post 
        ON account.account_id = user_post.account_id 
        LEFT JOIN contents.comment_post as comment_post
        ON account.account_id = comment_post.account_id
        WHERE account.account_id = ? 
        GROUP BY account.account_id
        ";
    
$stmt = mysqli_prepare($conn_accounts, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $fullname = $row['user_firstname'] . ' ' .  $row['user_lastname'];
    $profilePic = $row['profile_color'];
    $display_name = $row['display_name'];
    $total_post = $row['total_post'];
    $total_comment = $row['total_comment'];
    $total_chat = $row['total_chat'];
    $total_like = $row['total_like'];
}

header('Content-Type: Application/Json');
echo json_encode([
    'user_display_name' => $display_name,
    'user_fullname' => $fullname,
    'user_total_post' => $total_post,
    'user_profile_color' => $profilePic,
    'user_total_comment' => $total_comment,
    'user_total_chat' => $total_chat,
    'user_total_like' => $total_like
])

?>