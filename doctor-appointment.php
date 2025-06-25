<?php
session_start();
include('func1.php');

$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!isset($_SESSION['dname'])) {
    header("Location: index.php");
    exit();
}
$doctor = $_SESSION['dname'];

if(isset($_GET['cancel']) && isset($_GET['ID'])) {
    $id = mysqli_real_escape_string($con, $_GET['ID']);
    $query = mysqli_query($con, "UPDATE appointmenttb SET doctorStatus='0' WHERE ID='$id'");
    if($query) {
        echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Appointments</title>
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
    max-width: 1000px;
    margin: 40px auto;
}
.card {
    background: #f9fafb;
    padding: 30px;
    border-radius: 10px;
}
.table-container {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin: 10px 0;
}
table th, table td {
    border: 1px solid #ccc;
    padding: 8px;
}
table th {
    background: #f4f4f4;
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
    <div class="card">
        <h3>Appointments</h3>
        <div class="table-container">
            <table>
                <tr>
                    <th>Patient ID</th><th>Appointment ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Contact</th><th>Date</th><th>Time</th><th>Symptoms</th><th>Current Status</th><th>Action</th><th>Prescribe</th>
                </tr>
                <?php
                $res = mysqli_query($con, "SELECT * FROM appointmenttb WHERE doctor='" . mysqli_real_escape_string($con, $doctor) . "'");
                while($row = mysqli_fetch_array($res)):
                    $check = mysqli_query($con, "SELECT * FROM prestb WHERE pid = '{$row['pid']}' AND ID = '{$row['ID']}'");
                    $is_prescribed = mysqli_num_rows($check) > 0;

                    $status = '';
                    if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1) $status = 'Active';
                    elseif ($row['userStatus'] == 0 && $row['doctorStatus'] == 1) $status = 'Cancelled by Patient';
                    elseif ($row['userStatus'] == 1 && $row['doctorStatus'] == 0) $status = 'Cancelled by You';
                ?>
                <tr>
                    <td><?= $row['pid'] ?></td><td><?= $row['ID'] ?></td><td><?= $row['fname'] ?></td><td><?= $row['lname'] ?></td><td><?= $row['gender'] ?></td><td><?= $row['email'] ?></td><td><?= $row['contact'] ?></td><td><?= $row['appdate'] ?></td><td><?= $row['apptime'] ?></td><td><?= $row['symptoms'] ?></td><td><?= $status ?></td>
                    <td>
                        <?php if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1): ?>
                            <?php if ($is_prescribed): ?>
                                Prescribed
                            <?php else: ?>
                                <a href="?ID=<?= $row['ID'] ?>&cancel=1" onClick="return confirm('Are you sure?')">Cancel</a>
                            <?php endif; ?>
                        <?php else: ?>
                            Cancelled
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1): ?>
                            <?php if ($is_prescribed): ?>
                                Prescribed
                            <?php else: ?>
                                <a href="prescribe.php?pid=<?= $row['pid']; ?>&ID=<?= $row['ID']; ?>&fname=<?= $row['fname']; ?>&lname=<?= $row['lname']; ?>&appdate=<?= $row['appdate']; ?>&apptime=<?= $row['apptime']; ?>">Prescribe</a>
                            <?php endif; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <div style="margin: 20px 0; text-align: center;">
            <a href="doctor-panel.php" class="btn">← Back to Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
