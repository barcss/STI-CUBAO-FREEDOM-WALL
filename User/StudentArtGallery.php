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

        <div class="col-0 col-lg-3 d-none d-lg-flex flex-column bg-white p-2 overflow-scroll">
            <div class="d-flex align-content-center align-items-center p-0 mb-3">
                <p class="m-0 primary-text poppins-medium fw-bold">STI CUBAO FREEDOM WALL</p>
                <small class="fw-bold opacity-50 ms-2 m-0 fst-italic text-dark" style="font-size: 7px;">Beta v.2.3</small>
            </div>
            <div class="p-1 ">
                <button id="userDashboard" class="w-100 btn text-white text-start p-1 primary-color"><i class="bi bi-person-circle mx-2 text-white"></i>User Dashboard</button>
            </div>
                <div id="webPortfolio" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-4 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-file-earmark-code-fill"></i></div>
                    <p  class="m-0 ms-2 primary-fs">Student web portfolio</p>
                </div> 
                <div id="culinaryArt" style="cursor: pointer;" class="bg-light shadow-sm rounded mt-2 overflow-hidden d-flex align-items-center">
                    <div class="primary-color p-2"><i class="bi text-white bi-egg-fried"></i></div>
                    <p  class="m-0 ms-2 primary-fs">Student culinary art</p>
                </div> 
            <span class="flex-grow-1"></span>
            <div>
                <a class="mb-5 text-decoration-none w-100 yellow-color btn shadow-sm border-1 border-black" href="../Session/Logout.php">Logout</a>
            </div>
        </div>

        <div class="col-lg-6 col-12 bg-light p-3 d-flex  m-0 align-items-center flex-column overflow-scroll vh-100" id="content_container">
            <div class="bg-white     rounded-2 shadow-sm border primary-fs col-12 col-sm-9 p-0 mt-2 d-flex border border-info">
                <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Share art works
                </button>

                <form id="upload_photo_form" action="#" method="POST">
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content  bg-light">
                                <form method="post" action="../User/Handler/ArtGal_Upload_Photo.php" enctype="multipart/form-data">
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
            <div id="post_container" class="d-flex flex-column w-100"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
        <script src="../Admin/Function/ContainerContentChanger.js"></script>
        <script src="../Admin/Function/FetchUsers.js"></script>
        <script src="../Admin/Function/ViewUserProfile.js"></script>
        <script src="../User/Function/ArtGal_Retrieve_Post.js"></script>

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
                    alert("ADD IMAGE BRO")
                    return;
                }

                file.append("content", content)

                $.ajax({
                    url: '../User/Handler/ArtGal_Upload_Photo.php',
                    type: 'POST',
                    data: file,
                    contentType: false,
                    processData: false,
                    success: function() {
                        window.location.reload()
                    }
                })
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