<?php
require_once '../function/ap.session.php';
session_start();
if (SessionAdminCek()) {
  header("location:log-in.php");
} else {

  SessionActiveAdmin();
  $id = $Adminarray[0];
  $nama = $Adminarray[1];
  $email = $Adminarray[2];
  $username = $Adminarray[3];
  $level = $Adminarray[4];
}

?>
<?php

require_once '../config/database.php';
require_once '../function/ap.admin.php';
require_once '../function/ap.theme.php';
LoadHeadPanel();
LoadCssPanel();
LoadMenuPanel();
?>
<div id="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb" style="margin-top: 15px;">
      <li class="breadcrumb-item active"><i class="fas fa-fw fa-user"></i>Hi, Admin</li>
    </ol>
    <!-- Icon Cards-->
    <h2>Selamat datang di Admin Panel, QurbanQu</h2>
  </div>
</div>

<?php
LoadFooterPanel();
?>