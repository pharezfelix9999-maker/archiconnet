<?php
require_once "../../includes/auth.php";
require_once "../../includes/database.php";

if(isset($_POST['id'])) {
    $database = new Database();
    $db = $database->connect();

    $stmt = $db->prepare("UPDATE contacts SET status='read' WHERE id=?");
    $stmt->execute([$_POST['id']]);
}
