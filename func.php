<?php
// =========================== START SESSION ==========================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// =========================== DATABASE CONNECTION ===================
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// =========================== LOGIN HANDLING =========================
if (isset($_POST['role'])) {
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ---- PATIENT LOGIN ----
    if ($role === 'patient') {
        $query = "SELECT * FROM patreg WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['pid'] = $row['pid'];
            $_SESSION['username'] = $row['fname'] . " " . $row['lname'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['contact'] = $row['contact'];
            $_SESSION['email'] = $row['email'];
            header("Location: patient-dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid Patient Credentials'); window.location.href='index.php';</script>";
        }
    }

    // ---- DOCTOR LOGIN ----
    elseif ($role === 'doctor') {
        $query = "SELECT * FROM doctb WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['dname'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("Location: doctor-panel.php");
            exit();
        } else {
            echo "<script>alert('Invalid Doctor Credentials'); window.location.href='index.php';</script>";
        }
    }

    // ---- ADMIN LOGIN ----
    elseif ($role === 'admin') {
        if ($email === 'admin@gmail.com' && $password === 'admin123') {
            $_SESSION['admin'] = $email;
            header("Location: admin-panel1.php");
            exit();
        } else {
            echo "<script>alert('Invalid Admin Credentials'); window.location.href='index.php';</script>";
        }
    }
}

// =========================== DOCTOR REGISTRATION ===================
if (isset($_POST['doc_sub'])) {
    $doctor = $_POST['doctor'];
    $dpassword = $_POST['dpassword'];
    $demail = $_POST['demail'];
    $docFees = $_POST['docFees'];

    $query = "INSERT INTO doctb(username, password, email, docFees) VALUES ('$doctor', '$dpassword', '$demail', '$docFees')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Registration successful -> Redirect to wherever you want
        header("Location: admin-panel1.php");
        exit();
    } else {
        echo "<script>alert('Failed to add doctor'); window.location.href='register.php';</script>";
    }
}

// =========================== PAYMENT STATUS UPDATE ===================
if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    $query = "UPDATE appointmenttb SET payment='$status' WHERE contact='$contact'";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<script>alert('Updated successfully!'); window.location.href='admin-panel1.php';</script>";
    } else {
        echo "<script>alert('Update failed'); window.location.href='appointment.php';</script>";
    }
}

// =========================== UTILITY FUNCTION ===================
function display_docs()
{
    global $con;

    $query = "SELECT * FROM doctb";
    $result = mysqli_query($con, $query);

    echo '<option disabled selected>-- Select Doctor --</option>';
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['username'];
        $spec = $row['spec']; // Ensure 'spec' column exists
        $fees = $row['docFees'];
        echo '<option value="' . $name . '">' . $name . ' (' . $spec . ') - ₹' . $fees . '</option>';
    }
}
?>
