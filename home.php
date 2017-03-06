<?php  session_start(); 
if(!isset($_SESSION['userid'])){
	header("location: login.php");
}
$userid = $_SESSION['userid'];
?>
<html>
<head>
     <title>Static Code Analyzer - Home</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

 <h2>Static Code Analyzer Online</h2> 
 <br/>
  <div class="container">
  <h3>Welcome <?php echo $_SESSION['username'];?>! <a href="logout.php" tite="Logout" style="float:right">Logout</a></h3>
 <br/>
 <h4 style="color:green" >
 <?php
 if(isset($_GET['status'])){
 echo urldecode($_GET['status']);}
 ?>
 </h4>
 <h4>The Static Code Analyzer, analyzes CPP Code and provides the Analysis using CPP Check Static Analysis Tool. Upload a CPP file to our
server to start the Analysis </h4>
<form  class="form-signin" action="upload_file.php" method="post" enctype="multipart/form-data">

<input type="file" class="form-control" name="upload" accept="text/x-c" placeholder="Select a File:" required autofocus> 
<br/>
<button class="btn btn-lg btn-primary btn-block" type="submit" name="upload">Upload</button>
</form>

<h4>Your History is Below:</h4>

<?php
$connection = @mysql_connect("localhost:3306", "root", "rainbow");
				if (!$connection) {
				die('Could not connect: ' . mysql_error());
				}
$db = @mysql_select_db("staticcodeanalyzer_db", $connection);
$command = "select FileName,TimeStamp,Output from history where UserId='".$userid."'";
$result = mysql_query($command);
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<table class=\"table table-striped\">";
	echo "<tbody><tr>";
   echo "<th>". $row[0]."</th>";
   echo "<th>". $row[1]."</th></tr>";
  echo "<tr><th>". $row[2]."</th></tr>";
  echo "</tr></tbody>";
   echo "</table>";
}
@mysql_close($connection);
?>
</table>

</div>
</body>
</html>