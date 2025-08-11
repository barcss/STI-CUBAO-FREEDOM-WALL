<?php
include('../../Database/db_connect.php');
session_start();

$post_id = $_GET['post_id'];
$account_id = $_SESSION['account_id'];
$is_active = 1;
$user_comment = '';

$query = 'SELECT * FROM comment_post WHERE post_id = ? AND is_active = ? ORDER BY comment_id DESC' ;
$stmt = mysqli_prepare($conn_contents, $query);
mysqli_stmt_bind_param($stmt, 'ii', $post_id, $is_active);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    if ((bool) $row['is_active']) {
        $accountDetails = getUserDetails($row['account_id']);

        $user_comment .= '
        <div class="d-flex flex-column w-100 mb-3 ">
            <div class="d-flex flex-column align-items-start w-100">
                <div class="user-comment w-100 d-flex align-items-end justify-content-start " >
                    <div style="background-color:' . $accountDetails['profile_color'] .';height: 15px; width: 15px;" class="rounded-circle me-2  flex-shrink-0"></div>
                    <div class="d-flex flex-column overflow-hidden w-100 text-wrap align-items-start justify-content-end " >
                        <p class=" m-0 text-start" style="font-size: 10px"> '. $accountDetails['display_name'] .' </p>
                        <p class="gray-color text-start m-0 rounded-2 primary-fs p-2 text-dark-subtle text-wrap" style=" max-width: 90%; overflow-wrap: break-word;" >'. $row['comment_content'] .'</p>
                    </div>
                </div>
                <div class="d-flex ms-4 mb-0">
                    <p class="m-0" style="font-size: 10px; padding: 0px">'. $row['comment_date'].' - </p>
                    <p data-comment-id="'. $row['comment_id'].'" data-post-id="'. $row['post_id'].'" data-display-name="'. $accountDetails['display_name'] .'" class="reply-comment primary-text p-0 m-0 ms-2" style="cursor: pointer; font-size: 9px">Reply <span class="  p-1" style="height: 10px; width: 10px; font-size: 9px">'. getPostReplyCount($row['post_id'], $row['comment_id']). '</span></p> 
                </div>
            </div>
                    <div id="reply-container-'.$row['comment_id'].'" class="w-100 d-none d-flex flex-column align-items-start justify-content-start ps-4 p-2">
                    '. getPostCommentReply($row['post_id'], $row['comment_id']) .'

                    <div class="w-100 p-0">
                    <form id="reply-form-'. $row['comment_id'].'" class="d-flex w-100 justify-content-between p-2" >
                    <input type="hidden" name="post_id" value="'. $row["post_id"] .'">
                        <input  id="reply_input"  class="border primary-fs  reply_input p-1 w-100 m-0 comment-input-box rounded border-0 bg-light shadow-sm" placeholder="Comment as ' . $accountDetails['display_name'] . '" autocomplete="off">
                        <button   id="reply_submit" class="btn primary-color primary-fs text-white rounded shadow-sm m-1"  type="submit">Send</button>
                    </form>
                    </div>
                </div>';
        $user_comment .= '</div>';
    }
    
}

function getPostReplyCount($post_id ,$comment_id) {
    require '../../Database/db_connect.php';
    $query = 'SELECT COUNT(*) AS total_reply FROM reply_comment_post WHERE post_id = ? AND comment_id = ?';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $post_id, $comment_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total_reply);
    mysqli_stmt_fetch($stmt);
    return $total_reply;
}

function getPostCommentReply($post_id, $comment_id) {
    require '../../Database/db_connect.php';
    $initialActiveValue = 1;
    $reply = '';
    $rowCount = 0;

    $query = 'SELECT * FROM reply_comment_post WHERE comment_id = ? AND post_id = ? AND is_active = ?';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_bind_param($stmt, 'iii', $comment_id,$post_id,$initialActiveValue);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)) {
        $rowCount++;
        $accountDetails = getUserDetails($row['account_id']);

        $reply .= '
        <div class="d-flex flex-column w-100 mb-3 ">
            <div class="d-flex flex-column align-items-start w-100">
                <div class="user-comment w-100 d-flex align-items-end justify-content-start " >
                    <div style="background-color:' . $accountDetails['profile_color'] .';height: 15px; width: 15px;" class="rounded-circle me-2  flex-shrink-0"></div>

                    <div class="d-flex flex-column align-items-start justify-content-end" style="max-width: 90%;" >
                        <p class=" m-0 text-start " style="font-size: 10px"> '. $accountDetails['display_name'] .' </p>
                        <p class=" gray-color text-start m-0 rounded-2 p-2 text-dark-subtle" style="font-size: 12px; max-width: 100%; overflow-wrap: break-word;" >'. $row['reply_content'] .'</p>
                    </div>
                </div>
            </div>

            <div class="ms-4 p-0 d-flex">
                <p class="m-0 p-0" style="font-size: 10px; padding: 0px">'. $row['reply_date'] .'</p>
            </div>
        </div>
        ';
    }
    return $reply;
}

function getUserDetails($account_id){
    require '../../Database/db_connect.php';
    $query = 'SELECT display_name, profile_color FROM accounts WHERE account_id = ?';
    $stmt = mysqli_prepare($conn_accounts, $query);
    mysqli_stmt_bind_param($stmt, 'i', $account_id);
    mysqli_execute($stmt);
    $posterDisplayName = 'unknown';
    $profileColor = '';
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $posterDisplayName = $row['display_name'];
        $profileColor = $row['profile_color'];
    }

    return [
        'display_name' => $posterDisplayName,
        'profile_color' => $profileColor
    ];
}

header('Content-Type: application/json');
echo json_encode([
    'User_Comment' => $user_comment
])

?>
