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
    var $gallery = $("#gallery");
    // let the gallery items be draggable
    $(".sortable").sortable({
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
    var recycle_icon =
        "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
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
    var trash_icon =
        "<a href='link/to/trash/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";

    function recycleImage($item) {
        $item.fadeOut(function() {
            $item.find("a.ui-icon-refresh").remove().end().css(
                "width", "96px").append(trash_icon).find(
                "img").css("height", "72px").end().appendTo(
                $gallery).fadeIn();
        });
    }
    var victorycheck = function() {
        if (hero.x <= (exit.x) && exit.x <= (hero.x) && hero.y <= (
            exit.y) && exit.y <= (hero.y)) {
            if (currentlevel < 2) {
                alert("You win! On to the next level!");
                currentlevel += 1;
                var myurl = "http://3d-db.net/learntocode/?level=" +
                    currentlevel;
                window.location.href = myurl;
            } else {
                window.location.href =
                    "http://3d-db.net/learntocode/victory.php";
            }
        }
    };
    var rotateclockwise = function() {
        if (keeprunning) {
            if (hero.direction == "up") {
                hero.direction = "right";
            } else if (hero.direction == "right") {
                hero.direction = "down";
            } else if (hero.direction == "down") {
                hero.direction = "left";
            } else if (hero.direction == "left") {
                hero.direction = "up";
            }
        }
    }
    var checkfronttile = function(x, y) {
        if (hero.direction == "up") {
            return mapdata[((hero.y / tile.height) - 1) * grid.width +
                (hero.x / tile.width)];
        } else if (hero.direction == "right") {
            return mapdata[((hero.y / tile.height)) * grid.width +
                ((hero.x / tile.width) + 1)];
        } else if (hero.direction == "down") {
            return mapdata[((hero.y / tile.height) + 1) * grid.width +
                (hero.x / tile.width)];
        } else if (hero.direction == "left") {
            return mapdata[((hero.y / tile.height)) * grid.width +
                ((hero.x / tile.width) - 1)];
        }
    }
    var moveherogrid = function() {
        if (keeprunning) {
            if (hero.direction == "up") {
                if (mapdata[((hero.y / tile.height) - 1) * grid.width +
                    (hero.x / tile.width)] != '0') {
                    if (hero.y > 0) {
                        hero.y -= tile.height;
                    } else {
                        alert(
                            "Character has moved off the map. Please look at your code and re run."
                        );
                        keeprunning = false;
                    }
                } else {
                    alert(
                        "Character is off the grid. Please look at your code and re run."
                    );
                    keeprunning = false;
                }
            }
            if (hero.direction == "left") {
                if (mapdata[(hero.y / tile.height) * grid.width + (
                    hero.x / tile.width) - 1] != '0') {
                    if (hero.x > 0) {
                        hero.x -= tile.width;
                    } else {
                        alert(
                            "Character has moved off the map. Please look at your code and re run."
                        );
                        keeprunning = false;
                    }
                } else {
                    alert(
                        "Character is off the grid. Please look at your code and re run."
                    );
                    keeprunning = false;
                }
            }
            if (hero.direction == "down") {
                if (mapdata[((hero.y / tile.height) + 1) * grid.width +
                    (hero.x / tile.width) + 1] != '0') {
                    if (hero.y < grid.height * tile.height) {
                        hero.y += tile.height;
                    } else {
                        alert(
                            "Character has moved off the map. Please look at your code and re run."
                        );
                        keeprunning = false;
                    }
                } else {
                    alert(
                        "Character is off the grid. Please look at your code and re run."
                    );
                    keeprunning = false;
                }
            }
            if (hero.direction == "right") {
                if (mapdata[((hero.y / tile.height)) * grid.width +
                    (hero.x / tile.width) + 1] != '0') {
                    if (hero.x < grid.width * tile.width) {
                        hero.x += tile.width;
                    } else {
                        alert(
                            "Character has moved off the map. Please look at your code and re run."
                        );
                        keeprunning = false;
                    }
                } else {
                    alert(
                        "Character is off the grid. Please look at your code and re run."
                    );
                    keeprunning = false;
                }
            }
            victorycheck();
        }
    }

    function evaluate_if_statement() {
        console.log(checkfronttile(hero.x, (hero.y)));
        console.log($(this));
        if ($(this).find(".if_variable").find("span").text() ==
            "Tile In Front") {
            if ($(this).find(".if_comparator").find("span").text() ==
                "Equals" && $(this).find(".if_value").find("span").text() ==
                "Blank" && checkfronttile(hero.x, (hero.y)) == 0) {
                //iteratecode($( this ).find(".sublist"), 1 );
            }
        }
        if ($(this).find(".if_variable").find("span").text() ==
            "Tile In Front") {
            if ($(this).find(".if_comparator").find("span").text() ==
                "Equals" && $(this).find(".if_value").find("span").text() ==
                "Walkable" && checkfronttile(hero.x, (hero.y)) == 1
            ) {
                //iteratecode($( this ).find(".sublist"), 1 );
            }
        }
    }

    function iteratecode(tasks, timestorepeat) {
        for (var i = 0, count = timestorepeat; i < count; i++) {
            // 		I may eventually put the keeprunning statement here, but for now I won't because it decides on the order to evaluate the code before it even runs.
            //		if(keeprunning == true) {
            //	if comparator is equals, than if if_variable equals if_value
            //var tasks = $( "#sortable" ).sortable( "toArray" );
            //alert($( "#sortable" ).sortable( "toArray" ).toSource());
            tasks.children().each(function(index) {
                var task = $(this).attr('id');
                console.log($(this).attr('id'));
                if (task === "if") {
                    var that = $(this);
                    setTimeout(function() {
                        evaluate_if_statement.apply(
                            that);
                    }, commandsexecuted * 500);
                    commandsexecuted++;
                }
                if (task === "moveforward") {
                    setTimeout(function() {
                        moveherogrid()
                    }, commandsexecuted * 500);
                    commandsexecuted++;
                }
                if (task === "rotateclockwise") {
                    setTimeout(function() {
                        rotateclockwise()
                    }, commandsexecuted * 500);
                    commandsexecuted++;
                }
                if (task === "forloop") {
                    iteratecode($(this).find(".sublist"), $(
                            this).find(
                            "#commandtitle>#loopcount")
                        .val());
                }
                if (task === "while") {
                    iteratecode($(this).find(".sublist"),
                        10);
                }
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
    $("#btn_run").click(function(event) {
        var tasks = $("#codecontainer>#sortable").sortable(
            "toArray");
        //alert($( "#sortable" ).toSource());
        alert(tasks);
        var numberoftasks = tasks.length;
        if (numberoftasks == 0) {
            alert(
                "Please drag some commands from the command panel to the code panel."
            );
            return false;
        }
        keeprunning = true;
        iteratecode($("#sortable"), 1);
        $(this).hide();
        $("#btn_run_disable").show();
        $("#btn_reset_disable").hide();
        $("#btn_reset").show();
        return false;
    });
    $("#btn_reset").click(function(event) {
        reset();
        commandsexecuted = 0;
        $(this).hide();
        $("#btn_reset_disable").show();
        $("#btn_run").show();
        $("#btn_run_disable").hide();
        return false;
    });
});
