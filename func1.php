<?php
// Start the session only if it's not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connect to database
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Doctor Login
if (isset($_POST['docsub1'])) {
    $dname = mysqli_real_escape_string($con, $_POST['username3']);
    $dpass = mysqli_real_escape_string($con, $_POST['password3']);
    $query = "SELECT * FROM doctb WHERE username='$dname' AND password='$dpass'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['dname'] = $row['username'];
        header("Location: doctor-panel.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password. Try Again!'); window.location.href = 'index.php';</script>";
    }
}

// Optional: Function to display doctor names
function display_docs() {
    global $con;
    $query = "SELECT * FROM doctb";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
    }
}
?>
