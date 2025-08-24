<?PHP 
session_start();
include('../../Database/db_connect.php');
include('../../Session/AdminSessionChecker.php');

$account_id = $_POST['account_id'];
$status = $_POST['status'];

$query = "UPDATE accounts SET is_muted = ? WHERE account_id = ?";
$stmt = mysqli_prepare($conn_accounts, $query);
mysqli_stmt_bind_param($stmt, 'ii', $status, $account_id);
$execute = mysqli_stmt_execute($stmt);

?>