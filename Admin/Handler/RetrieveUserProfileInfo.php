<?php
include('../../Database/db_connect.php');
include('../../Session/AdminSessionChecker.php');

$user_id = $_GET['user_id'];

$query = "SELECT account.*, COUNT(user_post.post_id) AS total_post FROM user_accounts.accounts as account 
        LEFT JOIN contents.user_post as user_post 
        ON account.account_id = user_post.account_id 
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
}

header('Content-Type: Application/Json');
echo json_encode([
    'user_display_name' => $display_name,
    'user_fullname' => $fullname,
    'user_total_post' => $total_post,
    'user_profile_color' => $profilePic,
])

?>