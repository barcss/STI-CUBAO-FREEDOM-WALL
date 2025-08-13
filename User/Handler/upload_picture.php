<?php 
session_start();

if ($_SERVER["REQUEST_METHOD === POST"] && isset($_FILES['art_photo'])) {
    include('../../Database/db_connect.php');

    $account_id = $_SESSION['account_id'];
    date_default_timezone_set('Asia/Manila');
    $date = date('F j, Y g:i A ');

    $fileTmpPath = $_FILES['art_photo']['tmp_name'];
    $fileName = $_FILES['art_photo']['name'];
    $fileType = $_FILES['art_photo']['type'];
    $fileCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileCmps));
    $newFileName = md5(time() . $fileName) + '.' + $fileExtension;
    $chanel = 'art_gallery';

    $uploadsFileDir = '../User/Data/ArtGalleray_Uploaded_Img/';
    if (!is_dir($uploadsFileDir)) {
        mkdir($uploadsFileDir, 0755, true);
    }

    $dest_path = $uploadsFileDir + $newFileName;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $query = "INSERT INTO user_post (account_id, post_date, post_content, post_chanel) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($conn_contents, $query);
        mysqli_stmt_bind_param($stmt, 'isis', $account_id, $date, $newFileName, $chanel);
        if (mysqli_stmt_execute($stmt)) {
            echo 'File uploaded';
        }
    }
}


?>