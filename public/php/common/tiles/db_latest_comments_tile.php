<?php
/***************************************************************************
*                                db_latest_comments_tile.php
*                            ------------------------------------
*   begin                : Wednesday, Julu 12, 2017
*   copyright            : (C) 2017 Atari Legend
*   email                : martens_maarten@hotmail.com
*   actual update        : Creation of file
*
*   Id: db_latest_comments_tile.php,v 0.1 2017/07/12 23:35 ST Graveyard
*
***************************************************************************/

//*********************************************************************************************
// This is the php code where we update, delete the latest game comments
//*********************************************************************************************

include("../../config/common.php");
include("../../config/admin.php");

if (isset($action)) {
    if ($action=='delete_comment') {
        create_log_entry('Games', $comment_id, 'Comment', $comment_id, 'Delete', $_SESSION['user_id']);

        $sql = $mysqli->query("DELETE FROM game_user_comments WHERE comment_id = '$comment_id'")
            or die("couldn't delete game_comment quote");
        $sql = $mysqli->query("DELETE FROM comments WHERE comments_id = '$comment_id'")
            or die("couldn't delete comment quote");
    } else {
        //$data = $_POST['data'];
        $data = $mysqli->real_escape_string($data);

        $mysqli->query("UPDATE comments SET comment='$data' WHERE comments_id='$comment_id'")
            or die("couldn't update comments table");

        create_log_entry('Games', $comment_id, 'Comment', $comment_id, 'Update', $_SESSION['user_id']);
    }

    //get all the data
    if (isset($type) and $type == 'user') {
        $sql_comment = $mysqli->query("SELECT *
            FROM game_user_comments
            LEFT JOIN comments ON ( game_user_comments.comment_id = comments.comments_id )
            LEFT JOIN users ON ( comments.user_id = users.user_id )
            LEFT JOIN game ON ( game_user_comments.game_id = game.game_id )
            WHERE comments.user_id = '$_SESSION[user_id]'
            ORDER BY comments.timestamp DESC LIMIT 10") or die("Syntax Error! Couldn't not get the comments!");
        $smarty->assign('type', 'user');
    } else {
        $sql_comment = $mysqli->query("SELECT *
            FROM game_user_comments
            LEFT JOIN comments ON ( game_user_comments.comment_id = comments.comments_id )
            LEFT JOIN users ON ( comments.user_id = users.user_id )
            LEFT JOIN game ON ( game_user_comments.game_id = game.game_id )
            ORDER BY comments.timestamp DESC LIMIT 10") or die("Syntax Error! Couldn't not get the comments!");
    }

    // lets put the comments in a smarty array
    while ($query_comment = $sql_comment->fetch_array(MYSQLI_BOTH)) {
        $oldcomment = $query_comment['comment'];
        $oldcomment = nl2br($oldcomment);
        $oldcomment = InsertALCode($oldcomment);
        $oldcomment = trim($oldcomment);
        $oldcomment = RemoveSmillies($oldcomment);
        $oldcomment = stripslashes($oldcomment);

        $comment = stripslashes($query_comment['comment']);
        $comment = trim($comment);
        $comment = RemoveSmillies($comment);

        //this is needed, because users can change their own comments on the website, however this is done with JS
        //(instead of a post with pure HTML) The translation of the 'enter' breaks is different in JS, so in JS I do a
        // conversion to a <br>. However, when we edit a comment, this <br> should not be
        //visible to the user, hence again, now this conversion in php
        $breaks = array("<br />","<br>","<br/>");
        $comment = str_ireplace($breaks, "\r\n", $comment);

        $date = date("F j, Y", $query_comment['timestamp']);

        $smarty->append(
            'comments',
            array('comment' => $oldcomment,
                  'comment_edit' => $comment,
                  'comment_id' => $query_comment['comment_id'],
                  'date' => $date,
                  'game' => $query_comment['game_name'],
                  'game_id' => $query_comment['game_id'],
                  'user_name' => $query_comment['userid'],
                  'user_id' => $query_comment['user_id'],
                  'user_fb' => $query_comment['user_fb'],
                  'user_website' => $query_comment['user_website'],
                  'user_twitter' => $query_comment['user_twitter'],
                  'user_af' => $query_comment['user_af'],
                  'show_email' => $query_comment['show_email'],
                  'email' => $query_comment['email'])
        );
    }

    $smarty->assign('smarty_action', 'delete_comment');
    $smarty->display("file:" . $mainsite_template_folder. "latest_comments_tile.html");
}
