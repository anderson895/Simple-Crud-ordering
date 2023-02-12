<?php 
include 'config.php';

$id = $_GET["id"];

   $insert_query = mysqli_query($conn, "UPDATE `orders` SET status='1' where id=$id") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
	  header("Location: order.php");
   }else{
      $message[] = 'could not add the product';
   }



 ?>