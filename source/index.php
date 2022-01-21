<?php

require_once('db.php');	


if(!isset($_COOKIE['trans_id'])){
//set cookie
	$transid = substr(md5(uniqid(mt_rand(), true)) , 0, 10); //create random 10 char transaction ID
	setcookie('trans_id',$transid,time() + (3600),'/'); // 1hour transaction time	
	setcookie('trans_time',time() + (3600),time() + (3600),'/'); // 1hour transaction time	
	header("Refresh:0");
}	

$result = mysqli_query($link, "SELECT * FROM transactions WHERE trans_id = '$_COOKIE[trans_id]'");
while($row = mysqli_fetch_array($result)){
	//work out the total by adding every loop
	$totalTrans = $totalTrans + $row['retail_price'];
}
mysqli_free_result($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-gb" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

$(document).ready(function () {
	$("#Text1").focus();
});

$(function() {
	var $selector = $('Text1');
	$(document.body).off('keyup', $selector);
	// Bind to keyup events on the $selector.
	$(document.body).on('keyup', $selector, function(event) {
		if(event.keyCode == 13) { // 13 = Enter Key
		addtoOrder(Text1.value);
		}
	});
});

function validated(string) {

	for (var i=0, output='', valid='0123456789'; i<string.length; i++)

	if (valid.indexOf(string.charAt(i)) != -1)

	output += string.charAt(i)

	return output;
} 

jQuery(function(){

	jQuery("#btnAdd").click(function () {
		jQuery("#newItem").toggle("slow");
	});
		jQuery("#btnDiscount").click(function () {
	jQuery("#discount").toggle("slow");
	}); 

});


function btnErase(){
var s=confirm("Are you sure?");
if (s==true)
{
	var id1=0  ;
	$.ajax({
		type: "POST",
		url: "getStock.php",
		data: "erase="+id1,
		success: function(){
			window.location.href='./';
		}
	});
}
}

function deleteTrans(strid){
	var s=confirm("Are you sure?");
	if (s==true)
	{
		if (strid.length==0)
		{ 
			alert("error");
			return;
		}
		$.ajax({
			type: "POST",
			url: "getStock.php",
			data: "delete_item="+strid,
			success: function(){
				window.location.href='./';
			}
		});
	}
}


function changeQuantity(Quan,item_no,ucode1){
var quantity=prompt("please enter quantity",Quan);

	if (quantity!=null && quantity!="")
	{

		quantity = parseInt(quantity);
		if (isNaN(quantity))
		{
			alert('Please enter numbers only!');
		}else{

		    $.ajax({
			    type: "POST",
			    url: "getStock.php",
			       
				beforeSend: function () {
					$("#b4result").html("Loading...");
				},
				data: { item_quantity: quantity, change_quantity: ucode1, item_number: item_no },
				success: function(msg){
					window.location.href='./';       
				}

			});
		}
	}else{
	window.location.href='./';
	}


}

function addNewtoOrder(NewName, New, NewPrice){
//here we need to be able to add a new item 

	if (NewName!=null && NewName!=""){
		if (New!=null && New!=""){
			if (NewPrice!=null && NewPrice!=""){

				//add values to send
				$.ajax({
					type: "POST",
					url: "getStock.php",
				       
					beforeSend: function () {
						$("#b4result").html("Loading...");
					},

					data: { new_name: NewName, new_new: New, new_price: NewPrice },

				    success: function(msg){
						window.location.href='./';       }
				});

			}
		}
	}

}

function addDistoOrder(DiscountName, Discount, DiscountPrice){
//here we need to be able to discount the total, we get the values from the box's
//and use them to add to db.

	if (DiscountName!=null && DiscountName!=""){
		if (Discount!=null && Discount!=""){
			if (DiscountPrice!=null && DiscountPrice!=""){

				//add values to send
				$.ajax({
				type: "POST",
				url: "getStock.php",
				       
				beforeSend: function () {
					$("#b4result").html("Loading...");
				},

				data: { discount_name: DiscountName, discount_new: Discount, discount_price: DiscountPrice },
					   
				success: function(msg){
					window.location.href='./';       
				}

				});

			}
		}
	}


}

function addtoOrder(Text1){

	if (Text1!=null && Text1!=""){

		var quantity=prompt("please enter quantity",'1');

		if (quantity!=null && quantity!=""){

			quantity = parseInt(quantity);
			if (isNaN(quantity)){
			alert('Please enter numbers only!');
			}else{

			    $.ajax({
				    type: "POST",
				    url: "getStock.php",
				       
					beforeSend: function () {
				    	$("#b4result").html("Loading...");
				    },

					data: { item_number: Text1, item_quantity: quantity },
					   
				    success: function(msg){
						window.location.href='./';       
					}

			    });

			}

		}
	}else{
		window.location.href='./';
	}

}

</script>

<style type="text/css">
table.tillTable {
	width:60%;
}
table.tillTable tr td:hover { 
	background-color: #D6D6C2;
}
</style>

</head>

<body>

<p>The Till v0.64</p>


<input name="Text1" id="Text1" onchange='this.value=validated(this.value)' maxlength="4" onkeyup='this.value=validated(this.value)' type="text" />

<input name="btnNew" id="btnNew" onclick="addtoOrder(Text1.value)" type="button" value="  ADD  " />
<span id="b4result"></span>
<br /><br />
<table style="width: 80%">
	<tr>
		<td>
			<input name="btnAdd" id="btnAdd" type="button" value="  NEW  " />
			<input name="btnDiscount" id="btnDiscount" type="button" value="  DISCOUNT  " />
		</td>
		<td>
			<input name="btnCheckout" id="btnCheckout" onclick="btnCheckout()" type="button" value="  CHECKOUT  " />		
		</td>	
	</tr>
</table>



<div id="discount" style="display:none;" >
<p>Please Enter Discount:</p>
Name <input name="txtDiscountName" id="txtDiscountName" type="text" />
Reason <input name="txtDiscount" id="txtDiscount" type="text" />
Price <input name="txtDiscountPrice" id="txtDiscountPrice" type="text" /><br/>
<input name="btnDiscountItem" id="btnDiscountItem" onclick="addDistoOrder(txtDiscountName.value, txtDiscount.value, txtDiscountPrice.value)" type="button" value="  Discount  " />
</div>

<div id="newItem" style="display:none;" >
<p>Please Enter New Item:</p>
Name <input name="txtNewName" id="txtNewName" type="text" />
Reason <input name="txtNew" id="txtNew" type="text" />
Price <input name="txtNewPrice" id="txtNewPrice" type="text" /><br/>
<input name="btnNewItem" id="btnNewItem" onclick="addNewtoOrder(txtNewName.value, txtNew.value, txtNewPrice.value)" type="button" value="  Add Item  " />
</div>


<p><?php echo $totalTrans; ?></p>

<p>
<?php
	//display cookie time left
	$transTime =  $_COOKIE['trans_time'] - date(time());
	$TotalMinutes = floor((($transTime % 86400)%3600)/60);
	$TotalSeconds = floor(((($transTime % 86400)%3600)%60));
	echo $TotalMinutes." : ".$TotalSeconds;
?>
</p>




<div id="result">
<?php	

$result = mysqli_query($link, "SELECT * FROM transactions WHERE trans_id = '$_COOKIE[trans_id]'");

echo "<p>Receipt: <strong>". $_COOKIE['trans_id'] ."</strong></p>";

echo "<table class='tillTable' >
	<tr>
	<th style='text-align:left' >Item</th>		
	<th style='text-align:left' >Name</th>
	<th style='text-align:left' >Quantity</th>	
	<th style='text-align:left' >Retail</th>
	<th style='text-align:left' >&nbsp;</th>
	</tr>";


while($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>". $row['code'] ."</td>";  
	echo "<td>". $row['item_name'] ."</td>";

	echo "<td onclick='changeQuantity(".$row['quantity'].",".$row['code'].",".$row['ucode'].")'>". $row['quantity'];

	$retail = $row['retail_price'] / $row['quantity'];

	if ($retail == $row['retail_price']){
		echo "</td>";	
	}else{
		echo " @ £".$retail."</td>";	
	}

	echo "<td>£". $row['retail_price'] ."</td>";
	echo "<td><img onclick='deleteTrans(this.id)' id='".$row['ucode']."' alt='Remove' longdesc='Remove' title='Remove' src='edit-delete.gif' /></td>";
	echo "</tr>";  
}

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>"; 
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
  echo "</tr>";

  echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>"; 
echo "<td>Total:</td>";
echo "<td>£".$totalTrans."</td>";
echo "<td>&nbsp;</td>";
  echo "</tr>";

echo "</table>";

mysqli_free_result($result);

?>

</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<hr />
LOGGED ON :

<input name="btnCloseTill" id="btnCloseTill" onclick="btnCloseTill()" type="button" value="  SHIFT END  " />		
<input name="btnErase" id="btnErase" onclick="btnErase()" type="button" value="  START AGAIN  " />


</body>

</html>
