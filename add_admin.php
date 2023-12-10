<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 
    $email = $_POST['username'];
    $password = $_POST['password'];
    $verify = 1;

    
    $servername = "localhost";
    $username = "root";
    $dbpassword = ""; 
    $dbname = "phs_enrollment";


    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

  
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

 
    $sql = "INSERT INTO accounts (user_type, email, password, created_at, verify) 
            VALUES ('Admin', '$email', '$hashedPassword', NOW(), '$verify')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['add'] = "Admin added successfully";
    } else {
        $_SESSION['add'] = "Error: " . $sql . "<br>" . $conn->error;
    }

 
    $conn->close();

    // Redirect to the form page to display the session message
    header("Location: USERS.php");
    exit();
}

if(isset($_SESSION['add'])) //checking wether the session is set or not
			{
				echo $_SESSION['add']; //Display the session message if Set
				unset($_SESSION['add']); //Remove Session message
			}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

<form action="" method="POST">
			
			<table class="">
				
				<tr>
					<td> Email:</td>
					<td> <input type="text" name="username" placeholder="Email"></td>
				</tr>

				<tr>
					<td> Password:</td>
					<td> <input type="password" name="password" placeholder="Password"></td>
				</tr>
	
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-submit">
					</td>
				</tr>
			</table>
		</form>

</body>
</html>