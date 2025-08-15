<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_FILES['art_photo'])) {
        die("No file uploaded");
    }
    include('../../Database/db_connect.php');

    $account_id = $_SESSION['account_id'];
    date_default_timezone_set('Asia/Manila');
    $date = date('F j, Y g:i A ');

    $fileTmpPath = $_FILES['art_photo']['tmp_name'];
    $fileName = $_FILES['art_photo']['name'];
    $fileType = $_FILES['art_photo']['type'];
    $fileCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $postContent = isset($_POST['content']) ? $_POST['content'] : '';
    $chanel = 'culinary_art';
    $true = 1;

    $uploadsFileDir = '../../User/Data/CulArt_Uploaded_Img/';
    $serverSideFileDir = '../User/Data/CulArt_Uploaded_Img/';

    if (!is_dir($uploadsFileDir)) {
        mkdir($uploadsFileDir, 0755, true);
    }

    $dest_path = $uploadsFileDir . $newFileName;
    $file_path = $serverSideFileDir . $newFileName;
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $query = "INSERT INTO user_post (account_id, post_date, post_content, post_chanel, photo_path) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($conn_contents, $query);
        mysqli_stmt_bind_param($stmt, 'issss', $account_id, $date, $postContent, $chanel, $file_path);
        if (mysqli_stmt_execute($stmt)) {
        }
    }
}


?>