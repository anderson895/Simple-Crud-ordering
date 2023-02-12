<?php
session_start();
$id=$_SESSION['id'];
?>
<?php
         
		 //istockphoto-53833576   name sa database
		 //istockphoto-538335769-1024x1024
		 
            $select_products = mysqli_query($conn, "SELECT * FROM `settings`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
<style>      

body{
	
	 background-image: url("images/<?php echo $row['image']; ?>");
	 background-repeat: no-repeat, repeat;
	  background-position: center; /* Center the image */
	  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
   	
			

<header class="header" style="background-color:<?php echo $row['color']; ?>;">
  <?php
			   }};    ?>
   <div class="flex">

      <a href="#" class="logo">ADMIN</a>

      <nav class="navbar" >
         <a href="order.php">ORDER</a>
         <a href="admin.php">add products</a>
       
		
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart` where userID = '$id'") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
<a href="settings.php"  class="cart"> Settings </a>
      <a href="../../logout.php"  class="cart">Logout  </a>
      
	  
	  

     
      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>