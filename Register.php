<?php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = "Student";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cspassword = $_POST['cspassword'];

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors[] = "Password should be 8 characters long, a combination of uppercase and lowercase letters with numbers, and no special characters.";
    }

    if ($password != $cspassword) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $verify_code = mt_rand(100000, 999999);

        $conn = new mysqli("localhost", "root", "", "phs_enrollment");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $check_existing_email = $conn->prepare("SELECT email FROM accounts WHERE email = ?");
        $check_existing_email->bind_param("s", $email);
        $check_existing_email->execute();
        $check_existing_email->store_result();

        if ($check_existing_email->num_rows > 0) {
            $errors[] = "Email already exists";
        } else {
            $stmt = $conn->prepare("INSERT INTO accounts (user_type, email, password, verify_code, verify) VALUES (?, ?, ?, ?, 0)");
            $stmt->bind_param("sssi", $user_type, $email, $hashed_password, $verify_code);

            if ($stmt->execute()) {
                $_SESSION['user_email'] = $email; // Set the user's email in the session
                include 'verification.php';
                sendemail_verify($email, $verify_code);
                header("Location: verification.php");
                exit();
            } else {
                $errors[] = "Error: " . $conn->error;
            }

            $stmt->close();
        }

        $check_existing_email->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Form</title>
    <link rel="stylesheet" href="css/Register.css">
    <style>
        .error-block {
            background-color: #ff6666;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <form action="register.php" method="post">
        <div class="form-container">
            <?php 
            if (!empty($errors)) {
                echo '<div class="error-block">';
                foreach ($errors as $errorMsg) {
                    echo '<p>' . $errorMsg . '</p>';
                }
                echo '</div>';
            }
            ?>
            <img src="IMAGES/LOGO.png">
            <h1>Register Now</h1><br>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="password" name="cspassword" required placeholder="Confirm your password">
            <button type="submit">Register</button>
            <p>Already have an account? <a href="index.php">Sign In</a></p>
        </div>
    </form>
</body>
</html>
