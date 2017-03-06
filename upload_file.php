<?php
    session_start();
	$userid = null;
//if not set the session is invalid, redirect to login
if(!isset($_SESSION['userid'])){
	header("location: login.php");
	
	die();
}
//if here legimate
$userid= $_SESSION['userid'];
//echo $userid;
    if (@$_FILES["upload"]["error"] > 0)
        echo "Error in uploading file";
    
    else
    {
		
        $tmp_file=@$_FILES["upload"]["tmp_name"];
		
		$target_file=@$_FILES["upload"]["name"];
		echo $target_file;
		$split = explode(".", $target_file);
		echo $split[1];
		if(strcmp($split[1],"cpp")!=0)
		{
			header("location: home.php?status=Invalid%20FileType");
			die();
		}
		if ($_FILES['upload']['size'] > 2048) {
			header("location: home.php?status=File%20Size%20Too%20High");
    }
		//echo $split[1];
		$upload_dir="Uploaded_File";
		mkdir($upload_dir."/".$userid."/"); //create the directory to store the file
		$path = $upload_dir."/".$userid."/".$target_file;
        if(!(move_uploaded_file($tmp_file,$path)))
		{
			@mysql_close($connection);
			die("Could not store in the local folder");
		}
        else
			echo "Uploaded the file: " . $_FILES["upload"]["name"] . " in the local folder<br />";
		
		//$command ="ipconfig";
		$command='c://Cppcheck//cppcheck.exe c://xampp//htdocs//StaticCodeAnalyzer//Uploaded_File//'.$userid.'//'.$target_file.'  2>&1';
		echo $command;
		echo"<br/>";
		exec($command,$output,$status);
		echo "\n".$status;
		echo "Command returned and output:\n";
		//$output =;
		$output = implode('<br/>', ($output));
		$connection = @mysql_connect("localhost:3306", "root", "rainbow");
		if (!$connection) {//connection error
				die('Could not connect: ' . mysql_error());
		}
		$timestamp = $timestamp = date('Y-m-d G:i:s');
		$db = @mysql_select_db("staticcodeanalyzer_db", $connection);
		$command = "insert into history(UserId,TimeStamp,FileName,Output) values ('".$userid."','".$timestamp."','".$target_file."','".$output."')";
		if($retval = mysql_query( $command, $connection ))
		{
		echo("in");
		@mysql_close($connection);
		//header("location: home.php?status=Uploaded%20Successfully");
		}
		@mysql_close($connection);
    }
?>