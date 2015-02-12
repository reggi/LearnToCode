<? include "./includes/html.php" ?>
<?php $level = isset($_GET["level"]) ? $_GET["level"] : "1" ?>
<?php ini_set("display_errors", "On"); ?>
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

<div id="gamecontainer">
  <script src="js/game.php<?php echo "?level=".$level ?>"></script>
</div>

<div id="buttoncontainer">
  <div id="btn_run" class="button">Run Code</div>
  <div id="btn_run_disable" class="buttondisable">Run Code</div>
  <div id="btn_reset" class="button">Reset Level</div>
  <div id="btn_reset_disable" class="buttondisable">Reset Level</div>
</div>

<div class="linebreak"></div>

<div id="codecontainer">
  <p>Code</p>
  <ul id="sortable" class="sortable asdfasdfasdf">
  </ul>
</div>

<div id="commandcontainer">
  <p>Commands</p>
  <ul id="sortable" class="sortable">
    <?php display_levelcommands($level) ?>
  </ul>
</div>

<?php if(isset($_GET["level"]) && $_GET["level"]>=4) display_variablecontainer() ?>

<div class="linebreak"></div>

</body>
</html>
