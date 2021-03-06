<?php
/*******************************************************************************
 *                                autocomplete.php
 *                            -----------------------
 *   begin                : june 2015
 *   copyright            : (C) 2015 Atari Legend
 *   email                :
 *
 *   Id: autocomplete.php,v 0.10 2015 Brume
 *   Id: autocomplete.php,v 0.11 05/07/2017 ST Graveyard
 *          - Fixed the autocomplete script
 *
 ********************************************************************************

 *********************************************************************************
 * This is the autocompletion script used on the search
 *********************************************************************************/

include("../config/connect.php");
require_once __DIR__."/../common/DAO/GameReleaseDAO.php";

$gameReleaseDao = new \AL\Common\DAO\GameReleaseDAO($mysqli);

$text = $mysqli->real_escape_string($_GET['term']);

$json = array();

$term = $_GET['term'];
$term = $mysqli->real_escape_string($term);
$upperString = strtoupper($term);
$extraVar = $_GET['extraParams'];

if ($extraVar == 'title') {
    //Set up queries
    $game_name_query     = "SELECT game_name FROM game";
    $game_aka_name_query = "SELECT aka_name AS game_name FROM game_aka";

    //Create a temporary table to get all the demos and aka's as well.
    $mysqli->query("CREATE TEMPORARY TABLE temp ENGINE=MEMORY $game_name_query");
    $mysqli->query("INSERT INTO temp $game_aka_name_query");

    //Get the results
    $result = $mysqli->query("SELECT game_name FROM temp WHERE game_name LIKE '%$upperString%'
        ORDER BY game_name ASC LIMIT 10") or die("error getting date for autocomplete");

    while ($row = $result->fetch_assoc()) {
        $json[] = $row['game_name'];
    }

    $mysqli->query("DROP TABLE temp");
}

if ($extraVar == 'publisher') {
    //Get the results
    $result = $mysqli->query("SELECT pub_dev.pub_dev_name
                               FROM game_release
                               LEFT JOIN pub_dev ON (game_release.pub_dev_id = pub_dev.pub_dev_id)
                               WHERE pub_dev_name LIKE '%$upperString%'
                               GROUP BY pub_dev.pub_dev_id HAVING COUNT(DISTINCT pub_dev.pub_dev_id) = 1
                               ORDER BY pub_dev.pub_dev_name ASC LIMIT 10")
                            or die("Problems retrieving values from publishers");

    while ($row = $result->fetch_assoc()) {
        $json[] = $row['pub_dev_name'];
    }
}

if ($extraVar == 'developer') {
    //Get the results
    $result = $mysqli->query("SELECT pub_dev.pub_dev_name
                   FROM game_developer
                   LEFT JOIN pub_dev ON (game_developer.dev_pub_id = pub_dev.pub_dev_id)
                   WHERE pub_dev_name LIKE '%$upperString%'
                   GROUP BY pub_dev.pub_dev_id HAVING COUNT(DISTINCT pub_dev.pub_dev_id) = 1
                   ORDER BY pub_dev.pub_dev_name ASC LIMIT 10")
                or die("Problems retrieving values from developer");

    while ($row = $result->fetch_assoc()) {
        $json[] = $row['pub_dev_name'];
    }
}

if ($extraVar == 'year') {
    $years = $gameReleaseDao->getAllReleasesYears();
    foreach ($years as $year) {
        if (strpos("$year", $upperString) === 0) {
            $json[] = "$year";
        }
    }
}

if ($extraVar == 'cat') {
    //Get the results
    $result = $mysqli->query("SELECT * from game_genre WHERE name LIKE '%$upperString%' ORDER BY name")
                     or die("problems getting data from game_genre table");

    while ($row = $result->fetch_assoc()) {
        $json[] = $row['name'];
    }
}

if ($extraVar == 'individual') {
    $stmt = $mysqli->prepare("SELECT ind_id, ind_name from individuals
        WHERE LOWER(ind_name) LIKE CONCAT('%',LOWER(?),'%') ORDER BY ind_name")
        or die("problems getting data from individuals table: ".$mysqli->error);
    $stmt->bind_param("s", $term);
    $stmt->execute();
    $stmt->bind_result($ind_id, $ind_name);

    while ($stmt->fetch()) {
        $json[] = array(
            "value" => $ind_id,
            "label" => $ind_name
        );
    }

    $stmt->close();
}

header("Content-Type: application/json");
echo json_encode($json);
