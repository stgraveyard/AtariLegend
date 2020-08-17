<?php
/***************************************************************************
 *                                crew_search.php
 *                            --------------------------
 *   begin                : Sunday, August 28, 2005
 *   copyright            : (C) 2005 Atari Legend
 *   email                : admin@atarilegend.com
 *
 *   Id: crew_search.php,v 0.10 2005/10/29 Silver
 *   Id: crew_search.php,v 0.20 2016/10/04 STG
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

if (isset($new_crew)) {
    $smarty->assign('new_crew', $new_crew);
}

if ($crewsearch != '-' and $crewbrowse == '-') {
    $sql_crew = $mysqli->query("SELECT * FROM crew
                    WHERE crew_name LIKE '%$crewsearch%'
                    ORDER BY crew_name ASC") or die("Couldn't query Crew database");

    while ($crew = $sql_crew->fetch_array(MYSQLI_BOTH)) {
        $smarty->append('crew', array(
            'crew_id' => $crew['crew_id'],
            'crew_name' => $crew['crew_name']
        ));
    }
} elseif ($crewbrowse != '-' and $crewsearch == '-') {
    $sql_crew = $mysqli->query("SELECT * FROM crew
                WHERE crew_name LIKE '$crewbrowse%'
                ORDER BY crew_name ASC") or die("Couldn't query Crew database");

    while ($crew = $sql_crew->fetch_array(MYSQLI_BOTH)) {
        $smarty->append('crew', array(
            'crew_id' => $crew['crew_id'],
            'crew_name' => $crew['crew_name']
        ));
    }
} else {
    $sql_crew = $mysqli->query("SELECT * FROM crew WHERE crew_name REGEXP '^[0-9].*' ORDER BY crew_name ASC")
        or die("Couldn't query Crew database");

    while ($crew = $sql_crew->fetch_array(MYSQLI_BOTH)) {
        $smarty->append('crew', array(
            'crew_id' => $crew['crew_id'],
            'crew_name' => $crew['crew_name']
        ));
    }
}

if (isset($crew_select)) {
    // Do query for crew data
    $sql_crew = $mysqli->query("SELECT * FROM crew
                WHERE crew_id = '$crew_select'") or die("Couldn't query Crew database");

    $crew = $sql_crew->fetch_array(MYSQLI_BOTH);

    $crew_history = stripslashes($crew['crew_history']);

    if (isset($crew['crew_logo']) and $crew['crew_logo'] !== '') {
        $crew_logo = "$crew_logo_path$crew_select.$crew[crew_logo]";
    } else {
        $crew_logo = '';
    }

    $smarty->assign('crew_select', array(
        'crew_id' => $crew_select,
        'crew_name' => $crew['crew_name'],
        'crew_logo' => $crew_logo,
        'crew_history' => $crew_history
    ));
}

// set values for main edit of crew... change name etc
if (isset($action) and $action == "main") {
    $smarty->assign('crew_action', array(
        'action' => $action
    ));
}

// If no choice has been made but a crew has been selected we should be brought to the crew main edit regardless
if (empty($action) or (isset($action) and $action == "main")) {
    $action = "main";
    $smarty->assign('crew_action', array(
        'action' => $action
    ));
}

// Create dropdown values a-z
$az_value  = az_dropdown_value(0);
$az_output = az_dropdown_output(0);

$smarty->assign('az_value', $az_value);
$smarty->assign('az_output', $az_output);

// Search variables that got to be sent with the headers all through this module or else the code will dump
// the user back to the crew_main.php
$smarty->assign('tracking', array(
    'crewsearch' => $crewsearch,
    'crewbrowse' => $crewbrowse
));

if ($crew_select == '-' or $crew_select == '') {
    $_SESSION['edit_message'] = "Please select a crew";
    header("Location: ../crew/crew_main.php");
} else {
    //Send all smarty variables to the templates
    $smarty->display("file:" . $cpanel_template_folder . "crew/crew_editor.html");
}

//close the connection
mysqli_close($mysqli);