<?php 
include 'config.php';
 include 'header.php'; 


$cHeader ="";
if(isset($_POST['btnSubmit'])){

		$cHeader= $_POST["cHeader"];
   //fsdagfj
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'images/'.$p_image;

   $insert_query = mysqli_query($conn, "UPDATE `settings` SET image='$p_image',color='$cHeader'") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};
//start code for done
	


if(isset($_POST['btnDone'])){
$new_status = $_POST["new_status"];
$db_status = $new_status;
		
   $insert_query = mysqli_query($conn, "UPDATE `orders` SET status='1' where id=$") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};
//end code for done


?>


<title>Order</title>

    <link rel="stylesheet" href="css/style.css">
<body>	
<center>
<table border="1" width="100%" style="background-color:white;">		
<form method="POST">
		
	
	
	
	<tr>
	<td>
			<b>Fullname</b>
		</td>
		<td>
			<b>Contact No.</b>
		</td>
		
		
		
		<td>
			<b>Payment Method</b>
		</td>
		<td>
			<center><b>Complete Address</b></center>
		</td>
		<td>
			<center><b>STATUS</b></center>
		</td>
		
		
		
	</tr>
		
	<tr>
		
	<td colspan="4"><hr></td>
	</tr>

<?php
	
	// code for count
	$count_query = mysqli_query($conn,"select COUNT(*)as total FROM orders where status='0'");
	$row_count = mysqli_fetch_assoc($count_query);
    $count = $row_count["total"];
	// code for count
		$completeAddres="";
		$view_query = mysqli_query($conn,"SELECT * from orders where status='0' "); 
		// where account_type='0'
		
		while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
			
			$id = $row["id"];
			$db_name = $row["name"];
			$db_number = $row["number"];
			
			$db_method = $row["method"];$db_name = $row["name"];
			$db_flat = $row["flat"];
			$db_street = $row["street"];
			$db_city = $row["state"];$db_name = $row["name"];
			$db_country = $row["country"];
			$db_pin_code = $row["pin_code"];
			$db_total_products = $row["total_products"];
			$db_total_price = $row["total_price"];
			
		
			
			
			
		
			
			$completeAddres = ucfirst($db_flat)." ".ucfirst($db_street) .". ".ucfirst($db_city);
		
					
			
			echo "<tr> 
					<td>$db_name </td>
					<td>$db_number </td>
					
					<td>$db_method</td>
					<td><center>$completeAddres</center></td>
					<td>
					<a href='confirmation.php?id=$id'>DONE</a> || 
				<a href='cancel.php?id=$id'>CANCEL</a>
					
				
				  </tr>
				  
				  <br>
			 
				  
				  
				  
";
		}
	
	?>		
	
	
<br>

 </table>
  <?php// code for count
	$count_query = mysqli_query($conn,"select COUNT(*)as total FROM orders where status='0'");
	$row_count = mysqli_fetch_assoc($count_query);
	 $count = $row_count["total"];
	// code for count ?>
 	 
	  <?php
if ($count>0){
	   echo " <h1>THE TOTAL ORDER :<font color='red'>$count </font></h1>";
	  
}else{
	echo" <font color='red' size='40px'> NO RECORD FOUND </font>";
	
}
	  ?></font>
	  </h1>
				 
 </center>
 
</body>