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

//For voice recognition

const searchForm = document.querySelector("#search-form");
const searchFormInput = searchForm.querySelector("input"); 
const info = document.querySelector(".info");

const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition; 

if(SpeechRecognition) {
  console.log("Your Browser supports speech Recognition");
  
  const recognition = new SpeechRecognition();
  recognition.continuous = true;

  searchForm.insertAdjacentHTML("beforeend", '<button type="button"><i class="fas fa-microphone"></i></button>');
  searchFormInput.style.paddingRight = "50px";

  const micBtn = searchForm.querySelector("button");
  const micIcon = micBtn.firstElementChild;

  micBtn.addEventListener("click", micBtnClick);
  function micBtnClick() {
    if(micIcon.classList.contains("fa-microphone")) {
      recognition.start(); 
    }
    else {
      recognition.stop();
    }
  }

  recognition.addEventListener("start", startSpeechRecognition); // <=> recognition.onstart = function() {...}
  function startSpeechRecognition() {
    micIcon.classList.remove("fa-microphone");
    micIcon.classList.add("fa-microphone-slash");
    searchFormInput.focus();
    console.log("Voice activated, SPEAK");
  }

  recognition.addEventListener("end", endSpeechRecognition); // <=> recognition.onend = function() {...}
  function endSpeechRecognition() {
    micIcon.classList.remove("fa-microphone-slash");
    micIcon.classList.add("fa-microphone");
    searchFormInput.focus();
    console.log("Speech recognition service disconnected");
  }

  recognition.addEventListener("result", resultOfSpeechRecognition); // <=> recognition.onresult = function(event) {...} - Fires when you stop talking
  function resultOfSpeechRecognition(event) {
    const current = event.resultIndex;
    const transcript = event.results[current][0].transcript;
    
    if(transcript.toLowerCase().trim()==="stop recording") {
      recognition.stop();
    }
    else if(!searchFormInput.value) {
      searchFormInput.value = transcript;
    }
    else {
      if(transcript.toLowerCase().trim()==="go") {
        searchForm.submit();
      }
      else if(transcript.toLowerCase().trim()==="reset input") {
        searchFormInput.value = "";
      }
      else {
        searchFormInput.value = transcript;
      }
    }
    // searchFormInput.value = transcript;
    // searchFormInput.focus();
    setTimeout(() => {
      searchForm.submit();
    }, 500);
  }
  
  info.textContent = 'Voice Commands: "stop recording", "reset input", "go"';
  
}
else {
  console.log("Your Browser does not support speech Recognition");
  info.textContent = "Your Browser does not support Speech Recognition";
}
