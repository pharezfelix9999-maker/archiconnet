<?php
require_once 'db.php';

if (!isset($_GET['id'])) {
  die('Project not found');
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die('Project not found');
}

$project = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($project['title']) ?></title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="project-detail">
  <h1><?= htmlspecialchars($project['title']) ?></h1>

  <img 
    src="<?= htmlspecialchars($project['image_url']) ?>" 
    alt="<?= htmlspecialchars($project['title']) ?>"
    style="max-width:800px; width:100%; border-radius:12px;"
  >

  <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
