<?php

if (isset($_POST['Username']) && isset($_POST['Password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Username = validate($_POST['Username']);
    $Password = validate($_POST['Password']);

    if (empty($Username)) {
        header("Location: index.php?error=Username is required");
        exit();
    } else if (empty($Password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        echo "Invalid Input";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
