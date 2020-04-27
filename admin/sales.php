<?php 
  session_start();
  require '../db.php';
  $total = 0;
  $sql1 = 'SELECT sum(order_details.qty) as qty, name, price FROM `order_details` INNER JOIN product on productID = product.id group by productID';
  $sth1 = $pdo->prepare($sql1);
  $sth1->execute();

  $orders = $sth1->fetchAll();
  // var_dump($orders);
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
            <h1 class="h3 mb-0 text-gray-800">Sales</h1>
          </div>
          
                <a onclick="window.print();" href="#" class="btn btn-primary mb-3">Print</a>

          
            <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                
                <div class="table-responsive p-3">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Pastries</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                        
                      </tr>
                    </thead>
                    
                    <tbody>
                      

                      <?php foreach ($orders as $order): ?>
                        <tr>
                         
                          <th><?php echo $order['name']; ?></th>
                          <th><?php echo $order['qty']; ?></th>
                          <th><?php echo $order['price']; ?></th>
                          <th><?php echo $order['qty']*$order['price']; ?></th>
                          
                          
                         
                        </tr>
                      <?php 
                      $total = $total + ($order['qty']*$order['price']);
                  endforeach ;?>
                   		<tr>
                   			<td rowspan="2"></td>
                   			<td rowspan="2"></td>
                   			<td rowspan="2"><b>Total</b></td>
                   			<td rowspan="2"><?php echo $total; ?></td>
                   		</tr>
                      
                    </tbody>
                  </table>
                </div>
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