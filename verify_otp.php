<?php
session_start();
include("config.php");

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['reset_email'];

if (isset($_POST['verify'])) {

    $otp = mysqli_real_escape_string($conn, $_POST['otp1'].$_POST['otp2'].$_POST['otp3'].$_POST['otp4']);

    $check = mysqli_query($conn, "SELECT * FROM users 
    WHERE email='$email' 
    AND otp='$otp'
     ");

    if (mysqli_num_rows($check) > 0) {

        header("Location: reset_password.php");
        exit();

    } else {

        echo "<script>alert('Invalid or Expired OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="css/otp.css" rel="stylesheet">
</head>
<body>

<div class="otp-container">

    <form method="POST" class="otp-card">

        <div class="otp-logo">
            🔒
        </div>

        <h2>Enter Verification Code</h2>

        <p class="subtitle">
            We've sent a verification code to your registered email.
        </p>

        <div class="otp-inputs">
            <input type="text" maxlength="1" name="otp1" required>
            <input type="text" maxlength="1" name="otp2" required>
            <input type="text" maxlength="1" name="otp3" required>
            <input type="text" maxlength="1" name="otp4" required>
        </div>

        <p class="resend">
            Didn't get a code?
            <a href="forgot_password.php">Resend</a>
        </p>

        <div class="button-group">
            <a href="forgot_password.php" class="cancel-btn">Cancel</a>

            <button type="submit" name="verify" class="verify-btn">
                Verify
            </button>
        </div>

    </form>

</div>
<script src="js/otp.js"></script>
</body>
</html>