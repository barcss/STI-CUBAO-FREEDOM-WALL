<?php
session_start();
include("../../Database/db_connect.php");
$false = 0;

$query = "SELECT * FROM user_post WHERE photo_path IS NOT NULL AND is_hidden = ? ORDER BY post_id DESC";
$stmt = mysqli_prepare($conn_contents, $query);
mysqli_stmt_bind_param($stmt, "i", $false);
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
                <p class="text-start m-0 primary-fs ps-1">'. $row['post_content'] .'</p>
            </div>
            <div id="img-container" data-bs-toggle="modal" data-bs-target="#view-img-modal-'. $row['post_id'] .'" class="w-100 d-flex justify-content-center">
                <img id="img-preview" src="'. $row['photo_path'] .'" class="w-100 h-100" style="object-fit: cover; object-position: center center; max-height: 30vh; cursor: pointer; " />
            </div>
        </div>
        <div id="PostCard_ActionBar" class="rounded bg-white d-flex justify-content-between p-2">
            <p style="cursor: pointer" class="m-0 like_post primary-fs" data-post-id="' . $row['post_id'] . '">
                Likes <span class="primary-fs rounded text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">2</span>
            </p>
            <p id="comment_post" style="cursor: pointer" class="primary-fs m-0 comment_post" data-bs-toggle="modal" data-bs-target="#commentSectionModal-id-' . $row['post_id'] . '"> Comment
                <span class="rounded primary-fs text-white poppins-medium primary-color p-1" style="height:10px; width:10px;"> 4
            </p>
        </div>
    </div>

    <div style="backdrop-filter: blur(5px)" class="modal fade" id="view-img-modal-'. $row['post_id'] .'" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center align-items-center flex-shrink-0" style="max-width: 90vw; max-height: 90vh;">
            <div class="modal-content w-auto">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div >
                    <img style="max-width: 90vw; max-height: 90vh" src="'.$row['photo_path'].'" />
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