<?php

include '../User/Components/UserMetaData.php';
include '../User/Handler/Post_Create.php';
 

$Fullname = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
if (!isset($_SESSION['is_active'])) {
    header('Location: ../User/UserRegistration.php');
    exit;
}

?>


<body id="body" class="poppins-regular" style="opacity: 0;">
    

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
                        <div class="public_chat p-1 px-2 primary-color" ><i class=" bi bi-chat-square-dots-fill text-white"></i></div>
                        <div class="tab_menu primary-color px-2 p-1"><i class="bi text-white bi-list"></i></div>
                    
                    </div>
                </div>  
                <div class="p-2 d-flex flex-column vh-100">
                <div class="d-flex align-content-center align-items-center p-0 mb-3">
                    <p class="m-0 primary-text poppins-medium fw-bold">STI CUBAO FREEDOM WALL </p>
                    <small class="fw-bold opacity-50 ms-2 m-0 fst-italic text-dark" style="font-size: 7px;">Beta v.3.0</small>
                </div>

                <div id="profile" style="cursor: pointer;" class="bg-light shadow-sm rounded overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi m-0 bi-person-square text-white"></i></div>
                    <p  class="m-0 ms-2 primary-fs"> Profile </p>
                </div> 
                <div id="elms" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="yellow-color p-2"><i class="bi bi-book-half"></i></div>
                    <p  class="m-0 ms-2 primary-fs">eLMS</p>
                </div> 
                <div id="oneSTI" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="yellow-color p-2"><i class="bi bi-phone-fill"></i></div>
                    <p  class="m-0 ms-2 primary-fs">one STI</p>
                </div> 
                <div id="artGallery" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-brush-fill"></i></div>
                    <p  class="m-0 ms-2 primary-fs">Student art gallery</p>
                </div> 
                <div id="webPortfolio" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-file-earmark-code-fill"></i></div>
                    <p  class="m-0 ms-2 primary-fs">Student web portfolio</p>
                </div> 
                <div id="culinaryArt" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-egg-fried"></i></div>
                    <p  class="m-0 ms-2 primary-fs">Student culinary art</p>
                </div> 
                <?php
                    if ((bool) $_SESSION['is_admin']) {
                        echo  '
                            <div id="oneSTI" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                                <div class="primary-color p-2"><i class="bi  text-white bi-person-circle"></i></div>
                                <a class=" w-100 text-black  rounded  overflow-hidden d-flex align-items-center m-0 ps-2 p-0 primary-fs text-decoration-none" href="../Admin/AdminDashboard.php">Admin Dashboard</a>
                            </div> 
                        ';
              
                    } else {
     

                    }
                ?>
                <div class=" overflow-scroll my-4">
                    <div class=" bg-light overflow-hidden shadow-sm rounded d-flex flex-column align-items-center">
                        <p class="primary-color w-100 text-center text-white">Chanels</p>
                        <div class="p-0 w-100 primary-fs">
                            <button type="submit" name="postFilter" value="" class="p-2 text-start mb-4 bg-white w-100 rounded border">All Chanels</button>
                            <button type="submit" name="postFilter" value="random_message" class="p-2 bg-white w-100 rounded border text-start"><span class="primary-color p-1 me-2"></span>Random Message</button>
                            <button type="submit" name="postFilter" value="rants" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-warning p-1 me-2"></span>Rants</button>
                            <button type="submit" name="postFilter" value="confession" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-danger p-1 me-2"></span>Confession</button>
                            <button type="submit" name="postFilter" value="questions" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-primary p-1 me-2"></span>Questions</button>
                            <button type="submit" name="postFilter" value="lf_classmates" class="p-2 bg-white w-100 rounded border text-start"><span class=" bg-success p-1 me-2"></span>Looking For</button>
                            <button type="submit" name="postFilter" value="lost_and_found" class="p-2 bg-white w-100 rounded border text-start"><span class=" bg-dark p-1 me-2"></span>Lost and Found</button>
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
                    <div class="public_chat p-1 px-2 primary-color" ><i class=" bi bi-chat-square-dots-fill text-white"></i></div>
                    <div class="tab_menu primary-color px-2 p-1"><i class="bi text-white bi-list"></i></div>

                </div>
            </div>  
            <div class="bg-white     rounded-2 shadow-sm border primary-fs col-12 col-sm-9 p-0 mt-2 d-flex border border-info">
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
        <div id="col3" class="col-12 d-none col-lg-3 d-lg-block overflow-scroll m-0 p-0">
           <!-- <textarea id="comment-box" placeholder="Type @..."></textarea> -->
            <div class="bg-white d-flex flex-column  bg-light align-items-center vh-100">

             <div style="backdrop-filter: blur(100px); background: rgba(255, 255, 255, 0.7);" class="d-block d-lg-none  border-bottom border-dark-subtle w-100 sticky-top  d-flex justify-content-between align-items-center m-0">
                <div>
                    <p class="poopins-medium text-dark fw-bold m-0 ms-3">SCFW</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="tab_content p-1 px-2 primary-color" ><i class="tab_content bi bi-file-post-fill text-white"></i></div>
                    <div class="public_chat p-1 px-2 primary-color" ><i class=" bi bi-chat-square-dots-fill text-white"></i></div>
                    <div class="tab_menu primary-color px-2 p-1"><i class="bi text-white bi-list"></i></div>

                </div>
            </div>  
                <div id="PublicChatHeader" class="primary-color w-100">
                    <p class="text-center text-white m-0">Public Chat</p>
                </div>

                <div id="PublicChatBody" class="bg-white d-flex flex-column  overflow-scroll h-100 flex-grow-1 p-2 w-100 gap-3">
                    <p class="fs-6 text-center text-dark-emphasis"><small>Start of conversation</small></p>

                    <div id="chatContents">
                        <p class="alert alert-danger sticky-top m-0 primary-fs p-1">Chat updates are delayed to avoid server downtime. Websockets/Ratchets dont work with web host provider.</p>
                    </div>
                    
                </div>

                <div id="PublicChatAction" class=" d-flex bg-light w-100 mb-5 p-2">   
           
                    <input id="IPT_chatContent" name="chat_content" type="text" class=" comment-input-box primary-fs bg-white rounded border-0 shadow-sm w-100 border-1 ps-2" placeholder="Type a Message">
                    <button id="BTN_chatSend" name="send_message" type="submit" class="primary-color btn text-white shadow-sm">Send</button>  
                 
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="../User/Function/Dashboard_Retrieve_Comments.js"></script>
    <script src="../User/Function/Dashboard_Retrieve_Post.js"></script>
    <script src="../User/Function/Dashboard_Retrieve_Chat.js"></script> 
    <script src="../User/Function/Dashboard_LikePost.js"></script>    
    <script src="../User/Function/Dashboard_MentionUser.js"></script>
    <script src="../User/Function/Dashboard_ScrollBottom.js"></script>
    <script src="../User/Function/Dashboard_Header.js"></script>
    <script src="../User/Function/Dashboard_ReplyComment.js"></script>
 
    <script>
        $('#profile').on('click', ()=>{
            window.location.href = '../User/UserProfile.php';
        })
        $('#elms').on('click', ()=>{
            window.location.href = 'https://elms.sti.edu';
        })
        $('#oneSTI').on('click', ()=>{
            window.location.href = 'https://one.sti.edu';
        })
        $('#artGallery').on('click', ()=>{
            window.location.href = '../User/StudentArtGallery.php';
        })
        $('#webPortfolio').on('click', ()=>{
            window.location.href = '../User/StudentWebPortfolio.php';
        })
        $('#culinaryArt').on('click', ()=>{
            window.location.href = '../User/StudentCulinaryArts.php';
        })
    </script>

</body>
</html>