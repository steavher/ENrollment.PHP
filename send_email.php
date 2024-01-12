<?php
// Include the necessary PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phs_enrollment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if LRN and schedule parameters are present
if (isset($_POST['lrn']) && isset($_POST['schedule'])) {
    $lrn = $_POST['lrn'];
    $schedule = $_POST['schedule'];

    // Fetch student email address using the LRN from the database
    $emailSql = "SELECT email FROM names WHERE lrn = $lrn";
    $emailResult = $conn->query($emailSql);

    if ($emailResult && $emailRow = $emailResult->fetch_assoc()) {
        $toEmail = $emailRow['email'];

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Set up SMTP
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mit703843@gmail.com';
            $mail->Password   = 'cznsikanzkvwpldk';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Set up email content
            $mail->setFrom('from@example.com', 'SCHEDULING');
            $mail->addAddress($toEmail);
            $mail->Subject = 'Meeting Schedule';
            $mail->Body    = "Dear Student,\n\nWe have scheduled a face-to-face meeting with you on $schedule.Please bring all the requirements. \n\nBest regards,\nPitogo Senior High School";

            // Send the email
            $mail->send();
            echo 'Email has been sent successfully!';
        } catch (Exception $e) {
            echo 'Error sending email: ', $mail->ErrorInfo;
        }
    } else {
        echo 'Student email not found.';
    }
} else {
    echo 'LRN or schedule parameters not set.';
}

// Close the database connection
$conn->close();
?>
