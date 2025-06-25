<?php
$con = mysqli_connect("localhost","root","","myhmsdb");

if(isset($_POST['docsub'])) {
    $doctor = $_POST['doctor'];
    $dpassword = $_POST['dpassword'];
    $demail = $_POST['demail'];
    $spec = $_POST['special'];
    $docFees = $_POST['docFees'];
    $query = "INSERT INTO doctb(username, password, email, spec, docFees) VALUES ('$doctor','$dpassword','$demail','$spec','$docFees')";
    $result = mysqli_query($con, $query);
    if($result) {
        echo "<script>alert('Doctor added successfully!');</script>";
    }
}

if(isset($_POST['docsub1'])) {
    $demail = $_POST['demail'];
    $query = "DELETE FROM doctb WHERE email='$demail'";
    $result = mysqli_query($con, $query);
    if($result) {
        echo "<script>alert('Doctor removed successfully!');</script>";
    } else {
        echo "<script>alert('Unable to delete!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<style>
body {
    font-family: Arial, sans-serif;
}
.navbar {
    background: #3931af;
    color: #fff;
    padding: 15px;
}
.sidebar {
    float: left;
    width: 20%;
}
.sidebar a {
    display: block;
    padding: 10px;
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #ccc;
}
.sidebar a.active {
    background-color: #3931af;
    color: #fff;
}
.content {
    float: left;
    width: 75%;
    padding: 20px;
}
.tab-pane {
    display: none;
}
.tab-pane.active {
    display: block;
}
table {
    border-collapse: collapse;
    width: 100%;
}
table, th, td {
    border: 1px solid #ccc;
}
th, td {
    padding: 8px;
}
h3 {
    font-size: 20px;
}
.btn {
    padding: 6px 12px;
    cursor: pointer;
}
</style>
<script>
function showTab(tabId) {
    var tabs = document.querySelectorAll('.tab-pane');
    tabs.forEach(tab => tab.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');

    var links = document.querySelectorAll('.sidebar a');
    links.forEach(link => link.classList.remove('active'));
    document.querySelector('.sidebar a[href="#' + tabId + '"]').classList.add('active');
}
</script>
</head>
<body>
<div class="navbar">Admin Panel</div>
<div class="sidebar">
    <a href="#list-dash" class="active"onclick="showTab('list-dash')">Dashboard</a>
    <a href="#list-doc"onclick="showTab('list-doc')">Doctor List</a>
    <a href="#list-pat"onclick="showTab('list-pat')">Patient List</a>
    <a href="#list-app"onclick="showTab('list-app')">Appointment Details</a>
    <a href="#list-pres"onclick="showTab('list-pres')">Prescription List</a>
    <a href="#list-settings"onclick="showTab('list-settings')">Add Doctor</a>
    <a href="#list-settings1"onclick="showTab('list-settings1')">Delete Doctor</a>
</div>

<div class="content">

<div id="list-dash" class="tab-pane active">
    <h3>Welcome to Admin Dashboard</h3>
    <p>Use the sidebar links to navigate between sections.</p>
</div>

<div id="list-doc" class="tab-pane">
    <h3>Doctor List</h3>
    <table>
        <tr><th>Name</th><th>Specialization</th><th>Email</th><th>Password</th><th>Fees</th></tr>
        <?php
        $result = mysqli_query($con, "SELECT * FROM doctb");
        while($row = mysqli_fetch_array($result)) {
            echo "<tr><td>{$row['username']}</td><td>{$row['spec']}</td><td>{$row['email']}</td><td>{$row['password']}</td><td>{$row['docFees']}</td></tr>";
        }
        ?>
    </table>
</div>

<div id="list-pat" class="tab-pane">
    <h3>Patient List</h3>
    <table>
        <tr><th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Contact</th><th>Password</th></tr>
        <?php
        $result = mysqli_query($con, "SELECT * FROM patreg");
        while($row = mysqli_fetch_array($result)) {
            echo "<tr><td>{$row['pid']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['gender']}</td><td>{$row['email']}</td><td>{$row['contact']}</td><td>{$row['password']}</td></tr>";
        }
        ?>
    </table>
</div>

<div id="list-app" class="tab-pane">
    <h3>Appointment List</h3>
    <table>
        <tr><th>Appointment ID</th><th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Contact</th><th>Doctor</th><th>Fees</th><th>Date</th><th>Time</th><th>Status</th></tr>
        <?php
        $result = mysqli_query($con, "SELECT * FROM appointmenttb");
        while($row = mysqli_fetch_array($result)) {
            $status = '';
            if($row['userStatus']==1 && $row['doctorStatus']==1) $status = "Active";
            if($row['userStatus']==0 && $row['doctorStatus']==1) $status = "Cancelled by Patient";
            if($row['userStatus']==1 && $row['doctorStatus']==0) $status = "Cancelled by Doctor";

            echo "<tr><td>{$row['ID']}</td><td>{$row['pid']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['gender']}</td><td>{$row['email']}</td><td>{$row['contact']}</td><td>{$row['doctor']}</td><td>{$row['docFees']}</td><td>{$row['appdate']}</td><td>{$row['apptime']}</td><td>$status</td></tr>";
        }
        ?>
    </table>
</div>

<div id="list-pres" class="tab-pane">
    <h3>Prescription List</h3>
    <table>
        <tr><th>Doctor</th><th>Patient ID</th><th>Appointment ID</th><th>First Name</th><th>Last Name</th><th>App Date</th><th>App Time</th><th>Disease</th><th>Allergy</th><th>Prescription</th></tr>
        <?php
        $result = mysqli_query($con, "SELECT * FROM prestb");
        while($row = mysqli_fetch_array($result)) {
            echo "<tr><td>{$row['doctor']}</td><td>{$row['pid']}</td><td>{$row['ID']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['appdate']}</td><td>{$row['apptime']}</td><td>{$row['disease']}</td><td>{$row['allergy']}</td><td>{$row['prescription']}</td></tr>";
        }
        ?>
    </table>
</div>

<div id="list-settings" class="tab-pane">
    <h3>Add Doctor</h3>
    <form method="POST">
        Name: <input type="text" name="doctor" required><br><br>
        Specialization:
        <select name="special">
            <option value="General">General</option>
            <option value="Cardiologist">Cardiologist</option>
            <option value="Neurologist">Neurologist</option>
            <option value="Pediatrician">Pediatrician</option>
        </select><br><br>
        Email: <input type="email" name="demail" required><br><br>
        Password: <input type="password" name="dpassword" required><br><br>
        Fees: <input type="text" name="docFees" required><br><br>
        <input type="submit" name="docsub" value="Add Doctor" class="btn">
    </form>
</div>

<div id="list-settings1" class="tab-pane">
    <h3>Delete Doctor</h3>
    <form method="POST">
        Email: <input type="email" name="demail" required><br><br>
        <input type="submit" name="docsub1" value="Delete Doctor" class="btn">
    </form>
</div>
</body>
</html>
