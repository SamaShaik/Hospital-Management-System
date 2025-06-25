<?php
session_start();
if (!isset($_SESSION['pid'])) {
    echo "<script>alert('Please log in first.'); window.location.href = 'index.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Patient Dashboard</title>
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
.container {
    max-width: 1000px;
    margin: 60px auto;
}
.card {
    background: #f9fafb;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
}
h3 {
    font-size: 28px;
    color: rgb(46, 49, 51) !important;
}
.row {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
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
h5 {
    font-size: 20px;
    color: rgb(64, 70, 77) !important;
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
.alert {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
}
</style>
</head>
<body>
<div class="navbar">
    <div>Global Hospital</div>
    <div><a href="logout.php">Logout</a></div>
</div>
<div class="container">
    <div class="card">
        <h3>Welcome <?php echo $_SESSION['username'] ?? 'Patient'; ?></h3>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert"><?php echo $_SESSION['success_message']; ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <div class="row">
            <div class="dashboard-option">
                <h5>Book Appointment</h5>
                <a href="appointment.php" class="btn">Go</a>
            </div>

            <div class="dashboard-option">
                <h5>View Appointments</h5>
                <a href="view-appointments.php" class="btn">Go</a>
            </div>

            <div class="dashboard-option">
                <h5>View Prescriptions</h5>
                <a href="viewprescription.php" class="btn">Go</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
