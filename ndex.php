<?php
session_start(); // Start the session

// Database connection parameters
$hostname = "localhost";
$username = "root";
$password = "";
$database = "phs_enrollment";

// Establish a connection to the database
$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

$errors = [];
// ... Your existing PHP code ...

// Check if the email and password are provided in the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... Your existing code ...

    // Validate reCAPTCHA
    $recaptchaSecretKey = "YOUR_SECRET_KEY"; // Replace with your Secret Key
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse";
    $recaptchaResult = json_decode(file_get_contents($recaptchaUrl));

    if (!$recaptchaResult->success) {
        $errors[] = "reCAPTCHA verification failed. Please try again.";
        $_SESSION['message'] = "reCAPTCHA verification failed. Please try again.";
    } else {
        // reCAPTCHA verification successful, continue with your existing login logic.
        // ... Your existing code ...
    }
}

// Check if the email and password are provided in the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Sanitize user input
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Check for specific email addresses to redirect to the admin dashboard
        $adminEmails = array('phs_admin', 'phs_admin1', 'phs_admin2');
        if (in_array($email, $adminEmails)) {
            // For admin email addresses, check the password directly
            $adminPassword = getPasswordForAdminEmail($email, $conn);
        
            if (password_verify($password, $adminPassword)) {
                // Redirect to the admin dashboard
                header("Location: admin_dashboard.php");
                exit();
            } else {
                // Incorrect password for admin email
                $errors[] = "Incorrect email or password";
                $_SESSION['message'] = "Incorrect email or password";
            }
        } else {
            // Query to check if the email exists in the "accounts" table
            $query = "SELECT * FROM accounts WHERE Email = '$email'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result) == 0) {
                // Email does not exist in the database
                $errors[] = "Email does not exist";
                $_SESSION['message'] = "Email does not exist";
            } else {
                // Email exists, check the password
                $user = mysqli_fetch_assoc($result);
                $hashedPassword = $user['Password']; // Assuming you store hashed passwords in the database

                if (password_verify($password, $hashedPassword)) {
                    if ($user['verify'] == 0) {
                        // Account not yet verified
                        $errors[] = "Account not yet verified, please verify to log in";
                        $_SESSION['message'] = "Account not yet verified, please verify to log in";
                    } else {
                        // Redirect to the user's dashboard
                        header("Location: dashboard.html");
                        exit();
                    }
                } else {
                    // Incorrect password for regular user
                    $errors[] = "Incorrect email or password";
                    $_SESSION['message'] = "Incorrect email or password";
                }
            }
        }
    } else {
        // Handle the case where email and password are not set in the POST request
        $errors[] = "Email and password are required";
        $_SESSION['message'] = "Email and password are required";
    }
}

function getPasswordForAdminEmail($email, $conn) {
    $query = "SELECT Password FROM accounts WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    return $user['Password'];
}   

mysqli_close($conn);
?>

<?php
$recaptchaSiteKey = ($_SERVER['HTTP_HOST'] === 'localhost') ? '6Ldx_AkpAAAAAESRHtPOXPx0Rkar8yTwsGpcV4Oz' : '6Ldx_AkpAAAAAA2cyNPX9rud9aRfExJ80zxfo-u7
';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
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

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="login-container">
            <?php
            if (!empty($errors)) {
                echo '<div class="error-block">';
                foreach ($errors as $errorMsg) {
                    echo '<p>' . $errorMsg . '</p>';
                }
                echo '</div>';
            }
            ?>
            <img src="LOGO.png">

            <h1>LOGIN</h1>

            <input type="text" name="email" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="g-recaptcha" data-sitekey="<?php echo $recaptchaSiteKey; ?>"></div>

            <button type="submit">Login</button> <br>
            <p> Don't have an account? <a href="Register.php">Register</a>
        </div>
    </form>

    <script src="https://www.recaptcha.net/recaptcha/api.js"></script>


</body>
</html>
