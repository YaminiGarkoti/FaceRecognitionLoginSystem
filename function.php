<?php
$conn= mysqli_connect('localhost','root','','webcam');
if(isset($_FILES['webcam']['tmp_name'])){
    $tmpName=$_FILES['webcam']['tmp_name'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $imageName=$fname."-".$lname.'.jpeg';
    move_uploaded_file($tmpName.'img/',$imageName);
    $query="insert into data(fname,lname,email,image) values ('$fname','$lname','$email','$imageName')";
    mysqli_query($conn,$query); 
}