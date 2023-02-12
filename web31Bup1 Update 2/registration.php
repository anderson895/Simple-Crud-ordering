<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<style>
		body{
			
			background-color:#00bcd4;
		}
		.Error{
			color:red;
			
		}


</style>

<body>
<?php
    require('db.php');
	
	
	$usernameErr="";
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
		
		
		$check_username = mysqli_query($con,"SELECT * from users WHERE username='$username'");
		$check_username_row = mysqli_num_rows ($check_username);
		
		if($check_username_row ==0){
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '$password', '$email', '$create_datetime')";//" . md5($password) . "
       
	   $result   = mysqli_query($con, $query);
	    if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
		}else if($check_username_row ==1){
			
			$usernameErr = "USERNAME IS ALREADY EXIST !";
			
			?> 

			 <form class="form" action="" method="post" style="background-color:#ffeb3be8;">
        <h1 class="login-title" style="color:black;">Registration</h1>
		Username <br>
        <input type="text" class="login-input" name="username" placeholder="Username" required /><span class="Error"><?php echo $usernameErr; ?></span><br><br>
		
		Email Address
	   <input type="text" class="login-input" name="email" placeholder="Email Adress">
        Password
		<input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link" style="color:black;">Already have an account? <a href="login.php" style="color:black;">Login here</a></p>
    </form>
			
			<?php 
		}

       
    } else {
?>
    <form class="form" action="" method="post" style="background-color:#ffeb3be8;">
        <h1 class="login-title" style="color:black;">Registration</h1>
		Username <br><span class="Error"><?php echo $usernameErr; ?></span>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
		Email Address
	   <input type="text" class="login-input" name="email" placeholder="Email Adress">
        Password
		<input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link" style="color:black;">Already have an account? <a href="login.php" style="color:black;">Login here</a></p>
    </form>
<?php
    }
	
?>
</body>
</html>
