<?php 
  session_start();
  require '../db.php';

  $sql1 = 'SELECT * FROM `users` WHERE `id` = '.$_GET['oid'];
  $sth1 = $pdo->prepare($sql1);
  $sth1->execute();

  $user = $sth1->fetch(PDO::FETCH_ASSOC);
  // var_dump($user);
  // print("\n");


 ?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'admin_head.php'; ?>

<body id="page-top">
  <div id="wrapper">
    <?php include_once 'admin_side.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include_once 'admin_top.php'; ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Staff Details</h1>
          </div>

          
            <div class="card">
              <div class="card-body">
                <p>Name: <?php echo $user['name'];?></p>
                <p>Email: <?php echo $user['email'];?></p>
                <p>Level: <?php echo $user['level'];?></p>
                <p>
                  
                  <a href="delete.php?uid=<?php echo $_GET["oid"];?>" class="btn btn-secondary">Delete</a>
                </p>
              </div>
            </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include_once 'admin_footer.php'; ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>

</body>

</html>