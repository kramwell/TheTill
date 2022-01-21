<?php

require_once('db.php');	

	//$ucode = substr(md5(uniqid(mt_rand(), true)) , 0, 8); //create random 8 char $ucode
	$ucode = rand(00000000,99999999);

	if(isset($_REQUEST['item_number'])){

		$item_no = mysqli_real_escape_string($link, trim($_REQUEST['item_number']));
		$item_quantity = mysqli_real_escape_string($link, trim($_REQUEST['item_quantity']));

		if(isset($_REQUEST['change_quantity'])){

				$change_quantity = mysqli_real_escape_string($link, trim($_REQUEST['change_quantity']));
			
				mysqli_query($link, "DELETE FROM transactions WHERE ucode='$change_quantity' AND trans_id='$_COOKIE[trans_id]'");		
			
		}

		if ($item_no == ""){
		$item_no = 0;
		}
			

		$result = mysqli_query($link, "SELECT * FROM stock WHERE code = $item_no"); 
		$items = mysqli_fetch_assoc($result); 
		$num_rows = mysqli_num_rows($result);

		if ($num_rows == 1){

			$price = $items['retail_price'] * $item_quantity;

			mysqli_query($link, "INSERT INTO transactions (trans_id, item_name, retail_price, code, quantity, ucode) 
			VALUES ('$_COOKIE[trans_id]', '$items[item_name]', '$price', '$items[code]', '$item_quantity', '$ucode')");


			if (($items['promo_amount']=="") || ($items['promo_amount']=="0")){ 
			}else{
				//here we must now check for promo-

				$ucodeMulti = "Promo *".$ucode; 
				$quantity_new = $item_quantity - $items['promo_amount'];

				while ($quantity_new >= 0){

					//insert new row into transactions
					mysqli_query($link, "INSERT INTO transactions (trans_id, item_name, retail_price, code, quantity, ucode) 
					VALUES ('$_COOKIE[trans_id]', '$ucodeMulti', '$items[promo_price]', '997', '1', '$ucode')");

					$quantity_new = $quantity_new - $items['promo_amount'];

				}

			} //promo

		}//row found

		mysqli_free_result($result);

	} //end if item_number is sent


	if(isset($_REQUEST['new_name'])){
		
		$new_name = mysqli_real_escape_string($link, trim($_REQUEST['new_name']));
		$new_new = mysqli_real_escape_string($link, trim($_REQUEST['new_new']));
		$new_price = mysqli_real_escape_string($link, trim($_REQUEST['new_price']));
		
		$new_name = $new_name." *".$new_new;
	
		mysqli_query($link, "INSERT INTO transactions (trans_id, item_name, retail_price, code, quantity, ucode) 
		VALUES ('$_COOKIE[trans_id]', '$new_name', '$new_price', '999', '1', '$ucode')");
		
	} //end if new_name is sent


	if(isset($_REQUEST['discount_name'])){
		
		$discount_name = mysqli_real_escape_string($link, trim($_REQUEST['discount_name']));
		$discount_new = mysqli_real_escape_string($link, trim($_REQUEST['discount_new']));
		$discount_price = mysqli_real_escape_string($link, trim($_REQUEST['discount_price']));
		$discount_price = -$discount_price;
		
		$discount_name = $discount_name." *".$discount_new;
		
	
		mysqli_query($link, "INSERT INTO transactions (trans_id, item_name, retail_price, code, quantity, ucode) 
		VALUES ('$_COOKIE[trans_id]', '$discount_name', '$discount_price', '998', '1', '$ucode')");
				
	} //end if new_name is sent

	if(isset($_REQUEST['delete_item'])){
		
		$delete_item = mysqli_real_escape_string($link, trim($_REQUEST['delete_item']));		
	
		mysqli_query($link, "DELETE FROM transactions WHERE ucode='$delete_item' AND trans_id='$_COOKIE[trans_id]'");
		
	} //end if is sent

	if(isset($_REQUEST['erase'])){
			
		mysqli_query($link, "DELETE FROM transactions WHERE trans_id='$_COOKIE[trans_id]'");
		
	} //end if is sent


?>
