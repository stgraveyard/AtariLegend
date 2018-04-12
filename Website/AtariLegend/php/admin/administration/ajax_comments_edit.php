<?php
/***************************************************************************
 *                                ajax_comments_edit.php
 *                            -----------------------
 *   begin                : 2018-02-17
 *   copyright            : (C) 2018 Atari Legend
 *   email                : silversurfer@atari-forum.com
 *   actual update        : file creation
 *
 *
 ***************************************************************************/

include("../../config/common.php");
include("../../config/admin.php");
require_once __DIR__."/../../lib/Db.php";
require_once __DIR__."/../../common/DAO/CommentsDAO.php";

$commentsDao = new AL\Common\DAO\CommentsDAO($mysqli);

//*********************************************************************************************
// User comments
//*********************************************************************************************

if (isset($action) and $action == "get_comment_text") {
    if (isset($comments_id)) {
        $smarty->assign('comment_text', $commentsDao->getCommentText($comments_id));
        $smarty->assign('comment_type', $comment_type);
        $smarty->assign('action', $action);
        $smarty->assign('comments_id', $comments_id);
    }
}

if (isset($action) and $action == "save_comment_text") {
    if (isset($comments_id)) {
        if (!$commentsDao->saveCommentText($comments_id, $comment_text, $comment_type)) {
            $osd = "Comment Updated!";
        } else {
            $osd = "Update Failed!";
        }

        $smarty->assign('comment_text', $commentsDao->getCommentText($comments_id));
        $smarty->assign('action', $action);
        $smarty->assign('osd_message', $osd);
        $smarty->assign('comments_id', $comments_id);
    }
}

//Send all smarty variables to the templates
$smarty->display("file:" . $cpanel_template_folder . "ajax_comments_edit.html");