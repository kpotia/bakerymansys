<?php 
  session_start();
  require '../db.php';

  // Init vars
  $name = $email = $password = $confirm_password = $level ='';
  $name_err = $email_err = $level_err = $password_err = $confirm_password_err = '';

  // Process form when post submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Sanitize POST
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
var_dump($_POST);
    // Put post vars in regular vars
    $name =  trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $level = trim($_POST['level']);
    $confirm_password = trim($_POST['confirm_password']);
    // var_dump($_POST);
    // Validate email
    if(empty($email)){
      $email_err = 'Please enter email';
    } else {
      // Prepare a select statement
      $sql = 'SELECT id FROM `users` WHERE email = :email';

      if($stmt = $pdo->prepare($sql)){
        // Bind variables
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            $email_err = 'Email is already taken';
          }
        } else {
          die('Something went wrong');
        }
      }

      unset($stmt);
    }

    // Validate name
    if(empty($name)){
      $name_err = 'Please enter name';
    }

    // Validate name
    if(empty($level)){
      $level_err = 'Please enter level';
    }

    // Validate password
    if(empty($password)){
      $password_err = 'Please enter password';
    }

    // Validate Confirm password
    if(empty($confirm_password)){
      $confirm_password_err = 'Please confirm password';
    } else {
      if($password !== $confirm_password){
        $confirm_password_err = 'Passwords do not match';
      }
    }

    // Make sure errors are empty
    if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
      // Hash password
      $passwordh = password_hash($password, PASSWORD_DEFAULT);

      // Prepare insert query
      // $sql = 'INSERT INTO `users` (name, email, password,level) VALUES (:name, :email, :password, :level)';
      $sql = 'INSERT INTO `users` (`name`, `level`, `email`, `password`) VALUES (:name, :level,:email, :password) ';

      if($stmt = $pdo->prepare($sql)){
        // Bind params
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        // var_dump($stmt);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // var_dump($stmt);
        $stmt->bindParam(':password', $passwordh, PDO::PARAM_STR);
        // var_dump($stmt);
        $stmt->bindParam(':level', $level, PDO::PARAM_STR);
        // var_dump($stmt);
        $res = $stmt->execute();
        var_dump($res);
        // Attempt to execute
        if($res){
          // Redirect to login
          header('location: staff.php');
        } else {
          // var_dump($pdo->errorInfo());
          // die('Something went wrong');

        }
      }
      unset($stmt);
    }

    // Close connection
    unset($pdo);
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
            <h1 class="h3 mb-0 text-gray-800">Add Staff</h1>
          </div>

          <div class="conatiner">
                   <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light">
          
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
              <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>

          <div class="form-group">
              <label for="level">Level</label>
              <select name="level" id="level" class="form-control form-control-lg " >
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
              <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
              <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
              <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-row">
              <div class="col">
                <input type="submit" value="Register" class="btn btn-success btn-block">
              </div>
             
            </div>
          </form>
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