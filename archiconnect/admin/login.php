<?php
session_start();
require_once "../includes/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $database = new Database();
    $db = $database->connect();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="login-box">
<h2>Admin Login</h2>
<?php if(isset($error)) echo "<p>$error</p>"; ?>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
</div>
</body>
</html>
