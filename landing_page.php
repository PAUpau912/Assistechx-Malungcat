<?php 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/landing_page.css" />
    <title>AssisTechX</title>
  </head>
  <body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="landing_page.php">
            <img src="assets/logo.png" alt="logo" />
            <span></span>
          </a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-line"></i>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <li><a href="#">Features</a></li>
        <li><a href="ContactUS.php">Contact</a></li>
        <li><a href="index.php">Login</a></li>
      </ul>
    </nav>
    <header class="header__container">
      <div class="header__image">
        <img src="assets/header.png" alt="header" />
        <svg>
          <filter id="glow-effect" x="-50%" y="-50%" width="200%" height="200%">
            <feGaussianBlur in="SourceAlpha" stdDeviation="10" result="blur"></feGaussianBlur>
            <feOffset dx="0" dy="0" result="offsetblur"></feOffset>
            <feFlood flood-color="blue" flood-opacity="1" result="color"></feFlood>
            <feComposite in2="offsetblur" operator="in" result="glow"></feComposite>
            <feMerge>
              <feMergeNode in="glow"></feMergeNode>
              <feMergeNode in="SourceGraphic"></feMergeNode>
            </feMerge>
          </filter>
        </svg>

      </div>
      <div class="header__content">
        <h2>IT Help Desk</h2>
        <h1>
          Assign & Look<br /><span class="h1__span-1"> Solutions</span>
          <span class="h1__span-2">with our System</span>
        </h1>
        <p>
          From concept to launch, our expert team is dedicated to delivering
          exceptional solutions tailored to your needs. Let's bring your vision
          to life and create something extraordinary together.
        </p>
        <div class="header__btn">
          <button class="btn" onclick="window.location.href='index.php';">Get Started</button>
        </div>
        <ul class="socials">
          <li>
            <a href="https://www.facebook.com/ritchie.dorado.10"><i class="ri-facebook-circle-fill"></i></a>
          </li>
          <li>
            <a href="#"><i class="ri-twitter-x-fill"></i></a>
          </li>
          <li>
            <a href="#"><i class="ri-youtube-fill"></i></a>
          </li>
        </ul>
        <div class="header__bar">
          Copyright © 2024 AssisTechX. All rights reserved.
        </div>
      </div>
    </header>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="./js/landing_page.js"></script>
  </body>
</html>
