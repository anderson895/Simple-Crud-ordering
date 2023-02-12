<?php
session_start();
$id=$_SESSION['id'];
?>
<?php 

@include 'config.php';

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
      ";
   }

}

?>
<button onclick="window.print()">Print</button>
 
 <br><br>
 </div>
            <a href='products.php' class='btn'>continue shopping</a>
         </div>