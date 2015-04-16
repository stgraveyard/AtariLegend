<?php
/***************************************************************************
*                                screenstar.php
*                            -----------------------
*   begin                : Tuesday, April 16, 2015
*   copyright            : (C) 2015 Atari Legend
*   email                : martens_maarten@hotmail.com
*   actual update        : Creation of file
*
*   Id: screenstar.php,v 0.1 2015/04/16 22:54 Silver
*
***************************************************************************/

//*********************************************************************************************
// This is the php for the screenstar tile of AtariLegend
//*********************************************************************************************

//Select the screenstar info from the DB
$query_screenstar = mysql_query("SELECT 
					game.game_name,
					game.game_id,
					comments.comment,
					screenshot_main.screenshot_id,
					screenshot_main.imgext
					FROM game_user_comments
					LEFT JOIN comments ON (game_user_comments.comment_id = comments.comments_id)
					LEFT JOIN game ON (game_user_comments.game_id = game.game_id)
					LEFT JOIN screenshot_game ON (game.game_id = screenshot_game.game_id)
					LEFT JOIN screenshot_main ON (screenshot_game.screenshot_id = screenshot_main.screenshot_id)
					ORDER BY RAND() LIMIT 1") or die("query error, screenstar");

$sql_screenstar = mysql_fetch_array($query_screenstar);


	
	//Structure and manipulate the comment text
	$screenstar_comment = $sql_screenstar['comment'];
	$screenstar_comment = stripslashes($screenstar_comment);
	$screenstar_comment = InsertALCode($screenstar_comment); 
	$screenstar_comment = substr($screenstar_comment, 0,180);
	$screenstar_comment = trim($screenstar_comment);
	$screenstar_comment .= "..."; // need to write a if statement for this only if there are more then 180 chars

	//Ready screenshots path and filename
	$screenstar_image  = $game_screenshot_path;
	$screenstar_image .= $sql_screenstar['screenshot_id'];
	$screenstar_image .= '.';
	$screenstar_image .= $sql_screenstar['imgext'];
			
	$smarty->assign('screenstar',
	     array('screenstar_game_name' => $sql_screenstar['game_name'],
		   'screenstar_comment' => $screenstar_comment,
		   'screenstar_game_id' => $sql_screenstar['game_id'],
		   'screenstar_img' => $screenstar_image));

?>
