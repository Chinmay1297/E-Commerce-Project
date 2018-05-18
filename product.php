<?php
	include 'includes/db.php';
?>
<html>
<head>
	<title>Products</title>
	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body style="background: #e6e6e6;">
	<?php include 'includes/header.php'; ?>
	<div class="container" style="padding-top: 70px; padding-bottom: 70px;">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<?php
						if(isset($_GET['item_id']))
						{
							$sql="SELECT * FROM items WHERE item_id='$_GET[item_id]'";
							$run=mysqli_query($conn,$sql);
							while ($rows=mysqli_fetch_assoc($run)) 
							{
								$sql1="SELECT * FROM item_cat WHERE cat_id='$rows[item_category]'";
								$run1=mysqli_query($conn,$sql1);

								while ($rows1=mysqli_fetch_assoc($run1)) 
								{
									$name12=ucwords($rows1['cat_name']);
									echo "<li><a href='category1.php?category=$rows1[cat_id]&category_name=$cat_slug'>$name12</a></li>";
								}
									echo "<li class='active'>$rows[item_title]</li>";
							}
							
						}
					?>
				</ol>
			</div>
			<?php
					if(isset($_GET['item_id']))
					{
						$sql="SELECT * FROM items WHERE item_id='$_GET[item_id]'";
						$run=mysqli_query($conn,$sql);
						while ($rows=mysqli_fetch_assoc($run)) 
						{
							$item_id=$rows['item_id'];
							echo "<div class='col-md-8 product-desc' >
				
				<h3 class='product-page-title'>$rows[item_title]</h3>
				<img src='$rows[item_image]' class='img-responsive imagebox' alt=''>
				<h3 class='product-description'><u><b>Description</b></u></h4>
				$rows[item_description]
				</div>";
						}
					}
				?>
			
			<aside class="col-md-4">
				<div>
					<a href="buy.php?chk_item_id=<?php echo $item_id; ?>" class="btn btn-success btn-block" style="font-size: 30px; border-radius: 0;">Buy</a>
					<br>
					<ul class="list-group">
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
									<i class="fa fa-2x fa-truck" aria-hidden="true"></i>
								</div>
								<div class="col-md-8">Delivery in 5-7 days</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
									<i class="fa fa-2x fa-refresh" aria-hidden="true"></i>
								</div>
								<div class="col-md-8">Easy return in 7 days</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-4">
									<i class="fa fa-2x fa-phone" aria-hidden="true"></i>
								</div>
								<div class="col-md-8">Call us at 9876543210</div>
							</div>
						</li>
					</ul>
				</div>
			</aside>
		</div>
		<br><br>
		<h2>Related Search Items</h2>
		<section class="col-md-12">
			<?php
				
				$query="select * from items ORDER BY rand() LIMIT 3";
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
		</section>
	</div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
