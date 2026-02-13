/* =========================================
   ELITE WEBSITE MASTER SCRIPT
========================================= */

document.addEventListener("DOMContentLoaded", function () {

  /* =====================================
     1. HEADER SHRINK ON SCROLL
  ===================================== */

  const header = document.querySelector("header");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });


  /* =====================================
     2. SCROLL PROGRESS BAR
  ===================================== */

  const progressBar = document.querySelector(".scroll-progress");

  window.addEventListener("scroll", () => {
    const scrollTop = document.documentElement.scrollTop;
    const height =
      document.documentElement.scrollHeight -
      document.documentElement.clientHeight;

    const scrolled = (scrollTop / height) * 100;
    progressBar.style.width = scrolled + "%";
  });


  /* =====================================
     3. DARK MODE TOGGLE
  ===================================== */

  const toggle = document.getElementById("theme-toggle");

  if (toggle) {
    toggle.addEventListener("click", () => {
      document.body.classList.toggle("dark");

      if (document.body.classList.contains("dark")) {
        toggle.textContent = "☀️";
      } else {
        toggle.textContent = "🌙";
      }
    });
  }


  /* =====================================
     4. MOBILE MENU TOGGLE
  ===================================== */

  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector(".nav-links");

  if (menuToggle) {
    menuToggle.addEventListener("click", () => {
      navLinks.classList.toggle("active");
    });
  }


  /* =====================================
     5. SCROLL REVEAL (STAGGERED)
  ===================================== */

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.transitionDelay =
            entry.target.dataset.delay;
          entry.target.classList.add("active");
        }
      });
    },
    { threshold: 0.2 }
  );

  document.querySelectorAll(".scroll-reveal").forEach((el, index) => {
    el.dataset.delay = index * 0.1 + "s";
    observer.observe(el);
  });


  /* =====================================
     6. IMAGE LIGHTBOX
  ===================================== */

  const images = document.querySelectorAll(".project img");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.querySelector(".lightbox-img");
  const closeBtn = document.querySelector(".close");

  if (images.length > 0 && lightbox) {

    images.forEach((img) => {
      img.addEventListener("click", () => {
        lightbox.style.display = "flex";
        lightboxImg.src = img.src;
      });
    });

    closeBtn.addEventListener("click", () => {
      lightbox.style.display = "none";
    });

    lightbox.addEventListener("click", () => {
      lightbox.style.display = "none";
    });
  }

});
