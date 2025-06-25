<?php
session_start();
include('func1.php');

$pid = '';
$ID = '';
$appdate = '';
$apptime = '';
$fname = '';
$lname = '';
$doctor = $_SESSION['dname'];

if(isset($_GET['pid'], $_GET['ID'], $_GET['appdate'], $_GET['apptime'], $_GET['fname'], $_GET['lname'])) {
    $pid = $_GET['pid'];
    $ID = $_GET['ID'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $appdate = $_GET['appdate'];
    $apptime = $_GET['apptime'];
}

if(isset($_POST['prescribe'], $_POST['pid'], $_POST['ID'], $_POST['appdate'], $_POST['apptime'], $_POST['lname'], $_POST['fname'])) {
    $appdate = $_POST['appdate'];
    $apptime = $_POST['apptime'];
    $disease = $_POST['disease'];
    $allergy = $_POST['allergy'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pid = $_POST['pid'];
    $ID = $_POST['ID'];
    $prescription = $_POST['prescription'];

    $query = mysqli_query($con, "INSERT INTO prestb (doctor, pid, ID, fname, lname, appdate, apptime, disease, allergy, prescription) VALUES ('$doctor','$pid','$ID','$fname','$lname','$appdate','$apptime','$disease','$allergy','$prescription')");
    if($query) {
        echo "<script>alert('Prescribed successfully!');</script>";
    } else {
        echo "<script>alert('Unable to process your request. Try again!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Prescribe</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #3931af, #00c6ff);
    padding: 50px;
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* background: linear-gradient(to right, #3931af, #00c6ff); */
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
    margin: 30px auto;
    background: #f9fafb;
    padding: 30px;
    border-radius: 10px;
}
h3 {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}
label {
    font-size: 16px;
}
textarea {

    width: 100%;
    margin-bottom: 15px;
}
.btn {
    background-color: #3931af;
    color: #fff;
    padding: 10px 16px;
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
    <a href="doctor-panel.php">← Back</a>  
    <a href="logout.php">Logout</a>
</div>
<div class="container">
    <h3>Welcome, <?php echo htmlentities($doctor); ?></h3>
    <form method="post" action="prescribe.php">
        <div>
            <label>Disease:</label><br/>
            <textarea id="disease" rows="4" cols="50" name="disease" required></textarea>
        </div>
        <div>
            <label>Allergies:</label><br/>
            <textarea id="allergy" rows="4" cols="50" name="allergy" required></textarea>
        </div>
        <div>
            <label>Prescription:</label><br/>
            <textarea id="prescription" rows="4" cols="50" name="prescription" required></textarea>
        </div>
        <input type="hidden" name="fname" value="<?php echo $fname; ?>">
        <input type="hidden" name="lname" value="<?php echo $lname; ?>">
        <input type="hidden" name="appdate" value="<?php echo $appdate; ?>">
        <input type="hidden" name="apptime" value="<?php echo $apptime; ?>">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
        <div style="text-align: center;">
            <input type="submit" name="prescribe" value="Prescribe" class="btn">
        </div>
    </form>
</div>
</body>
</html>
