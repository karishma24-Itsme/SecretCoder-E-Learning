<?php
session_start();
include("config.php");

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

if(isset($_POST['update']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $update = mysqli_query($conn,"UPDATE users SET username='$username', password='$password' WHERE email='$email'");

    if($update)
    {
        echo "<script>
        alert('Profile Updated Successfully');
        window.location='profile.php';
        </script>";
    }
    else
    {
        echo "<script>alert('Update Failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Edit Profile</title>

<link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

<div class="card shadow p-4">

<h2>Edit Profile</h2>

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input type="text"
class="form-control"
name="username"
value="<?php echo $user['username']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
class="form-control"
value="<?php echo $user['email']; ?>"
readonly>

</div>

<div class="mb-3">

<label>New Password</label>

<input type="password"
class="form-control"
name="password"
value="<?php echo $user['password']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

Update Profile

</button>

<a href="profile.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</body>

</html>