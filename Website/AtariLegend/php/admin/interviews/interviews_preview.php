<?php
/***************************************************************************
*                                interviews_preview.php
*                            --------------------------
*   begin                : friday, July 21, 2005
*   copyright            : (C) 2004 Atari Legend
*   email                : admin@atarilegend.com
*
*   Id: interviews_preview.php,v 0.10 2005/07/21 16:47 ST Graveyard
*   Id: interviews_preview.php,v 0.20 2016/08/03 16:33 ST Graveyard
*       - AL 2.0
*
***************************************************************************/

//*********************************************************************************************
// Load a preview of the interview!
//*********************************************************************************************

//load all common functions
include("../../includes/common.php");
include("../../includes/admin.php");

//load the search fields of the quick search side menu
include("../../includes/quick_search_games.php");

$sql_interview = $mysqli->query("SELECT
                                   interview_main.interview_id,
                                   interview_main.user_id,
                                   interview_main.ind_id,
                                   interview_text.interview_text,
                                   interview_text.interview_chapters,
                                   interview_text.interview_date,
                                   users.userid,
                                   individual_text.ind_imgext,
                                   individuals.ind_name
                            FROM interview_main
                            LEFT JOIN interview_text on (interview_main.interview_id = interview_text.interview_id)
                            LEFT JOIN users on (interview_main.ind_id = users.user_id)
                            LEFT JOIN individuals on (interview_main.ind_id = individuals.ind_id)
                            LEFT JOIN individual_text on (interview_main.ind_id = individual_text.ind_id)
                            WHERE interview_main.interview_id = $interview_id") or die("Error - Couldn't query interview data");

$query_interview = $sql_interview->fetch_array(MYSQLI_BOTH);

    $v_interview_date = date("F j, Y",$query_interview['interview_date']);

    $interview_text = $query_interview['interview_text'];
    $interview_text = nl2br($interview_text);
    $interview_text = InsertALCode($interview_text);

    $interview_chapters = $query_interview['interview_chapters'];
    $interview_chapters = nl2br($interview_chapters);
    $interview_chapters = InsertALCode($interview_chapters);

    //get the author of the interview
    $query_author = $mysqli->query("SELECT userid, email FROM users WHERE user_id = $query_interview[user_id]")
                    or die ("couldn't get author of interview");
    $sql_author = $query_author->fetch_array(MYSQLI_BOTH);

    //The interviewed person's picture
    if ( $query_interview['ind_imgext'] == 'png' or
         $query_interview['ind_imgext'] == 'jpg' or
         $query_interview['ind_imgext'] == 'gif')
    {
        $v_ind_image  = $individual_screenshot_path;
        $v_ind_image .= $query_interview['ind_id'];
        $v_ind_image .= '.';
        $v_ind_image .= $query_interview['ind_imgext'];
    }
    else
    {
        $v_ind_image = "none";
    }

    $smarty->assign('interview',
         array('individual_name' => $query_interview['ind_name'],
               'individual_id' => $query_interview['ind_id'],
               'interview_author' => $sql_author['userid'],
               'interview_email' => $sql_author['email'],
               'interview_id' => $interview_id,
               'interview_date' => $v_interview_date,
               'interview_img' => $v_ind_image,
               'interview_text' => $interview_text,
               'interview_chapters' => $interview_chapters));

//Get the screenshots and the comments of this interview
$query_screenshots = $mysqli->query("SELECT * FROM interview_main
                                LEFT JOIN screenshot_interview ON (interview_main.interview_id = screenshot_interview.interview_id)
                                LEFT JOIN screenshot_main ON (screenshot_interview.screenshot_id = screenshot_main.screenshot_id)
                                LEFT JOIN interview_comments ON (screenshot_interview.screenshot_interview_id = interview_comments.screenshot_interview_id)
                                WHERE interview_main.interview_id = '$interview_id'
                                ORDER BY screenshot_main.screenshot_id");

$count = 1;

while ($sql_screenshots = $query_screenshots->fetch_array(MYSQLI_BOTH))
{
    $new_path = $interview_screenshot_path;
    $new_path .= $sql_screenshots['screenshot_id'];
    $new_path .= ".";
    $new_path .= $sql_screenshots['imgext'];

    $smarty->append('screenshots',
                  array('screenshot' => $new_path,
                        'count' => $count,
                        'comment' => $sql_screenshots['comment_text']));

    $count++;
}

//Send all smarty variables to the templates
$smarty->display("file:".$cpanel_template_folder."interviews_preview.html");

//close the connection
mysqli_close($mysqli);
?>
