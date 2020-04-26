<?php 
  session_start();
  require '../db.php';

//index.php

// $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");

$message = '';

if(isset($_POST["add_to_cart"]))
{
  if(isset($_COOKIE["shopping_cart"]))
  {
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
  }
  else
  {
    $cart_data = array();
  }

  $item_id_list = array_column($cart_data, 'item_id');

  if(in_array($_POST["hidden_id"], $item_id_list))
  {
    foreach($cart_data as $keys => $values)
    {
      if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
      {
        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
      }
    }
  }
  else
  {
    $item_array = array(
      'item_id'     =>  $_POST["hidden_id"],
      'item_name'     =>  $_POST["hidden_name"],
      'item_price'    =>  $_POST["hidden_price"],
      'item_quantity'   =>  $_POST["quantity"]
    );
    $cart_data[] = $item_array;
  }

  
  $item_data = json_encode($cart_data);
  setcookie('shopping_cart', $item_data, time() + (86400 * 30));
  header("location:index.php?success=1");
}

if(isset($_GET["action"]))
{
  if($_GET["action"] == "delete")
  {
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
      if($cart_data[$keys]['item_id'] == $_GET["id"])
      {
        unset($cart_data[$keys]);
        $item_data = json_encode($cart_data);
        setcookie("shopping_cart", $item_data, time() + (86400 * 30));
        header("location:index.php?remove=1");
      }
    }
  }
  if($_GET["action"] == "clear")
  {
    setcookie("shopping_cart", "", time() - 3600);
    header("location:index.php?clearall=1");
  }
}

if(isset($_GET["success"]))
{
  $message = '
  <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Item Added into Cart
  </div>
  ';
}

if(isset($_GET["remove"]))
{
  $message = '
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item removed from Cart
  </div>
  ';
}
if(isset($_GET["clearall"]))
{
  $message = '
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Your Shopping Cart has been clear...
  </div>
  ';
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
            <!-- <h1 class="h3 mb-0 text-gray-800"></h1> -->
          </div>
          

          <div class="row">

            <div class="col-lg-12">
     <div class="row">
       
    
      <?php
      $query = "SELECT * FROM product ORDER BY id ASC";
      $statement = $pdo->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      foreach($result as $row)
      {
      ?>
      <div class="col-md-4 ">
        <form method="post" class="card">
          <div align="center">
            <img src="../images/<?php echo $row["image"]; ?>" class="w-100" /><br />

            <h4 class="text-info"><?php echo $row["name"]; ?></h4>

            <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

            <input type="text" name="quantity" value="1" class="form-control" />
            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
            <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
          </div>
        </form>
      </div>
      <?php
      }
      ?> </div>
      
            </div>

            <div class="col-lg-5">
              <h3>Order Details</h3>
      <div class="table-responsive">
      <?php echo $message; ?>
      <div align="right">
        <a href="index.php?action=clear"><b>Clear Cart</b></a>
      </div>
      <table class="table table-bordered">
        <tr>
          <th width="40%">Item Name</th>
          <th width="10%">Quantity</th>
          <th width="20%">Price</th>
          <th width="15%">Total</th>
          <th width="5%">Action</th>
        </tr>
      <?php
      if(isset($_COOKIE["shopping_cart"]))
      {
        $total = 0;
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $keys => $values)
        {
      ?>
        <tr>
          <td><?php echo $values["item_name"]; ?></td>
          <td><?php echo $values["item_quantity"]; ?></td>
          <td>$ <?php echo $values["item_price"]; ?></td>
          <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
          <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
        </tr>
      <?php 
          $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
      ?>
        <tr>
          <td colspan="3" align="right">Total</td>
          <td align="right">$ <?php echo number_format($total, 2); ?></td>
          <td></td>
        </tr>
      <?php
      }
      else
      {
        echo '
        <tr>
          <td colspan="5" align="center">No Item in Cart</td>
        </tr>
        ';
      }
      ?>
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
    