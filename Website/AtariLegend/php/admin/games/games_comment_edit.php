<?php
/***************************************************************************
 *                                games_comment_edit.php
 *                            -----------------------
 *   begin                : Sunday, sept 18, 2005
 *   copyright            : (C) 2005 Atari Legend
 *   email                : silversurfer@atari-forum.com
 *   actual update        : file creation
 *
 *
 *   Id: games_comment_edit.php,v 0.10 2005/09/18 Silver Surfer
 *   Id: games_comment_edit.php,v 0.20 2015/12/29 STG - added left/right side
 *   Id: games_comment_edit.php,v 0.21 2017/04/27 STG - added stripslashes
 *
 ***************************************************************************/

/*
 ***********************************************************************************
 This will compile the games comment edit page
 ***********************************************************************************
 */

include("../../config/common.php");
include("../../config/admin.php");

//load the search fields of the quick search side menu
include("../../admin/games/quick_search_games.php");

if (empty($view)) {
    $view = "comment";
}
if (empty($c_counter)) {
    $c_counter = "";
}

$sql_build = "SELECT *  FROM game_user_comments
                            LEFT JOIN comments ON ( game_user_comments.comment_id = comments.comments_id )
                            LEFT JOIN users ON ( comments.user_id = users.user_id )
                            LEFT JOIN game ON ( game_user_comments.game_id = game.game_id )
                            WHERE game_user_comments_id = '$game_user_comments_id'";

$sql_comment = $mysqli->query($sql_build) or die("couldn't build query");
$query_comment = $sql_comment->fetch_array(MYSQLI_BOTH) or die("couldn't build query");

$date = date("F j, Y", $query_comment['timestamp']);

$comment = stripslashes($query_comment['comment']);
$comment = trim($comment);

$smarty->assign('comments', array(
    'comment' => $comment,
    'date' => $date,
    'game' => $query_comment['game_name'],
    'game_id' => $query_comment['game_id'],
    'view' => $view,
    'user_name' => $query_comment['userid'],
    'users_id' => $query_comment['user_id'],
    'game_user_comments_id' => $game_user_comments_id,
    'c_counter' => $c_counter,
    'comment_id' => $query_comment['comment_id'],
    'v_counter' => $v_counter
));

//Send all smarty variables to the templates
$smarty->display("file:" . $cpanel_template_folder . "games_comment_edit.html");
