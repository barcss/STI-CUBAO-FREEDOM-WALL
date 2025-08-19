<?php
include('../User/Components/UserMetaData.php');

?>

<head>
    <style>
        .img-preview {
            object-fit: cover;
            object-position: center center;
            /* Spacing from text */
        }
    </style>
</head>

<body class="poppins-regular">
    <div class="container-fluid vh-100 d-flex p-0 m-0 row">
        <div class="col-0 col-lg-3 d-none d-lg-flex flex-column bg-white p-0 overflow-scroll" id="col1">
            <div style="backdrop-filter: blur(100px); background: rgba(255, 255, 255, 0.7);" class="d-block d-lg-none  border-bottom border-dark-subtle w-100 sticky-top  d-flex justify-content-between align-items-center m-0">
                <div>
                    <p class="poopins-medium text-dark fw-bold m-0 ms-3">SCFW</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="tab_content p-1 px-2 primary-color"><i class="tab_content bi bi-file-post-fill text-white"></i></div>
                    <div class="public_chat p-1 px-2 primary-color"><i class="bi bi-bell-fill text-white"></i></div>
                    <div class="tab_menu primary-color px-2 p-1"><i class="bi bi-list text-white"></i></div>
                </div>
            </div>

            <div class="d-flex flex-column vh-100 p-2">
                <div class="d-flex align-content-center align-items-center p-0 mb-3">
                    <p class="m-0 primary-text poppins-medium fw-bold">STI CUBAO FREEDOM WALL</p>
                    <small class="fw-bold opacity-50 ms-2 m-0 fst-italic text-dark" style="font-size: 7px;">v.2</small>
                </div>
                <div >
                    <button id="userDashboard" class="w-100 btn text-white text-start p-1 primary-color"><i class="bi bi-person-circle mx-2 text-white"></i>User Dashboard</button>
                </div>
                <div id="webPortfolio" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-4 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-file-earmark-code-fill"></i></div>
                    <p class="m-0 ms-2 primary-fs">Student programming app</p>
                </div>
                <div id="artGallery" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-brush-fill"></i></div>
                    <p class="m-0 ms-2 primary-fs">Student art gallery</p>
                </div>
                <div id="culinaryArt" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-egg-fried"></i></div>
                    <p class="m-0 ms-2 primary-fs">Student culinary art</p>
                </div>
                <span class="flex-grow-1"></span>
                <div>
                    <a class="mb-5 text-decoration-none w-100 yellow-color btn shadow-sm border-1 border-black" href="../Session/Logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="col2 col-lg-6 col-12 bg-light d-flex p-0 m-0 align-items-center flex-column overflow-scroll vh-100" id="content_container">
            <div style="backdrop-filter: blur(100px); background: rgba(255, 255, 255, 0.7);" class="d-block d-lg-none  border-bottom border-dark-subtle w-100 sticky-top  d-flex justify-content-between align-items-center m-0">
                <div>
                    <p class="poopins-medium text-dark fw-bold m-0 ms-3">SCFW</p>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="tab_content p-1 px-2 primary-color"><i class="tab_content bi bi-file-post-fill text-white"></i></div>
                    <div class="public_chat p-1 px-2 primary-color"><i class="bi bi-bell-fill text-white"></i></div>
                    <div class="tab_menu primary-color px-2 p-1"><i class="bi bi-list text-white"></i></div>
                </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm border primary-fs col-12 col-sm-9 p-0 mt-2 d-flex border border-info">
                <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Share art works
                </button>

                <form id="upload_photo_form" action="#" method="POST">
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content  bg-light">
                                <form method="post" action="../User/Handler/CulArt_Upload_Photo.php" enctype="multipart/form-data">
                                    <div class="modal-body d-flex flex-column">
                                        <div class="d-flex justify-content-between mb-2 p-0 align-items-center">
                                            <p class="m-0 col-4">Create a post</p>
                                        </div>
                                        <div>
                                            <textarea name="post_content" class="bg-white w-100 shadow-sm p-1 border-0 rounded" rows="2" placeholder="Add some caption for this masterpiece, <?php echo $_SESSION['display_name'] ?>... "></textarea>
                                            <div id="img-container" class="w-100 my-4 d-flex justify-content-center d-none" style="height: 30vh;">
                                                <img id="img-preview" style="object-fit: cover; object-position: center center;" />
                                            </div>
                                            <label for="art_photo" class="btn primary-color w-100 text-white">Upload Image</label>
                                            <input hidden name="art_photo" id="art_photo" type="file" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="modal-footer p-1">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit_post" class="btn btn-primary">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="response" class="d-flex flex-column w-100">
                <div id="loading" style="display: none; text-align: center;" class="d-flex justify-content-center ">
                    <p>Loading</p>
                </div>
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
                        <div class="tab_content p-1 px-2 primary-color"><i class="tab_content bi bi-file-post-fill text-white"></i></div>
                        <div class="public_chat p-1 px-2 primary-color"><i class="bi bi-bell-fill text-white"></i></div>
                        <div class="tab_menu primary-color px-2 p-1"><i class="bi bi-list text-white"></i></div>
                    </div>
                </div>
                <div id="Notification" class="primary-color w-100">
                    <p class="text-center text-white m-0">Notification</p>
                </div>

                <div id="Notification_body" class="bg-white d-flex flex-column  overflow-scroll h-100 flex-grow-1 p-2 w-100 gap-3">
                    <div id="Notification_container d-flex flex-column">
                        <?php include('../User/Handler/RetrieveNotification.php') ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
        <script src="../Admin/Function/ContainerContentChanger.js"></script>
        <script src="../Admin/Function/FetchUsers.js"></script>
        <script src="../Admin/Function/ViewUserProfile.js"></script>
        <script src="../User/Function/CulArt_Retrieve_Post.js"></script>
        <script src="../User/Function/Dashboard_ReplyComment.js"></script>
        <script src="../User/Function/Dashboard_Retrieve_Comments.js"></script>
        <script src="../User/Function/Dashboard_LikePost.js"></script>
        <script src="../User/Function/Dashboard_MentionUser.js"></script>
        <script src="../User/Function/Dashboard_Header.js"></script>
        <script>
            $('#userDashboard').on('click', () => {
                window.location.href = "../User/UserDashboard.php"
            })

            $('#art_photo').on('change', function() {
                var file = this.files[0]; //reference to the parent then get the first files value
                if (file) {
                    var reader = new FileReader(); //Object for reading Files, makes file output as pic
                    $('#img-container').removeClass('d-none').addClass('d-block')
                    console.log(file)
                    reader.onload = function(e) {
                        $('#img-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file)
                }
            })


            $('#upload_photo_form').on('submit', function(e) {
                e.preventDefault();

                let file = new FormData(this)
                let img = file.get("art_photo")
                let content = $('textarea[name="post_content"]').val();

                if (!img || img.size === 0) {
                    alert("No image found")
                    return;
                }

                file.append("content", content)

                $.ajax({
                    url: '../User/Handler/CulArt_Upload_Photo.php',
                    type: 'POST',
                    data: file,
                    contentType: false,
                    processData: false,
                    success: function() {
                        window.location.reload()
                    }
                })
            })

            $('#webPortfolio').on('click', () => {
                window.location.href = '../User/StudentProgramming.php';
            })
            $('#culinaryArt').on('click', () => {
                window.location.href = '../User/StudentCulinaryArts.php';
            })
            $('#artGallery').on('click', () => {
                window.location.href = '../User/StudentArtGallery.php';
            })
        </script>
</body>

</html>