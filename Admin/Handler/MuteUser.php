<?PHP
session_start();
include('../../Database/db_connect.php');
include('../../Session/AdminSessionChecker.php');

$account_id = $_GET['account_id'];

$query = "SELECT is_muted FROM accounts WHERE account_id = ?";
$stmt = mysqli_prepare($conn_accounts, $query);
mysqli_stmt_bind_param($stmt, 'i', $account_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

header('Content-Type: Applciation/Json');
echo json_encode([
    'is_muted' => (bool) mysqli_fetch_assoc($result)['is_muted'],
])
?>