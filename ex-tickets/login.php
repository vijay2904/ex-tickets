<?php
session_start();
$database="extickets1";
$servername="localhost";
$username="root";
$password="";
$usname=$_POST['name'];
$password1=$_POST['pswd'];
$error = "username/password incorrect";

$conn = new mysqli($servername,$username,$password,$database);
if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());}
$select2 = "SELECT username,password FROM exusers WHERE username='$usname'and password='$password1'";
$result2=$conn->query($select2);
if($result2->num_rows>0){
	$_SESSION["username"] = $usname;
    header("location: test1.html"); //send user to homepage, for example.
}else{
    $_SESSION["error"] = $error;
    header("location: modal1.php"); //send user back to the login page.
}
  
            
?>