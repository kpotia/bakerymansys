<?php 
  session_start();
  require '../db.php';

  $sql1 = 'SELECT count(id) as ord FROM `orders`';
  $sth1 = $pdo->prepare($sql1);
  $sth1->execute();

  $orders = $sth1->fetch(PDO::FETCH_ASSOC);
  // var_dump($orders);
  // print("\n");


  $sql2 = 'SELECT sum(orders.total) as sales FROM `orders`';
  $sth2 = $pdo->prepare($sql2);
  $sth2->execute();

  /* Exercise PDOStatement::fetch styles */
  $sales = $sth2->fetch(PDO::FETCH_ASSOC);
  // var_dump($sales);


   $sql3 = 'SELECT count(id) as users FROM `users`';
  $sth3 = $pdo->prepare($sql3);
  $sth3->execute();

  $users = $sth3->fetch(PDO::FETCH_ASSOC);
  // var_dump($users);
  // die;
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">
            <div class="col-5 m-4">
              <div class="card">
                <div class="card-header">
                  <h2>Orders</h2>
                </div>
                <div class="card-body text-center">
                  <h1><?php echo $orders['ord'];?> Orders</h1>
                </div>
              </div>
            </div>
            <div class="col-5 m-4">
              <div class="card">
                <div class="card-header">
                  <h2>Sales</h2>
                </div>
                <div class="card-body text-center">
                  <h1><?php echo (double)$sales['sales'];?> GHS</h1>
                  
                </div>
              </div>
            </div>

             <div class="col-5 m-4">
              <div class="card">
                <div class="card-header">
                  <h2>Staff</h2>
                </div>
                <div class="card-body text-center">
                  <h1><?php echo $users['users'];?></h1>
                  
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
    