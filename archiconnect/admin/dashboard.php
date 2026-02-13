<?php
require_once "../includes/auth.php";
require_once "../includes/database.php";

$database = new Database();
$db = $database->connect();

$total = $db->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
$unread = $db->query("SELECT COUNT(*) FROM contacts WHERE status='unread'")->fetchColumn();
$read = $db->query("SELECT COUNT(*) FROM contacts WHERE status='read'")->fetchColumn();
?>

<link rel="stylesheet" href="../assets/css/admin.css">

<div class="admin-layout">

<div class="sidebar">
  <h2>Admin Panel</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="messages.php">Messages</a>
  <a href="logout.php">Logout</a>
</div>

<div class="content">

<h1>Dashboard Overview</h1>

<div class="stat-grid">
  <div class="card">
    <h3>Total Messages</h3>
    <p><?= $total ?></p>
  </div>
  <div class="card">
    <h3>Unread</h3>
    <p><?= $unread ?></p>
  </div>
  <div class="card">
    <h3>Read</h3>
    <p><?= $read ?></p>
  </div>
</div>

</div>
</div>
