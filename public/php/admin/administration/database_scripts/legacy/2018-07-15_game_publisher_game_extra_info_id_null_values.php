<?php
/*************************************************************************************************
 *   Replace 0 values in game_publisher.game_extra_info_id by NULLs
 ************************************************************************************************/

// Unique identifier set by developer.
$database_update_id = 148;

// Description of what the change will do.
$update_description = "Replace 0 values in game_publisher.game_extra_info_id by NULLs";

// Should the database change query execute if test is "test_fail" or "test_success"
$execute_condition = "test_success";

//This is the test query, the query should be made to get an either true or false result.
$test_condition = "SELECT *
FROM information_schema.columns
WHERE table_schema = '$db_databasename'
AND table_name = 'game_publisher'
AND column_name = 'game_extra_info_id'
AND is_nullable = 'NO'";

// Database change
$database_update_sql = "../../admin/administration/database_scripts/legacy/2018-07-15_game_publisher_game_extra_info_id_null_values_addition.php";

// If the update should auto execute without user interaction set to "yes".
$database_autoexecute = "yes";

// This var should almost allways be set to "no", it is only used for certain corner cases where
// the database change has already been done in some other way and we only want to update the
// change database.
$force_insert = "no";
