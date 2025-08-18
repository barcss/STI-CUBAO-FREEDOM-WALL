<?php 
include("../../User/Handler/Post_Data_Retriever.php");
require '../../Database/db_connect.php';
session_start();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;
$defaultHiddenValue = 0;

$htmlContent = '';
$account_id = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : 0;
$rowCount = 0;

$query = 'SELECT * FROM user_post WHERE is_hidden = ? AND account_id = ? ORDER BY post_id DESC LIMIT ?, ?';
$stmt = mysqli_prepare($conn_contents, $query);
mysqli_stmt_bind_param($stmt, 'iiii', $defaultHiddenValue, $account_id, $offset, $limit);

mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    $rowCount++;
    switch ($row['post_chanel']) {
        case 'random_message':
            $postColor = '#38b6ff';
            $textColor = '#f1f1f1ff';
            $chanel = '#Random-Message';
            break;
        case 'rants':
            $postColor = '#ffc107';
            $textColor = '#1b1b1bff';
            $chanel = '#Rants';
            break;
        case 'confession':
            $postColor = '#dc3545';
            $textColor = '#f1f1f1ff';
            $chanel = '#Confession';
            break;
        case 'questions':
            $postColor = '#0d6efd';
            $textColor = '#f1f1f1ff';
            $chanel = '#Questions';
            break;
        case 'lf_classmates':
            $postColor = '#198754';
            $textColor = '#f1f1f1ff';
            $chanel = '#Looking-For';
            break;
        case 'lost_and_found':
            $postColor = '#212529';
            $textColor = '#f1f1f1ff';
            $chanel = '#Lost-And-Found';
            break;
        case 'Programming_App':
            $postColor = '#e8e100ff';
            $textColor = '#0a0a0aff';
            $chanel = '#Programming-App';
            break;
        case 'art_gallery':
            $postColor = '#e8e100ff';
            $textColor = '#0a0a0aff';
            $chanel = '#Art-Gallery';
            break;
        case 'culinary_art':
            $postColor = '#e8e100ff';
            $textColor = '#0a0a0aff';
            $chanel = '#Culinary-Art';
            break;
        default:
            $postColor = '#38b6ff';
            $textColor = '#f1f1f1ff';
            $chanel = '#Random-Message';

            break;
    }
    
    $htmlContent .= '
    <div data-post-id="' . $row['post_id'] . '" class="user_post bg-light rounded-2 shadow-sm border my-2 p-0 col-12 col-lg-9 d-flex flex-column overflow-hidden container flex-shrink-0">
        <div id="PostCard_Header" class="bg-light m-0 align-items-center d-flex justify-content-between p-2">
            <p class="m-0 primary-fs">' . getUserDisplayName($row["account_id"]) . '</p>

            <div class="d-flex gap-3 p-0 align-items-center justify-content-center">
                <p class="m-0 primary-fs">' . $row['post_date'] . '</p>
                <button class="p-0 m-0 bg-transparent border-0 primary-fs text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-'. $row['post_id'].'" >delete</button>
                
                <div class="modal fade" id="deleteModal-'. $row['post_id'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                  
                    <div class="modal-body">
                        Delete this post?
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button id="delete_post_btn" type="button" class="delete_post_btn btn btn-primary" >Yes</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div id="PostCard_Body" style="background-color: ' . $postColor . '">
            <p class="text-start m-2 mb-0" style="font-size:12px; color:'. $textColor .'">'. $chanel .'</p>
            <div class="p-5">
                
                <p class="text-center mb-5 mt-3" style="color: ' . $textColor . '">' . nl2br($row['post_content']) . '</p>
            </div>
        </div>

        <div id="PostCard_ActionBar" class="rounded bg-white d-flex justify-content-between p-2">';

        if (checkUserLikePost($row['post_id'], $account_id)) {
            $htmlContent .= '<p style="cursor: default" class="disabled-like primary-fs m-0 like_post" data-post-id="' . $row['post_id'] .  '">
                Likes <span class="primary-fs rounded text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . getPostLike($row['post_id']) .  '</span>
            </p>';
        } else {
            $htmlContent .= '<p style="cursor: pointer" class="m-0 like_post primary-fs" data-post-id="' . $row['post_id'] . '">
                Likes <span class="primary-fs rounded text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . getPostLike($row['post_id']) .  '</span>
            </p>';
        }

        $htmlContent .= '<p id="comment_post" style="cursor: pointer" class="primary-fs m-0 comment_post" data-bs-toggle="modal" data-bs-target="#commentSectionModal-id-'.$row['post_id'].'"> 
            Comment <span class="rounded primary-fs text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . (getPostCommentCount($row['post_id']) + getPostReplyCount($row['post_id'])) . '</p>

                <div id="commentSectionModal-id-'. $row['post_id'] .'" aria-hidden="false" class="modal fade" tabindex="-1"  >
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
                            <input type="hidden" name="post_id" value="'. $row["post_id"] .'">
                            <input id="comment_input"   class=" comment-input-box w-100 m-0 rounded primary-fs border-0 bg-light shadow-sm" placeholder="Comment as ' . getUserDisplayName($account_id) . '" autocomplete="off">
                            <button id="comment_submit" class="btn primary-color text-white rounded shadow-sm m-1"  type="submit">Send</button>
                        </form>
                        
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
 
    ';
}

header('Content-Type: application/json');
echo json_encode([
    'html' => $htmlContent,
    'count' => $rowCount
]);

?>

 