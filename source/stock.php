<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-gb" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script type="text/javascript">

function validated(string) {

	for (var i=0, output='', valid='0123456789'; i<string.length; i++)

	if (valid.indexOf(string.charAt(i)) != -1)

	output += string.charAt(i)

	return output;

} 


function calcResult(Text1){
	$.ajax({
		type: "POST",
		url: "getStock.php",
		beforeSend: function () {
			$("#result").html("Loading...");
		},
		data: "Text1="+Text1,
		success: function(msg){
			$("#result").html(msg);
		}
	});
}
</script>


</head>

<body>



<?php

require_once('db.php');	

$result = mysqli_query($con,"SELECT * FROM stock");

echo "<table width='100%' border='1'>
<tr>
<th>Code</th>
<th>Name</th>
<th>Cost</th>
<th>Retail</th>
<th>&nbsp;</th>
<th>Quantity</th>
<th>(p) price</th>
<th>(p) amount</th>
<th>ID</th>
<th>Supplier</th>
<th>Location</th>
<th>Reorder</th>
<th>Category</th>
<th>Notes</th>
</tr>";

while($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['code'] . "</td>";
	echo "<td>" . $row['item_name'] . "</td>";
	echo "<td>" . $row['cost_price'] . "</td>";
	echo "<td>" . $row['retail_price'] . "</td>";

	$new = $row['retail_price'] - $row['cost_price'];
	echo "<td>" . $new. "</td>";
	echo "<td>" . $row['quantity'] . "</td>";
	echo "<td>" . $row['promo_price'] . "</td>";
	echo "<td>" . $row['promo_amount'] . "</td>";
	echo "<td>" . $row['serial_number'] . "</td>";
	echo "<td>" . $row['supplier'] . "</td>";
	echo "<td>" . $row['location'] . "</td>";
	echo "<td>" . $row['reorder_level'] . "</td>";
	echo "<td>" . $row['category'] . "</td>";
	echo "<td>" . $row['description'] . "</td>";
	  
	echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>

<input name="Text1" id="Text1" type="text" />

<input name="btnGo" onclick='<?php echo "calcResult(Text1.value)" ?>' type="button" value="  Go!  " />
<div id="result"></div>

</body>

</html>
