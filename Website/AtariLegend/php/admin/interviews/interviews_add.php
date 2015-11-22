<?php
/***************************************************************************
*                                interviews_add.php
*                            --------------------------
*   begin                : Saturday, July 30 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : created this page
*
*   Id: interviews_add.php,v 0.10 2005/07/30 23:07 Gatekeeper
*
***************************************************************************/

//****************************************************************************************
// This is the interview add page. Overhere you can add a new interview
//**************************************************************************************** 

include("../includes/common.php");

//****************************************************************************************
//first we check if there is an individual selected. This is done at the main page
//****************************************************************************************

if ( $individual_create == " " or $individual_create == '-' )
{
	$message = 'Please choose an individual to interview';
	$smarty->assign("message",$message);
		
	$smarty->assign("user_id",$_SESSION['user_id']);
	
	//Get the individuals
	$sql_individuals = $mysqli->query("SELECT * FROM individuals ORDER BY ind_name ASC")
			  		   or die ("Couldn't query indiciduals database");
		
	while ($individuals = $sql_individuals->fetch_array(MYSQLI_BOTH))
	{
		$smarty->append('individuals',
	    		 array('ind_id' => $individuals['ind_id'],
					   'ind_name' => $individuals['ind_name']));
	}

	//Send all smarty variables to the templates
	$smarty->display('file:../templates/0/interviews_main.html');
}
//****************************************************************************************
//This piece of code is used to open up a blank interview add canvas (before we actually 
//add it to the DB)
//****************************************************************************************
else
{
//Get the individuals
$sql_individuals = $mysqli->query("SELECT * FROM individuals ORDER BY ind_name ASC")
		  		   or die ("Couldn't query indiciduals database");
		
while ($individuals = $sql_individuals->fetch_array(MYSQLI_BOTH))
{
	
	//Get the selected individual data
	if ( $individuals['ind_id'] == $individual_create )
	{
		$smarty->assign('selected_individual',
	    	 	array('ind_id' => $individuals['ind_id'],
				 	  'ind_name' => $individuals['ind_name']));
	}
	
	$smarty->append('individuals',
	    	 array('ind_id' => $individuals['ind_id'],
				   'ind_name' => $individuals['ind_name']));
}

//Get the authors for the interview
$sql_author = $mysqli->query("SELECT user_id,userid FROM users")
			  or die ("Database error - getting members name");
        
while ( $authors=$sql_author->fetch_array(MYSQLI_BOTH) )
{
	$smarty->append('authors',
	    	 array('user_id' => $authors['user_id'],
				   'user_name' => $authors['userid']));
}				   

$smarty->assign("user_id",$_SESSION['user_id']);

//Send all smarty variables to the templates
$smarty->display('file:../templates/0/interviews_add.html');
}

//close the connection
mysqli_close($mysqli);