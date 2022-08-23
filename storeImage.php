<?php
    session_start();
    include('cofig.php');
    $img = $_POST['image'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    $folderPath = "img/";
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $imgname = $email . '.jpeg';
    $sqq="select* from user where email='$email'";
    $res=mysqli_query($conn,$sqq);
    $present=mysqli_num_rows($res);
    if($present>0)
    {
        $_SESSION['email_alert']='1';
        header("Location:login_page.php");

    }
    else{
    $sql="insert into user(email,name,imgname) value ('$email','$name','$imgname')";
    $result=mysqli_query($conn,$sql);
    header("Location:login_page.php");
    $file = $folderPath . $imgname;
    file_put_contents($file, $image_base64);
    }
?>