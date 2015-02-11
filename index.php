<?php ini_set('display_errors', 'On'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Simple Canvas Game</title>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<style>
#codecontainer {margin: 0; padding: 0; float: left; margin-right: 10px;background: #eee; padding: 5px; width:40%;height:50%;}
#commandcontainer {margin: 0; padding: 0; float: left; margin-right: 10px;background: #eee; padding: 5px; width:40%;height:50%;}
#variablecontainer {margin: 0; padding:0; float:left; margin-right:10px; background: #eee; padding: 5px; width:10%; height:50%;}
#variable{background:#FF00FF; width:80%; margin:10px; height:30px; padding:5px; }

#sortable { list-style-type: none; margin: 0; padding:0;background:#ccc; padding:5px;padding-right:0;height:400px;}
#sortable li { margin: 5px; padding:5px;  }


.sublist { list-style-type:none; margin:0; padding:0; background:#ccc; padding:5px; padding-right:0; height:auto; min-height:50px;}
.sublist li { margin: 5px; padding: 5px; margin-right:0px;}

#gamecontainer{ margin: 0; padding: 0; float: left; margin-right: 10px; width:auto; height: auto;}
#buttoncontainer { margin: 0; padding: 0 10px; float: left; margin-right: 10px; width:120px; height: 300px;}
.button {background:#eee; float:left; width:100px; padding:10px; margin: 5px 0;}
.button:hover {background:#ccc; cursor:pointer;}
.buttondisable {background:#999; float:left; width:100px; padding:10px; margin: 5px 0;}
.buttondisable:hover {cursor:default;}
.grabable {cursor: -moz-grab; cursor: -webkit-grab;}
#commandtitle {height:30px;}
#commandtext{font-size: 1.2em; padding:5px;float:left;width:auto;}
#loopcount {float:left; width:30px; padding:4px;margin-top:5px; }
.linebreak{clear:both;}
#forloop {padding-bottom:20px;}
.tooltip {outline:none;}
.tooltip:hover {text-decoration: none;}
.tooltip span { z-index:10;display:none;padding:14px 20px;margin:-30px 0 0 28px;width:300px;line-height:16px;}
.tooltip span:hover {display:inline;position:absolute;color:#111;border:1px solid #DCA;background:#fffAF0;}
.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
.dropdowncontainer {
  text-align: left;
  display: inline;
  margin: 0;
  padding: 15px 4px 17px 0;
  list-style: none;
  -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}
.dropdown {
  font: bold 12px/18px sans-serif;
  display: inline-block;
  margin-right: -4px;
  position: relative;
  padding: 15px 20px;
  background: #fff;
  cursor: pointer;
}
.dropdown ul {
  padding: 0;
  position:absolute;
  top: 45px;
  left: 0;
  width: 150px;
  dipslay:none;
  opacity: 0;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  -webkit-transiton: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -ms-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  -transition: opacity 0.2s;
}
.dropdowncontainer:hover ul {
  display:visable;
  opacity: 1;
}

.dropdown ul li { 
  background: #555; 
  display: block; 
  color: #fff;
  text-shadow: 0 -1px 0 #000;
}
.dropdown ul li:hover {
  background: #333;
}

body {
  -webkit-user-select: none;
     -moz-user-select: -moz-none;
      -ms-user-select: none;
          user-select: none;
}
 
</style>
<script>  
var keeprunning = true;
var commandsexecuted = 0;
$(document).ready(function() {
	$("#btn_run_disable").hide();
	$("#btn_reset").hide();
});
//Div ID's define how we draw things. 
//Div classes define how things behave
$(function() {
    // there's the gallery and the trash
    var $gallery = $( "#gallery" );
    // let the gallery items be draggable
    $( ".sortable" ).sortable({
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      connectWith: ".sortable"
	 // stop: function( event, ui ) { ui.item.animate({ width: "90%" }, "slow" ); }
    });

	
    // $( "li", $gallery ).draggable({
      // connectToSortable: "#sortable",
      // cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      // revert: "invalid", // when not dropped, the item will revert back to its initial position
      // containment: "document",
      // helper: "clone",
      // cursor: "move"

    // });

    // let the trash be droppable, accepting the gallery items

 
    // let the gallery be droppable as well, accepting items from the trash
    // $gallery.droppable({
      // accept: "#trash li",
      // activeClass: "custom-state-active",
      // drop: function( event, ui ) {
        // recycleImage( ui.draggable );
      // }
    // });
 
    // image deletion function
    var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
/*     function deleteImage( $item ) {
      $item.fadeOut(function() {
        var $list = $( "ul", $trash ).length ?
          $( "ul", $trash ) :
          $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $trash );
 
        $item.find( "a.ui-icon-trash" ).remove();
        $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
          $item
            .animate({ width: "48px" })
            .find( "img" )
              .animate({ height: "36px" });
        });
      });
    } */
 
    // image recycle function
    var trash_icon = "<a href='link/to/trash/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";
    function recycleImage( $item ) {
      $item.fadeOut(function() {
        $item
          .find( "a.ui-icon-refresh" )
          .remove()
          .end()
          .css( "width", "96px")
          .append( trash_icon )
          .find( "img" )
          .css( "height", "72px" )
          .end()
          .appendTo( $gallery )
          .fadeIn();
        });
    }



var victorycheck = function() {
        if (
                hero.x <= (exit.x)
                && exit.x <= (hero.x)
                && hero.y <= (exit.y)
                && exit.y <= (hero.y)
        ) {
                if(currentlevel <2){
                        alert("You win! On to the next level!"  );
                        currentlevel += 1;
                        var myurl = "http://3d-db.net/learntocode/?level=" + currentlevel;
                        window.location.href = myurl;
                } else { window.location.href = "http://3d-db.net/learntocode/victory.php"; }
        }
};

var rotateclockwise = function() {
	if(keeprunning) {
        	if(hero.direction == "up"){
                	hero.direction = "right";
        	}
        	else if(hero.direction == "right") {
               		hero.direction = "down";
        	}
        	else if(hero.direction == "down") {
                	hero.direction = "left";
		}
	        else if(hero.direction == "left") {
			hero.direction = "up";
	        }
	}
}

var checkfronttile = function(x , y ) {
		if(hero.direction == "up") {
        		return mapdata[((hero.y/tile.height)-1)*grid.width + (hero.x/tile.width)];
		}
		else if(hero.direction == "right") {

			return mapdata[((hero.y/tile.height))*grid.width + ((hero.x/tile.width)+1)];
                }
                else if(hero.direction == "down") {

			return mapdata[((hero.y/tile.height)+1)*grid.width + (hero.x/tile.width)];
                }
                else if(hero.direction == "left") {

			return mapdata[((hero.y/tile.height))*grid.width + ((hero.x/tile.width)-1)];
		}
}

var moveherogrid = function() {
	if(keeprunning) {
        if(hero.direction == "up"){
                if( mapdata[((hero.y/tile.height)-1)*grid.width + (hero.x/tile.width)] != '0' ) {
                        if(hero.y>0) {
                                hero.y-=tile.height;
                        } else {alert ("Character has moved off the map. Please look at your code and re run."); keeprunning = false; }
                } else {alert ("Character is off the grid. Please look at your code and re run."); keeprunning = false; }
        }
        if(hero.direction == "left") {
                if(mapdata[(hero.y/tile.height)*grid.width + (hero.x/tile.width) - 1] != '0') {
                        if(hero.x>0) {
                                hero.x-=tile.width;
                        } else {alert ("Character has moved off the map. Please look at your code and re run."); keeprunning = false; }
                } else {alert ("Character is off the grid. Please look at your code and re run."); keeprunning = false; }
        }
        if(hero.direction == "down") {
                if(mapdata[((hero.y/tile.height)+1)*grid.width + (hero.x/tile.width) + 1] != '0') {
                        if(hero.y < grid.height*tile.height) {
                                hero.y+=tile.height;
                        } else {alert ("Character has moved off the map. Please look at your code and re run."); keeprunning = false; }
                } else {alert ("Character is off the grid. Please look at your code and re run."); keeprunning = false; }
        }
        if(hero.direction == "right") {
                if(mapdata[((hero.y/tile.height))*grid.width + (hero.x/tile.width) + 1] != '0') {
                        if(hero.x < grid.width*tile.width) {
                                hero.x+=tile.width;
                        } else {alert ("Character has moved off the map. Please look at your code and re run."); keeprunning = false; }
                } else {alert ("Character is off the grid. Please look at your code and re run."); keeprunning = false; }
        }
        victorycheck();
	}
}
 
function evaluate_if_statement() {
	console.log(checkfronttile(hero.x,(hero.y)));
	console.log($(this));
	if( $( this ).find(".if_variable").find("span").text() == "Tile In Front" ) {
		if( $( this ).find(".if_comparator").find("span").text() == "Equals" &&
		    $( this ).find(".if_value").find("span").text() == "Blank" && 
		    checkfronttile(hero.x,(hero.y)) == 0 
                  ) {
			//iteratecode($( this ).find(".sublist"), 1 );
		}
	}
	if( $( this ).find(".if_variable").find("span").text() == "Tile In Front" ) {
         if( $( this ).find(".if_comparator").find("span").text() == "Equals" &&
                    $( this ).find(".if_value").find("span").text() == "Walkable" &&
                    checkfronttile(hero.x,(hero.y)) == 1
                  ) {
                        //iteratecode($( this ).find(".sublist"), 1 );
                }
        } 
}

function iteratecode( tasks, timestorepeat ) {	
	for(var i=0, count=timestorepeat;i<count;i++) {
// 		I may eventually put the keeprunning statement here, but for now I won't because it decides on the order to evaluate the code before it even runs. 
//		if(keeprunning == true) {
//	if comparator is equals, than if if_variable equals if_value
	//var tasks = $( "#sortable" ).sortable( "toArray" );
			//alert($( "#sortable" ).sortable( "toArray" ).toSource());
			tasks.children().each(function( index ) {
				var task = $(this).attr('id');
				console.log($(this).attr('id'));
				if(task === "if") {
					var that = $(this);
					setTimeout( function() { evaluate_if_statement.apply(that); },commandsexecuted*500);commandsexecuted++;
				}
				if(task === "moveforward"){setTimeout(function(){moveherogrid()},commandsexecuted*500);commandsexecuted++;} 
				if(task === "rotateclockwise"){setTimeout(function(){rotateclockwise()},commandsexecuted*500);commandsexecuted++;} 
				if(task === "forloop") {
					iteratecode($( this ).find(".sublist"), $(this).find("#commandtitle>#loopcount").val() );
				}
				if(task === "while") {iteratecode($( this ).find(".sublist") , 10);}
			});	
			var task;
//		}	
	}	
	return true;
}
$(".dropdownbtn").click(function(event) {
		$(this).parent().parent().find("span").text($(this).text());	
		});
// resolve the icons behavior with event delegation
$( "#btn_run" ).click(function( event ) {
		var tasks = $( "#codecontainer>#sortable" ).sortable( "toArray" );
		        //alert($( "#sortable" ).toSource());
		alert(tasks);
		var numberoftasks = tasks.length;

		if(numberoftasks == 0) {
		alert("Please drag some commands from the command panel to the code panel."); 
		return false;
		}
		keeprunning=true;
		iteratecode($("#sortable"), 1 );
		$(this).hide();
		$("#btn_run_disable").show();
		$("#btn_reset_disable").hide();
		$("#btn_reset").show();
		return false;
		});
$( "#btn_reset" ).click(function( event ) {
		reset();
		commandsexecuted=0;
		$(this).hide();
		$("#btn_reset_disable").show();
		$("#btn_run").show();
		$("#btn_run_disable").hide();
		return false;
		});
});
</script>
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

