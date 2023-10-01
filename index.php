<?php ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=content-width, initial scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="login.php">

        <h1>LOGIN</h1>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?> </p>
        <?php } ?>
 
        <input type="text" name="Username" placeholder="Username" required> <br>
        <input type="password" name="Password" placeholder="Password" required> <br>
        <button type="Submit">Login</button>
    
    </form> 

</body>
</html>
