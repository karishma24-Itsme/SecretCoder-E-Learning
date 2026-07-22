<?php
include("config.php");

session_start();

if(!isset($_SESSION['reset_email']))
{
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['reset_email'];
if(isset($_POST['update']))
{
    $newpassword = mysqli_real_escape_string($conn,$_POST['newpassword']);
    $confirmpassword = mysqli_real_escape_string($conn,$_POST['confirmpassword']);

    if($newpassword == $confirmpassword)
    {
        $sql = "UPDATE users SET password='$newpassword' WHERE email='$email'";

        if(mysqli_query($conn,$sql))
        {
            unset($_SESSION['reset_email']);
            echo "<script>
                    alert('Password Updated Successfully');
                    window.location='login.php';
                  </script>";
        }
        else
        {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    else
    {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/reset.css" rel="stylesheet">
</head>
<body>

<div class="reset-container">

    <form method="POST" class="reset-card">

        <div class="reset-logo">
            🔑
        </div>

        <h2>Reset Password</h2>

        <div class="input-box">
    <label>New Password</label>
    <input type="password" name="newpassword" placeholder="Password" required>
</div>

<div class="input-box">
    <label>Confirm New Password</label>
    <input type="password" name="confirmpassword" placeholder="Password" required>
</div>

<button type="submit" name="update" class="reset-btn">
    Update Password
</button>

    </form>

</div>
    

</body>
</html>