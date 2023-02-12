
<?php 
include 'config.php';

$id = $_GET["id"];

   $insert_query = mysqli_query($conn, "DELETE from`orders` where id=$id") or die('query failed');

   if($insert_query){
     
	  header("Location: order.php");
   }else{
      $message[] = 'Error';
   }



 ?>
?>