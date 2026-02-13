<?php
require_once "../includes/auth.php";
require_once "../includes/database.php";

if(isset($_GET['id'])) {
    $database = new Database();
    $db = $database->connect();

    $stmt = $db->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: messages.php");
exit;
