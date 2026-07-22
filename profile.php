<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
include("config.php");

$email = $_SESSION['email'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);
$user_id = $user['id'];

$result = mysqli_query($conn,"SELECT COUNT(*) AS total FROM purchases WHERE user_id='$user_id'");
$data = mysqli_fetch_assoc($result);
$totalCourses = $data['total'];

$result2 = mysqli_query($conn,"SELECT SUM(price) AS total FROM purchases WHERE user_id='$user_id'");
$data2 = mysqli_fetch_assoc($result2);
$totalSpent = $data2['total'];

if($totalSpent==NULL){
    $totalSpent=0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="dashboard">

<div class="sidebar">

<div class="logo">
<h2>Secret<span>Coder</span></h2>
</div>

<div class="profile-box">
<img src="img/user.png" alt="">
<h3><?php echo $user['username']; ?></h3>
<p><?php echo $user['email']; ?></p>
</div>

<ul class="menu">
<li class="active"><a href="profile.php"><i class="fa fa-home"></i> Dashboard</a></li>
<li><a href="courses.php"><i class="fa fa-book"></i> Browse Courses</a></li>
<li><a href="mycourses.php"><i class="fa fa-graduation-cap"></i> My Courses</a></li>
<li><a href="payment.php"><i class="fa fa-wallet"></i> Payments</a></li>
<li><a href="editprofile.php"><i class="fa fa-user-pen"></i> Edit Profile</a></li>
<li><a href="logout.php"><i class="fa fa-right-from-bracket"></i> Logout</a></li>
</ul>

</div>

<div class="main">

<div class="topbar">
<div>
<h2>Welcome back, <?php echo $user['username']; ?> 👋</h2>
<p>Keep learning and grow your skills.</p>
</div>

<div class="top-right">
<i class="fa-regular fa-bell"></i>
<span class="username"><?php echo $user['username']; ?></span>
</div>
</div>

<div class="stats">
<div class="stat-card">
<i class="fa fa-book-open"></i>
<h3><?php echo $totalCourses; ?></h3>
<p>Enrolled Courses</p>
</div>

<div class="stat-card">
<i class="fa fa-wallet"></i>
<h3>₹<?php echo $totalSpent; ?></h3>
<p>Total Spent</p>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="myChart"></canvas>
<script src="dashboard.js"></script>
</body>
</html>