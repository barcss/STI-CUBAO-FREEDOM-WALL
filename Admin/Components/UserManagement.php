<?php 
$Fullname = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
?>

<div id="user_management" class="content p-0 container d-flex row">
    <div class="col-lg-8 col-12 d-flex flex-column container">
        <!-- <div class="d-flex container w-100 p-0">
            <form action="#" class="w-100 d-flex m-0">
                <input type="text" placeholder="search user" class="flex-grow-1">
                <select class=" me-3">
                    <option value="1" default>Active</option>
                    <option value="2">Deactive</option>
                </select>
                <button class="btn btn-success text-white">Search</button>
            </form>
        </div> -->  
        <div class="d-flex flex-column bg-white p-3 rounded-1 shadow-sm mt-2">
            <div class="d-flex">
                <p class="p-0 m-0">Users</p>
                <div class="flex-grow-1"></div>
                <p class="p-0 m-0">Actions</p>

            </div>

            <div id="users_container" class="d-flex flex-column gap-1 bg">
            </div>
        </div>
        
    </div>
    <div id="user_profile" class="col d-flex d-none d-lg-block flex-column bg-white shadow-sm rounded-1 p-3 gap-2 h-100">
        <div id="user_profile_info">
            <div class="d-flex justify-content-center flex-column shadow-sm rounded bg-light align-items-center">
                <p class="m-0 poppins-medium primary-fs w-100 text-start primary-color text-white p-1 ps-2">User profile</p>
                <div class="d-flex align-items-center py-3 flex-column">
                    <div id="profile_color" class="rounded-circle mb-3" style="height:10vh; width:10vh;" ></div>
                    <p id="profile_display_name" class="fw-bold fs-6 m-0"></p>
                    <p id="profile_full_name" class="primary-fs m-0 text-black-50"></p>
                </div>
            </div>
            <div id="user_profile_record" class="d-none justify-content-center flex-column shadow-sm rounded bg-light align-items-start">
                <p class="m-0 poppins-medium primary-fs w-100 text-start primary-color text-white p-1 ps-2">User Record</p>
                <div class="d-flex align-items-start p-3 flex-column">
                    <p id="profile_total_post" class="primary-fs p-0 m-0">Post Count: <span class="fw-bold"></span></p>
                    <p id="profile_total_message"class="primary-fs p-0 m-0">Message Count: <span class="fw-bold"></span></p>
                    <p id="profile_total_comment"class="primary-fs p-0 m-0">Comment Count: <span class="fw-bold"></span></p>
                    <p id="profile_total_like"class="primary-fs p-0 m-0">Like Count: <span class="fw-bold"></span></p>
                </div>
            </div>
        </div>
        <div id="user_mute" class="w-100 d-none">
            <div class="d-flex flex-column shadow-sm w-100">
                <p class="m-0 poppins-medium primary-fs w-100 text-start primary-color text-white p-1 ps-2">Mute User</p>
                <div class="p-2">
                    <p id="user_status" class="primary-fs p-0 m-0">User Status: <span class="fw-bold"></span></p>
                    <div class="d-flex flex-column  gap-2 mt-3">
                        <button id="mute_user_btn" class="btn btn-danger rounded-0 p-0 m-0 text-white w-100 primary-fs">Mute User</button>
                        <button id="unmute_user_btn" class="btn primary-color rounded-0 p-0 m-0 text-white w-100 primary-fs">Unmute User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>