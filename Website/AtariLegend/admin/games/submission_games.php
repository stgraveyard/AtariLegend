<?php
/***************************************************************************
*                                submission_games.php
*                            -----------------------
*   begin                : Saturday, Jan 08, 2005
*   copyright            : (C) 2003 Atari Legend
*   email                : silversurfer@atari-forum.com
*   actual update        : Fixed counting bug
						   Fixed switch bug
*							
*
*   Id: submission_games.php,v 0.12 2005/04/28 Silver Surfer
*
***************************************************************************/

/*
***********************************************************************************
Display submissions
***********************************************************************************
*/

include("../includes/common.php");
include("../includes/config.php");

// get the total nr of submissions in the DB
$query_total_number = mysql_query("SELECT count(*) FROM game_submitinfo") or die ("Couldn't get the total number of submissions");
$v_rows_total = mysql_result($query_total_number,0,0) or die("Couldn't get the total number of submissions");
$smarty->assign('total_nr_submissions', $v_rows_total);

$v_counter = (isset($_GET['v_counter']) ? $_GET['v_counter'] : 0);
		if (!isset($list)) {$list="current"; }
		if ($list=="done") 
		
		{
		$sql_submission =  mysql_query("SELECT * FROM game_submitinfo
									 	LEFT JOIN game ON (game_submitinfo.game_id = game.game_id)
									 	LEFT JOIN users ON (game_submitinfo.user_id = users.user_id)
										WHERE game_done = '1'
										ORDER BY game_submitinfo.game_submitinfo_id
										DESC LIMIT  " . $v_counter . ", 25");
										
				//check the number of comments
				$query_number = mysql_query("SELECT count(*) FROM game_submitinfo 
											 WHERE game_done = '1' 
											 ORDER BY game_submitinfo_id DESC") 
											 or die("Couldn't get the number of game submissions");
									 
				$v_rows = mysql_result($query_number,0,0) or die("Couldn't get the number of game_submissions");
		}
		
		else
		
		{
		
		$sql_submission =  mysql_query("SELECT * FROM game_submitinfo
									 	LEFT JOIN game ON (game_submitinfo.game_id = game.game_id)
									 	LEFT JOIN users ON (game_submitinfo.user_id = users.user_id)
										WHERE game_done <> '1'
										ORDER BY game_submitinfo.game_submitinfo_id
										DESC LIMIT  " . $v_counter . ", 25");
										
				//check the number of comments
				$query_number = mysql_query("SELECT count(*) FROM game_submitinfo 
											 WHERE game_done <> '1' 
											 ORDER BY game_submitinfo_id DESC") 
											 or die("Couldn't get the number of game submissions");
									 
				$v_rows = mysql_result($query_number,0,0);

		}
		
										
		$number_sub = get_rows($sql_submission);
	
		while ($query_submission = mysql_fetch_array($sql_submission))  
		{
		
		
	if (isset($query_submission['game_id'])) 
	{
	
		//Select a random screenshot record
	$query_game = mysql_query("SELECT 
							   screenshot_game.game_id,
							   screenshot_game.screenshot_id,
							   screenshot_main.imgext
						   	   FROM screenshot_game 
						       LEFT JOIN screenshot_main ON (screenshot_game.screenshot_id = screenshot_main.screenshot_id) 
							   WHERE screenshot_game.game_id = " .$query_submission['game_id']. "						   	   
						   	   ORDER BY RAND() LIMIT 1"); 
							   
	$sql_game = mysql_fetch_array($query_game);  
	}
	
	// Retrive userstats from database
	$query_user = mysql_query("SELECT count(*)
							   FROM game_user_comments
							   LEFT JOIN comments ON ( game_user_comments.comment_id = comments.comments_id )
							   WHERE user_id = " .$query_submission['user_id']."");
	$usercomment_number = mysql_result($query_user,0,0);
	
	$query_submitinfo = mysql_query("SELECT count(*) FROM game_submitinfo WHERE user_id = ".$query_submission['user_id']."") 
						or die ("Could not count user submissions");
	$usersubmit_number = mysql_result($query_submitinfo,0,0);
	
	
			//Get the dataElements we want to place on screen
			$v_game_image  = $game_screenshot_path;
			$v_game_image .= $sql_game['screenshot_id'];
			$v_game_image .= '.';
			$v_game_image .= $sql_game['imgext'];
	
			$converted_date = convert_timestamp($query_submission['timestamp']);
			$user_joindate = convert_timestamp($query_submission['join_date']);
				$comment = InsertALCode($query_submission['submit_text']);
				$comment = InsertSmillies($comment);
				$comment = nl2br($comment);
				$comment = stripslashes($comment);
		
			if ($query_submission['avatar_ext']!=="")
			{
			$avatar_image  = $user_avatar_path;
			$avatar_image .= $query_submission['user_id'];
			$avatar_image .= '.';
			$avatar_image .= $query_submission['avatar_ext'];
			}
			else {
			$avatar_image ="";
			}
					$smarty->append('submission',
	    				    array('game_id' => $query_submission['game_id'],
						  'game_name' => $query_submission['game_name'],
						  'date' => $converted_date,
						  'image' => $v_game_image,
						  'comment' => $comment,
						  'submit_id' => $query_submission['game_submitinfo_id'],
						  'user_name' => $query_submission['userid'],
						  'user_id' => $query_submission['user_id'],
						  'avatar_ext' => $query_submission['avatar_ext'],
			  			  'avatar_image' => $avatar_image,
						  'karma' => $query_submission['karma'],
						  'user_joindate' => $user_joindate,
						  'user_comment_nr' => $usercomment_number,
						  'usersubmit_number' => $usersubmit_number,
						  'email' => $query_submission['email']));
		} 
		
		//Check if back arrow is needed 
		if($v_counter > 0)
			{
				$back_arrow = $v_counter - 25;
			}


		//Check if we need to place a next arrow
		if($v_rows > ($v_counter + 25))
			{
				$forward_arrow = ($v_counter + 25);
			}

			if (!isset($list)) {$list="current"; }
			if (empty($back_arrow)) {$back_arrow='';}	 
				 $smarty->assign('structure',
	    			array('list' => $list,
						  'v_counter' => $v_counter,
						  'back_arrow' => $back_arrow,
						  'forward_arrow' => $forward_arrow,
						  'num_sub' => $number_sub));
 
$smarty->assign('submission_games_tpl', '1');

//Send all smarty variables to the templates
$smarty->display('file:../templates/0/index.tpl');
?>
