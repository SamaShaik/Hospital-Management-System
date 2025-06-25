<?php
session_start();
if (!isset($_SESSION['pid'])) {
    echo "<script>alert('Please log in first.'); window.location.href = 'index.php';</script>";
    exit();
}
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
$pid = $_SESSION['pid'];

$query = "SELECT * FROM appointmenttb WHERE pid='$pid' ORDER BY appdate DESC, apptime DESC";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Appointment History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #3931af, #00c6ff);
            padding: 30px;
            margin: 0;
        }
        .card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0,0,0,.2);
        }
        h2 {
            text-align: center;
            font-size: 30px;
            color: #34495E;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 16px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a.btn {
            display: block;
            text-align: center;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            background-color: #007bff;
            margin: 20px auto 0 auto;
            max-width: 300px;
        }
        a.btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="card">
    <h2>My Appointment History</h2>
    <table>
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Specialization</th>
                <th>Fees</th>
                <th>Date</th>
                <th>Time</th>
                <th>Payment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result)) {
                $doctor = $row['doctor'];
                $specQuery = mysqli_query($con, "SELECT spec FROM doctb WHERE username='$doctor'");
                $specRow = mysqli_fetch_assoc($specQuery);
                $spec = $specRow['spec'] ?? 'N/A';
                $status = ($row['userStatus'] == 1 && $row['doctorStatus'] == 1) ? "Active" :
                           ($row['userStatus'] == 0 ? "Cancelled by You" : "Cancelled by Doctor");
                
                echo "<tr>
                    <td>{$doctor}</td>
                    <td>{$spec}</td>
                    <td>₹{$row['docFees']}</td>
                    <td>{$row['appdate']}</td>
                    <td>{$row['apptime']}</td>
                    <td>{$row['payment']}</td>
                    <td>{$status}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="patient-dashboard.php" class="btn">← Back to Patient Panel</a>
</div>
</body>
</html>
