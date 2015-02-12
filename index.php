<?php ini_set('display_errors', 'On'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Simple Canvas Game</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="/style.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="/script.js"></script>
</head>
<body>
<div id = 'gamecontainer'>
<script src="js/game.php<?php if(isset($_GET['level'])) {echo "?level=".$_GET['level'];}?>"></script>
</div>
<div id="buttoncontainer" >
<div id="btn_run" class="button">Run Code</div>
<div id="btn_run_disable" class="buttondisable">Run Code</div>
<div id="btn_reset" class="button">Reset Level</div>
<div id="btn_reset_disable" class="buttondisable">Reset Level</div>
</div>

<div class='linebreak'></div>
<div id="codecontainer">
<p>Code</p>
<ul id="sortable" class="sortable asdfasdfasdf">
</ul>
</div>
<div id="commandcontainer">
<p>Commands</p>


<ul id='sortable' class='sortable'>
<?php
function display_forloop() {
	echo "<li id='forloop' class='ui-state-highlight grabable'>
		<div id='commandtitle'>
		<div id='commandtext'>For Loop</div>
		<input type='text' id='loopcount' class='std' value='1' name='loopcount'  size='10' maxlength='16' tabindex='1'>
		</div>
		<div class='tooltip'>(futuretooltip)<span>I like to eat pie</span></div>
		<div class='linebreak'></div>
		<ul class='sublist sortable'></ul>
		</li>";
}
function display_while() {
	echo "<li id='while' class='ui-state-highlight grabable'>
		<div id='commandtitle'>
		<div id='commandtext'>WhileTrue</div>
		</div>
		<div class='linebreak'></div>
		<ul class='sublist sortable'></ul>
		</li>";
}
function display_moveforward() {
	echo "<li id='moveforward' class='ui-state-highlight grabable'>
		<div id='commandtitle'>
		<div id='commandtext'>MoveForward</div>
		</div>
		<div class='linebreak'></div>
		</li>";
}
function display_rotateclockwise() {
	echo "<li id='rotateclockwise' class='ui-state-highlight grabable'>
		<div id='commandtitle'>
		<div id='commandtext'>RotateClockwise</div>
		</div>
		<div class='linebreak'></div>
		</li>";
}
function display_if() {
        echo "<li id='if' class='ui-state-highlight grabable'>
                <div id='commandtitle'>
                        <div id='commandtext'>If</div>
                </div>
		<div class='dropdowncontainer'>
			<div id='if_variable' class='dropdown if_variable'>
			<span>(ChooseVariable)</span>
				<ul>
					<li class='dropdownbtn'>Tile In Front</li>
					<li class='dropdownbtn'>Tile In Front</li>
				</ul>
			</div>
		</div>
		<div class='dropdowncontainer'>
			<div id='if_comparator' class='dropdown if_comparator'>
			<span>(ChooseComparator)</span>
				<ul>
					<li class='dropdownbtn'>Equals</li>
					<li class='dropdownbtn'>Less Than</li>
					<li class='dropdownbtn'>Greater Than</li>
				</ul>
			</div>
		</div>
		<div class='dropdowncontainer'>
			<div id='if_value' class='dropdown if_value'>
			<span>(ChooseResult)</span>
				<ul>
					<li class='dropdownbtn'>Blank</li>
					<li class='dropdownbtn'>Walkable</li>
					<li class='dropdownbtn'>Exit</li>
				</ul>
			</div>
		</div>
                <div class='linebreak'></div>
                <ul class='sublist sortable'></ul>
	</li>";
}
if(isset($_GET['level'])) {// this code is similar to the line checker I should write but it is not good enough atm.
	$txt_file    = file_get_contents("/var/www/html/learntocode/level/".$_GET['level']."c.txt");
	$rows        = explode("\n", $txt_file);

	foreach($rows as $data)
	{

		$row_data = explode(' ', $data);
		if($row_data[0] === "moveforward") {
			display_moveforward();
		}
		if($row_data[0] === "while") {
			display_while();
		}
		if($row_data[0] === "rotateclockwise") {
			display_rotateclockwise();
		}
		if($row_data[0] === "forloop") {
			display_forloop();
		}
                if($row_data[0] === "if") {
                        display_if();
                }
	}
} else {
	display_moveforward();
}
?>
</ul>
</div>

<?php
if($_GET['level']>=4) {
echo "
<div id='variablecontainer'>
<p>Var</p>
<ul id='sortable' class='sortable'>
	<li id='variable'>Var 1</li>
	<li id='variable'>Var 2</li>
</ul>
</div>
";
}
?>


<div class='linebreak'></div>




</body>
</html>
