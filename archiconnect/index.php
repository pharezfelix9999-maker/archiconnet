<?php
require_once 'db.php';

// Fetch projects
$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Architect Portfolio</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<!-- HERO SECTION -->
<section class="hero scroll-reveal">
  <div class="hero-content">
    <h2>Designing Timeless Architecture</h2>
    <p>Residential and commercial architecture focused on function, beauty, and sustainability.</p>
    <a href="#projects" class="btn">View Projects</a>
  </div>
</section>

<!-- PROJECTS SECTION -->
<section id="projects" class="scroll-reveal">
  <h2 class="section-title">Selected Projects</h2>

  <div class="projects">

    <?php if ($projects && $projects->num_rows > 0): ?>
      <?php while ($project = $projects->fetch_assoc()): ?>

        <article class="project">
          <a href="project.php?id=<?= (int)$project['id'] ?>" aria-label="View project details">

            <img 
              src="<?= htmlspecialchars($project['image_url']) ?>" 
              alt="<?= htmlspecialchars($project['title']) ?>"
              loading="lazy"
            >

            <div class="project-content">
              <h3><?= htmlspecialchars($project['title']) ?></h3>

              <?php if (!empty($project['description'])): ?>
                <p><?= htmlspecialchars($project['description']) ?></p>
              <?php endif; ?>
            </div>

          </a>
        </article>

      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center;">No projects added yet.</p>
    <?php endif; ?>

  </div>
</section>

<!-- SERVICES SECTION -->
<section id="services" class="scroll-reveal">
  <h2 class="section-title">Services</h2>

  <div class="services">
    <div class="service">
      <h4>Residential Design</h4>
      <p>Elegant and functional homes designed for modern living.</p>
    </div>
    <div class="service">
      <h4>Commercial Architecture</h4>
      <p>Smart and efficient spaces for business and productivity.</p>
    </div>
    <div class="service">
      <h4>3D Visualization</h4>
      <p>High-quality renders that bring ideas to life.</p>
    </div>
  </div>
</section>

<!-- ABOUT SECTION -->
<section id="about" class="scroll-reveal">
  <h2 class="section-title">About</h2>

  <div class="about">
    <img 
      src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" 
      alt="Architect portrait"
      loading="lazy"
    >
    <p>
      I am a professional architect specializing in contemporary residential and 
      commercial design. My approach blends aesthetics, functionality, and sustainability 
      to create meaningful spaces.
    </p>
  </div>
</section>

<!-- CONTACT SECTION -->
<section id="contact" class="scroll-reveal">
  <h2 class="section-title">Contact Me</h2>

  <p>
    Email: <strong>pharezfelix9999@gmail.com</strong><br>
    Phone: <strong>+234 815 928 2352</strong>
  </p>

  <form action="contact.php" method="POST" class="contact-form">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
    <button type="submit" class="btn">Send Message</button>
  </form>
</section>

<?php include 'footer.php'; ?>

<!-- Scroll Animations Script -->
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
