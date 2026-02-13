<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  echo "<script>
    alert('Thank you! Your message has been received.');
    window.location.href='index.php';
  </script>";
  exit;
}

// If someone tries to open contact.php directly
header("Location: index.php");
exit;
