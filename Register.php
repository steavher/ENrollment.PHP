<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register Form</title>

	<link rel="stylesheet" href="CSS/Register.css">
</head>
<body>

	<form action="Register.php" method="post">
		<div class="form-container">

		<?php 
		 if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            }
        }
        ?>
	
		<h1>Register Now</h1><br><select name="user_type">
			<option value="user">User</option>
			<option value="admin">Admin</option>
		</select> <br>
		<input type="text" name="name" required placeholder="Enter your Name">
		<input type="email" name="email" required placeholder="Enter your email">
		<input type="password" name="password" required placeholder="Enter your password">
		<input type="password" name="cspassword" required placeholder="Confirm your password">
		<button type="submit">Register</button>
		<p>Already have an account? <a href="ndex.php">Sign In</a></p>
	</form>
</div>
</body>
</html>
