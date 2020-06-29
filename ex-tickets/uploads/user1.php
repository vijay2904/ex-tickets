
<?php
$database="extickets1";
$servername="localhost";
$username="root";
$password="";
$usname=$_POST['Name'];
$email=$_POST['Email'];
$password1=$_POST['Password'];
$conn = new mysqli($servername,$username,$password,$database);
if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());}
$select2 = "INSERT into exusers values(usname,email,password1)";
$result2=$conn->query($select2);
if($result2->num_rows>0){
   echo "entered into table successfully";
}
   else{
echo "error";
            }
?>
