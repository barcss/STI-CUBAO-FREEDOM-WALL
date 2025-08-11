<?php 
include('../User/Components/UserMetaData.php');

?>

<body class="poppins-regular">
    <div class="container-fluid vh-100 d-flex p-0 m-0 row">

        <div class="col-0 col-lg-3 d-none d-lg-flex flex-column bg-white p-2 overflow-scroll">
            <div class="d-flex align-content-center align-items-center p-0 mb-3">
                <p class="m-0 primary-text poppins-medium fw-bold">STI CUBAO FREEDOM WALL</p>
                <small class="fw-bold opacity-50 ms-2 m-0 fst-italic text-dark" style="font-size: 7px;">Beta v.2.3</small>
            </div>
            <div class="p-1 ">
                <button id="userDashboard" class="w-100 btn text-white text-start p-1 primary-color"><i class="bi bi-person-circle mx-2 text-white"></i>User Dashboard</button>
            </div>
        
            <!-- <div class=" bg-light overflow-hidden shadow-sm rounded d-flex flex-column align-items-center mt-3">
                <div id="filter_btn_container" class="p-0 w-100 primary-fs">
                    <button value="user_management" class="p-2 bg-white w-100 rounded border text-start"><span class="primary-color p-1 me-2"></span>User Management</button>
                    <button value="content_management" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-primary p-1 me-2"></span>Content Management</button>
                    <button value="content_approval" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-success p-1 me-2"></span>Content Approval</button>
                    <button value="content_report" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-danger p-1 me-2"></span>Content Reports</button>
                </div>  
            </div> -->
            <span class="flex-grow-1"></span>
            <div>
                <a class="mb-5 text-decoration-none w-100 yellow-color btn shadow-sm border-1 border-black" href="../Session/Logout.php">Logout</a>
            </div>
        </div>

        <div class="col p-0 bg-light p-3 d-flex container m-0 row align-items-center flex-column overflow-scroll vh-100" id="content_container">
            <div class="bg-white     rounded-2 shadow-sm border primary-fs col-12 col-sm-9 p-0 mt-2 d-flex border border-info">
                <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Share art works
                </button>

                <form action="#" method="POST">
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content  bg-light">
                                <div class="modal-body d-flex flex-column">
                                    <div class="d-flex justify-content-between mb-2 p-0 align-items-center">
                                        <p class="m-0 col-4">Create a post</p>
                                        <select name="post_chanel" class="col-8 w-auto m-0 form-select form-select-sm">
                                            <option value="random_message">Random Message</option>
                                            <option value="rants">Rants</option>
                                            <option value="confession">Confession</option>
                                            <option value="questions">Questions</option>
                                            <option value="lf_classmates">Looking For</option>
                                            <option value="lost_and_found">Lost and Found</option>
                                        </select>
                                    </div>
                                    <div>
                                        <textarea name="post_content" class="bg-white w-100 shadow-sm p-1 border-0 rounded" rows="5" placeholder="Say something, <?php echo $_SESSION['display_name'] ?>... "></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer p-1">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="sumbit_post" class="btn btn-primary">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div data-post-id="' . $row['post_id'] . '" class="user_post rounded-2 shadow-sm border my-2 p-0 col-12 col-lg-9 d-flex flex-column overflow-hidden container flex-shrink-0">
        <div id="PostCard_Header" class="bg-white m-0 d-flex justify-content-between p-2">
            <p class="m-0 primary-fs" > Anonymous Poster </p>
            <p class="m-0 primary-fs">' . $row['post_date'] . '</p>
        </div>

        <div id="PostCard_Body" style="background-color: ' . $postColor . '">
            <p class="text-start m-2 mb-0" style="font-size:12px; color:'. $textColor .'">'. $chanel .'</p>
            <div class="p-5">
                
                <p class="text-center mb-5 mt-3" style="color: ' . $textColor . '">' . nl2br($row['post_content']) . '</p>
            </div>
        </div>
        <div id="PostCard_ActionBar" class="rounded bg-white d-flex justify-content-between p-2">';

        if (checkUserLikePost($row['post_id'], $account_id)) {
            $htmlContent .= 
            '<p style="cursor: default" class="disabled-like primary-fs m-0 like_post" data-post-id="' . $row['post_id'] .  '">
                Likes <span class="primary-fs rounded text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . getPostLike($row['post_id']) .  '</span>
            </p>';
        } else {
            $htmlContent .= 
            '<p style="cursor: pointer" class="m-0 like_post primary-fs" data-post-id="' . $row['post_id'] . '">
                Likes <span class="primary-fs rounded text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . getPostLike($row['post_id']) .  '</span>
            </p>';
        }

        $htmlContent .= 
            '<p id="comment_post" style="cursor: pointer" class="primary-fs m-0 comment_post" data-bs-toggle="modal" data-bs-target="#commentSectionModal-id-' . $row['post_id'] . '"> Comment 
            <span class="rounded primary-fs text-white poppins-medium primary-color p-1" style="height:10px; width:10px;">' . (getPostCommentCount($row['post_id']) + getPostReplyCount($row['post_id'])) . '</p>

        </div> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="../Admin/Function/ContainerContentChanger.js"></script>
    <script src="../Admin/Function/FetchUsers.js"></script>
    <script src="../Admin/Function/ViewUserProfile.js"></script>

    <script>
        $('#userDashboard').on('click', ()=>{
            window.location.href = "../User/UserDashboard.php"
        })
    </script>
</body>
</html>