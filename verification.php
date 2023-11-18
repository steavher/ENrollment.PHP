<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start(); // Add session_start() to initiate or resume a session

require 'vendor/autoload.php';

// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "phs_enrollment";

// Create a connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to send verification email
function sendemail_verify($email, $verify_code)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
        $mail->isSMTP();                                          
        $mail->Host       = 'smtp.gmail.com';                      
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'mit703843@gmail.com';                 
        $mail->Password   = 'cznsikanzkvwpldk';                  
        $mail->SMTPSecure = 'tls';            
        $mail->Port       = 587;                                    

        //Recipients
        $mail->setFrom('from@example.com', 'OTP Verification');
        $mail->addAddress($email);     
        $mail->addReplyTo('info@example.com', 'Information');

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Welcome to Pitogo Senior High School';
        $mail->Body    = "Your OTP for account verification is: $verify_code";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$error = []; 

// OTP verification logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_otp = $_POST["user_otp"]; 

    // Check if the user_otp is not empty
    if (!empty($user_otp)) {
        // Query the 'accounts' table to check if the provided OTP matches
        $query = "SELECT * FROM accounts WHERE verify_code = '$user_otp'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            // OTP matched, get the user's email
            $row = $result->fetch_assoc();
            $user_email = $row['Email'];

            // Update the 'verify' column
            $update_query = "UPDATE accounts SET verify = 1 WHERE Email = '$user_email'";
            if ($conn->query($update_query) === TRUE) {
                // Send a success email to the user
                sendemail_verify($user_email, "Your account has been verified. Please log in to continue");

                // Redirect the user back to ndex.php with a success message
                header("Location: ndex.php?message=Account has been verified. Please log in to continue");
                exit();
            } else {
                $error[] = "Error updating record: " . $conn->error;
            }
        } else {
            $error[] = "Incorrect OTP";
        }
    } else {
        $error[] = "Please enter an OTP";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>
</head>
<style>
    body {
        background-image: url("FINAL.png");
        height: 100vh;
        align-items: center;
        justify-content: center;
        display: flex;
    }

    form {
        width: 500px;
        border: 5px solid #ccc;
        padding: 30px;
        background: #fff;
        border-radius: 30px;
        border-color: #4fa2ed;
        background: rgba(225, 225, 225, 0.8);
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    }

    form h1,h3,label {
        align-items: center;
        justify-content: center;
        display: flex;
    }

    form img {
        width: 80px;
        align-items: center;
        display: flex;
        border: 3px solid;
        border-color: #4fa2ed;
        border-radius: 50px;
        margin-left: auto;
        margin-right: auto;
    }

    input {
        background: rgba(225, 225, 225, 0.5);
        display: block;
        width: 45%;
        padding: 10px;
        margin: 10px auto;
        border-radius: 10px;
    }

    button {
        background-color: #4fa2ed;
        display: block;
        width: 50%;
        padding: 10px;
        margin: 10px auto;
        border-radius: 12px;
    }

    .error {
            background-color: #ff6666;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
        }
</style>
<body>
    <form method="post">
    <?php if (!empty($error)) { ?>
    <div class="error">
        <?php foreach ($error as $errorMessage) { ?>
            <p><?php echo $errorMessage; ?></p>
        <?php } ?>
            </div>
        <?php } ?>
        <img src="IMAGES/LOGO.png">
        <h1>OTP Verification</h1> <br>
        <label>Verification Code</label> <br>
        <h3>Please Input Verification Code sent to </h3> <hr><hr>

        <input type="number" name="user_otp" placeholder="Enter OTP"> <!-- Add input field for OTP entry -->

        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
