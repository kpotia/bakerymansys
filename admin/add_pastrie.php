<?php 
  session_start();
  require '../db.php';
 
    //setup a directory where images will be saved 

    if (isset($_POST['action']) && $_POST['action'] == 'add_pastry') {
      # code...
    
    $target = "../images/"; 
    $target = $target . basename( $_FILES['photo']['name']); 
    
    //Sanitize the POST values
    $name = trim($_POST['name']);
    
    $price = trim($_POST['price']);
    
    $photo = trim($_FILES['photo']['name']);
    // var_dump($_FILES);

    //Create INSERT query
    $qry = "INSERT INTO `product` (`name`, `image`, `price`) VALUES ( :p_name, :p_img, :p_price) ";

    
    

    if($stmt = $pdo->prepare($qry)){
        // Bind params
        $stmt->bindParam(':p_name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':p_img', $photo, PDO::PARAM_STR);
        $stmt->bindParam(':p_price', $price, PDO::PARAM_STR);

        // Attempt to execute
        if($result = $stmt->execute()){
          // Redirect to login
          header('location: index.php');
        } 
    }
    var_dump($result);
    //Check whether the query was successful or not
    if($result) {
            //Writes the photo to the server 
         $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
         
         if($moved) 
         {      
             //everything is okay
             echo "The photo ". basename( $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory"; 
         } else {  
             //Gives an error if its not okay 
             echo "Sorry, there was a problem uploading your photo. "  . $_FILES["photo"]["error"]; 
         }
        header("location: pastries.php");
        exit();
    }else {
        // die("Query failed " . mysqli_error($conn));
      die('error while adding pastry');
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
            <h1 class="h3 mb-0 text-gray-800">Add Pastry</h1>
          </div>

          <div class="row">
            <div class="col-8">
              <form action="" method="post"  enctype="multipart/form-data">
                

                    <div class="form-group">
                      <label >Pastry Name</label>
                      <input type="text" name="name" class="form-control"placeholder="Enter Pastry Name">
                      
                    </div>
                    <div class="form-group">
                      <label >Pastry Price</label>
                      <input class="form-control" type="number" name="price" placeholder="Enter Pastry Price">
                    </div>
                    <div class="form-group">
                      <label >Pastry Picture</label>

                      
                        <input type="file" class="file-input" name="photo" id="customFile">
                        <!-- <label class="custom-file-label" for="customFile">Choose Pastry Picture</label> -->
                      <!-- </div> -->
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="action" value="add_pastry">Submit</button>
                  
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