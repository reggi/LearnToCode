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
  echo "<ul>
    <li class='ui-state-highlight grabable' id='if'></li>
  </ul>
  <div id='commandtitle'>
    <div id='commandtext'>
      If
    </div>
  </div>
  <div class='dropdowncontainer'>
    <div class='dropdown if_variable' id='if_variable'>
      <span>(ChooseVariable)</span>
      <ul>
        <li class='dropdownbtn'>Tile In Front</li>
        <li class='dropdownbtn'>Tile In Front</li>
      </ul>
    </div>
  </div>
  <div class='dropdowncontainer'>
    <div class='dropdown if_comparator' id='if_comparator'>
      <span>(ChooseComparator)</span>
      <ul>
        <li class='dropdownbtn'>Equals</li>
        <li class='dropdownbtn'>Less Than</li>
        <li class='dropdownbtn'>Greater Than</li>
      </ul>
    </div>
  </div>
  <div class='dropdowncontainer'>
    <div class='dropdown if_value' id='if_value'>
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
  <ul></ul>";
}

function display_variablecontainer() {
  echo "<div id='variablecontainer'>
  <p>Var</p>
  <ul id='sortable' class='sortable'>
  	<li id='variable'>Var 1</li>
  	<li id='variable'>Var 2</li>
  </ul>
  </div>";
}

function display_levelcommands($level){
  $txt_file = file_get_contents("./level/" . $level . "c.txt");
  $rows     = explode("\n", $txt_file);
  foreach ($rows as $data) {
    $row_data = explode(' ', $data);
    if ($row_data[0] === "moveforward") display_moveforward();
    if ($row_data[0] === "while") display_while();
    if ($row_data[0] === "rotateclockwise") display_rotateclockwise();
    if ($row_data[0] === "forloop") display_forloop();
    if ($row_data[0] === "if") display_if();
  }
}
?>
