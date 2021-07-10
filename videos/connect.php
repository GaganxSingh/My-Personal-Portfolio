<?php
//include "config.php";
$dbusername="root";
    $dbpass="";
    $dbhost="localhost";
    $dbselect="work";
    $dbcon=mysqli_connect($dbhost,$dbusername,$dbpass,$dbselect);
if(isset($_POST['fileupload'])){
   $maxsize = 50242880; // 5MB
   if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
       $name = $_FILES['file']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["file"]["name"];
	   $txtname=$_POST['txtname'];
	   $email=$_POST['email'];
	   $message=$_POST['message'];
	   

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
             echo "File too large. File must be less than 5MB.";
          }else{
             // Upload
             if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
               // Insert record
               $query = "INSERT INTO demo VALUES('','".$txtname."','".$email."','".$target_file."','".$message."','".$name."')";

               mysqli_query($dbcon,$query);
               echo "Upload successfully.";
             }
          }

       }else{
          echo "Invalid file extension.";
       }
   }else{
       echo "Please select a file.";
   }
  //header('location: index.php');
   exit;
}
?>

