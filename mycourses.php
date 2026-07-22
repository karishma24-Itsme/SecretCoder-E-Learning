<?php
session_start();
include("config.php");

if(!isset($_SESSION['email']))
{
    header("Location:login.php");
    exit();
}

$email=$_SESSION['email'];

$user=mysqli_query($conn,"select * from users where email='$email'");
$userData=mysqli_fetch_assoc($user);
$user_id=$userData['id'];
$course=mysqli_query($conn,"select * from  purchases where user_id='$user_id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>My Courses</title>

<link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

<h2 class="mb-4">📚 My Purchased Courses</h2>

<a href="profile.php" class="btn btn-primary mb-3">
← Back to Dashboard
</a>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Course Name</th>

<th>Price</th>

<th>Purchase Date</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($course)>0)
{
    while($row=mysqli_fetch_assoc($course))
    {
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['course_name']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['purchase_data']; ?></td>

</tr>

<?php
    }
}
else
{
?>

<tr>

<td colspan="4" class="text-center">
No Course Purchased Yet
</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</body>

</html>