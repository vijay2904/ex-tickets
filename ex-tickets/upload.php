<?php

// Include the database configuration file
include 'dbConfig.php';
$statusMsg = '';                                                                                                                                                                                                                                                                
$genre=$_POST['genre'];
// File upload path
if($genre=="movies")
{
$targetDir = "uploads/movies/";
}
else if($genre=="concerts")
{
$targetDir = "uploads/concerts/";
}
else if($genre=="events")
{
$targetDir = "uploads/events/";
}
else if($genre=="sports")
{
$targetDir = "uploads/sports/";
}
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$uname=$_POST['name'];
$email=$_POST['email'];
$movie=$_POST['movie'];
$no=$_POST['number'];

$phone=$_POST['phone'];
$rawdate=htmlentities($_POST['date']);
$date=date('Y-m-d',strtotime($rawdate));


$link = mysqli_connect("localhost", "root", "", "extickets1");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt insert query execution
$sql = "INSERT into post values('$uname','$email','$movie',$no,'$genre','$phone','$date')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $db->query("INSERT into images1 (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");

            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Display status message
echo $statusMsg;
mysqli_close($link);
?>
