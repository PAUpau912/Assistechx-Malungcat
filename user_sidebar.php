<?php
$user = $_SESSION['user'];
?>
<ul class="sidebar navbar-nav">
  <li class="nav-item active">
    <a class="nav-link" href="./user_dashboard.php">
      <i class="fas fa-fw fa-ticket-alt"></i>
      <span> New ticket</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./user_ticket.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span> My Tickets</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="user_profile.php">
      <i class="fas fa-fw fa-user"></i>
      <span> Profile</span>
    </a>
  </li>
  <li class = "nav-item">
    <a class = "nav-link" href="user_general_terms.php">
      <span>General Terms</span>
    </a>
  </li>
</ul>