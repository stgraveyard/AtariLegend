<?php
/***************************************************************************
 *                                news_iconpreview.php
 *                            -----------------------
 *   begin                : Sunday, May 1, 2005
 *   copyright            : (C) 2003 Atari Legend
 *   email                : maarten.martens@freebel.net
 *   actual update        : added 2 columns to the list
 *
 *   Id: news_iconpreview.php,v 0.11 2004/05/07 Silver
 *   Id: news_iconpreview.php,v 0.12 2016/07/28 STG
 *           -AL 2.0
 *
 ***************************************************************************/
/*
 ***********************************************************************************
 In this section we can preview the news icons
 ***********************************************************************************
 */

include("../../config/common.php");
include("../../config/admin.php");

//load the search fields of the quick search side menu
include("../../admin/games/quick_search_games.php");

$count = 1;

$sql_images = $mysqli->query("SELECT * FROM news_image");

while ($news_images = $sql_images->fetch_array(MYSQLI_BOTH)) {
    $v_image = $news_images_path;
    $v_image .= $news_images['news_image_id'];
    $v_image .= '.';
    $v_image .= $news_images['news_image_ext'];

    $smarty->append('news_images', array(
        'image_id' => $news_images['news_image_id'],
        'image_name' => $news_images['news_image_name'],
        'image_link' => $v_image,
        'count' => $count
    ));

    if ($count == 3) {
        $count = 1;
    } else {
        $count = $count + 1;
    }
}

//Send all smarty variables to the templates
$smarty->display("file:" . $cpanel_template_folder . "news/news_iconpreview.html");

//close the connection
mysqli_close($mysqli);
