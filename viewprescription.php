<?php
session_start();
if (!isset($_SESSION['pid'])) {
    header("Location: index.php");
    exit();
}
include('func1.php');
$pid = $_SESSION['pid'];

$query = mysqli_query($con, "SELECT * FROM prestb WHERE pid = '$pid' ORDER BY appdate DESC, apptime DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Prescriptions</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(90deg, #3931af, #00c6ff);
        margin: 0;
        padding: 0;
    }
    .navbar {
        background: linear-gradient(90deg, #3931af, #00c6ff);
        padding: 15px;
        color: #fff;
        font-size: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .navbar a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }
    .container {
        display: flex;
        padding: 30px;
        gap: 20px;
    }
    .sidebar {
        flex: 0 0 200px;
        padding: 15px;
        background-color: #fff;
        border-radius: 10px;
        align-self: flex-start;
    }
    .sidebar a {
        display: block;
        padding: 12px;
        text-decoration: none;
        font-size: 16px;
        color: #333;
        border-bottom: 1px solid #eee;
    }
    .sidebar a.active {
        background-color: #342ac1;
        color: #fff;
    }
    .main {
        flex: 1;
    }
    .card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0px 0px 10px rgba(0,0,0,.2);
    }
    h3 {
        text-align: center;
        color: #000;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }
    table, th, td {
        border: 1px solid #dee2e6;
    }
    th {
        background-color: #007bff;
        color: #fff;
        padding: 12px;
    }
    td {
        padding: 12px;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .no-prescriptions {
        text-align: center;
        font-size: 16px;
        padding: 20px;
        color: #555;
    }
</style>

</head>
<body>
    <div class="navbar">
        <div>Global Hospital</div>
        <div><a href="logout.php">Logout</a></div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="patient-dashboard.php">Dashboard</a>
            <a href="appointment.php">Book Appointment</a>
            <a href="view-appointments.php">View Appointments</a>
            <a class="active" href="#">View Prescriptions</a>
        </div>
        <div class="main">
            <div class="card">
                <h3>My Prescriptions</h3>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <table>
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Doctor</th>
                            <th>Disease</th>
                            <th>Allergy</th>
                            <th>Prescription</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['appdate']) ?></td>
                            <td><?= htmlspecialchars($row['apptime']) ?></td>
                            <td><?= htmlspecialchars($row['doctor']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['disease'])) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['allergy'])) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['prescription'])) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-prescriptions">No prescriptions found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
