<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form action="authenticate.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Login">
    <a href="registration.php">Registration</a>
</form>
</body>
</html>
