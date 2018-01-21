<?php
/***************************************************************************
*                                quick_search_games.php
*                            -------------------------------
*   begin                : Monday, December 21, 2015
*   copyright            : (C) 2015 Atari Legend
*   email                : admin@atarilegend.com
*
*   Id: quick_search_games.php 21/12/2015 ST Graveyard - creation of file
*
***************************************************************************/

/*
***********************************************************************************
This is the include to fill the quick search games side menu
***********************************************************************************
*/

//Get publisher values to fill the searchfield
$sql_publisher = $mysqli->query("SELECT pub_dev.pub_dev_id,
                   pub_dev.pub_dev_name
                   FROM game_publisher
                   LEFT JOIN pub_dev ON (game_publisher.pub_dev_id = pub_dev.pub_dev_id)
                   GROUP BY pub_dev.pub_dev_id HAVING COUNT(DISTINCT pub_dev.pub_dev_id) = 1
                   ORDER BY pub_dev.pub_dev_name ASC")
                or die("Problems retriving values from publishers.");

while ($company_publisher = $sql_publisher->fetch_array(MYSQLI_BOTH)) {
    $smarty->append('company_publisher', array(
                    'comp_id' => $company_publisher['pub_dev_id'],
                    'comp_name' => $company_publisher['pub_dev_name']));
}

//Get Developer values to fill the searchfield
$sql_developer = $mysqli->query("SELECT pub_dev.pub_dev_id,
                   pub_dev.pub_dev_name
                   FROM game_developer
                   LEFT JOIN pub_dev ON (game_developer.dev_pub_id = pub_dev.pub_dev_id)
                   GROUP BY pub_dev.pub_dev_id HAVING COUNT(DISTINCT pub_dev.pub_dev_id) = 1
                   ORDER BY pub_dev.pub_dev_name ASC")
                or die("Problems retriving values from developers.");

while ($company_developer = $sql_developer->fetch_array(MYSQLI_BOTH)) {
    $smarty->append('company_developer', array(
            'comp_id' => $company_developer['pub_dev_id'],
            'comp_name' => $company_developer['pub_dev_name']));
}

//Get Year values to fill the searchfield
$sql_year = $mysqli->query("SELECT distinct game_year from game_year order by game_year")
                     or die("problems getting data from game_year table");

while ($game_year = $sql_year->fetch_array(MYSQLI_BOTH)) {
    $smarty->append('game_year', array(
            'game_year' => $game_year['game_year']));
}

// Create dropdown values a-z
$az_value = az_dropdown_value(0);
$az_output = az_dropdown_output(0);

$smarty->assign('az_value', $az_value);
$smarty->assign('az_output', $az_output);
