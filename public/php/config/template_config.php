<?php
/***************************************************************************
 *                                template_config.php
 *                            --------------------------
 *   copyright            : (C) 2015 Atari Legend
 *   email                : silversurfer@atari-forum.com
 *
 *
 ***************************************************************************/

 define('ROOT_PATH', dirname(__DIR__) . '/');

//Skin Switching functions

//create skin switch links dynamically with called page

//Set which template is going to be used
if (isset($_SESSION['skin'])) {
    $set_skin = $_SESSION['skin'];

    $cpanel_template_folder   = "". ROOT_PATH ."../themes/templates/1/admin/";
    $mainsite_template_folder = "". ROOT_PATH ."../themes/templates/1/main/";
    $style_folder = "". ROOT_PATH ."../themes/styles/1/";
    $smarty->assign("template_dir", "../../themes/templates/1/");
    $smarty->assign("style_dir", "../../themes/styles/1/");
    $smarty->assign("style_dir2", "../../themes/styles/1/");  //when called from the show_image function

    foreach (glob("../../../themes/styles/$set_skin/images/trivia/*.*") as $filename) {
        $filename = substr($filename, 3);
        $smarty->append('image', array(
            'image_name' => $filename
        ));
    }
} else {
    $cpanel_template_folder   = "". ROOT_PATH ."../themes/templates/1/admin/";
    $mainsite_template_folder = "". ROOT_PATH ."../themes/templates/1/main/";
    $style_folder = "". ROOT_PATH ."../themes/styles/1/";
    $smarty->assign("template_dir", "../../themes/templates/1/");
    $smarty->assign("style_dir", "../../themes/styles/1/");
    $smarty->assign("style_dir2", "../../themes/styles/1/");  //when called from the show_image function

    foreach (glob("../../../themes/styles/1/images/trivia/*.*") as $filename) {
        $filename = substr($filename, 3);
        $smarty->append('image', array(
            'image_name' => $filename
        ));
    }
}
