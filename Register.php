<?php
session_start();
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cspassword = $_POST['cspassword'];

    if ($user_type == "Admin" && strpos($email, '@outlook') === false) {
        $error[] = "Incorrect Email Domain";
    } elseif ($user_type == "Student" && strpos($email, '@gmail') === false) {
        $error[] = "Incorrect Email Domain";
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || preg_match('/[^A-Za-z0-9]/', $password)) {
        $error[] = "Password should be 8 characters long, a combination of uppercase and lowercase letters with numbers, and no special characters.";
    }

    if ($password != $cspassword) {
        $error[] = "Passwords do not match.";
    }

    if (empty($error)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Insert user data into the database (replace with your database connection code)
        $conn = new mysqli("localhost", "root", "", "phs_enrollment");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $stmt = $conn->prepare("INSERT INTO accounts (user_type, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_type, $email, $hashed_password);
    
        if ($stmt->execute()) {
            // Redirect to a verification page (verification.php)
            header("Location:verification.php");
            exit();
        } else {
            $error[] = "Error: " . $conn->error;
        }
    
        $stmt->close();
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
            if (!empty($error)) {
                echo '<div class="error-block">';
                foreach ($error as $errorMsg) {
                    echo '<p>' . $errorMsg . '</p>';
                }
                echo '</div>';
            }
            ?>
            <h1>Register Now</h1><br>
            <select name="user_type">
                <option value="Student">Student</option>
                <option value="Admin">Admin</option>
            </select> <br>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="password" name="cspassword" required placeholder="Confirm your password">
            <button type="submit">Register</button>
            <p>Already have an account? <a href="index.php">Sign In</a></p>
        </div>
    </form>
</body>
</html>
