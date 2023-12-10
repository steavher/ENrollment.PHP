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

// Check if Admin type is provided in the request
if (isset($_GET['Admin'])) {

    $deleteQuery = "DELETE FROM accounts WHERE user_type = 'Admin'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION['success_message'] = "Admin user(s) deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Error deleting admin user(s): " . $conn->error;
    }

    // Redirect back to the page where the deletion was initiated
    header("Location: USERS.php");
    exit();
} else {
    $_SESSION['error_message'] = "Admin type not provided.";
    header("Location: USERS.php");
    exit();
}

$conn->close();
?>
