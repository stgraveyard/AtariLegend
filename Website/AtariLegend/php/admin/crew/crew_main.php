<?php
/***************************************************************************
 *                                crew_main.php
 *                            --------------------------
 *   begin                : Sunday, August 28, 2005
 *   copyright            : (C) 2005 Atari Legend
 *   email                : admin@atarilegend.com
 *
 *   Id: crew_main.php,v 0.10 2005/10/29 Silver
 *   Id: crew_main.php,v 0.20 2016/10/04 STG
 *            - CPANEL 2.0
 *
 ***************************************************************************/

/*
 ***********************************************************************************
 This is the crew page contructor
 ***********************************************************************************
 */

//load all common functions
include("../../config/common.php");
include("../../config/admin.php");
include("../../admin/games/quick_search_games.php");

if (isset($crewsearch)) {
    $crewsearch = $mysqli->real_escape_string($crewsearch);
} else {
    $crewsearch='-';
}

if (isset($crewbrowse)) {
} else {
    $crewbrowse='-';
}

if (isset($message)) {
} else {
    $message='';
}

if (isset($new_crew)) {
    $smarty->assign('new_crew', $new_crew);
}

$sql_crew = $mysqli->query("SELECT * FROM crew WHERE crew_name REGEXP '^[0-9].*' ORDER BY crew_name ASC") or die("Couldn't query Crew database");

while ($crew = $sql_crew->fetch_array(MYSQLI_BOTH)) {
    $smarty->append('crew', array(
        'crew_id' => $crew['crew_id'],
        'crew_name' => $crew['crew_name']
    ));
}

// Create dropdown values a-z
$az_value  = az_dropdown_value(0);
$az_output = az_dropdown_output(0);

$smarty->assign('az_value', $az_value);
$smarty->assign('az_output', $az_output);

//Send all smarty variables to the templates
$smarty->display("file:" . $cpanel_template_folder . "crew_main.html");

//close the connection
mysqli_close($mysqli);
