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
    <link rel="stylesheet" href="./css/contactus.css"/>
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
        <li><a href="#">Contact</a></li>
        <li><a href="index.php">Login</a></li>
      </ul>
    </nav>
    <header class="header__container">
      
      <div class="header__content">
        <h2>IT Help Desk</h2>
        <h1>
          Reach out to us
        </h1>
        <p>
            We're here to assist you with any inquiries or support needs. Please reach out using the information below:.
        </p>
        <section class="contact-us">
            <div class="contact-details">
              <p><strong>Email:</strong> support@assistechx.com</p>
              <p><strong>Phone:</strong> +123-456-7890</p>
              <p><strong>Address:</strong> 123 Innovation Drive, Tech City</p>
            </div>
            <div class="contact-form">
              <h2>Send Us a Message</h2>
              <form action="#" method="post">
                <input type="text" id="name" name="name" placeholder="Name" required />
                <input type="email" id="email" name="email" placeholder="Email" required />
                <textarea id="message" name="message" rows="5" placeholder="Message" required></textarea>
                <button type="submit">Submit</button>
              </form>
            </div>
          </section>
        <ul class="socials">
          <li>
            <a href="#"><i class="ri-facebook-circle-fill"></i></a>
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
