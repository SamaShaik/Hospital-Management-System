<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logged Out</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(90deg, #3931af, #00c6ff);
    color: #fff;
    padding: 100px;
    text-align: center;
}
h3 {
    font-size: 24px;
    margin-bottom: 30px;
}
a {
    display: inline-block;
    padding: 12px 25px;
    font-size: 16px;
    color: #ffff;
    background-color: #0076d4;
    text-decoration: none;
    border-radius: 5px;
    border: 2px solid #f8f9fa;
    transition: background-color 0.3s, color 0.3s;
}
a:hover {
    color: #f8f9fa;
    background-color:rgb(49, 64, 177);
}
</style>
</head>
<body>
    <h3>You have logged out.</h3>
    <a href="index.php">Back to Login Page</a>
</body>
</html>
