<?php 
include('../Admin/Components/AdminMetaData.php');
include('../Admin/Handler/RetrieveCounts.php');
?>

<body class="poppins-regular">
    <div style="backdrop-filter: blur(100px); background: rgba(255, 255, 255, 0.7);" class="d-block   border-bottom border-dark-subtle w-100 sticky-top  d-flex justify-content-between align-items-center m-0">
        <div>
            <p class="poopins-medium text-dark fw-bold m-0 ms-3">SCFW</p>
        </div>
        <div class="d-flex justify-content-end">
            <div class="tab_content p-1 px-2 primary-color"><i class="tab_content bi bi-file-post-fill text-white"></i></div>
            <div class="tab_menu primary-color px-2 p-1"><i class="bi text-white bi-list"></i></div>
        </div>
    </div>
    <div class="container-fluid vh-100 d-flex p-0 m-0 row">
        <!-- col1 -->
        <div id="col1" class="col-0 col-lg-3 d-none d-lg-flex flex-column bg-white p-2 overflow-scroll">
            <div class="d-flex align-content-center align-items-center p-0 mb-3">
                <p class="m-0 primary-text poppins-medium fw-bold">SCFW Admin</p>
                <small class="fw-bold opacity-50 ms-2 m-0 fst-italic text-dark" style="font-size: 7px;">Beta v.2.3</small>
            </div>
            <div class="p-1 ">
                <button id="adminDashboard" class="w-100 btn text-white text-start p-1 primary-color mb-1" onclick="location.reload()"><i class="bi bi-person-circle mx-2 text-white"></i>Admin Dashboard</button>
                <button id="userDashboard" class="w-100 btn text-white text-start p-1 primary-color"><i class="bi bi-person-circle mx-2 text-white"></i>User Dashboard</button>
            </div>
        
            <div class=" bg-light overflow-hidden shadow-sm rounded d-flex flex-column align-items-center mt-3">
                <div id="filter_btn_container" class="p-0 w-100 primary-fs">
                    <button value="user_management" name="filter" class="p-2 bg-white w-100 rounded border text-start"><span class="primary-color p-1 me-2"></span>User Management</button>
                    <button value="content_management" name="filter" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-primary p-1 me-2"></span>Content Management</button>
                    <button value="content_approval" name="filter" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-success p-1 me-2"></span>Content Approval</button>
                    <button value="content_report" name="filter" class="p-2 bg-white w-100 rounded border text-start"><span class="bg-danger p-1 me-2"></span>Content Reports</button>
                </div>  
            </div>
            <span class="flex-grow-1"></span>
            <div>
                <a class="mb-5 text-decoration-none w-100 yellow-color btn shadow-sm border-1 border-black" href="../Session/Logout.php">Logout</a>
            </div>
        </div>
        <!-- col2 -->
        <div class="col p-0 bg-light p-3 d-flex container m-0 row align-items-center flex-column overflow-scroll vh-100" id="content_container">
            <?php include '../Admin/Components/DashboardTotalCounts.php' ?>
            <?php include '../Admin/Components/UserManagement.php' ?>
            <?php include '../Admin/Components/ContentManagement.php' ?>
        </div> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="../Admin/Function/ContainerContentChanger.js"></script>
    <script src="../Admin/Function/FetchUsers.js"></script>
    <script src="../Admin/Function/ViewUserProfile.js"></script>
    <script src="../Admin/Function/MuteUser.js"></script>
    <script src="../Admin/Function/ContentManagement_Delete_Post.js"></script>
    <script src="../Admin/Function/ContentManagement_Retrieve_Post.js"></script>
    <script src="../Admin/Function/ContentManagement_Show_Post.js"></script>
    <script src="../Admin/Function/Dashboard_Header.js"></script>



    <script>
        $('#userDashboard').on('click', ()=>{
            window.location.href = "../User/UserDashboard.php"
        })
    </script>
</body>
</html>