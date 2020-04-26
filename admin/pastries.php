<?php 
  session_start();
  require '../db.php';

  $sql1 = 'SELECT * FROM `product`';
  $sth1 = $pdo->prepare($sql1);
  $sth1->execute();

  $pastries = $sth1->fetchAll();
  // var_dump($product);
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
            <h1 class="h3 mb-0 text-gray-800">Pastries</h1>
          </div>

          <div class="row">
            <a href="add_pastrie.php" class="btn btn-primary mb-4">
              ADD PASTRIES
            </a>
            </div>
            <div class="row">

                      <?php foreach ($pastries as $pastry): ?>

              <div class="col-sm-4">
                <div class="card">
                  <div class="card-img-top">
                    <img src="../images/<?php echo $pastry['image']; ?>" alt="" class="w-100">
                  </div>
                  <div class="card-body">
                    <h3 class="card-title text-gray-800"><?php echo $pastry['name']; ?></h3>
                    <div class="card-text">
                   <h4> <?php echo $pastry['price']; ?> </h4>
                    <a href="delete.php?pid=<?php echo $pastry['id']; ?>" class="btn btn-secondary">Update</a>
                    <a href="delete.php?pid=<?php echo $pastry['id']; ?>" class="btn btn-warning">Delete</a>
                  </div>
                  </div>
                  
                </div>
              </div>
                      <?php endforeach ;?>

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