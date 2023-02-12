<?php

@include 'config.php';
include 'header.php';
$id=$_SESSION['id'];
if(isset($_POST['orders_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` where userID ='$id'");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };
   $delete="DELETE From cart where userID='$id'";
   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total') ") or die('query failed');

   if($cart_query && $detail_query){
      $test = mysqli_query($conn,$delete);
      echo "
      <div class='orders-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='orders-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='products.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php //include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your orders</h1>

   <form action="bill.php" method="post">

   <div class="display-orders" >
    <h2>  <?php
        
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` where userID = '$id'");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
	  
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
	<br><br>
   <?php
         }
      }else{
         echo "<div class='display-orders'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : <font style="color:red;">$<?= $grand_total; ?></font></span>
   </h1>
   <br></div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on delivery</option>
               <option value="Gcash">Gcash</option>
			   <option value="credit cart">credit cart</option>
            
               <option value="Paymaya">Paymaya</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>House No.</span>
            <input type="text" placeholder="e.g. 634" name="flat" required>
         </div>
         <div class="inputBox">
            <span>Street Name</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>City</span>
            <input type="text" placeholder="e.g. Marilao" name="city" required>
         </div>
         <div class="inputBox">
            <span>Province</span>
            <input type="text" placeholder="e.g. Bulacan" name="state" required>
         </div>
         <div class="inputBox">
            <span>Country</span>
            <input type="text" placeholder="e.g. Philippines" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="orders now" name="orders_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>