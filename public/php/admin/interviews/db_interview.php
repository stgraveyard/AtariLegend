<?php
/***************************************************************************
 *                                db_interview.php
 *                            -----------------------
 *   begin                : Saturday, Sept 24, 2005
 *   copyright            : (C) 2005 Atari Legend
 *   email                : silversurfer@atari-forum.com
 *   actual update        : New section.
 *
 *   Id: db_interview,v 1.10 2005/10/29 Silver Surfer
 *   Id: db_interview,v 1.20 2016/08/02 STG
 *   - AL 2.0
 *   Id: db_interview,v 1.21 2016/08/20 STG
 *   - Added the change log
 *
 ***************************************************************************/

// This document contain all the code needed to operate the website database.
// We are using the action var to separate all the queries.

include("../../config/common.php");
include("../../config/admin.php");
//include("../../config/admin_rights.php"); /*--> We can not use it like this because of the ajax.
// redirecting does not work correctly with the inheritance of Ajax.

require_once __DIR__."/../../lib/Db.php" ;

if (isset($action) and $action == "stop") {
    echo "test";
    exit;
}

//****************************************************************************************
// This is the image selection/upload screen for the interviews
//****************************************************************************************

//If we are uploading new screenshots
if (isset($action2) and $action2 == 'add_screens') {
    if ($_SESSION['permission']==1 or $_SESSION['permission']=='1') {
        //Here we'll be looping on each of the inputs on the page that are filled in with an image!
        $image = $_FILES['image'];

        foreach ($image['tmp_name'] as $key => $tmp_name) {
            if ($tmp_name !== 'none') {
                // Check what extention the file has and if it is allowed.

                $ext        = "";
                $type_image = $image['type'][$key];

                // set extension
                if ($type_image == 'image/png') {
                    $ext = 'png';
                }

                if ($type_image == 'image/x-png') {
                    $ext = 'png';
                } elseif ($type_image == 'image/gif') {
                    $ext = 'gif';
                } elseif ($type_image == 'image/jpeg') {
                    $ext = 'jpg';
                }

                if ($ext !== "") {
                    // First we insert the directory path of where the file will be stored...
                    // this also creates an autoinc number for us.
                    $sdbquery = $mysqli->query("INSERT INTO screenshot_main (imgext) VALUES ('$ext')")
                        or die("Database error - inserting screenshots: ".$mysqli->error);

                    //select the newly entered screenshot_id from the main table
                    $SCREENSHOT = $mysqli->query("SELECT screenshot_id FROM screenshot_main
                           ORDER BY screenshot_id desc") or die("Database error - selecting screenshots");

                    $screenshotrow = $SCREENSHOT->fetch_row();
                    $screenshot_id = $screenshotrow[0];

                    $sdbquery = $mysqli->query("INSERT INTO screenshot_interview (interview_id, screenshot_id)
                        VALUES ($interview_id, $screenshot_id)") or die("Database error - inserting screenshots2");

                    // Rename the uploaded file to its autoincrement number and move it to its proper place.
                    $file_data = rename(
                        $image['tmp_name'][$key],
                        "$interview_screenshot_save_path$screenshotrow[0].$ext"
                    );

                    $osd_message = "Screenshot uploaded";

                    create_log_entry(
                        'Interviews',
                        $interview_id,
                        'Screenshots',
                        $interview_id,
                        'Insert',
                        $_SESSION['user_id']
                    );

                    chmod("$interview_screenshot_save_path$screenshotrow[0].$ext", 0777);
                }
            }
        }
    } else {
        $osd_message = "You do not have the necessary authorizations to perform this action";
    }

    if (isset($osd_message)) {
    } else {
        $osd_message = "No screenshot uploaded";
    }

    //Let's get the screenshots for the interview
    $sql_screenshots = $mysqli->query("SELECT * FROM screenshot_interview
        LEFT JOIN screenshot_main on ( screenshot_interview.screenshot_id = screenshot_main.screenshot_id )
        WHERE screenshot_interview.interview_id = '$interview_id'
        ORDER BY screenshot_interview.screenshot_id ASC")
        or die("Database error - getting screenshots & comments");

    //get the number of screenshots in the archive
    $v_screenshots = $sql_screenshots->num_rows;
    $smarty->assign("screenshots_nr", $v_screenshots);

    $count = 1;

    while ($screenshots = $sql_screenshots->fetch_array(MYSQLI_BOTH)) {
        $v_int_image = $interview_screenshot_path;
        $v_int_image .= $screenshots['screenshot_id'];
        $v_int_image .= '.';
        $v_int_image .= $screenshots['imgext'];

        //We need to get the comments with each screenshot
        $sql_comments = $mysqli->query("SELECT * FROM interview_comments
            WHERE screenshot_interview_id  = $screenshots[screenshot_interview_id]")
            or die("Database error - getting screenshots comments");

        $comments = $sql_comments->fetch_array(MYSQLI_BOTH);

        $smarty->append('screenshots', array(
            'interview_screenshot' => $v_int_image,
            'interview_screenshot_id' => $screenshots['screenshot_id'],
            'interview_screenshot_count' => $count,
            'interview_screenshot_comment' => htmlentities($comments['comment_text'] ?? '')
        ));
        $count = $count + 1;
    }

    $smarty->assign('osd_message', $osd_message);

    $smarty->assign('smarty_action', 'add_screen_to_interview_return');
    $smarty->assign('interview_id', $interview_id);

    //Send to smarty for return value
    $smarty->display("file:" . $cpanel_template_folder . "interviews/ajax_interview_add_screenshots.html");
}

//*************************************************************************
// Delete the interview and return to the interview page
//*************************************************************************
if (isset($action) and $action == "delete_interview") {
    include("../../config/admin_rights.php");
    create_log_entry('Interviews', $interview_id, 'Interview', $interview_id, 'Delete', $_SESSION['user_id']);

    $sql = $mysqli->query("DELETE FROM interview_main WHERE interview_id = '$interview_id' ");
    $sql = $mysqli->query("DELETE FROM interview_text WHERE interview_id = '$interview_id' ");

    //delete the comments at every screenshot for this review
    $SCREENSHOT = $mysqli->query("SELECT * FROM screenshot_interview where interview_id = '$interview_id' ")
        or die("Database error - getting screenshots");

    while ($screenshotrow = $SCREENSHOT->fetch_row()) {
        $sql = $mysqli->query("DELETE FROM interview_comments WHERE screenshot_interview_id = $screenshotrow[0] ");
    }

    //delete the screenshots
    $SCREENSHOT2 = $mysqli->query("SELECT * FROM screenshot_interview where interview_id = '$interview_id' ")
        or die("Database error - getting screenshots");

    while ($screenshotrow = $SCREENSHOT2->fetch_row()) {
        //get the extension
        $SCREENSHOT_ext = $mysqli->query("SELECT * FROM screenshot_main
                       WHERE screenshot_id = $screenshotrow[2]") or die("Database error - selecting screenshots");

        $screenshotrow_ext   = $SCREENSHOT_ext->fetch_array(MYSQLI_BOTH);
        $screenshot_ext_type = $screenshotrow_ext['imgext'];

        $sql = $mysqli->query("DELETE FROM screenshot_main WHERE screenshot_id = $screenshotrow[2] ");

        $new_path = $interview_screenshot_save_path;
        $new_path .= $screenshotrow[2];
        $new_path .= ".";
        $new_path .= $screenshot_ext_type;

        unlink("$new_path");
    }

    $sql = $mysqli->query("DELETE FROM screenshot_interview WHERE interview_id = '$interview_id' ");

    $_SESSION['edit_message'] = 'interview deleted';

    header("Location: ../interviews/interviews_main.php");
}

//*************************************************************************
// Delete the interview screenshots and comments and return to the interview page
//*************************************************************************

//If the delete comment has been triggered
if (isset($action) and $action == 'delete_screenshot_comment') {
    if ($_SESSION['permission']==1 or $_SESSION['permission']=='1') {
        $sql_interviewshot = $mysqli->query("SELECT * FROM screenshot_interview
                              WHERE interview_id = $interview_id
                        AND screenshot_id = $screenshot_id") or die("Database error - selecting screenshots interview");

        $interviewshot   = $sql_interviewshot->fetch_row();
        $interviewshotid = $interviewshot[0];

        create_log_entry('Interviews', $interview_id, 'Screenshots', $interview_id, 'Delete', $_SESSION['user_id']);

        //delete the screenshot comment from the DB table
        $sdbquery = $mysqli->query("DELETE FROM interview_comments WHERE screenshot_interview_id = $interviewshotid")
            or die("Error deleting comment");

        //get the extension
        $SCREENSHOT = $mysqli->query("SELECT * FROM screenshot_main
                        WHERE screenshot_id = '$screenshot_id'") or die("Database error - selecting screenshots");

        $screenshotrow  = $SCREENSHOT->fetch_array(MYSQLI_BOTH);
        $screenshot_ext = $screenshotrow['imgext'];

        $sql = $mysqli->query("DELETE FROM screenshot_main WHERE screenshot_id = '$screenshot_id' ");
        $sql = $mysqli->query("DELETE FROM screenshot_interview WHERE screenshot_id = '$screenshot_id' ");

        $new_path = $interview_screenshot_save_path;
        $new_path .= $screenshot_id;
        $new_path .= ".";
        $new_path .= $screenshot_ext;

        unlink("$new_path");
        $osd_message = "Screenshot and comment deleted successfully";
    } else {
        $osd_message = "You do not have the necessary authorizations to perform this action";
    }

    if (isset($osd_message)) {
    } else {
        $osd_message = "No screenshot uploaded";
    }

    //Let's get the screenshots for the interview
    $sql_screenshots = $mysqli->query("SELECT * FROM screenshot_interview
        LEFT JOIN screenshot_main on ( screenshot_interview.screenshot_id = screenshot_main.screenshot_id )
        WHERE screenshot_interview.interview_id = '$interview_id' ORDER BY screenshot_interview.screenshot_id ASC")
        or die("Database error - getting screenshots & comments");

    //get the number of screenshots in the archive
    $v_screenshots = $sql_screenshots->num_rows;
    $smarty->assign("screenshots_nr", $v_screenshots);

    $count = 1;

    while ($screenshots = $sql_screenshots->fetch_array(MYSQLI_BOTH)) {
        $v_int_image = $interview_screenshot_path;
        $v_int_image .= $screenshots['screenshot_id'];
        $v_int_image .= '.';
        $v_int_image .= $screenshots['imgext'];

        //We need to get the comments with each screenshot
        $sql_comments = $mysqli->query("SELECT * FROM interview_comments
            WHERE screenshot_interview_id  = $screenshots[screenshot_interview_id]")
            or die("Database error - getting screenshots comments");

        $comments = $sql_comments->fetch_array(MYSQLI_BOTH);

        $smarty->append('screenshots', array(
            'interview_screenshot' => $v_int_image,
            'interview_screenshot_id' => $screenshots['screenshot_id'],
            'interview_screenshot_count' => $count,
            'interview_screenshot_comment' => htmlentities($comments['comment_text'])
        ));
        $count = $count + 1;
    }

    $smarty->assign('osd_message', $osd_message);

    $smarty->assign('smarty_action', 'add_screen_to_interview_return');
    $smarty->assign('interview_id', $interview_id);

    //Send to smarty for return value
    $smarty->display("file:" . $cpanel_template_folder . "interviews/ajax_interview_add_screenshots.html");
}

//*************************************************************************
// UPDATE INTERVIEW AND RETURN TO THE INTERVIEW EDIT PAGE
//*************************************************************************

//If the Update interview has been triggered
if (isset($action) and $action == 'update_interview' and (!isset($action2))) {
    include("../../config/admin_rights.php");
    //First, we'll be filling up the main interview table
    $sdbquery = $mysqli->query("UPDATE interview_main SET user_id = $members, ind_id = $individual
               WHERE interview_id = $interview_id") or die("Couldn't Update into interview_main");

    // first we have to convert the date vars into a time stamp to be inserted to review_date
    $date = date_to_timestamp($Date_Year, $Date_Month, $Date_Day);

    $textfield    = $mysqli->real_escape_string($textfield);
    $textintro    = $mysqli->real_escape_string($textintro);
    $textchapters = $mysqli->real_escape_string($textchapters);

    //check if this is first update. If yes, interview_text is not filled yet and we need to do a create
    //Let's get the screenshots for the interview
    $sql_interview_text = $mysqli->query("SELECT * FROM interview_text WHERE interview_id = '$interview_id'")
        or die("Database error - getting interview text");

    //get the number of screenshots in the archive
    $v_nr_text = $sql_interview_text->num_rows;

    if ($v_nr_text > 0) {
        $sdbquery = $mysqli->query("UPDATE interview_text SET interview_text = '$textfield', interview_date = '$date',
            interview_intro = '$textintro', interview_chapters = '$textchapters' WHERE interview_id = $interview_id")
            or die("Couldn't update into interview_text");
    } else {
        $sdbquery = $mysqli->query("INSERT INTO interview_text (interview_id, interview_text, interview_date,
            interview_intro, interview_chapters) VALUES ($interview_id, '$textfield', '$date', '$textintro',
            '$textchapters')") or die("Couldn't insert into interview_text");
    }

    // Update draft status
    $draft = $draft ?? 0;

    $stmt = \AL\Db\execute_query(
        "db_interview: Update Draft status",
        $mysqli,
        "UPDATE interview_main set draft = ? where interview_id = ?",
        "ii", $draft, $interview_id
    );

    //we're gonna add the screenhots into the screenshot_interview table and fill up the interview_comment table.
    //We need to loop on the screenshot table to check the shots used. If a comment field is filled,
    //the screenshot was used!
    $SCREEN = $mysqli->query("SELECT * FROM screenshot_interview where interview_id = '$interview_id'
        ORDER BY screenshot_id ASC") or die("Database error - getting screenshots");

    $i = 0;
    while ($screenrow = $SCREEN->fetch_row()) {
        if ($inputfield[$i] != "") {
            //fill the comments table
            $screenid = $screenrow[0];
            $comment  = $inputfield[$i];
            $comment  = $mysqli->real_escape_string($comment);

            $interviewshotid = $screenrow[0];

            //check if comment already exists for this shot
            $INTERVIEWCOMMENT = $mysqli->query("SELECT * FROM interview_comments
                where screenshot_interview_id = $interviewshotid")
                or die("Database error - selecting screenshot interview comment");

            $number = $INTERVIEWCOMMENT->num_rows;

            if ($number > 0) {
                $sdbquery = $mysqli->query("UPDATE interview_comments SET comment_text = '$comment'
                     WHERE screenshot_interview_id = $interviewshotid") or die("Couldn't update interview_comments");
            } else {
                $sdbquery = $mysqli->query("INSERT INTO interview_comments (screenshot_interview_id, comment_text)
                    VALUES ($interviewshotid, '$comment')") or die("Couldn't insert into interview_comments");
            }
        }
        $i++;
    }
    create_log_entry('Interviews', $interview_id, 'Interview', $interview_id, 'Update', $_SESSION['user_id']);

    $_SESSION['edit_message'] = 'Interview updated succesfully';

    header("Location: ../interviews/interviews_edit.php?interview_id=$interview_id");
} elseif (isset($action) and $action == 'add_interview') {
    //****************************************************************************************
    //This is what happens when we press the create interview button in the interview creation
    //page
    //****************************************************************************************
    if ($individual_create == '' or $individual_create == '-') {
        $_SESSION['edit_message'] = 'Some required info is not filled in. Make sure the -Add Interview- field is used';
        header("Location: ../interviews/interviews_main.php");
    } else {
        include("../../config/admin_rights.php");
        $sdbquery = $mysqli->query("INSERT INTO interview_main (ind_id, draft) VALUES ($individual_create, 1)")
            or die("Couldn't insert into interview_main");

        //get the id of the inserted interview
        $id = $mysqli->insert_id;

        //insert the date of today
        $date = date_to_timestamp(date("Y"), date("m"), date("d"));
        $sdbquery = $mysqli->query("INSERT INTO interview_text (interview_id, interview_date) VALUES ($id, '$date')")
            or die("Couldn't insert into interview_text");

        create_log_entry('Interviews', $individual_create, 'Interview', $id, 'Insert', $_SESSION['user_id']);

        $_SESSION['edit_message'] = 'Interview added succesfully';

        $smarty->assign("user_id", $_SESSION['user_id']);

        //Send all smarty variables to the templates
        header("Location: ../interviews/interviews_edit.php?interview_id=$id");
    }
}
