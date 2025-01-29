<?php
    include './header.php';
    require_once './src/ticket.php';
    require_once './src/requester.php';
    require_once './src/team.php';

    $ticket = new Ticket();
    $allTicket = $ticket::findAll();

    $team = new Team();

    if (isset($_GET['del'])) {
      $ticket::delete($_GET['del']);
    }
?>
<div id="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="general_terms.php">General Terms</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="sidebar-heading text-uppercase text-muted small mb-2">
    General Terms and Conditions
</div>

<p class="text-muted small mb-3">
    Please read the following general terms carefully. By using the IT Help Desk website, you agree to the terms outlined below:
</p>

<ul class="nav flex-column">
    <li><strong>1. Acceptance of Terms:</strong> By accessing or using this IT Help Desk system, you agree to comply with these Terms and Conditions.</li>
    <li><strong>2. User Account Registration:</strong> You must provide accurate and complete information during registration and keep your login credentials secure.</li>
    <li><strong>3. Services and Support:</strong> The website allows users to submit technical support tickets, which will be addressed by the support team.</li>
    <li><strong>4. Prohibited Actions:</strong> Users may not engage in any unlawful activities such as spamming, fraud, or system abuse.</li>
    <li><strong>5. Data Privacy and Protection:</strong> We protect your personal data in accordance with our privacy policy. We do not share your data with third parties without your consent.</li>
    <li><strong>6. Response Time and Ticket Resolution:</strong> Our support team will aim to address and resolve tickets in a timely manner.</li>
    <li><strong>7. Service Availability:</strong> The IT Help Desk service is available 24/7, but may experience downtime due to maintenance or technical issues.</li>
    <li><strong>8. Intellectual Property:</strong> All content on the website, including software, logos, and designs, is protected by copyright and intellectual property laws.</li>
    <li><strong>9. Limitation of Liability:</strong> We are not responsible for any damages arising from the use of the website or its services.</li>
    <li><strong>10. Modifications to the Terms:</strong> These terms may be updated periodically. You are advised to review them regularly.</li>
    <li><strong>11. Governing Law:</strong> These terms are governed by the laws of the Philippines.</li>
</ul>

  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © 2024 AssisTechX. All rights reserved.</span>
      </div>
    </div>
  </footer>
</div>
<!--LOGOUT-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="./index.php">Logout</a>
      </div>
    </div>
  </div>
</div>


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="js/sb-admin.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
</body>
</html>