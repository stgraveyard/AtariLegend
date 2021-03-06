<?php
/***************************************************************************
*                                who_is_it_tile.php
*                            ----------------------------
*   begin                : Thurrsday, April 16, 2015
*   copyright            : (C) 2015 Atari Legend
*   email                : martens_maarten@hotmail.com
*   actual update        : Creation of file
*
*   Id:   who_is_it_tile.php,v 0.1 2015/04/16 22:29 ST Graveyard
*
***************************************************************************/

//*********************************************************************************************
// This is the php code for the 'who is it' tile
//*********************************************************************************************

//Select a random interview record
$query_interview = $mysqli->query("SELECT
						interview_main.interview_id,
						interview_text.interview_intro,
                        interview_text.interview_date,
						individuals.ind_id,
						individuals.ind_name,
						individual_text.ind_imgext,
                        users.user_id,
						users.userid
						FROM interview_main
						LEFT JOIN interview_text ON (interview_main.interview_id = interview_text.interview_id)
						LEFT JOIN individuals ON (interview_main.ind_id = individuals.ind_id)
						LEFT JOIN individual_text ON (individuals.ind_id = individual_text.ind_id)
						LEFT JOIN users ON (interview_main.user_id = users.user_id)
						WHERE individual_text.ind_imgext <> ' '
						ORDER BY RAND() LIMIT 1") or die("query error, who_is_it");

$sql_interview = $query_interview->fetch_array(MYSQLI_BOTH);

//Get the dataElements we want to place on screen

$v_ind_image  = $individual_screenshot_path;
$v_ind_image .= $sql_interview['ind_id'];
$v_ind_image .= '.';
$v_ind_image .= $sql_interview['ind_imgext'];

$interview_date = date("d/m/Y", $sql_interview['interview_date']);

//Structure and manipulate the comment text
$int_text = $sql_interview['interview_intro'];

//fixxx the enters
$int_text = stripslashes($int_text);
$int_text = InsertALCode($int_text); // disabled this as it wrecked the design.
$int_text = trim($int_text);
$int_text = RemoveSmillies($int_text);

$smarty->assign(
    'who_is_it',
    array('ind_id' => $sql_interview['ind_id'],
               'ind_name' => $sql_interview['ind_name'],
               'ind_img' => $v_ind_image,
               'int_id' => $sql_interview['interview_id'],
               'int_text' => $int_text,
               'int_date' => $interview_date,
               'int_user_id' => $sql_interview['user_id'],
               'int_userid' => $sql_interview['userid'])
);
