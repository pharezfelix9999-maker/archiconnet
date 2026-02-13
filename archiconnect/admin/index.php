<?php
require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/style.css">
  <style>
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background: #f5f5f5; }
    a.btn { padding: 6px 12px; background: #333; color: #fff; border-radius: 5px; text-decoration: none; margin-right: 5px; }
    a.btn:hover { background: #000; }
  </style>
</head>
<body>
<h1>Admin Dashboard</h1>
<a href="add_project.php" class="btn">Add New Project</a>

<table>
  <tr>
    <th>ID</th>
    <th>Title</th>
    <th>Image URL</th>
    <th>Actions</th>
  </tr>
  <?php
  $sql = "SELECT * FROM projects ORDER BY created_at DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row['id'] . '</td>';
          echo '<td>' . htmlspecialchars($row['title']) . '</td>';
          echo '<td><img src="' . $row['image_url'] . '" width="100"></td>';
          echo '<td>';
          echo '<a href="edit_project.php?id=' . $row['id'] . '" class="btn">Edit</a>';
          echo '<a href="delete_project.php?id=' . $row['id'] . '" class="btn" onclick="return confirm(\'Are you sure?\')">Delete</a>';
          echo '</td>';
          echo '</tr>';
      }
  } else {
      echo '<tr><td colspan="4">No projects found.</td></tr>';
  }
  ?>
</table>
</body>
</html>
