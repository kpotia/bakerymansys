<?php 
  session_start();
  require '../db.php';

  $sql1 = 'SELECT * FROM `users`';
  $sth1 = $pdo->prepare($sql1);
  $sth1->execute();

  $users = $sth1->fetchAll();
  // var_dump($users);
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
            <h1 class="h3 mb-0 text-gray-800">Staff</h1>
          </div>

          <div class="conatiner">
            <a href="add_staff.php" class="btn btn-primary mb-4">
              ADD Staff
            </a>
            
            </div>

            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>
                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>                        
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php foreach ($users as $user): ?>

                      <tr>
                        
                          <th><?php echo $user['name']; ?></th>
                          <th><?php echo $user['email']; ?></th>
                          <th><?php echo $user['level']; ?></th>

                      
                        <th>
                              <a href="user_details.php?oid=<?php echo $user['id']; ?>" class="btn btn-secondary">Details</a>
                          
                        </th>
                      </tr>
                      <?php endforeach ;?>
                      

                      
                    </tbody>
                  </table>
                </div>
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