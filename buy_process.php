<?php 
	session_start();
	include 'includes/db.php';

	if (isset($_REQUEST['chk_del_id'])) 
	{
		$chk_del_sql="DELETE FROM checkout where check_id = '$_REQUEST[chk_del_id]'";
		$chk_del_run=mysqli_query($conn,$chk_del_sql);
	}

	if(isset($_REQUEST['up_chk_qty']))
	{
		$up_chk_qty_sql="UPDATE checkout SET check_qty='$_REQUEST[up_chk_qty]' WHERE check_id='$_REQUEST[up_chk_id]'";
		$qty_run=mysqli_query($conn,$up_chk_qty_sql);
	}

	//WHERE check_ref='$_SESSION[ref]'"
	$chk_sel_sql="SELECT * FROM checkout c JOIN items i ON c.check_item = i.item_id WHERE c.check_ref='$_SESSION[ref]'";
	$chk_sel_run=mysqli_query($conn,$chk_sel_sql);
	$c=1;
	while($chk_sel_rows=mysqli_fetch_assoc($chk_sel_run))
	{
		$total=$chk_sel_rows['item_cost']*$chk_sel_rows['check_qty'];
		echo "
			<tr>
				<td>$c</td>
				<td>$chk_sel_rows[item_title]</td>
				<td><input type='number' style='width:45; text-align:center;' onblur=up_chk_qty(this.value,'$chk_sel_rows[check_id]'); min=1 value='$chk_sel_rows[check_qty]'></td>
				<td>$chk_sel_rows[item_cost]</td> "; ?>
				<td><button class='btn btn-danger' onclick="del_func(<?php echo $chk_sel_rows['check_id']; ?>);">Remove</button></td>
				<?php echo"
				<td class='text-right'>$total</td>
			</tr>
		";
		$c++;
	}
?>