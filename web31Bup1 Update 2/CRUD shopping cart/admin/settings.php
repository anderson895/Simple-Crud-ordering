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
   header("Location:settings.php");
};


?>

    <link rel="stylesheet" href="css/style.css">
<body>			
<!--  //istockphoto-53833576   name sa database
		 //istockphoto-538335769-1024x1024-->			
<br>
<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
<title>Settings</title>
<center><h1>Change Background</h1></center>
 <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>

<br> 
<center><h1>Change Color Header</h1></center>
<center> 

    
	<input type="color" name="cHeader" placeholder="TYPE COLOR">

<input class="btn" type="submit" name="btnSubmit" value="CHANGE">
</center>


</form>
</body>