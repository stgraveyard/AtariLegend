<?php
/***************************************************************************
 *                                games_review_list.php
 *                            --------------------------
 *   begin                : Sunday, November 27, 2005
 *   copyright            : (C) 2005 Atari Legend
 *   email                : admin@atarilegend.com
 *                         Created file
 *
 *   Id: games_review_list.php,v 0.10 2005/11/27 ST Graveyard
 *   Id: games_review_list.php,v 0.20 2016/07/24 ST Graveyard
 *                      - AL 2.0
 *
 ***************************************************************************/

//load all common functions
include("../../config/common.php");
include("../../config/admin.php");

//load the search fields of the quick search side menu
include("../../admin/games/quick_search_games.php");

//get the number of reviews in the archive
$query_number = $mysqli->query("SELECT * FROM review_main WHERE review_edit = '0'") or die("Couldn't get the number of reviews");
$v_reviews = $query_number->num_rows;

$RESULTGAME = "SELECT
                    game.game_id,
                    game.game_name,
                    pub_dev.pub_dev_name,
                    pub_dev.pub_dev_id,
                    game_year.game_year,
                    users.userid,
                    review_main.review_date
                    FROM game
                    LEFT JOIN game_publisher ON ( game.game_id = game_publisher.game_id )
                    LEFT JOIN pub_dev ON ( game_publisher.pub_dev_id = pub_dev.pub_dev_id )
                    LEFT JOIN game_year ON ( game_year.game_id = game.game_id )
                    LEFT JOIN review_game ON ( review_game.game_id = game.game_id )
                    LEFT JOIN review_main ON ( review_main.review_id = review_game.review_id)
                    LEFT JOIN users ON ( review_main.user_id = users.user_id)
                    WHERE review_game.game_id IS NOT NULL
                    GROUP BY game.game_id, game.game_name HAVING COUNT(DISTINCT game.game_id, game.game_name) = 1
                    ORDER BY review_main.review_date DESC";

$games = $mysqli->query($RESULTGAME);

$rows = $games->num_rows;
$v_reviewed_games = $rows;

// Send to smarty

$smarty->assign('review_nr', $v_reviews);
$smarty->assign('game_review_nr', $v_reviewed_games);


/*
 ************************************************************************************************
 This is the game review main page
 ************************************************************************************************
 */
$start1 = gettimeofday();
list($start2, $start3) = explode(":", exec('date +%N:%S'));

if (empty($action)) {
    $action = "";
}
if (isset($action) and $action == 'search') {

    //check the $gamebrowse select
    if ($gamebrowse == "") {
        $gamebrowse_select = "";
    } elseif ($gamebrowse == '-') {
        $gamebrowse_select = "";
    } elseif ($gamebrowse == 'num') {
        $gamebrowse_select = "game.game_name REGEXP '^[0-9].*' AND ";
    } else {
        $gamebrowse = $mysqli->real_escape_string($gamebrowse);
        $gamebrowse_select = "game.game_name LIKE '$gamebrowse%' AND ";
    }

    //Before we start the build the query, we check if there is at least
    //one search field filled in or used!

    if ($gamebrowse_select == "" and $gamesearch == "") {
        $smarty->assign("message", "Please fill in one of the search fields");

        $smarty->assign("user_id", $_SESSION['user_id']);
        $smarty->assign('games_review_tpl', '1');

        //Send all smarty variables to the templates
        $smarty->display("file:" . $cpanel_template_folder . "games_review.html");

        //close the connection
        mysqli_free_result();
    } else {
        //In all cases we search we start searching through the game table
        //first
        $RESULTGAME = "SELECT
                            game.game_id,
                            game.game_name,
                            pub_dev.pub_dev_name,
                            pub_dev.pub_dev_id,
                            game_year.game_year
                       FROM game
                       LEFT JOIN game_publisher ON ( game.game_id = game_publisher.game_id )
                       LEFT JOIN pub_dev ON ( game_publisher.pub_dev_id = pub_dev.pub_dev_id )
                       LEFT JOIN game_year ON ( game_year.game_id = game.game_id ) WHERE ";

        $RESULTGAME .= $gamebrowse_select;
        $gamesearch = $mysqli->real_escape_string($gamesearch);
        $RESULTGAME .= "game.game_name LIKE '%$gamesearch%'";
        $RESULTGAME .= ' ORDER BY game.game_name ASC';

        $games = $mysqli->query($RESULTGAME);

        if (!$games) {
            echo "Couldn't query games database for games starting with a certain number";
        } else {
            $rows = $games->num_rows;
            if ($rows > 0) {
                if (empty($i)) {
                    $i = 0;
                }
                while ($row = $games->fetch_array(MYSQLI_BOTH)) {
                    $i++;

                    //check how many reviews there are for the game
                    $number_revs = $mysqli->query("SELECT count(*) as count FROM review_game WHERE game_id='$row[game_id]'") or die("couldn't get number of reviews");

                    $array = $number_revs->fetch_array(MYSQLI_BOTH);

                    $smarty->append('review', array(
                        'game_id' => $row['game_id'],
                        'game_name' => $row['game_name'],
                        'game_publisher' => $row['pub_dev_name'],
                        'game_year' => $row['game_year'],
                        'number_reviews' => $array['count']
                    ));
                }

                $end1       = gettimeofday();
                $totaltime1 = (float) ($end1['sec'] - $start1['sec']) + ((float) ($end1['usec'] - $start1['usec']) / 1000000);

                $smarty->assign('querytime', $totaltime1);
                $smarty->assign('nr_of_entries', $i);

                $smarty->assign("user_id", $_SESSION['user_id']);

                //Send all smarty variables to the templates
                $smarty->display("file:" . $cpanel_template_folder . "games_review_list.html");

                //close the connection
                mysqli_close($mysqli);
            } else {
                $_SESSION['edit_message'] = "No entries for your query!";

                $smarty->assign("user_id", $_SESSION['user_id']);

                //Send all smarty variables to the templates
                $smarty->display("file:" . $cpanel_template_folder . "games_review.html");

                //close the connection
                mysqli_close($mysqli);
            }
        }
    }
}
