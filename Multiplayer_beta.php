<!doctype html>
<html lang=en>
<head>
<meta charset=utf-8>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" /> 
<title>Tron battle thing</title>
<style type="text/css"> 

* {
-webkit-touch-callout: none; /* prevent callout to copy image, etc when tap to hold */
-webkit-text-size-adjust: none; /* prevent webkit from resizing text to fit */
/* make transparent link selection, adjust last value opacity 0 to 1.0 */
-webkit-tap-highlight-color: rgba(0,0,0,0); 
-webkit-user-select: none; /* prevent copy paste, to allow, change 'none' to 'text' */
-webkit-tap-highlight-color: rgba(0,0,0,0); 
}

body {
background-color: #000000;
margin: 0px;
}
canvas {
background:url('https://media.starwars.ea.com/content/starwars-ea-com/en_US/starwars/battlefront/news-articles/get-a-first-glimpse-of-the-battle-of-jakku-in-star-wars-battlefr/_jcr_content/body/image.img.jpg');
//background-color:brown;
display:block; 
position:absolute; 
z-index:1;
background-size: 1000px 600px;
}
.container {
width:auto;
text-align:center;

}

.div1
{
position:absolute;
top:10px;
left:0px;
z-index:12;

}
.div2
{
position:absolute;
top:50px;
left:150px;
z-index:12;

}

</style>


</head>
<body onload = "init()">
<div class="div1" width="1000px" height="1000px"</div>

<br>
<div ><div id='stats' style="position:absolute; top: 0px; left: 100px; color:#33ccff"></div></div>

<div id="playerdata" class="div1" style="color: white;"></div>

Chat Output
<div id=box class="div2" style="color: white;"></div>






<?php

$servername = "localhost";
$username = "cryszwjw_g_user";
$password = "vWNxak!auom3";
$dbname = "cryszwjw_g_stats";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT PlayerId, x_location, y_location FROM player_location_data";




$result = $conn->query($sql);


$x_in_php=10;



if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<br> id: ". $row["PlayerId"]. " ". $row["x_location"]. " " . $row["y_location"] . "<br>";
$x_in_php= $row["x_location"];
     }
} else {
     echo "0 results";
}

$conn->close();

?>


<script>
var opponentX = "<?php echo $x_in_php; ?>";

var initialX=0;
var initialY=0;
var canvas,
c, // c is the canvas' context 2D
container;
playerX=500;
playerY=100;
lasers=[];
var samusimage=new Image();
samusimage.src="http://2.bp.blogspot.com/-kdevsW8V4qo/Ti-uO7DKkaI/AAAAAAAAAB8/Tks3dJqaW50/s1600/samus_shoot_1.gif";

//var opponentX=0;

var hudimage=new Image();
hudimage.src="http://img10.deviantart.net/91c4/i/2012/292/f/5/hud_02_png_version_by_a1samurai-d5i8u7z.png";

var darkside=new Image();
darkside.src="http://i1141.photobucket.com/albums/n594/sagepure11/darth_vader_render_by_moonmanxo-d4qfjqy.png";

setupCanvas();

var mouseX, mouseY, 
// is this running in a touch capable environment?
touchable = 'createTouch' in document,
touches = []; // array of touch vectors

setInterval(draw, 1000/35); 


if(touchable) {
canvas.addEventListener( 'touchstart', onTouchStart, false );
canvas.addEventListener( 'touchmove', onTouchMove, false );
canvas.addEventListener( 'touchend', onTouchEnd, false );
window.onorientationchange = resetCanvas; 
window.onresize = resetCanvas; 
} else {

canvas.addEventListener( 'mousemove', onMouseMove, false );
}

function resetCanvas (e) { 
// resize the canvas - but remember - this clears the canvas too. 
canvas.width = window.innerWidth; 
canvas.height = window.innerHeight;

//make sure we scroll to the top left. 
window.scrollTo(0,0); 
}

function init(){

}

function draw() {



c.clearRect(0,0,canvas.width, canvas.height); 

for (i=0; i<lasers.length;i++)
{
lasers[i][0]+=10;
lasers[i][2]+=1;
c.fillStyle="yellow";
c.fillRect(lasers[i][0],lasers[i][1],20,5);

if (lasers[i][2]>100){
lasers.splice(i,1);
}

}

//c.fillStyle="green";
//c.fillRect(playerX, playerY, 30,60);
c.drawImage(samusimage,playerX, playerY, 30,60);
//c.fillStyle="blue";
//c.fillRect(opponentX, 100, 30,30);
c.drawImage(darkside,opponentX,100,60,60);

c.fillStyle="white";
c.fillText(opponentX,200,250);

if(touches[0])
{
if (touches[0].clientX<380)
{
playerX+=(touches[0].clientX-initialX)*0.05;
}

}
if(touchable) {

for(var i=0; i<touches.length; i++)
{
var touch = touches[i]; 
c.beginPath(); 
c.fillStyle = "white";
c.fillText("touch id : "+touch.identifier+ "touch X: " + initialX+" x:"+touch.clientX+" y:"+touch.clientY, touch.clientX+30, touch.clientY-30); 

c.fillText(touches[i].clientX-initialX, 250,250);
if(touches[i].clientX < 380)
{
c.beginPath(); 
c.strokeStyle = "orange";
c.lineWidth = "6";
c.arc(touch.clientX, touch.clientY, 40, 0, Math.PI*2, true); 
c.stroke();

c.beginPath(); 
c.strokeStyle = "orange";
c.lineWidth = "3";
c.arc(initialX, initialY, 40, 0, Math.PI*2, true); 
c.stroke();

c.beginPath(); 
c.strokeStyle = "orange";
c.lineWidth = "6";
c.arc(initialX, initialY, 60, 0, Math.PI*2, true); 
c.stroke();
}
else
{
c.beginPath(); 
c.strokeStyle = "white";
c.lineWidth = "6";
c.arc(touch.clientX, touch.clientY, 40, 0, Math.PI*2, true); 
c.stroke();
}

}

} else {

c.fillStyle	= "white"; 
c.fillText("mouse : "+mouseX+", "+mouseY, mouseX, mouseY); 

}
//c.fillText("hello", 0,0); 
//c.drawImage(hudimage, 0,0, canvas.width, canvas.height);
}

/*	
*	Touch event (e) properties : 
*	e.touches: Array of touch objects for every finger currently touching the screen
*	e.targetTouches: Array of touch objects for every finger touching the screen that
*	originally touched down on the DOM object the transmitted the event.
*	e.changedTouches	Array of touch objects for touches that are changed for this event. 
*	I'm not sure if this would ever be a list of more than one, but would 
*	be bad to assume. 
*
*	Touch objects : 
*
*	identifier: An identifying number, unique to each touch event
*	target: DOM object that broadcast the event
*	clientX: X coordinate of touch relative to the viewport (excludes scroll offset)
*	clientY: Y coordinate of touch relative to the viewport (excludes scroll offset)
*	screenX: Relative to the screen
*	screenY: Relative to the screen
*	pageX: Relative to the full page (includes scrolling)
*	pageY: Relative to the full page (includes scrolling)
*/	

function onTouchStart(e) {

touches = e.touches; 


for(var i=0; i<touches.length; i++)
{
if(touches[i].clientX < 380)
{
initialX=200;
initialY=350;
}
else if(touches[i].clientX > 380){
lasers.push([playerX, playerY+16,0]);
}

}
}

function onTouchMove(e) {
// Prevent the browser from doing its default thing (scroll, zoom)
e.preventDefault();
touches = e.touches; 

} 

function onTouchEnd(e) { 

touches = e.touches; 

}

function onMouseMove(event) {

mouseX = event.offsetX;
mouseY = event.offsetY;
}


function setupCanvas() {

canvas = document.createElement( 'canvas' );
c = canvas.getContext( '2d' );
container = document.createElement( 'div' );
container.className = "container";

canvas.width = window.innerWidth; 
canvas.height = window.innerHeight; 

document.body.appendChild( container );
container.appendChild(canvas);	

c.strokeStyle = "#ffffff";
c.lineWidth =2;	
}


</script>





</body>
</html>
