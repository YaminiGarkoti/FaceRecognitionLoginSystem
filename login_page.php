<?php
session_start();
$msg='';
if(isset($_SESSION['email_alert'])){
  $msg="Already Registered";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Login and Voice Search</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="main.js" defer></script>
</head>
<body class="page" onload="document.getElementById('login-form').style.display='block'">
    <div id="login-form" class="login-page">
        <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" onclick="login_()" class="toggle-btn">Log In</button>
            <button type="button" onclick="register_()" class="toggle-btn">Register</button>
        </div>
        <center><h2><?php echo $msg;?></h2></center>
        
        <form id="login" action="login.py" method="post" class="input-group-login" enctype="multipart/form-data">
            <input type="text" class="input-field" placeholder="Enter Email" required>
            <video onclick="snapshot(this);" width=250 height=250 id="video" controls autoplay></video>
            <input type="text" accept="image/png" hidden name="current_image" id="current_image">
               <button  onclick="login()" class="submit-btn" value="login">Login </button>
        </form>

        <form id="register" action="http://localhost/miini_project_6/storeImage.php" method="post" class="input-group-register">
            <input type="text" name="name" class="input-field" placeholder="Name" required>
            <input type="email" name="email" class="input-field" placeholder="Email" required>
            <div id="my_camera" width=250 height=250></div>
            <button type="button" class="submit-btn" onclick="take_snapshot()">Take Snapshott</button>

            <br>
          <input type="hidden" name="image" class="image-tag">
          
          <div class="col-md-6">
            <div id="results">Image will appear here...</div>
          </div>
          <div class="col-md-12-text-center">
            <br>
            <button  type="submit" class="submit-btn">Register</button> 
            <br />
          </div>
        </form>
      </div>
    </div>


    <script language="JavaScript">
var x=document.getElementById('login');
var y=document.getElementById('register');
var z=document.getElementById('btn');
function register_()
{
    x.style.left='-400px';
    y.style.left='50px';
    z.style.left='110px';
    Webcam.set({
      width: 250,
      height: 250,
      image_format: "jpeg",
      jpeg_quality: 90,
    });
    Webcam.attach("#my_camera");
}
function login_()
{
    x.style.left='50px';
    y.style.left='450px';
    z.style.left='0px';
    navigator.getUserMedia = ( navigator.getUserMedia ||
      navigator.webkitGetUserMedia ||
      navigator.mozGetUserMedia ||
      navigator.msGetUserMedia);

var video;
var webcamStream;
if (navigator.getUserMedia) {
navigator.getUserMedia (

// constraints
{
video: true,
audio: false
},

// successCallback
function(localMediaStream) {
video = document.querySelector('video');
video.srcObject = localMediaStream;
webcamStream = localMediaStream;
},

// errorCallback
function(err) {
console.log("The following error occured: " + err);
}
);
} else {
console.log("getUserMedia not supported");
}  
}
      // GET USER MEDIA CODE
      
Webcam.set({
  width: 250,
  height: 250,
  image_format: "jpeg",
  jpeg_quality: 90,
});
Webcam.attach("#my_camera");

function take_snapshot() {
  Webcam.snap(function (data_uri) {
    $(".image-tag").val(data_uri);
    document.getElementById("results").innerHTML =
      '<img src="' + data_uri + '"/>';
  });
}

var modal=document.getElementById('login-form');
window.onclick=function(event)
{
    if(event.target==modal)
    {
        modal.style.display='none';
    }
}
var canvas, ctx;

function init() {
  // Get the canvas and obtain a context for
  // drawing in it
mcanvas = document.getElementById("myCanvas");
  ctx = mcanvas.getContext('2d');
}

function login() {
  // Draws current image from the video element into the canvas
 ctx.drawImage(video,0,0,mcanvas.width,mcanvas.height);
 var dataURL = mcanvas.toDataURL('image/png');
  document.getElementById("current_image").value=dataURL;
}

Webcam.set({
  width: 200,
  height: 200,
  image_format: "jpeg",
  jpeg_quality: 90,
});

Webcam.attach("#my_camera");

function take_snapshot() {
  Webcam.snap(function (data_uri) {
    $(".image-tag").val(data_uri);
    document.getElementById("results").innerHTML =
      '<img src="' + data_uri + '"/>';
  });
}

function take_image()
{
   Webcam.set({
    width:250,
    height: 250,
    image_format:'jpeg',
    jpeg_quality: 90
  });
}
function configure()
{
    Webcam.set({
        width:480,
        height: 360,
        imageformat:'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');
    
}
function saveSnap(){
    Webcam.snap(function(data_uri){
        document.getElementById('results').innerHTML= '<img id="webcam" src="'+data_uri+'">';
    });
    Webcam.reset();
    var base64image = document.getElementById("webcam").src;
    Webcam.upload(base64image,'function.php',function(code,text){
        alert('Save Successfully');
        document.location.href='image.php';
    });
}
    </script>
    <?php unset($_SESSION['email_alert']); ?>
</body>
</html>