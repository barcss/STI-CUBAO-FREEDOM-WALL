<?php
include('../Database/db_connect.php');
include('../Session/AdminSessionChecker.php');
function getTotalUser(){
    include('../Database/db_connect.php');

    $query = 'SELECT COUNT(*) AS totalUser FROM accounts';
    $stmt = mysqli_prepare($conn_accounts, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $totalAccounts);
    mysqli_stmt_fetch($stmt);
    return $totalAccounts;
}

function getTotalActive(){
    include('../Database/db_connect.php');

    $defaultVal = 1;

    $query = 'SELECT COUNT(*) AS totalActive FROM accounts WHERE is_active = ?';
    $stmt = mysqli_prepare($conn_accounts, $query);
    mysqli_stmt_bind_param($stmt, 'i', $defaultVal);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $totalActive);
    mysqli_stmt_fetch($stmt);
    return $totalActive;
}

function getTotalMuted(){
    include('../Database/db_connect.php');

    $defaultVal = 1;

    $query = 'SELECT COUNT(*) AS totalMuted FROM accounts WHERE is_muted = ?';
    $stmt = mysqli_prepare($conn_accounts, $query);
    mysqli_stmt_bind_param($stmt, 'i', $defaultVal);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $totalMuted);
    mysqli_stmt_fetch($stmt);
    return $totalMuted;
}

//Contets DB
function getTotalPost(){
    include('../Database/db_connect.php');

    $query = 'SELECT COUNT(DISTINCT post_id) AS totalPost FROM user_post';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $totalPost);
    mysqli_stmt_fetch($stmt);
    return $totalPost;
}

function getTotalComment(){
    include('../Database/db_connect.php');

    $query = 'SELECT COUNT(*) AS totalComment FROM comment_post';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $totalComment);
    mysqli_stmt_fetch($stmt);
    return $totalComment;
}

function getTotalMessage(){
    include('../Database/db_connect.php');

    $query = 'SELECT COUNT(*) AS totalMessage FROM public_chat';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $totalMessage);
    mysqli_stmt_fetch($stmt);
    return $totalMessage;
}

function getTotalLikes(){
    include('../Database/db_connect.php');

    $query = 'SELECT COUNT(*) AS totalLikes FROM like_post';
    $stmt = mysqli_prepare($conn_contents, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $totalLikes);
    mysqli_stmt_fetch($stmt);
    return $totalLikes;
}


// echo json_encode([
//     'totalAccounts' => getTotalUser(),
//     'totalActive' => getTotalActive(),
//     'totalMuted' => getTotalMuted(),
//     'totalInactive' => (getTotalUser() - getTotalActive()),
// ])
?>