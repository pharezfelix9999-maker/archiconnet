<?php
require_once 'db.php';

// Ensure project id is set
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Project not found. <a href='index.php'>Back to Portfolio</a></p>";
    exit();
}

$project = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($project['title']) ?> | Architect Portfolio</title>
<link rel="stylesheet" href="assets/style.css">
<style>
/* ===========================
   Project Detail Page Styling
=========================== */

body {
    font-family: 'Arial', sans-serif;
    background: #f9f9f9;
}

.project-detail {
    max-width: 1100px;
    margin: 60px auto;
    padding: 0 20px;
}

.project-detail h2.section-title {
    font-size: 32px;
    text-align: center;
    margin-bottom: 40px;
    color: #333;
}

.project-hero {
    width: 100%;
    height: 500px;
    overflow: hidden;
    border-radius: 15px;
    margin-bottom: 40px;
}

.project-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-hero img:hover {
    transform: scale(1.05);
}

.project-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.project-gallery img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.project-gallery img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.project-description {
    background: #fff;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    margin-bottom: 40px;
}

.project-description h3 {
    font-size: 22px;
    margin-top: 15px;
    margin-bottom: 10px;
    color: #222;
}

.project-description p,
.project-description ul {
    color: #555;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 15px;
}

.project-description ul li {
    margin-bottom: 8px;
}

.project-detail .btn {
    display: inline-block;
    padding: 12px 25px;
    background: #333;
    color: #fff;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.3s;
}

.project-detail .btn:hover {
    background: #000;
}
</style>
</head>
<body>

<?php include 'header.php'; ?>

<section class="project-detail scroll-reveal">

    <!-- Project Title -->
    <h2 class="section-title"><?= htmlspecialchars($project['title']) ?></h2>

    <!-- Hero Image -->
    <div class="project-hero">
        <img src="<?= htmlspecialchars($project['image_url']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
    </div>

    <!-- Image Gallery (currently just duplicating the main image for example) -->
    <div class="project-gallery">
        <img src="<?= htmlspecialchars($project['image_url']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
        <img src="<?= htmlspecialchars($project['image_url']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
        <img src="<?= htmlspecialchars($project['image_url']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
    </div>

    <!-- Project Description Card -->
    <div class="project-description">
        <?php if (!empty($project['description'])): ?>
            <h3>Project Overview</h3>
            <p><?= htmlspecialchars($project['description']) ?></p>
        <?php endif; ?>

        <?php if (!empty($project['detail_page'])): ?>
            <h3>Detail Page</h3>
            <p>For more info, visit <a href="<?= htmlspecialchars($project['detail_page']) ?>" target="_blank"><?= htmlspecialchars($project['detail_page']) ?></a></p>
        <?php endif; ?>
    </div>

    <a href="index.php" class="btn">← Back to Portfolio</a>
</section>

<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('.scroll-reveal');
    const revealOnScroll = () => {
        const windowHeight = window.innerHeight;
        elements.forEach(el => {
            if (el.getBoundingClientRect().top < windowHeight - 100) {
                el.classList.add('active');
            }
        });
    };
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();
});
</script>

</body>
</html>
