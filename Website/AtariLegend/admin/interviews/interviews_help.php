<?
/***************************************************************************
*                                interviews_help.php
*                            --------------------------
*   begin                : Sunday, July 31 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : created this page
*
*   Id: interviews_help.php,v 0.10 2005/07/31 18:01 Gatekeeper
*
***************************************************************************/

//****************************************************************************************
// This is the interview help page. 
//**************************************************************************************** 

include("../includes/common.php");
include("../includes/config.php"); 

$smarty->assign("user_id",$_SESSION[user_id]);
$smarty->assign('interviews_hlp_tpl', '1');

//Send all smarty variables to the templates
$smarty->display('file:../templates/0/index.tpl');

//close the connection
mysql_close();