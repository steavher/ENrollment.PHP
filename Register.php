<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register Form</title>

	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-container">
	
	<form action="Register.php" method="post">
		<h3>Register Now</h3>
		<input type="text" name="name" required placeholder="Enter your Name">
		<input type="email" name="email" required placeholder="Enter your email">
		<input type="password" name="password" required placeholder="Enter your password">
		<input type="password" name="cspassword" required placeholder="Confirm your password">
		<select name="user_type">
			<option value="user">User</option>
			<option value="admin">Admin</option>
		</select>
	</form>
</div>
</body>
</html>
