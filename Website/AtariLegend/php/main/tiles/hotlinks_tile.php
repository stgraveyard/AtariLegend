<?php
/***************************************************************************
*                                hotlinks_tile.php
*                            ----------------------------
*   begin                : Thurrsday, April 16, 2015
*   copyright            : (C) 2015 Atari Legend
*   email                : martens_maarten@hotmail.com
*   actual update        : Creation of file
*
*   Id:   who_is_it_tile.php,v 0.1 2015/04/23 22:31 ST Graveyard
*
***************************************************************************/

//*********************************************************************************************
// This is the php code for the 'hotlinks' tile
//*********************************************************************************************

//Select a random interview record
$query_links = $mysqli->query("SELECT  
						website.website_id,
						website.website_name,	
						website.website_url,
						website.website_imgext,	
						users.userid,
						website_description.website_description_text
						FROM website
						LEFT JOIN users ON ( website.website_user_sub = users.user_id )
						LEFT JOIN website_description ON ( website.website_id = website_description.website_id )
						WHERE website.website_imgext <> ' '
						ORDER BY RAND() LIMIT 1") or die("query error, hotlinks");  
						   
$sql_links = $query_links->fetch_array(MYSQLI_BOTH); 

//Get the dataElements we want to place on screen
	
$v_link_image  = $website_image_path;
$v_link_image .= $sql_links['website_id'];
$v_link_image .= '.';
$v_link_image .= $sql_links['website_imgext'];

$website_text = nl2br($sql_links['website_description_text']);
$website_text = InsertALCode($website_text); // disabled this as it wrecked the design.
$website_text = trim($website_text);
$website_text = RemoveSmillies($website_text);
	
$smarty->assign('hotlinks',
    	 array('website_id' => $sql_links['website_id'],
		 	'website_name' => $sql_links['website_name'],
		 	'website_img' =>$v_link_image,
			'website_url' => $sql_links['website_url'],
			'website_text' => $website_text,
			'userid' => $sql_links['userid']));
			   
?>