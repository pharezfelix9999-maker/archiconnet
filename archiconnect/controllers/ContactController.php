<?php

require_once "../includes/database.php";
require_once "../models/Contact.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $database = new Database();
    $db = $database->connect();

    $contact = new Contact($db);

    $contact->name = $_POST["name"] ?? "";
    $contact->email = $_POST["email"] ?? "";
    $contact->message = $_POST["message"] ?? "";

    if (!filter_var($contact->email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email.");
    }

    if ($contact->create()) {
        header("Location: ../index.php?success=1");
        exit;
    } else {
        echo "Something went wrong.";
    }
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'yourgmail@gmail.com';
$mail->Password = 'your_app_password';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('yourgmail@gmail.com', 'Portfolio Website');
$mail->addAddress('yourgmail@gmail.com');

$mail->Subject = 'New Contact Form Message';
$mail->Body = "Name: {$contact->name}\nEmail: {$contact->email}\nMessage: {$contact->message}";

$mail->send();
