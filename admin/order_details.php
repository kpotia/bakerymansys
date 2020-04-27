<?php 
  session_start();
  require '../db.php';

  $sql1 = 'SELECT * FROM `orders` WHERE `id` ='. $_GET["oid"] ;
  $sql2 = 'SELECT * FROM `order_details` INNER JOIN product on productID = product.id WHERE `orderID` ='. $_GET["oid"];
  // echo $sql2;
  $sth1 = $pdo->prepare($sql1);
  $sth1->execute();

  $orders = $sth1->fetch(PDO::FETCH_ASSOC);
  // var_dump($orders);

  $sth2 = $pdo->prepare($sql2);
  $sth2->execute();
  $order_details = $sth2->fetchAll();
  // var_dump($order_details);
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
            <h1 class="h3 mb-0 text-gray-800">Order Details</h1>
          </div>

          
            <div class="row">
              <div class="col-lg-12">
                <a onclick="window.print();" href="#" class="btn btn-primary mb-3">Print</a>
              <div class="card mb-4">
                <div class="card-body">
                  <ul>
                    <li>Order ID: <?php echo $orders['id']; ?></li>
                    <li>Order date: <?php echo $orders['order_date']; ?>  </li>
                    <li>Customer Name: <?php echo $orders['customer_name']; ?></li>
                  </ul>

                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th>Pastry</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($order_details as $order_item): ?>
                        <tr>
                          <td><?php echo $order_item['name'] ?></td>
                          <td><?php echo $order_item['qty'] ?></td>
                          <td><?php echo $order_item['price'] ?></td>
                          <td><?php echo $order_item['qty'] * $order_item['price'] ?></td>
                        </tr>
                      <?php endforeach ?>
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