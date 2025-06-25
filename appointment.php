<?php
session_start();
if (!isset($_SESSION['pid'])) {
    header("Location: index.php");
    exit();
}

$con = mysqli_connect("localhost", "root", "", "myhmsdb");

$error_message = ""; 
$success_message = ""; 

if (isset($_POST['entry_submit'])) {
    $pid     = $_SESSION['pid'];
    $fname   = $_POST['fname'];
    $lname   = $_POST['lname'];
    $email   = $_POST['email'];
    $contact = $_POST['contact'];
    $doctor  = $_POST['doctor'];

    $fees_query = mysqli_query($con, "SELECT docFees FROM doctb WHERE username='$doctor'");
    $row = mysqli_fetch_array($fees_query);
    $docFees = $row['docFees'];

    $appdate  = $_POST['appdate'];
    $apptime  = $_POST['apptime'];
    $payment  = $_POST['payment'];
    $symptoms = $_POST['symptoms'];

    $gender = $_SESSION['gender'] ?? '';

    if (strtotime($appdate) < strtotime(date('Y-m-d'))) {
        $error_message = "Error: Appointment date must be today or later.";
    } elseif ($apptime < '08:00' || $apptime > '18:00') {
        $error_message = "Error: Appointment time must be between 08:00 and 18:00.";
    } else {
        $query = "INSERT INTO appointmenttb(pid, fname, lname, gender, email, contact, doctor, docFees, appdate, apptime, symptoms, userStatus, doctorStatus, payment) 
                  VALUES ('$pid', '$fname', '$lname', '$gender', '$email', '$contact', '$doctor', '$docFees', '$appdate', '$apptime', '$symptoms', 1, 1, '$payment')";
        $result = mysqli_query($con, $query);
        if ($result) {
            $_SESSION['success_message'] = "Appointment successfully booked.";
            header("Location: patient-dashboard.php");
            exit();
        } else {
            $error_message = "Error booking appointment. Try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            margin: 0;
            padding: 60px 0;
        }
        .navbar {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }
        .card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: 80px auto 30px auto;
        }
        h2 {
            text-align: center;
            color: rgb(46, 49, 51);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 14px;
            color: rgb(46, 49, 51);
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #3c50c1;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #2e3d9c;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            color: rgb(46, 49, 51);
            font-size: 15px;
            font-family: Arial, sans-serif;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
<div class="navbar">
    <a href="#">Global Hospital</a>
    <a href="logout.php">Logout</a>
</div>

<div class="card">
    <h2>Book Appointment</h2>

    <?php if ($error_message): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="fname" class="form-control" required value="<?php echo $_SESSION['fname']; ?>">
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="lname" required value="<?php echo $_SESSION['lname']; ?>">
        </div>
        <div class="form-group">
            <label>Email ID:</label>
            <input type="email" name="email" required value="<?php echo $_SESSION['email']; ?>">
        </div>
        <div class="form-group">
            <label>Contact:</label>
            <input type="text" name="contact" required value="<?php echo $_SESSION['contact']; ?>">
        </div>
        <div class="form-group">
            <label>Select Doctor:</label>
            <select name="doctor" required>
                <option value="" disabled selected>--Select Doctor--</option>
                <?php
                $doc_query = mysqli_query($con, "SELECT * FROM doctb");
                while ($doc = mysqli_fetch_assoc($doc_query)) {
                    $selected = (isset($_POST['doctor']) && $_POST['doctor'] == $doc['username']) ? 'selected' : '';
                    echo '<option value="' . $doc['username'] . '" ' . $selected . '>'
                          . $doc['username'] . ' (' . $doc['spec'] . ', ₹' . $doc['docFees'] . ')</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Symptoms / Disease:</label>
            <textarea name="symptoms" required><?php echo $_POST['symptoms'] ?? ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Appointment Date:</label>
            <input type="date" name="appdate" required value="<?php echo $_POST['appdate'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label>Appointment Time:</label>
            <input type="time" name="apptime" required value="<?php echo $_POST['apptime'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label>Payment:</label>
            <select name="payment" required>
                <option value="" disabled selected>--Select Payment Status--</option>
                <option value="Paid" <?php echo (isset($_POST['payment']) && $_POST['payment'] == 'Paid') ? 'selected' : ''; ?>>Paid</option>
                <option value="Pay later" <?php echo (isset($_POST['payment']) && $_POST['payment'] == 'Pay later') ? 'selected' : ''; ?>>Pay later</option>
            </select>
        </div>
        <button type="submit" name="entry_submit" class="btn-primary">Book Appointment</button>
    </form>
</div>
</body>
</html>
