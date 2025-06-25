<?php
session_start();
include('func1.php');
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

if (!isset($_SESSION['dname'])) {
    header("Location: index.php");
    exit();
}
$doctor = $_SESSION['dname'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Doctor Panel</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #3931af, #00c6ff);
    margin: 0;
    padding: 0;
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(to right, #3931af, #00c6ff);
    padding: 15px 30px;
    color: #fff;
    font-size: 18px;
}
.navbar a {
    color: #fff;
    text-decoration: none;
}
.navbar a:hover {
    text-decoration: underline;
}
.content {
    display: flex;
    justify-content: center;
    padding: 50px;
}
.main {
    flex-grow: 1;
    max-width: 1000px;
}
h3 {
    text-align: center;
    font-size: 30px;
    color: #2e3133;
}
.card {
    background: #f9fafb;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
}
.row {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin: 30px 0;
}
.dashboard-option {
    flex: 1;
    max-width: 250px;
    background: #fff;
    padding: 25px;
    margin: 15px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0px 0px 10px rgba(0,0,0,.1);
    transition: transform .3s;
}
.dashboard-option:hover {
    transform: translateY(-5px);
}
.dashboard-option h5 {
    font-size: 20px;
    color: #40464d;
}
.btn {
    background-color: #3931af;
    color: #fff;
    padding: 8px 16px;
    font-size: 14px;
    text-decoration: none;
    border-radius: 4px;
}
.btn:hover {
    background-color: #2d258a;
}
</style>
</head>
<body>
<div class="navbar">
    <div>Global Hospital</div>
    <div><a href="logout.php">Logout</a></div>
</div>
<div class="content">
    <div class="main">
        <h3>Welcome, <?php echo htmlentities($doctor); ?></h3>
        <div class="card">
            <div class="row">
                <div class="dashboard-option">
                    <h5>View Appointments</h5>
                    <a href="doctor-appointment.php" class="btn">Go</a>
                </div>
                <div class="dashboard-option">
                    <h5>Prescribe Patient</h5>
                    <a href="prescribe.php" class="btn">Go</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
