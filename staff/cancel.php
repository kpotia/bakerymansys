<?php 
	
	if (isset($_GET['oid'])) {
		$sql = 'UPDATE `orders` SET status = `cancel` WHERE `id` = '.$_GET['oid'];

		include_once '../db.php';

		if($pdo->query($sql)){
?>
<script>
	alert('order cancelled');window.location = 'orders.php';
</script>

<?php
		}
	}else{?>
<script>
	alert('order ID not set');window.location = 'orders.php';
</script>

<?php

	}

 ?>