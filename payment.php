<?php
session_start();
include("config.php");

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'];

$query = mysqli_query($conn,"select * from users where email='$email'");
$user = mysqli_fetch_assoc($query);

if(isset($_POST['pay']))
{
   $course = $_POST['course'];
$price = $_POST['price'];

mysqli_query($conn,"insert into purchases(user_id, course_name, price, purchase_data)
values(
'{$user['id']}',
'$course',
'$price',
NOW()
)");
echo "<script>
    alert('Payment Successful!');
    window.location='mycourses.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Payment</title>

<link rel="stylesheet" href="css/bootstrap.min.css">

<style>
body{
    background:#f4f6f9;
}
.card{
    max-width:500px;
    margin:50px auto;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 0px 15px rgba(0,0,0,.2);
}
</style>

</head>

<body>

<div class="card">

<h2 class="text-center mb-4">💳 Payment</h2>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" class="form-control"
value="<?php echo $user['username']; ?>" readonly>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" class="form-control"
value="<?php echo $user['email']; ?>" readonly>
</div>

<div class="mb-3">
<label>Course Name</label>
<input type="text"
class="form-control"
value="<?php echo isset($_GET['course']) ? $_GET['course'] : ''; ?>">
<input type="hidden" name="course" value="<?php echo isset($_GET['course']) ? $_GET['course'] : ''; ?>">
</div>

<div class="mb-3">
<label>Amount (₹)</label>
<input type="text"
class="form-control"
value="<?php echo isset($_GET['price']) ? $_GET['price'] : ''; ?>">
<input type="hidden" name="price" value="<?php echo isset($_GET['price']) ? $_GET['price'] : ''; ?>">
</div>
<button
type="submit"
name="pay"
class="btn btn-success w-100">

Pay Now

</button>

<br><br>

<a href="profile.php"
class="btn btn-secondary w-100">

Back to Dashboard

</a>

</form>

</div>

</body>
</html>