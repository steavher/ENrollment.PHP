
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>
</head>
<style>
    body {
        background-image: url("./IMAGES/FINAL.png");
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
</style>
<body>
    <form method="post">
        <?php if (!empty($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>

        <h1>OTP Verification</h1> <br>
        <label>Verification Code</label> <br>
        <h3>Please Input Verification Code sent to </h3> <hr><hr>

        <input type="number" name="vercode">

        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
