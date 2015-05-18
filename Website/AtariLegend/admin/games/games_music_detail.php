<?php
/***************************************************************************
*                                games_music_detail.php
*                            -----------------------------
*   begin                : Tuesday, November 15, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : admin@atarilegend.com
*						   Created file
*						
*   Id: games_music_detail.php,v 0.10 2005/11/15 ST Graveyard
*
***************************************************************************/

//load all common functions
include("../includes/common.php"); 

/*
***********************************************************************************
This is the game music detail page. 
***********************************************************************************
*/

if (isset($action) and $action == 'delete_music')
{

if(isset($music_id)) 
{
	foreach($music_id_selected as $music)
	{
		//get the extension 

		$MUSIC = $mysqli->query("SELECT * FROM music
	   			   		      WHERE music_id = '$music'")
				 or die ("Database error - selecting screenshots");
		
		$musicrow = $MUSIC->fetch_array(MYSQLI_BOTH);
		$music_ext = $musicrow['imgext'];

		$sql = $mysqli->query("DELETE FROM music WHERE music_id = '$music' ") or die ("error deleting music");
		$sql = $mysqli->query("DELETE FROM game_music WHERE music_id = '$music' ")  or die ("error deleting game_music");
		$sql = $mysqli->query("DELETE FROM music_author WHERE music_id = '$music' ")  or die ("error deleting music_author");
		$sql = $mysqli->query("DELETE FROM music_types WHERE music_id = '$music' ")  or die ("error deleting music_types");

		$new_path = $music_game_path;
		$new_path .= $music;
		$new_path .= ".";
		$new_path .= $music_ext;

		unlink ("$new_path");
	}
}
}

if (isset($action) and $action == 'play_music')
{
	$query_music = $mysqli->query("SELECT * FROM music 
							WHERE music.music_id='$music_id'");
							
	$sql_music = $query_music->fetch_array(MYSQLI_BOTH);

	$filename="$music_game_path$sql_music[music_id].$sql_music[imgext]";

	$fp=fopen($filename, "rb");
	
	header("Content-Type: $sql_music[mime_type]");
	header("Content-Length: ".filesize($filename));
	
	if ($sql_music['imgext']=='mod')
		{
	    	header('Content-Disposition: attachment; filename="music.mod"');
		}
	if ($sql_music['imgext']=='ym')
		{
	    	header('Content-Disposition: attachment; filename="music.ym"');
		}
	if ($sql_music['imgext']=='snd')
		{
	    	header('Content-Disposition: attachment; filename="music.snd"');
		}
	if ($sql_music['imgext']=='mp3')
		{
	    	header('Content-Disposition: attachment; filename="music.mp3"');
		}
	
	fpassthru($fp);
	exit;
}

if (isset($action) and $action == 'pick_composer')
{
	if ( $individuals == '-' )
	{
		$smarty->assign('message', 'Please pick a composer or add one in the detail page');
	}
	else
	{
		$smarty->assign('action', 'pick_composer');
	
		//We need to get all the info of this game. 
		$SQL_IND = $mysqli->query("SELECT *
							   	 FROM individuals
						         WHERE ind_id='$individuals'")
			        or die ("Error getting ind name");
	
		while ( $IND=$SQL_IND->fetch_array(MYSQLI_BOTH) ) 
		{  
			$smarty->assign('ind_selected',
		  	 		 array( 'ind_id'  => $IND['ind_id'],
					 		'ind_name' => $IND['ind_name']));
		}
	}
}
	
if (isset($action) and $action == 'upload_zaks')
{
	//Here we'll be looping on each of the inputs on the page that are filled in with an image!

$image = $_FILES['music'];

foreach($image['tmp_name'] as $key=>$tmp_name)
{
	if ($tmp_name!=='none')
	{
	// Check what extention the file has and if it is allowed.
	
		$ext="";
		$type_image = $image['name'][$key];
		$pos = strrpos($type_image, '.');
        $ext = substr($type_image, $pos + 1);
		
		$mime_type = $image['type'][$key];
		
		// lower case please.
		$ext = strtolower ($ext);
		// Is the extention allowed?
		
		if ( $ext=='ym' or $ext=='mod' or $ext=='snd' or $ext=='mp3')
		
		{
		// First we insert extension of the file... this also creates an autoinc number for us.
		$sdbquery = $mysqli->query("INSERT INTO music (music_id,imgext,mime_type) VALUES ('','$ext','$mime_type')")
					or die ("Database error - inserting music_id");
		
		//select the newly entered music_id from the main table
		$MUSIC = $mysqli->query("SELECT music_id FROM music
	   					   	  ORDER BY music_id desc")
				 or die ("Database error - selecting music_id");
		
		$musicrow = $MUSIC->fetch_row();
		$music_id = $musicrow[0];
		
		$sdbquery = $mysqli->query("INSERT INTO game_music (game_id,music_id) VALUES ('$game_id','$music_id')")
					or die ("Database error - inserting music id");
		
		// Insert the author id
		
		$sdbquery = $mysqli->query("INSERT INTO music_author (music_id,ind_id) VALUES ('$music_id','$ind_id')")
					or die ("Database error - couldn't insert author id");
		
		// Get the type id and insert it into the music type table
		$typequery = $mysqli->query("SELECT music_types_main_id FROM music_types_main WHERE extention='$ext'") 
					 or die ("Database error - selecting music_id");
		
		$typerow = $typequery->fetch_row();
		$type_id = $typerow[0];
		
		// Insert the type id
		$sdbquery = $mysqli->query("INSERT INTO music_types (music_types_main_id,music_id) VALUES ('$type_id','$music_id')")
					or die ("Database error - inserting type id");
		
		// Rename the uploaded file to its autoincrement number and move it to its proper place.
		$file_data = rename($image['tmp_name'][$key], "$music_game_path$music_id.$ext") or die("couldn't rename and move file");
		
		chmod("$music_game_path$music_id.$ext", 0777) or die("couldn't chmod file");
		
		}
		else
		{
			$smarty->assign('message', 'Please use extension ym, mod, mp3 or snd');
		}
			
	}          
}
}

//We need to get all the info of this game. 
$SQL_GAME = $mysqli->query("SELECT game_name, 
						   game.game_id
						   FROM game 
					       WHERE game.game_id='$game_id'")
		      or die ("Error getting game info");
			
while ( $GAME=$SQL_GAME->fetch_array(MYSQLI_BOTH) ) 
{  
	$smarty->assign('game',
	   		 array('game_id' => $GAME['game_id'],
				   'game_name' => $GAME['game_name']));
}

//get the music info
$sql_music = $mysqli->query("SELECT * FROM game_music 
							LEFT JOIN music ON (game_music.music_id = music.music_id)
							LEFT JOIN music_author ON (music.music_id = music_author.music_id)
							LEFT JOIN individuals ON (music_author.ind_id = individuals.ind_id)
							LEFT JOIN music_types ON (music.music_id = music_types.music_id)
							LEFT JOIN music_types_main ON (music_types.music_types_main_id = music_types_main.music_types_main_id)
							WHERE game_music.game_id='$game_id'");
$i = 0;
while ( $MUSIC=$sql_music->fetch_array(MYSQLI_BOTH) ) 
{ 		
	$i++;
	
	$smarty->append('music',
	   		 array('music_id' => $MUSIC['music_id'],
				   'ind_name' => $MUSIC['ind_name'],
				   'music_id' => $MUSIC['music_id'],
				   'extention' => $MUSIC['extention']));
}

$smarty->assign('nr_of_zaks', $i);

//get the individuals
//$sql_author = $mysqli->query("SELECT * FROM individuals ORDER BY ind_name ASC");

//while ( $IND=$sql_author->fetch_array(MYSQLI_BOTH) ) 
//{ 		
//	$smarty->append('ind',
//	   		 array('ind_id' => $IND[ind_id],
//				   'ind_name' => $IND[ind_name]));
//}

$SQL_MUSICIAN = $mysqli->query("SELECT *
						   FROM game_author
						   LEFT JOIN author_type ON ( game_author.author_type_id = author_type.author_type_id )
					       LEFT JOIN game ON ( game_author.game_id = game.game_id )
						   LEFT JOIN individuals ON ( game_author.ind_id = individuals.ind_id )
						   WHERE game.game_id='$game_id'
						   AND author_type.author_type_info = 'music'")
		      or die ("Error getting game musician");
$i = 0;

while ( $MUSICIAN=$SQL_MUSICIAN->fetch_array(MYSQLI_BOTH) ) 
{  
	$i++;
	
	$smarty->append('ind',
	   		 array('ind_id' => $MUSICIAN['ind_id'],
				   'ind_name' => $MUSICIAN['ind_name']));
}

if (isset($i) and $i == 0 )
{
	$message = "No musician attached to this game, go to the detail pages to add a musician first";
	$smarty->assign("message",$message);
}
else
{
	$message = "To add more musicians, just click the game name in the header to go to the detail pages of this game";
	$smarty->assign("message",$message);
}

$smarty->assign("user_id",$_SESSION['user_id']);
$smarty->assign('games_music_detail_tpl', '1');

//Send all smarty variables to the templates
$smarty->display('file:../templates/0/index.html');

//close the connection
mysqli_close($mysqli);

