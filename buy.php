<?php
	session_start();
	include 'includes/db.php';
	if(isset($_GET['chk_item_id']))
	{
		$date=date('Y-m-d H:i:s');
		$rand_num=mt_rand();

		if(isset($_SESSION['ref']))
		{

		}
		else
		{
			$_SESSION['ref']=$date.'_'.$rand_num;
		}


		$chk_sql="INSERT INTO checkout (check_item,check_ref,check_time,check_qty) values ('$_GET[chk_item_id]','$_SESSION[ref]','$date','1')";
		$chk_run=mysqli_query($conn,$chk_sql);
	}
?>
<html>
<head>
	<title>Payment</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script>
		function ajax_func() 
		{
			xmlhttp=new XMLHttpRequest();

			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState==4 && xmlhttp.status == 200)
				{
					document.getElementById('get_processed_data').innerHTML=xmlhttp.responseText;
				}
			}

			xmlhttp.open('GET','buy_process.php',true);
			xmlhttp.send();
			// var x = document.getElementById("get_processed_data");   // Get the element with id="demo"
			// x.style.color = "red";
			history.pushState(null, "", location.href.split("?")[0]);
		}

		function del_func(chk_id)
		{
			// alert($chk_id);
			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState==4 && xmlhttp.status == 200)
				{
					document.getElementById('get_processed_data').innerHTML=xmlhttp.responseText;
				}
			}

			xmlhttp.open('GET','buy_process.php?chk_del_id='+chk_id,true);
			xmlhttp.send();
		}

		function up_chk_qty(chk_qty,chk_id)
		{
			//alert(chk_qty);
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status == 200)
				{
					document.getElementById('get_processed_data').innerHTML=xmlhttp.responseText;
				}
			}

			xmlhttp.open('GET','buy_process.php?up_chk_qty='+chk_qty+'&up_chk_id='+chk_id,true);
			xmlhttp.send();
		}
	</script>
</head>  
<body onload="ajax_func();">
	<?php include 'includes/header.php'; ?>
	<br><br><br><br><br><br>
	<div class="container">
		<div class="page-header">
			<h2 class="pull-left"><b>Checkout</b></h2>
			<div class="pull-right"><button class="btn btn-success" data-toggle="modal" data-target="#proceed_modal" data-backdrop="static" data-keyboard="false">Proceed</button></div>
			<!----The Proceed form modal---->
			<div id="proceed_modal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button class="close" data-dismiss="modal">&times;</button>
							<br>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" id="name" class="form-control" placeholder="Full Name">
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" id="email" class="form-control" placeholder="xyz@abc.com">
								</div>
								<div class="form-group">
									<label for="contact">Contact Number</label>
									<input type="text" id="contact" class="form-control" placeholder="9876543210">
								</div>
								<div class="form-group">
									<label for="city">States</label>
									<input list="states" class="form-control">
									<datalist id="states">
										<option>Odisha</option>
										<option>Punjab</option>
										<option>Delhi</option>
										<option>Madhya Pradesh</option>
										<option>Uttar Pradesh</option>
										<option>Mumbai</option>
									</datalist>
								</div>
								<div class="form-group">
									<label for="address">Delivery Address</label>
									<textarea class="form-control" rows="5"></textarea>
								</div>
								<div class="form-group">
									<input type="submit" value="Submit" class="btn btn-danger btn-block">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Order Details</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>S.no</th>
							<th>Item</th>
							<th>Qty</th>
							<th>Price</th>
							<th width="5%">Delete</th>
							<th class="text-right">Total</th>
							
						</tr>
					</thead>
					<tbody id="get_processed_data">
						<!----------  The Buy Process Data  ---------->
						<!-- <tr>
							<td>fuck</td>
							<td>you</td>
							<td>fuck</td>
							<td>off</td>
							<td><button class='btn btn-danger'>Remove</button></td>
							<td class='text-right'>fuck off</td>
						</tr> -->

					</tbody>
				</table>
				<table class="table">
					<thead>
						<tr>
							<th class="text-center" colspan="2">Order Summary</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left">Subtotal</td>
							<td class="text-right">Rs.2850</td>
						</tr>
						<tr>
							<td class="text-left">Delivery Charges</td>
							<td class="text-right">FREE</td>
						</tr>
						<tr>
							<td class="text-left">Grand Total</td>
							<td class="text-right"><b>Rs.2850</b></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>