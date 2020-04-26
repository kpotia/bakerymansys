<?php if(isset($_GET)){
	include_once '../db.php';
	if (isset($_GET['pid'])) {
		$sql = 'DELETE FROM product where `id` = '.$_GET['pid'];
		$count=$pdo->prepare($sql);
		if($count->execute()){$msg = "PAstry dleted successfuly";}


	}elseif (isset($_GET['uid'])) {
		$sql = 'DELETE FROM users where `id` = '.$_GET['uid'];	
		$count=$pdo->prepare($sql);
		if($count->execute()){$msg = "User dleted successfuly";}
	}
	else{
		$msg ='something went wrong';
	}

} ?>

<script>

				alert("<?php echo $msg;?>");
		
				window.history.back();
	
</script>