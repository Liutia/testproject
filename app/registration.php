<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
<h2>Registration Form</h2>
<form action="registration_process.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required><br><br>

    <input type="submit" value="Register">

    <a href="login.php">Login</a>
</form>
</body>
</html>
