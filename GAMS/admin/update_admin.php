<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
//Udpate Staff
if (isset($_POST['UpdateAdmin'])) {
  //Prevent Posting Blank Values
  if (empty($_POST["admin_number"]) || empty($_POST["admin_name"]) || empty($_POST['admin_email']) || empty($_POST['admin_password'])) {
    $err = "Blank Values Not Accepted";
  } else {
    $admin_number = $_POST['admin_number'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $update = $_GET['update'];

    //Insert Captured information to a database table
    $postQuery = "UPDATE rpos_staff SET   admin_name =?, admin_number =?, admin_mail =?, admin_password =? WHERE aadmin_id =?";
    $postStmt = $mysqli->prepare($postQuery);
    //bind paramaters
    $rc = $postStmt->bind_param('ssssi', $admin_name, $admin_number, $admin_email, $admin_password, $update);
    $postStmt->execute();
    //declare a varible which will be passed to alert function
    if ($postStmt) {
      $success = "Admin Updated" && header("refresh:1; url=hrm.php");
    } else {
      $err = "Please Try Again Or Try Later";
    }
  }
}
require_once('partials/_head.php');
?>

<body>
  <!-- Sidenav -->
  <?php
  require_once('partials/_sidebar.php');
  ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php
    require_once('partials/_topnav.php');
    $update = $_GET['update'];
    $ret = "SELECT * FROM  rpos_aadmin WHERE aadmin_id = '$update' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($admin = $res->fetch_object()) {
    ?>
      <!-- Header -->
      <div style="background-image: url(assets/img/theme/restro00.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
      <span class="mask bg-gradient-dark opacity-8"></span>
        <div class="container-fluid">
          <div class="header-body">
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--8">
        <!-- Table -->
        <div class="row">
          <div class="col">
            <div class="card shadow">
              <div class="card-header border-0">
                <h3>Please Fill All Fields</h3>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Admin Number</label>
                      <input type="text" name="admin_number" class="form-control" value="<?php echo $admin->admin_number; ?>">
                    </div>
                    <div class="col-md-6">
                      <label>Admin Name</label>
                      <input type="text" name="admin_name" class="form-control" value="<?php echo $admin->admin_name; ?>">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Admin Email</label>
                      <input type="email" name="staff_email" class="form-control" value="<?php echo $admin->admin_mail; ?>">
                    </div>
                    <div class="col-md-6">
                      <label>Admin Password</label>
                      <input type="password" name="staff_password" class="form-control" value="">
                    </div>
                  </div>
                  <br>
                  <div class="form-row">
                    <div class="col-md-6">
                      <input type="submit" name="UpdateAdmin" value="Update Admin" class="btn btn-success" value="">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
      <?php
      require_once('partials/_footer.php');
    }
      ?>
      </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>