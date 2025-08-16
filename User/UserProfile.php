<?php
include '../User/Components/UserMetaData.php';
include '../User/Handler/Post_Create.php';

$Fullname = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
 
?>
<body class="bg-light poppins-regular">
    <div class="container-fluid row m-0 p-0">
        
        <!-- FIRST COL -->
        <div id="col1" class="col-sm-12 d-none col-lg-3 d-lg-block bg-white m-0 p-0 vh-100 ">
            <div class=" d-flex flex-column vh-100">
                 
                <div style="backdrop-filter: blur(100px); background: rgba(255, 255, 255, 0.7);" class="d-block d-lg-none  border-bottom border-dark-subtle w-100 sticky-top  d-flex justify-content-between align-items-center m-0">
                <div>
                    <p class="poopins-medium text-dark fw-bold m-0 ms-3">SCFW</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="tab_content p-1 px-2 primary-color" ><i class="tab_content bi bi-file-post-fill text-white"></i></div>
                    <div class="public_chat p-1 px-2 primary-color" ><i class="bi bi-bell-fill text-white"></i></div>
                    <div class="tab_menu primary-color px-2 p-1"><i class="bi bi-person-square text-white"></i></div>

                </div>
            </div>  
                <div class="p-2 d-flex flex-column vh-100">
                <div class="d-flex align-content-center align-items-center p-0 mb-3">
                    <p class="m-0 primary-text poppins-medium fw-bold">STI CUBAO FREEDOM WALL </p>
                    <small class="fw-bold opacity-50 ms-2 m-0 fst-italic text-dark" style="font-size: 7px;">v.2</small>
                </div>

                <div id="profile" style="cursor: pointer;" class="bg-light shadow-sm rounded overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class=" text-white bi bi-caret-left-square-fill"></i></div>
                    <p  class="m-0 ms-2">Go back</p>
                </div> 

                <div class=" overflow-scroll my-4 ">
                    <div class="d-flex justify-content-center flex-column shadow-sm rounded bg-light align-items-center">
                        <p class="m-0 poppins-medium primary-fs w-100 text-start primary-color text-white p-1 ps-2">User profile</p>
                        <div class="d-flex align-items-center py-3 flex-column">
                            <div class="rounded-circle mb-3" style="background-color: <?php echo $_SESSION['profile']?> ;height:10vh; width:10vh;" ></div>
                            <p class="fw-bold fs-6 m-0"><?php echo $_SESSION['display_name'] ?></p>
                            <p class="primary-fs m-0 text-black-50"><?php echo $Fullname ?></p>
                        </div>
                    </div>
                    <button id="edit_profile" data-bs-toggle="modal" data-bs-target="#edit_profile_modal" class="btn primary-color m-0 w-100 poppins-medium text-white mt-3">Edit profile</button>

                        <div class="modal fade" id="edit_profile_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                               
                                <div class="modal-body p-0 py-3">
                                    <div class="d-flex flex-column align-items-center gap-3">
                                        <div class="border rounded-circle" style="background-color: <?php echo $_SESSION['profile']?> ;height: 10vh; width: 10vh;"></div>
                                        <div class="d-flex justify-content-between w-100 bg-light p-2 align-items-center">
                                            <p class="primary-fs poppins-medium fw-bold text-black-50 m-0">Profile color</p>
                                            <input id="user_profile_color" type="color" class="p-0" name="profile_color" value="<?php echo $_SESSION['profile']?>">
                                        </div>
                                        <div class="d-flex justify-content-between w-100 p-2 align-items-center">
                                            <p class="primary-fs poppins-medium fw-bold text-black-50 m-0">Display name</p>
                                            <input id="user_display_name" type="text" class="p-1 rounded-sm bg-light primary-fs poppins-regular border-1 border-dark-subtle" maxlength="20" value="<?php echo $_SESSION['display_name'] ?>" name="profile_color">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer p-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button id="profile_submit" type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                        </div>

                </div>
                <span class="flex-grow-1"></span>
                <div>
                    <a class="mb-5 text-decoration-none w-100 yellow-color btn shadow-sm border-1 border-black" href="../Session/Logout.php">Logout</a>
                </div>
            </div>
            </div>  
        </div>

            <!-- SECOND COL -->
            <div id="MainBody" class="col2 col-12 col-lg-6 d-block d-flex p-0 flex-column align-items-center bg-light vh-100 overflow-scroll m-0">
                <div style="backdrop-filter: blur(100px); background: rgba(255, 255, 255, 0.7);" class="d-block d-lg-none  border-bottom border-dark-subtle w-100 sticky-top  d-flex justify-content-between align-items-center m-0">
                <div>
                    <p class="poopins-medium text-dark fw-bold m-0 ms-3">SCFW</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="tab_content p-1 px-2 primary-color" ><i class="tab_content bi bi-file-post-fill text-white"></i></div>
                    <div class="public_chat p-1 px-2 primary-color" ><i class="bi bi-bell-fill text-white"></i></div>
                    <div class="tab_menu primary-color px-2 p-1"><i class="bi bi-person-square text-white"></i></div>
                </div>
            </div>  
            <div class="bg-light rounded-2 shadow-sm border primary-fs col-12 col-sm-9 p-0 mt-2 d-flex border border-info">
                <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create a post on freedom wall
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

            <div id="response" class="w-100  m-0 p-0 d-flex justify-content-center flex-column text-center align-items-center"></div>
            <div id="loading" style="display: none; text-align: center;" class="d-flex justify-content-center ">
                <p>Loading more post</p>
            </div>
        </div>

        <!-- THIRD COL -->
        <div id="col3" class="col-12 d-none col-lg-3 d-lg-block overflow-scroll bg-white m-0 p-0">
           <!-- <textarea id="comment-box" placeholder="Type @..."></textarea> -->
            <div class="bg-white d-flex flex-column align-items-center vh-100">

             <div style="backdrop-filter: blur(100px); background: rgba(255, 255, 255, 0.7);" class="d-block d-lg-none  border-bottom border-dark-subtle w-100 sticky-top  d-flex justify-content-between align-items-center m-0">
                <div>
                    <p class="poopins-medium text-dark fw-bold m-0 ms-3">SCFW</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="tab_content p-1 px-2 primary-color" ><i class="tab_content bi bi-file-post-fill text-white"></i></div>
                    <div class="public_chat p-1 px-2 primary-color" ><i class="bi bi-bell-fill text-white"></i></div>
                    <div class="tab_menu primary-color px-2 p-1"><i class="bi bi-person-square text-white"></i></div>

                </div>
            </div>  
                <div id="Notification" class="primary-color w-100">
                    <p class="text-center text-white m-0">Notification</p>
                </div>

                <div id="Notification_body" class="bg-white d-flex flex-column  overflow-scroll h-100 flex-grow-1 p-2 w-100 gap-3">
                    <div id="Notification_container d-flex flex-column">
                        <?php include('../User/Handler/RetrieveNotification.php')?>
                      
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="../User/Function/Profile_delete_post.js"></script>
    <script src="../User/Function/Profile_Retrieve_Post.js"></script>

    <!-- Reused Func for user owned post -->
    <script src="../User/Function/Dashboard_Retrieve_Comments.js"></script>
    <script src="../User/Function/Dashboard_ReplyComment.js"></script>
    <script src="../User/Function/Dashboard_LikePost.js"></script>    
    <script src="../User/Function/Dashboard_MentionUser.js"></script>
    <script src="../User/Function/Dashboard_Header.js"></script>

    <script>
        $('#profile').on('click', ()=>{
            window.location.href = '../User/UserDashboard.php';
        })

        $('#edit_profile').on('click', () =>{
            $('#user_profile_color').val('<?php echo $_SESSION['profile'] ?>')
            $('#user_display_name').val('<?php echo $_SESSION['display_name'] ?>')
        })

        $('#profile_submit').on('click', function(event) {
            event.preventDefault();
            let current_profile_color = '<?php echo $_SESSION['profile'] ?>'
            let current_display_name = '<?php echo $_SESSION['display_name'] ?>'
            let new_profile_color = $('#user_profile_color').val();
            let new_display_name = $('#user_display_name').val();

            console.log(new_profile_color + new_display_name);


            if (current_profile_color === new_profile_color && current_display_name === new_display_name ) return
            
            $.ajax({
                url: '../User/Handler/UpdateUserProfile.php',
                type: 'POST',
                data: {
                    profile_color: new_profile_color,
                    display_name: new_display_name
                },
                success: function(response){
                    location.reload()
                },
                error: function() {
                }
            })
        })
    </script>
</body>
</html>