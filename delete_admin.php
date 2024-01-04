<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phs_enrollment";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the Admin parameter is set in the query string
if (isset($_GET['Admin'])) {
    $adminId = $_GET['Admin'];

    // Perform the deletion based on the admin ID
    $sql = "DELETE FROM accounts WHERE account_Id = '$adminId'";
    $result = $conn->query($sql);

    if ($result) {
        // set success message
        $_SESSION['success_message'] = "Admin deleted successfully.";
    } else {
        // set error message
        $_SESSION['error_message'] = "Error deleting admin: " . $conn->error;
    }

    // Redirect back to the page displaying admin users
    header("Location: USERS.php");
    exit();
} else {
    // Admin parameter not set, handle accordingly (e.g., show an error message)
    $_SESSION['error_message'] = "Admin ID not provided for deletion.";
    header("Location: USERS.php");
    exit();
}

// Close the database connection
$conn->close();
?>
