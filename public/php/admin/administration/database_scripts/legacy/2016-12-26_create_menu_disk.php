<?php
/***************************************************************************
*                                2016-12-26_create_menu_disk.php
*                            ------------------------------------------
*   begin                : 2016-12-26
*   copyright            : (C) 2016 Atari Legend
*   email                : martens_maarten@hotmail.com
*   actual update        : creation of file
*
*   Id: 2016-12-26_create_menu_disk.php,v 0.10 2016-12-26 ST Graveyard
*
***************************************************************************/

// Unique identifier set by developer.
$database_update_id = 51;

// Description of what the change will do.
$update_description = "Create the menu disk table";

// Should the database change query execute if test is "test_fail" or "test_success"
$execute_condition = "test_fail";

//This is the test query, the query should be made to get an either true or false result.
$test_condition = "SELECT * FROM information_schema.tables
WHERE table_schema = '$db_databasename' AND table_name = 'menu_disk' LIMIT 1";

// Database change
$database_update_sql = "CREATE TABLE IF NOT EXISTS `menu_disk` (
						  `menu_disk_id` int(11) NOT NULL AUTO_INCREMENT,
                          `menu_sets_id` int(11),
                          `menu_disk_number` int(11),
						  `menu_disk_letter` char(1),
                          `menu_disk_part` char(1),
                          `menu_disk_version` char(1),
						  `state` int(11),
						  PRIMARY KEY (`menu_disk_id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

// If the update should auto execute without user interaction set to "yes".
$database_autoexecute = "yes";

// This var should almost allways be set to "no", it is only used for certain corner cases where
// the database change has already been done in some other way and we only want to update the
// change database.
$force_insert = "no";
