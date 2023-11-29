<?php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = "Student";
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <style>
        .error-block {
            background-color: #ff6666;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
        }
         /* Add some styling for the eye icon */
         .password-container {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 50px;
            transform: translateY(-50%);
            cursor: pointer;
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
            <div class="password-container">
                <input type="password" name="password" id="password" required placeholder="Enter your password">
                <i class="eye-icon" onclick="togglePassword('password')"><i id="password-icon" class="far fa-eye"></i></i>
            </div>
            
            <!-- Confirm Password input with font awesome eye icon -->
            <div class="password-container">
                <input type="password" name="cspassword" id="cspassword" required placeholder="Confirm your password">
                <i class="eye-icon" onclick="togglePassword('cspassword')"><i id="cspassword-icon" class="far fa-eye"></i></i>
            </div>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="ndex.php">Sign In</a></p>
        </div>
    </form>
    <script>
        function togglePassword(inputId) {
            var x = document.getElementById(inputId);
            var icon = document.getElementById(inputId + "-icon");

            if (x.type === "password") {
                x.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                x.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
