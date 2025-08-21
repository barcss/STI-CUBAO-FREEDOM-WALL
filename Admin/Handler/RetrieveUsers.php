<?php
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
        <div class="flex gap-1">
            <button id="profile" class="bg-info col btn border-0 rounded p-2"><i class="bi text-white bi-person-square"></i></button>
            <button id="edit" class="bg-primary col btn border-0 rounded p-2"><i class="bi text-white bi-pencil-square"></i></button>
            <button id="mute" class="bg-success col btn border-0 rounded p-2"><i class="bi text-white bi-mic-mute-fill"></i></button>
            <button id="block" class="bg-danger col btn border-0 rounded p-2"><i class="bi text-white bi-ban-fill"></i></button>
        </div>
    </div>
';
}

header('Content-Type: Application/Json');
echo json_encode(['users'=> $users]);
?>
