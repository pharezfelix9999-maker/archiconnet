<?php
require_once "../includes/auth.php";
require_once "../includes/database.php";

$database = new Database();
$db = $database->connect();

$stmt = $db->query("SELECT * FROM contacts ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/admin.css">
<script src="../assets/js/admin.js"></script>

<div class="admin-layout">

<div class="sidebar">
  <h2>Admin Panel</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="messages.php">Messages</a>
  <a href="logout.php">Logout</a>
</div>

<div class="content">

<h1>Messages</h1>

<input type="text" id="search" placeholder="Search messages..." style="padding:10px;width:300px;">

<br><br>

<?php foreach($messages as $msg): ?>
<div class="card" id="msg-<?= $msg['id'] ?>">
  <strong><?= htmlspecialchars($msg['name']) ?></strong>
  <p><?= htmlspecialchars($msg['email']) ?></p>
  <p><?= htmlspecialchars($msg['message']) ?></p>
  <small><?= $msg['created_at'] ?></small>
  <br><br>

  <?php if($msg['status']=='unread'): ?>
    <button onclick="markRead(<?= $msg['id'] ?>)">Mark as Read</button>
  <?php endif; ?>

  <button onclick="deleteMessage(<?= $msg['id'] ?>)">Delete</button>
</div>
<?php endforeach; ?>

</div>
</div>
