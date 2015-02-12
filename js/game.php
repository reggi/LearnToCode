var canvas = document.createElement("canvas");
canvas.setAttribute("id", "gamecontainer");
var ctx = canvas.getContext("2d");
canvas.width = 512;
canvas.height = 480;
document.body.appendChild(canvas);
var evaluatecode = false;

/*

<?php echo $_GET['level'] ?>

*/

<?php
if(isset($_GET['level'])) {// this code is similar to the line checker I should write but it is not good enough atm.
	echo "var currentlevel = " . $_GET['level'] . ";";
	$txt_file    = file_get_contents("../level/".$_GET['level'].".txt");
	$rows        = explode("\n", $txt_file);

	$row_length = sizeof(explode(' ',$rows[0]));

	echo "var mapdata = [
	";
	foreach($rows as $y => $data)
	{
		$row_data = explode(' ', $data);
		//if($row_length != sizeof($row_data)) { echo "Warning: array mis-match. Although you probably wont see this error."; }
		for($x = 0; $x < sizeof($row_data); $x++ ){
			if($row_data[$x] == "1" || $row_data[$x] == "P" || $row_data[$x] == "E" || $row_data[$x] == "0") {
				echo "'" . $row_data[$x] . "'" . ", ";
			}
		}
		echo "
		"; // add the linebreak between lines of the array for debuging readability.
	}
	echo "];";
} else {
echo "var mapdata = [
	'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', 'E', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', 'P', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
		];
";
}
?>






// Standable Tile
var bgTileReady = false;
var bgTile = new Image();
bgTile.onload = function () {
	bgTileReady = true;
};
bgTile.src = "http://www.3d-db.net/learntocode/img/GridTile.png";

// Coin Tile
var coinReady = false;
var coinSprite = new Image();
coinSprite.onload = function () {
	coinReady = true;
};
coinSprite.src = "http://www.3d-db.net/learntocode/img/coin.png";

// Hero image
var heroReady = false;
var heroImage = new Image();
heroImage.onload = function () {
	heroReady = true;
};
heroImage.src = "http://www.lostdecadegames.com/demos/simple_canvas_game/images/hero.png";


// Game objects
var hero = {
	speed: 256 // movement in pixels per second
};

var tile = {width: 32, height: 32};

var grid = {width: 15, height: 16};
var exit = {}

// Handle keyboard controls
var keysDown = {};

addEventListener("keydown", function (e) {
	keysDown[e.keyCode] = true;
}, false);

addEventListener("keyup", function (e) {
	delete keysDown[e.keyCode];
}, false);


var reset = function () {
<?php
if(isset($_GET['level'])) {

	$txt_file    = file_get_contents("../level/".$_GET['level'].".txt");
	$rows        = explode("\n", $txt_file);

	$row_length = sizeof(explode(' ',$rows[0]));
	foreach($rows as $y => $data)
	{
		$row_data = explode(' ', $data);

//		if($row_length != sizeof($row_data)) { echo "Warning: array mis-match. Although you probably wont see this error."; }

		for($x = 0; $x < sizeof($row_data); $x++ ){
			if($row_data[$x] == "P") { echo "	hero.x =". $x ."*tile.width;
	hero.y =". $y ."*tile.height;"; }
			if($row_data[$x] == "E") { echo "	exit.x =". $x ."*tile.width;
	exit.y =". $y ."*tile.height;"; }
		}
	}
} else {
echo "
	hero.x = 5*tile.width;
	hero.y = 5*tile.width;//canvas.height / 2;
	";
}
?>

	hero.direction = "up";
};

// Update game objects
var update = function (modifier) {
	if (38 in keysDown) { // Player holding up
//		hero.y -= hero.speed * modifier;
	}
	if (40 in keysDown) { // Player holding down
//		hero.y += hero.speed * modifier;
	}
	if (37 in keysDown) { // Player holding left
//		hero.x -= hero.speed * modifier;
	}
	if (39 in keysDown) { // Player holding right
//		hero.x += hero.speed * modifier;
	}


	// Are they touching?

};

// Draw everything
var render = function () {
	// if (bgReady) {
		// ctx.drawImage(bgImage, 0, 0);
	// }

//todo: add level variables, quick pass at file validation, command controls
//also file version for my level format
//single for loop to generate my draw funtions.
<?php
if(isset($_GET['level'])) {
	echo "if (bgTileReady) {";
	$txt_file    = file_get_contents("../level/".$_GET['level'].".txt");
	$rows        = explode("\n", $txt_file);

	$row_length = sizeof(explode(' ',$rows[0]));
	foreach($rows as $y => $data)
	{
		$row_data = explode(' ', $data);

//		if($row_length != sizeof($row_data)) { echo "Warning: array mis-match. Although you probably wont see this error."; }

		for($x = 0; $x < sizeof($row_data); $x++ ){
			if($row_data[$x] == "1" || $row_data[$x] == "P" || $row_data[$x] == "E") { echo "ctx.drawImage(bgTile,". $x ."*bgTile.width,". $y."*bgTile.height);"; }
		}
	}
	echo "}";
} else {
echo "	if (bgTileReady) {
		for(y=0; y<grid.height; y++) {
			for(x=0; x<grid.width; x++) {
				ctx.drawImage(bgTile, x*bgTile.width, y*bgTile.height);
			}
		}
	}";
}

if(isset($_GET['level'])) {

	echo "if (coinReady) {";
	$txt_file    = file_get_contents("../level/".$_GET['level'].".txt");
	$rows        = explode("\n", $txt_file);

	$row_length = sizeof(explode(' ',$rows[0]));
	foreach($rows as $y => $data)
	{
		$row_data = explode(' ', $data);

//		if($row_length != sizeof($row_data)) { echo "Warning: array mis-match. Although you probably wont see this error."; }

		for($x = 0; $x < sizeof($row_data); $x++ ){
			if($row_data[$x] == "E") { echo "ctx.drawImage(coinSprite,". $x ."*bgTile.width,". $y."*bgTile.height);"; }
		}
	}

	echo "}";
} else {
echo "
	if (coinReady) {
		ctx.drawImage(coinSprite, tile.width*2, tile.height*2);
	}";
}


?>

	if (heroReady) {

		ctx.save();

        ctx.translate( hero.x, hero.y );
		if(hero.direction == "right") {
			ctx.rotate(Math.PI/2);ctx.translate( 0,-32 );
		} if(hero.direction == "down") {
			ctx.rotate(Math.PI);ctx.translate(  -32,-32 );
		} if(hero.direction == "left") {
			ctx.rotate(Math.PI*(3/2));ctx.translate(  -32,0 );
		}
		ctx.drawImage(heroImage, 0, 0);

		ctx.restore();
	}


	// Score
	ctx.fillStyle = "rgb(250, 250, 250)";
	// ctx.font = "24px Helvetica";
	// ctx.textAlign = "left";
	// ctx.textBaseline = "top";
	// ctx.fillText("Goblins caught: " + monstersCaught, 32, 32);
};

// The main game loop
var main = function () {
	var now = Date.now();
	var delta = now - then;

	update(delta / 1000);
	render();

	then = now;

	// Request to do this again ASAP
	requestAnimationFrame(main);
};

// Cross-browser support for requestAnimationFrame
var w = window;
requestAnimationFrame = w.requestAnimationFrame || w.webkitRequestAnimationFrame || w.msRequestAnimationFrame || w.mozRequestAnimationFrame;

// Let's play this game!
var then = Date.now();
reset();
main();
