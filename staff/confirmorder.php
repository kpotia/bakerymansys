<?php 
  session_start();
  require '../db.php';
  $order  = $_SESSION['order'];
  // print_r($order);

  if (isset($_POST['order']) && $_POST['order'] =='proceed') {

    // var_dump($_POST);
    if(isset($_POST['status']) && $_POST['status'] !=''){
      $status = $_POST['status'];
    }

    if(isset($_POST['paid']) && $_POST['paid'] !=''){
      $paid = $_POST['paid'];
    }

    if(isset($_POST['cust_name']) && $_POST['cust_name'] !=''){
      $cust_name = $_POST['cust_name'];
    }

    // insert order into table 
    $sql = "INSERT INTO `orders` ( `customer_name`,  `total`, `status`, `paid`) VALUES (:customer_name, :total, :status, :paid)" ;
// var_dump(date('Ymd h:i:s a'));
    $stmt1 = $pdo->prepare($sql);
    if($stmt1){
      $stmt1->bindParam(':customer_name', $cust_name, PDO::PARAM_STR);
      $stmt1->bindParam(':total', $order['total'], PDO::PARAM_STR);
      $stmt1->bindParam(':status', $status, PDO::PARAM_STR);
      $stmt1->bindParam(':paid', $paid, PDO::PARAM_STR);

      // execute and retrieve order id
      if ($stmt1->execute()) {
        $oid = $pdo->lastInsertId();

          $sql1 = "INSERT INTO `order_details` (`orderID`, `productID`, `qty`, `sub_total`) VALUES ('$oid', :productID, :qty, :sub_total) ";
             $pdo->beginTransaction();
                try{
                  foreach ($order['items'] as $item) {
                  $sql2 ="INSERT INTO `order_details` (`orderID`, `productID`, `qty`, `sub_total`) VALUES ('$oid','".$item['item_id']."', '".$item['item_quantity']."','".($item["item_quantity"] * $item["item_price"])."')";
                  $pdo->exec($sql2);
                  echo $sql2;
                  }//die();
                  $pdo->commit();
                } catch (PDOExecption $e){
                   echo $e->getMessage();
                }
           ?>
          }

            <script>
              alert('order saved');
            </script>

            <?php
                $_SESSION['order'] = null;
          setcookie("shopping_cart", "", time() - 3600);

          header('location: receipt.php?oid='.$oid);

      }else {

      var_dump($pdo);
      var_dump($pdo->errorInfo());
        die('fuck something went wrong!!!');

      }
     
    }
  }
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
            <h1 class="h3 mb-0 text-gray-800">Orders</h1>
          </div>

          
            <div class="row">
              <div class="col-lg-8">
                <div class="card mb-4">
                  <div class="card-body">
                    
                    <table class="table ">
                      <thead>
                        <tr>
                          <th>Item Name</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                          <tr>
                            <td><?php echo $item['item_name']; ?></td>
                            <td><?php echo $item['item_quantity']; ?></td>
                            <td><?php echo $item['item_price']; ?></td>
                            <td><?php echo number_format($item["item_quantity"] * $item["item_price"], 2); ?></td>
                          </tr>
                          
                        <?php endforeach ?>
                                          <tr>
                          <th rowspan="3"></th>
                          <th rowspan=>Total</th>
                          <th ><?php echo number_format($order['total'],2); ?></th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                </div>
           
              </div>
              <div class="col-lg-4">
                <form action="" method="post" class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="cust_name">Customer Name</label>
                      <input type="text" id="cust_name" name="cust_name" placeholder="Customer Name " class="form-control">
                    </div>

                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Paid</legend>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="paid1" name="paid" value="yes" class="custom-control-input">
                            <label class="custom-control-label" for="paid1">Yes</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="paid2" name="paid" value="no" class="custom-control-input">
                            <label class="custom-control-label" for="paid2">No</label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                      <label for="exampleFormControlSelect1">Example select</label>
                      <select class="form-control" name="status" id="exampleFormControlSelect1">
                        <option>Waiting</option>
                        <option>Delivered</option>
                        <option>Cancelled</option>
                      </select>
                    </div>

                    <button class="btn" name="order" value="proceed"> Proceed</button>


                  </div>
                  
                 


                </form>
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