<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Login | Global Hospital</title>
<style>
body {
  font-family: Arial, sans-serif;
  background: linear-gradient(to right, #3931af, #00c6ff);
  margin: 0;
  padding: 0;
}
.navbar {
  text-align: center;
  padding: 15px;
  color: #fff;
  font-size: 1.5em;
}
.container {
  max-width: 400px;
  margin: 40px auto;
}
.card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 30px;
  text-align: center;
}
h4 {
  font-size: 1.25rem;
  margin: 15px 0;
}
.icon {
  font-size: 48px;
}
.form-switch {
  margin: 20px 0;
}
.tab-btn {
  margin: 5px;
  border-radius: 20px;
  padding: 8px 20px;
  border: none;
  font-weight: bold;
  font-size: 14px;
  cursor: pointer;
}
.tab-btn.active {
  background-color:#3931af;
  color: #fff;
}
label {
  display: block;
  text-align: left;
  font-size: 14px;
  color: #333;
  margin: 8px 0 3px 0;
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 8px;
  font-size: 14px;
  border-radius: 5px;
  border: 1px solid #ccc;
}
input[type=submit] {
  margin-top: 15px;
  padding: 10px;
  font-size: 16px;
  font-weight: bold;
  border-radius: 5px;
  border: none;
  background-color:#3931af ;
  color: #fff;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: #2f2893;
}
</style>
</head>
<body>
<div class="navbar">👤 GLOBAL HOSPITALS</div>
<div class="container">
  <div class="card">
    <div class="icon">🏥</div>
    <h4>Login to Global Hospital</h4>

    <div class="form-switch">
      <button class="tab-btn active" id="btn-patient" onClick="switchRole('patient')">Patient</button>
      <button class="tab-btn" id="btn-doctor" onClick="switchRole('doctor')">Doctor</button>
      <button class="tab-btn" id="btn-admin" onClick="switchRole('admin')">Admin</button>
    </div>

    <form method="POST" action="func.php">
      <input type="hidden" name="role" id="login-role" value="patient">

      <div class="form-group">
        <label>Email-ID</label>
        <input type="text" name="email" placeholder="Enter Email ID" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password" required>
      </div>

      <input type="submit" name="login" value="Login">
    </form>
  </div>
</div>

<script>
function switchRole(role) {
  document.getElementById('login-role').value = role;

  var roles = ["btn-patient", "btn-doctor", "btn-admin"];
  roles.forEach(r => {
    document.getElementById(r).classList.remove("active");
  });
  document.getElementById("btn-" + role).classList.add("active");
}
</script>
</body>
</html>
