<?php
session_start();
include("../../User/Handler/Post_Data_Retriever.php");
include("../../Database/db_connect.php");

$false = 0;
$post_chanel = 'culinary_art';
$account_id = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : die('Account ID not set');

$query = "SELECT * FROM user_post WHERE photo_path IS NOT NULL AND is_hidden = ? AND post_chanel = ? ORDER BY post_id DESC";
$stmt = mysqli_prepare($conn_contents, $query);
mysqli_stmt_bind_param($stmt, "is", $false, $post_chanel);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$postContent = '';

while ($row = mysqli_fetch_assoc($result)){
    $postContent .= '
    <div data-post-id="' . $row['post_id'] . '" class="user_post rounded-2 shadow-sm border my-2 p-0 col-12 col-lg-9 d-flex flex-column overflow-hidden container flex-shrink-0">
        <div id="PostCard_Header" class="bg-white m-0 d-flex justify-content-between p-2">
            <p class="m-0 primary-fs"> Anonymous Poster </p>
            <p class="m-0 primary-fs">' . $row['post_date'] . '</p>
        </div>

        <div id="PostCard_Body">
            <div class="p-1 bg-white border shadow-sm">
                <p class="text-start m-0 primary-fs ps-1">' . $row['post_content'] . '</p>
            </div>
            <div id="img-container" data-bs-toggle="modal" data-bs-target="#view-img-modal-' . $row['post_id'] . '" class="w-100 d-flex justify-content-center">
                <img loading="lazy" id="img-preview" src="' . $row['photo_path'] . '" class="w-100 h-100" style="object-fit: cover; object-position: center center; max-height: 30vh; cursor: pointer; " />
            </div>
        </div>
        <div id="PostCard_ActionBar" class="rounded bg-white d-flex justify-content-between p-2">';

        if (checkUserLikePost($row['post_id'], $account_id)) {
            $postContent .= 
            '<p style="cursor: default" class="disabled-like primary-fs m-0 like_post" data-post-id="' . $row['post_id'] .  '">
                Likes <span class="primary-fs rounded text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . getPostLike($row['post_id']) .  '</span>
            </p>';
        } else {

            $postContent .= 
            '<p style="cursor: pointer" class="m-0 like_post primary-fs" data-post-id="' . $row['post_id'] . '">
                Likes <span class="primary-fs rounded text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . getPostLike($row['post_id']) .  '</span>
            </p>';
        }

        $postContent .= '
            <p id="comment_post" style="cursor: pointer" class="primary-fs m-0 comment_post" data-bs-toggle="modal" data-bs-target="#commentSectionModal-id-' . $row['post_id'] . '"> Comment 
            <span class="rounded primary-fs text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . (getPostCommentCount($row['post_id']) + getPostReplyCount($row['post_id'])) . '</span></p>
            <div id="commentSectionModal-id-' . $row['post_id'] . '"  class="modal fade" tabindex="-1"  >
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-lg-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Comment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="comment-section">
                            <p id="loading-comments">Loading comments</p>
                            </div>
                        </div>
                        <div class="">
                            <form id="comment_form" class="d-flex justify-content-between p-2" >
                                <input type="hidden" name="post_id" value="' . $row["post_id"] . '">
                                <input id="comment_input"   class=" comment-input-box w-100 m-0 rounded primary-fs border-0 bg-light shadow-sm" placeholder="Comment as ' . getUserDisplayName($account_id) . '" autocomplete="off">
                                <button id="comment_submit" class="btn primary-color text-white rounded shadow-sm m-1"  type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div style="backdrop-filter: blur(5px)" class="modal fade" id="view-img-modal-' . $row['post_id'] . '" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center align-items-center flex-shrink-0" style="max-width: 90vw; max-height: 90vh;">
            <div class="modal-content w-auto">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div >
                    <img loading="lazy" style="max-width: 90vw; max-height: 90vh" src="' . $row['photo_path'] . '" />
                </div>
            </div>
        </div>
    </div>
    ';
}



header('Content-Type: application/json');
echo json_encode([
    'post' => $postContent,
]);
?>