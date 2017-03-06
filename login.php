<?php
   ob_start();
   session_start();
?>
<html lang="en">
   
   <head>
      <title>Static Code Analyzer</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link rel="stylesheet" href="css/style.css"/>
      
   </head>
	
   <body>
      
      <h2>Static Code Analyzer Online</h2> 
      <div class="container form-signin">
         
         <?php
            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
				
				$connection = @mysql_connect("localhost:3306", "root", "rainbow");
				if (!$connection) {
				die('Could not connect: ' . mysql_error());
				}
				$db = @mysql_select_db("staticcodeanalyzer_db", $connection);
				$username = mysql_real_escape_string($_POST['username']);
				$password = md5(mysql_real_escape_string($_POST['password']));
				//echo $password;
				$command = "select UserId from login where username='".$username."' and password='".$password."'";
				//echo $command;
				$sql=@mysql_query($command, $connection);
				$row = @mysql_fetch_assoc($sql);
				$userId =$row['UserId'];
				$_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $username;
				$_SESSION['userid'] = $userId;
				if(!isset($_SESSION['userid'])){
					@mysql_close($connection); // Closing Connection
					header('Location: login.php?status=Invalid%20UserName%20or%20Password!'); // Redirecting To Home Page
					die();
				}
				header('Location: home.php');
				die();
            }
         ?>
      </div> <!-- /container -->
      
      <div class="container">
      
         <form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <!--  <h4 class="form-signin-heading">Static Code Analyzer Online</h4> -->
            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus></br>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
         </form>
		 <form class="form-signin" action="/StaticCodeAnalyzer/register.php">
			<input type="submit" class="btn btn-lg btn-primary btn-block"  value="Register">	
			<p><?php  if(isset($_GET['status']))
			{ echo $_GET['status']; 
		}?></p>
		</form>
		
			
       <!--  Click here to clean <a href="logout.php" tite="Logout">Session. -->
         
      </div> 
      
   </body>
</html>