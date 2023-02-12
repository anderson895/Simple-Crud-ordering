<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>


<style>
		body{
			
			background-color:#00bcd4;
		}


</style>

<?php 
session_start();
include("db.php");


$username = $password="";
$usernameErr = $passwordErr="";


if(isset($_POST["submit"])){
	
	
	//Login
if(empty($_POST["username"])){
	
	$usernameErr ="username is Required !";
}else{
	
	$username = $_POST["username"];
	
	
	//PAssword
}if(empty($_POST["password"])){
	
	$passwordErr ="Password is Required !";
}else{
	
	$password = $_POST["password"];
}
if($username AND $password){
		
		$check_username = mysqli_query($con,"SELECT * from users WHERE username='$username'");
		$check_username_row = mysqli_num_rows ($check_username);
		
		if($check_username_row  > 0){
			
			$row = mysqli_fetch_assoc($check_username);
			$id  = $row["id"];
			$db_password = $row["password"];
			$accountype= $row["account_type"];
			
			if($password==$db_password){
				
				$_SESSION["id"]=$id; 
				$_SESSION["username"]=$username;
			
				if($accountype==1){
					//redirect admin
						echo "<script>window.location.href='CRUD shopping cart/admin/admin.php?id=$id';</script>";	
					
				}else{
					//redirect user
					echo "<script>window.location.href='CRUD shopping cart/costumer/cart.php?id=$id';</script>";	
				}
				
			}else{
				
				$passwordErr="Password incorrect !";
				
			}
		}else{
			
			$usernameErr = "Email is Not Registered !";
		}
		
		
		
	}
}
?>

<style>
.Error{
	color:red;
	
}

</style>

<body>

    <form class="form" method="post" name="login" style="background-color:#ffeb3be8;">
        <h1 class="login-title" style="color:black;">Login</h1>
		Username <br><span class="Error"><?php echo $usernameErr; ?></span>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
		Password <br><span class="Error"><?php echo $passwordErr; ?></span>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link" style="color:black;" >Don't have an account? <a href="registration.php" style="color:black;">Registration Now</a></p>
  </form>
  

<footer>
<div class="container" style="background-color:white;">



 
 
</footer>

</div>

</body>
</html>
