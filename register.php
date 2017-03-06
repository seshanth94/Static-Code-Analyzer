<?php
   ob_start();
   session_start();
   $url =''
?>
<html lang="en">
   
   <head>
      <title>Static Code Analyzer - Register</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link rel="stylesheet" href="css/style.css"/>
      
   </head>
	
   <body>
    <h2>Static Code Analyzer Online - Register</h2> 
	 <div class="container">
	 <form class="form-signin" role="form" action="<?php echo htmlspecialchars('register_help.php'); ?>" method="post">
            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus></br>
            <input type="password" class="form-control" name="password" placeholder="Password" required></br>
			 <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Register</button>
			
         </form>
	 </div>
   </body>
</html>