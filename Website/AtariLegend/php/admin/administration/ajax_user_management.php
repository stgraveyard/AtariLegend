<?php
/***************************************************************************
*                                ajax_user_management.php
*                            -----------------------
*   begin                : 2016-02-21
*   copyright            : (C) 2016 Atari Legend
*   email                : silversurfer@atari-forum.com
*   actual update        : 	
*							 
*							
*
*   Id: ajax_user_management.php,v 0.10 2016-02-21 Silver Surfer
*
***************************************************************************/

include("../../includes/common.php");
include("../../includes/admin.php"); 


$sql_query = "SELECT users.user_id, users.userid, users.email, users.join_date, users.last_visit FROM users";

if (isset($with_comments) and $with_comments=="1") {$sql_query .= " LEFT JOIN comments ON (users.user_id = comments.user_id)"; }
if (isset($no_comments) and $no_comments=="1") {$sql_query .= " LEFT JOIN comments ON (users.user_id = comments.user_id)"; }
if ((isset($with_news) and $with_news=="1") || (isset($no_news) and $no_news=="1")) {$sql_query .= " LEFT JOIN news ON (users.user_id = news.user_id)"; }
if ((isset($with_links) and $with_links=="1") || (isset($no_links) and $no_links=="1")) {$sql_query .= " LEFT JOIN website ON (users.user_id = website.website_user_sub)"; }
if ((isset($with_submissions) and $with_submissions=="1") || (isset($no_submissions) and $no_submissions=="1"))
	{
		$sql_query .= " LEFT JOIN game_submitinfo ON (users.user_id = game_submitinfo.user_id)"; 
		$sql_query .= " LEFT JOIN demo_submitinfo ON (users.user_id = demo_submitinfo.user_id)"; 
		
	}

// Start Where clause 

if (isset($userbrowse) and $userbrowse=="num") {$sql_query .= "	WHERE userid REGEXP '^[0-9].*'";}
elseif (isset($userbrowse) and $userbrowse=="-") {$sql_query .= " WHERE userid LIKE '%'";}
else {$sql_query .= " WHERE userid LIKE '$userbrowse%'";}

if (isset($with_email) and $with_email=="1") {$sql_query .= " AND email IS NOT NULL AND TRIM(email)<>''"; }
if (isset($no_email) and $no_email=="1") {$sql_query .= " AND TRIM(email) = ''"; }
if (isset($with_comments) and $with_comments=="1") {$sql_query .= " AND comments.user_id IS NOT NULL"; }
if (isset($no_comments) and $no_comments=="1") {$sql_query .= " AND comments.comments_id IS NULL"; }
if (isset($with_news) and $with_news=="1") {$sql_query .= " AND news.user_id IS NOT NULL"; }
if (isset($no_news) and $no_news=="1") {$sql_query .= " AND news.user_id IS NULL"; }
if (isset($with_links) and $with_links=="1") {$sql_query .= " AND website.website_id IS NOT NULL"; }
if (isset($no_links) and $no_links=="1") {$sql_query .= " AND website.website_id IS NULL"; }
if (isset($with_submissions) and $with_submissions=="1") 
	{
		$sql_query .= " AND game_submitinfo.game_submitinfo_id OR demo_submitinfo.demo_submitinfo_id IS NOT NULL"; 
	}
if (isset($no_submissions) and $no_submissions=="1") 
	{
		$sql_query .= " AND game_submitinfo.game_submitinfo_id IS NULL AND demo_submitinfo.demo_submitinfo_id IS NULL"; 
	}

// filter out duplicates
$sql_query .= " GROUP BY users.user_id HAVING COUNT(DISTINCT users.user_id) = 1";
			  
$sql_query .= " ORDER BY users.userid";

//echo $sql_query;

$sql_users = $mysqli->query($sql_query)
						  or die ("Couldn't query users Database");	
	
while ($query_users = $sql_users->fetch_array(MYSQLI_BOTH))
{
	if(empty($nr_users)) 
	{
		$nr_users='';
	}
	
	$nr_users++;
	$email = trim($query_users['email']);

	if ($query_users['join_date']!=='')
	{
		$join_date = convert_timestamp($query_users['join_date']);
	}
	else
	{
	$join_date = "Unknown";
	}

	if ($query_users['last_visit']!=='')
	{
		$last_visit = convert_timestamp($query_users['last_visit']);
	}
	else
	{
		$last_visit = "Unknown";
	}

	$smarty->append('users',
				array('user_id' => $query_users['user_id'],
					  'user_name' => $query_users['userid'],
					  'join_date' => $join_date,
					  'last_visit' => $last_visit,
					  'email' => $email));

	$smarty->assign('nr_users', $nr_users);
}



		
//Send all smarty variables to the templates

$smarty->display("file:".$cpanel_template_folder."ajax_user_management.html");
?>
