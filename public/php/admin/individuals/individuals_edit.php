<?php
/***************************************************************************
 *                                Individuals_edit.php
 *                            --------------------------
 *   begin                : Saturday, August 6, 2005
 *   copyright            : (C) 2005 Atari Legend
 *   email                : maarten.martens@freebel.net
 *   actual update        : Creation of file
 *   Id: Individuals_edit.php,v 0.10 2005/08/06 15:25 Gatekeeper
 *   Id: Individuals_edit.php,v 0.20 2016/08/01 23:31 Gatekeeper
 *          - AL 2.0
 *   Id: Individuals_edit.php,v 0.30 2017/02/02 00:22 Gatekeeper
 *          - Converting to the new way of individual nicks storage
 *
 ***************************************************************************/

/*
 ************************************************************************************************
 The individuals edit page
 ************************************************************************************************
 */

include("../../config/common.php");
include("../../config/admin.php");

//load the search fields of the quick search side menu
include("../../admin/games/quick_search_games.php");

if ($ind_id == '-') {
    //Get the individuals
    $sql_individuals = $mysqli->query("SELECT * FROM individuals ORDER BY ind_name ASC")
        or die("Couldn't query individual database");

    while ($individuals = $sql_individuals->fetch_array(MYSQLI_BOTH)) {
        $smarty->append('individuals', array(
            'ind_id' => $individuals['ind_id'],
            'ind_name' => $individuals['ind_name']
        ));
    }

    $_SESSION['edit_message'] = "Please select an individual";

    $smarty->assign("user_id", $_SESSION['user_id']);

    //Send all smarty variables to the templates
    $smarty->display("file:" . $cpanel_template_folder . "individuals/individuals_main.html");
} else {
    //Let's see if we have selected a nickname
    $sql_nick = $mysqli->query("SELECT * FROM individual_nicks WHERE nick_id=$ind_id")
        or die("problem getting nickname");

    while ($ind_nicks = $sql_nick->fetch_array(MYSQLI_BOTH)) {
        $ind_id = $ind_nicks['ind_id'];
    }

    //Get the individual data
    $sql_individuals = $mysqli->query("SELECT * FROM individuals
                    LEFT JOIN individual_text ON (individuals.ind_id = individual_text.ind_id )
                    WHERE individuals.ind_id=$ind_id");

    while ($individuals = $sql_individuals->fetch_array(MYSQLI_BOTH)) {
        if ($individuals['ind_imgext'] == 'png' or $individuals['ind_imgext'] == 'jpg'
            or $individuals['ind_imgext'] == 'gif') {
            $v_ind_image = $individual_screenshot_path;
            $v_ind_image .= $ind_id;
            $v_ind_image .= '.';
            $v_ind_image .= $individuals['ind_imgext'];
        } else {
            $v_ind_image = "none";
        }

        $smarty->assign('individuals', array(
            'ind_id' => $ind_id,
            'ind_name' => $individuals['ind_name'],
            'ind_profile' => $individuals['ind_profile'],
            'ind_screenshot_path' => $individual_screenshot_path,
            'ind_email' => $individuals['ind_email'],
            'ind_image' => $v_ind_image
        ));
    }

    // Get nickname information
    $sql_nick = $mysqli->query("SELECT * FROM individual_nicks where ind_id=$ind_id")
        or die("problem getting nickname");

    while ($ind_nicks = $sql_nick->fetch_array(MYSQLI_BOTH)) {
        $ind_id = $ind_nicks['nick_id'];
        $sql_nickname = $mysqli->query("SELECT * FROM individuals WHERE ind_id=$ind_id");

        while ($ind_nickname = $sql_nickname->fetch_array(MYSQLI_BOTH)) {
            $smarty->append('nicks', array(
                'nick_id' => $ind_nicks['nick_id'],
                'nick_name' => $ind_nickname['ind_name']
            ));
        }
    }

    $smarty->assign("user_id", $_SESSION['user_id']);

    //Send all smarty variables to the templates
    $smarty->display("file:" . $cpanel_template_folder . "individuals/individuals_edit.html");
}

//close the connection
mysqli_close($mysqli);
