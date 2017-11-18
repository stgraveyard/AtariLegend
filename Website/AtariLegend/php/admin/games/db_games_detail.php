<?php
/***************************************************************************
 *                                db_games_detail.php
 *                            ------------------------
 *   begin                : Tuesday, September 6, 2005
 *   copyright            : (C) 2005 Atari Legend
 *   email                : admin@atarilegend.com
 *   actual update        : Creation of file
 *
 *   Id: db_games_detail.php,v 0.10 2005/10/06 17:41 Zombieman
 *   Id: db_games_detail.php,v 0.20 2015/11/06 22:16 Zombieman
 *   Id: db_games_detail.php,v 0.30 2015/12/27 22:16 Zombieman - added messages
 *   Id: db_games_detail.php,v 0.40 2016/08/19 STG - added change log
 *   Id: db_games_detail.php,v 0.41 2017/01/06 STG - added falcon vga and rgb option
 *
 ***************************************************************************/

//****************************************************************************************
// This is the detail page of a game. Change all the specifics over here!
//****************************************************************************************

//load all common functions
include("../../config/common.php");
include("../../config/admin.php");
include("../../config/admin_rights.php");

//***********************************************************************************
//Insert new game
//***********************************************************************************
if (isset($action) and $action == "insert_game") {
    //Insert the game in the game table
    $sql_game = $mysqli->query("INSERT INTO game (game_name) VALUES ('$newgame')") or die("Couldn't insert game into database");

    $_SESSION['edit_message'] = "The game $newgame has been inserted into the database";

    $new_game_id = $mysqli->insert_id;

    create_log_entry('Games', $new_game_id, 'Game', $new_game_id, 'Insert', $_SESSION['user_id']);

    header("Location: ../games/games_detail.php?game_id=$new_game_id");
}

//***********************************************************************************
//If delete aka link has been pressed
//***********************************************************************************
if (isset($action) and $action == 'delete_aka') {
    create_log_entry('Games', $game_id, 'AKA', $game_aka_id, 'Delete', $_SESSION['user_id']);

    $sql_aka = $mysqli->query("DELETE FROM game_aka WHERE game_aka_id = '$game_aka_id' AND game_id = '$game_id'") or die("Couldn't delete aka");

    $_SESSION['edit_message'] = "AKA link has been deleted";
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If add aka button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'game_aka') {
    $sql_aka = $mysqli->query("INSERT INTO game_aka (game_id, aka_name) VALUES ('$game_id','$game_aka')") or die("Couldn't insert aka games");

    $new_aka_id = $mysqli->insert_id;
    create_log_entry('Games', $game_id, 'AKA', $new_aka_id, 'Insert', $_SESSION['user_id']);

    $_SESSION['edit_message'] = "AKA link has been added";
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If delete Creator button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'delete_creator') {
    if (isset($game_author_id)) {
        foreach ($game_author_id as $author) {
            create_log_entry('Games', $game_id, 'Creator', $author, 'Delete', $_SESSION['user_id']);

            $mysqli->query("DELETE FROM game_author WHERE game_author_id = '$author' AND game_id = '$game_id'");
            $_SESSION['edit_message'] = "Creator has been deleted";
        }
    } else {
        $_SESSION['edit_message'] = "Please choose a creator";
    }
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If add publisher button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'add_creator') {
    if ($ind_id != '-') {
        $sql = $mysqli->query("INSERT INTO game_author (game_id , ind_id, author_type_id) VALUES ('$game_id','$ind_id', '$author_type_id')") or die("creator insertion failed");

        create_log_entry('Games', $game_id, 'Creator', $ind_id, 'Insert', $_SESSION['user_id']);

        $_SESSION['edit_message'] = "Creator has been added";
    } else {
        $_SESSION['edit_message'] = "Please choose a creator";
    }
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If delete publisher button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'delete_publisher') {
    if (isset($game_publisher_id)) {
        foreach ($game_publisher_id as $publisher) {
            create_log_entry('Games', $game_id, 'Publisher', $publisher, 'Delete', $_SESSION['user_id']);

            $mysqli->query("DELETE FROM game_publisher WHERE pub_dev_id = '$publisher' AND game_id = '$game_id'");
            $_SESSION['edit_message'] = "Publisher has been deleted";
        }
    } else {
        $_SESSION['edit_message'] = "Please choose a publisher";
    }
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If add publisher button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'add_publisher') {
    if ($company_id_pub != '-') {
        $sql = $mysqli->query("INSERT INTO game_publisher (pub_dev_id ,game_id, continent_id, game_extra_info_id) VALUES ('$company_id_pub','$game_id','$continent_pub', '$game_extra_info_pub')") or die("Publisher insertion failed");

        create_log_entry('Games', $game_id, 'Publisher', $company_id_pub, 'Insert', $_SESSION['user_id']);

        $_SESSION['edit_message'] = "Publisher has been added";
    } else {
        $_SESSION['edit_message'] = "Please choose a publisher";
    }
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If delete developer button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'delete_developer') {
    if (isset($game_developer_id)) {
        foreach ($game_developer_id as $developer) {
            create_log_entry('Games', $game_id, 'Developer', $developer, 'Delete', $_SESSION['user_id']);

            $mysqli->query("DELETE FROM game_developer WHERE dev_pub_id = '$developer' AND game_id = '$game_id'");
            $_SESSION['edit_message'] = "Developer has been deleted";
        }
    } else {
        $_SESSION['edit_message'] = "Please choose a developer";
    }
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If add developer button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'add_developer') {
    if ($company_id_dev != '-') {
        $sql = $mysqli->query("INSERT INTO game_developer (dev_pub_id, game_id, continent_id, game_extra_info_id) VALUES ('$company_id_dev','$game_id','$continent_dev','$game_extra_info_dev')") or die("Developer insertion failed");

        create_log_entry('Games', $game_id, 'Developer', $company_id_dev, 'Insert', $_SESSION['user_id']);

        $_SESSION['edit_message'] = "Developer has been added";
    } else {
        $_SESSION['edit_message'] = "Please choose a developer";
    }
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If delete year button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'delete_year') {
    if (isset($game_year_id)) {
        foreach ($game_year_id as $year) {
            create_log_entry('Games', $game_id, 'Year', $year, 'Delete', $_SESSION['user_id']);

            $mysqli->query("DELETE FROM game_year WHERE game_year_id = '$year' AND game_id = '$game_id'");
            $_SESSION['edit_message'] = "Year has been deleted";
        }
    } else {
        $_SESSION['edit_message'] = "Please choose a release year";
    }
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If add year button has been pressed
//***********************************************************************************
if (isset($action) and $action == 'add_year') {
    $sql = $mysqli->query("INSERT INTO game_year (game_id, game_year, game_extra_info_id) VALUES ('$game_id','$Date_Year','$game_extra_info_year')") or die("Release year insertion failed");
    $new_year_id = $mysqli->insert_id;

    create_log_entry('Games', $game_id, 'Year', $new_year_id, 'Insert', $_SESSION['user_id']);

    $_SESSION['edit_message'] = "Year has been added";
    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If the modify button has been pressed, update the necesarry tables
//***********************************************************************************
if (isset($action) and $action == 'modify_game') {
    // game_table

    $game_name = $mysqli->real_escape_string($game_name);

    $sdbquery = $mysqli->query("UPDATE game SET game_name='$game_name' WHERE game_id=$game_id") or die("trouble updating game");

    // Delete the category crosses currently in the database for this game
    $sdbquery = $mysqli->query("DELETE FROM game_cat_cross WHERE game_id=$game_id");

    // Insert the values from the passed category array
    if (isset($category)) {
        foreach ($category as $cat) {
            $sdbquery = $mysqli->query("INSERT INTO game_cat_cross (game_id,game_cat_id) VALUES ($game_id,$cat)");
        }
    }

    // Delete game attributes currently in the database for this game
    $sdbquery = $mysqli->query("DELETE FROM game_attributes WHERE game_id=$game_id");

    // Insert the all the attributes again
    if (isset($attribute_types)) {
        foreach ($attribute_types as $attribute_type) {
            $sdbquery = $mysqli->query("INSERT INTO game_attributes (game_id,attribute_type_id) VALUES ($game_id,$attribute_type)");
        }
    }

    $_SESSION['edit_message'] = "Game has been modified";

    create_log_entry('Games', $game_id, 'Game', $game_id, 'Update', $_SESSION['user_id']);

    header("Location: ../games/games_detail.php?game_id=$game_id");
}

//***********************************************************************************
//If the delete button has been pressed, delete the necesarry records from the tables
//***********************************************************************************

if (isset($action) and $action == 'delete_game') {
    //First we need to do a hell of a lot checks before we can delete an actual game.
    $sdbquery = $mysqli->query("SELECT * FROM game_download WHERE game_id='$game_id'") or die("Error getting download info");

    if ($sdbquery->num_rows > 0) {
        $_SESSION['edit_message'] = "Deletion failed - This game has downloads - Delete it in the appropriate section";
        header("Location: ../games/games_detail.php?game_id=$game_id");
    } else {
        $sdbquery = $mysqli->query("SELECT * FROM game_diskscan WHERE game_id='$game_id'") or die("Error getting diskscan info");
        if ($sdbquery->num_rows > 0) {
            $_SESSION['edit_message'] = "Deletion failed - This game has a diskscan - Delete it in the appropriate section";
            header("Location: ../games/games_detail.php?game_id=$game_id");
        } else {
            $sdbquery = $mysqli->query("SELECT * FROM game_gallery WHERE game_id='$game_id'") or die("Error getting gallery info");

            if ($sdbquery->num_rows > 0) {
                $_SESSION['edit_message'] = "Deletion failed - This game has a images in the gallery table - Delete it in the appropriate section";
                header("Location: ../games/games_detail.php?game_id=$game_id");
            } else {
                $sdbquery = $mysqli->query("SELECT * FROM game_boxscan WHERE game_id='$game_id'") or die("Error getting boxscan info");

                if ($sdbquery->num_rows > 0) {
                    $_SESSION['edit_message'] = "Deletion failed - This game has (a) boxscan(s) - Delete it in the appropriate section";
                    header("Location: ../games/games_detail.php?game_id=$game_id");
                } else {
                    $sdbquery = $mysqli->query("SELECT * FROM game_user_comments WHERE game_id='$game_id'") or die("Error getting user comments");

                    if ($sdbquery->num_rows > 0) {
                        $_SESSION['edit_message'] = "Deletion failed - This game has user comments - Delete it in the appropriate section";
                        header("Location: ../games/games_detail.php?game_id=$game_id");
                    } else {
                        $sdbquery = $mysqli->query("SELECT * FROM game_submitinfo WHERE game_id='$game_id'") or die("Error getting submit info");

                        if ($sdbquery->num_rows > 0) {
                            $_SESSION['edit_message'] = "Deletion failed - This game has info submitted from visitors - Delete it in the appropriate section";
                            header("Location: ../games/games_detail.php?game_id=$game_id");
                        } else {
                            $sdbquery = $mysqli->query("SELECT * FROM screenshot_game WHERE game_id='$game_id'") or die("Error getting screenshot info");

                            if ($sdbquery->num_rows > 0) {
                                $_SESSION['edit_message'] = "Deletion failed - This game has screenshots - Delete it in the appropriate section";
                                header("Location: ../games/games_detail.php?game_id=$game_id");
                            } else {
                                $sdbquery = $mysqli->query("SELECT * FROM review_game WHERE game_id='$game_id'") or die("Error getting review info");

                                if ($sdbquery->num_rows > 0) {
                                    $_SESSION['edit_message'] = "Deletion failed - This game has reviews - Delete it in the appropriate section";
                                    header("Location: ../games/games_detail.php?game_id=$game_id");
                                } else {
                                    $sdbquery = $mysqli->query("SELECT * FROM game_music WHERE game_id='$game_id'") or die("Error getting music info");

                                    if ($sdbquery->num_rows > 0) {
                                        $_SESSION['edit_message'] = "Deletion failed - This game has music files attached - Delete it in the appropriate section";
                                        header("Location: ../games/games_detail.php?game_id=$game_id");
                                    } else {
                                        create_log_entry('Games', $game_id, 'Game', $game_id, 'Delete', $_SESSION['user_id']);

                                        $sdbquery = $mysqli->query("DELETE FROM game WHERE game_id = '$game_id' ");
                                        $sdbquery = $mysqli->query("DELETE FROM game_publisher WHERE game_id = '$game_id'");
                                        $sdbquery = $mysqli->query("DELETE FROM game_developer WHERE game_id = '$game_id' ");
                                        $sdbquery = $mysqli->query("DELETE FROM game_year WHERE game_id = '$game_id' ");
                                        $sdbquery = $mysqli->query("DELETE FROM game_cat_cross WHERE game_id = '$game_id' ");
                                        $sdbquery = $mysqli->query("DELETE FROM game_attributes_hardware WHERE game_id='$game_id'");
                                        $sdbquery = $mysqli->query("DELETE FROM game_attributes WHERE game_id='$game_id'");
                                        $sdbquery = $mysqli->query("DELETE FROM game_aka WHERE game_id='$game_id'");
                                        $sdbquery = $mysqli->query("DELETE FROM lingo_game WHERE game_id='$game_id'");
                                        $sdbquery = $mysqli->query("DELETE FROM game_similar WHERE game_id='$game_id'");
                                        $sdbquery = $mysqli->query("DELETE FROM game_series_cross WHERE game_id='$game_id'");
                                        $sdbquery = $mysqli->query("DELETE FROM game_author WHERE game_id='$game_id'");

                                        $_SESSION['edit_message'] = "Game has been deleted";

                                        header("Location: ../games/games_main.php");
                                        $smarty->assign("user_id", $_SESSION['user_id']);

                                        //close the connection
                                        mysqli_free_result();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

//close the connection
mysqli_close($mysqli);
