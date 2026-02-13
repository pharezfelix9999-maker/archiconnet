<?php
require_once '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $detail_page = $_POST['detail_page'] ?: NULL;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "../assets/images/";
        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image_url = "assets/images/" . $fileName;

            $stmt = $conn->prepare("INSERT INTO projects (title, description, image_url, detail_page) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $description, $image_url, $detail_page);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "<p style='color:red;'>Database Error: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Failed to upload image.</p>";
        }
    } else {
        echo "<p style='color:red;'>Please select an image to upload.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Project</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f4f4f4;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea { resize: vertical; }
        button {
            margin-top: 20px;
            padding: 12px 25px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover { background: #0056b3; }
        a.back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
        }
        a.back:hover { text-decoration: underline; }

        /* Image Preview */
        #preview {
            margin-top: 15px;
            max-width: 100%;
            border-radius: 8px;
            display: none;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<h1>Add New Project</h1>

<form method="POST" enctype="multipart/form-data">
    <label>Project Title:</label>
    <input type="text" name="title" placeholder="Enter project title" required>

    <label>Project Description:</label>
    <textarea name="description" rows="5" placeholder="Enter a short description"></textarea>

    <label>Project Image:</label>
    <input type="file" name="image" accept="image/*" required onchange="showPreview(event)">
    <img id="preview" src="#" alt="Image Preview">

    <label>Detail Page (Optional):</label>
    <input type="text" name="detail_page" placeholder="Enter project detail page URL">

    <button type="submit">Add Project</button>
</form>

<a href="index.php" class="back">← Back to Dashboard</a>

<script>
function showPreview(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>

</body>
</html>
