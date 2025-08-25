<?php
session_start();
include('../../Database/db_connect.php');
include('../../Session/AdminSessionChecker.php');

$query = "SELECT * FROM accounts";
$stmt = mysqli_prepare($conn_accounts, $query);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$users = '';

while ($row = mysqli_fetch_assoc($result)) {
    $fullname = $row['user_firstname'] . ' ' . $row['user_lastname'];

    $users .= '
    <div class="d-flex align-items-center bg-light p-2 rounded-1 shadow-sm user-data" data-user-id="'. $row['account_id'] .'">
        <div class=" me-3" style="height: 20px; width: 20px; background-color: '. $row["profile_color"] .'"></div>
        <div class="d-flex flex-column justify-content-center align-items-start">
            <p class="p-0 m-0">'. $row["display_name"] .'</p>
            <p class="p-0 m-0 primary-fs">'. $fullname .'</p>
        </div>
        <div class="flex-grow-1"></div>
        <div class="flex gap-1 d-lg-flex d-none">
            <button id="profile" class="bg-info col btn border-0 rounded p-2"><i class="bi text-white bi-person-square"></i></button>
            <button id="edit" class="bg-primary col btn border-0 rounded p-2"><i class="bi text-white bi-pencil-square"></i></button>
            <button id="mute" class="bg-success col btn border-0 rounded p-2"><i class="bi text-white bi-mic-mute-fill"></i></button>
            <button id="block" class="bg-danger col btn border-0 rounded p-2"><i class="bi text-white bi-ban-fill"></i></button>
        </div>
        <div class="d-flex d-lg-none flex-column">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProfileModal'. $row['account_id'].'">
            a
            </button>
        </div>
        <div class="modal fade" id="ProfileModal'. $row['account_id'].'" tabindex="-1" aria-labelledby="ProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="user_profile" class="col d-flex flex-column bg-white shadow-sm rounded-1 gap-2 h-100">
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
            <div class="modal-footer">
                <div class="flex gap-1">
                    <button id="profile" class="bg-info col btn border-0 rounded p-2"><i class="bi text-white bi-person-square"></i></button>
                    <button id="edit" class="bg-primary col btn border-0 rounded p-2"><i class="bi text-white bi-pencil-square"></i></button>
                    <button id="mute" class="bg-success col btn border-0 rounded p-2"><i class="bi text-white bi-mic-mute-fill"></i></button>
                    <button id="block" class="bg-danger col btn border-0 rounded p-2"><i class="bi text-white bi-ban-fill"></i></button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
';
}

header('Content-Type: Application/Json');
echo json_encode(['users'=> $users]);
?>
