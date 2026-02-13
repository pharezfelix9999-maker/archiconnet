<?php
require_once '../db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Fetch project details
$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

if (!$project) {
    echo "Project not found.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $image_url = $_POST['image_url'];
    $detail_page = $_POST['detail_page'] ?: NULL;

    $update = $conn->prepare("UPDATE projects SET title = ?, description = ?, image_url = ?, detail_page = ? WHERE id = ?");
    $update->bind_param("ssssi", $title, $description, $image_url, $detail_page, $id);

    if ($update->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $update->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Project</title>
</head>
<body>
<h1>Edit Project</h1>
<form method="POST">
  <label>Title:</label><br>
  <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required><br><br>

  <label>Description:</label><br>
  <textarea name="description" rows="5"><?php echo htmlspecialchars($project['description']); ?></textarea><br><br>

  <label>Image URL:</label><br>
  <input type="text" name="image_url" value="<?php echo $project['image_url']; ?>" required><br><br>

  <label>Detail Page (optional):</label><br>
  <input type="text" name="detail_page" value="<?php echo $project['detail_page']; ?>"><br><br>

  <button type="submit">Update Project</button>
</form>
<a href="index.php">Back to Dashboard</a>
</body>
</html>
