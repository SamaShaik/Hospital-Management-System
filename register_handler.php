<?php
session_start();

// Connect to the database
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if register button is clicked
if (isset($_POST['register'])) {
    $role    = mysqli_real_escape_string($con, $_POST['role']);
    $fname   = mysqli_real_escape_string($con, $_POST['fname']);
    $lname   = mysqli_real_escape_string($con, $_POST['lname']);
    $gender  = mysqli_real_escape_string($con, $_POST['gender']);
    $email   = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $pass    = mysqli_real_escape_string($con, $_POST['password']);
    $cpass   = mysqli_real_escape_string($con, $_POST['cpassword']);

    if ($role === "patient") {
        $query = "INSERT INTO patreg (fname, lname, gender, email, contact, password, cpassword) 
                  VALUES ('$fname', '$lname', '$gender', '$email', '$contact', '$pass', '$cpass')";
        if (mysqli_query($con, $query)) {
            echo "<script>alert('Patient registered!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error registering patient: " . mysqli_error($con) . "'); window.location='register.php';</script>";
        }

    } elseif ($role === "doctor") {
        $username = $fname . " " . $lname;
        $query = "INSERT INTO doctb (username, password, email, spec, docFees) 
                  VALUES ('$username', '$pass', '$email', 'General', 500)";
        if (mysqli_query($con, $query)) {
            echo "<script>alert('Doctor registered!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error registering doctor: " . mysqli_error($con) . "'); window.location='register.php';</script>";
        }

    } elseif ($role === "admin") {
        echo "<script>alert('Admin registration not allowed!'); window.location='index.php';</script>";
    }
}

// Close the database connection
mysqli_close($con);
?>
