<?php
session_start();
include("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(isset($_POST['send']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check)>0)
    {
       $otp = rand(1000,9999);

mysqli_query($conn,"UPDATE users SET otp='$otp' WHERE email='$email'");
$_SESSION['reset_email'] = $email;
echo "<script>
alert('Your OTP is: $otp');
window.location='verify_otp.php';
</script>";

        


try {
  $mail->isSMTP();
$mail->Host = 'smtp-relay.brevo.com';
$mail->SMTPAuth = true;
$mail->Username = 'xxxx';
$mail->Password = 'xxxx';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('secretcoder@gmail.com', 'E-Learning Website');
$mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset OTP';
    $mail->Body = "
        <h2>Password Reset</h2>
        <p>Your OTP is:</p>
        <h1>$otp</h1>
        <p>This OTP will expire in 50 minutes.</p>
    ";

    $mail->send();

    echo "<script>
        alert('OTP sent successfully');
        window.location='verify_otp.php';
    </script>";

} catch (Exception $e) {
    die("Mailer Error: " . $mail->ErrorInfo);
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/auth.css" rel="stylesheet">

</head>

<body>

<div class="forgot-wrapper">

    <!-- Left Side -->
    <div class="left-side">

        <img src="img/forgot_password1.png" alt="Forgot Password">

    </div>

    <!-- Right Side -->
    <div class="right-side">

        <form method="POST">

            <h1>Forgot<br>Your Password?</h1>

            <p class="subtitle">
                Don't worry! Enter your registered email address and we'll send you an OTP to reset your password.
            </p>

            <div class="mb-4">

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email Address"
                    required>

            </div>

            <button
                type="submit"
                name="send"
                class="btn btn-primary">

                SEND OTP

            </button>

            <div class="back">

                <a href="login.php">
                    ← Back to Login
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>