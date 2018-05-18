<?php
	include 'includes/db.php';
?>
<head>
	<title>Online Shopping</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	
	<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
		<div class="row">
			<?php
				$query="select * from items order by rand()";
				$run=mysqli_query($conn,$query);
				while ($rows=mysqli_fetch_assoc($run)) 
				{
					$item_title_url=str_replace(' ','-',$rows['item_title']);
					echo "<div class='col-md-3'>
				<div class='col-md-12 single-item nopadding'>
					<div class='top'><img src='$rows[item_image]' style=' max-height:100%; max-width:100%;' class='item-img'alt=''></div>
					<div class='bottom'>
						<div class='item-title' align='center'><a href='product.php?item_id=$rows[item_id]&item_title=$item_title_url'>$rows[item_title]</a></div>
						<div class='original-price col-md-12 text-muted' align='center'><del>Rs. $rows[item_price]</del></div>
						<div class='discount-price col-md-12' align='center'>Rs. $rows[item_cost]</div>
					</div>
				</div>
			</div>";
				}
			?>
		</div>
	<?php include 'includes/footer.php';  ?>
</body>
</html>