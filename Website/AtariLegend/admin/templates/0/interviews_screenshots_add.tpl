{* 
/************************************************************************************
*                                interviews_screenshots_add.tpl
*                            -------------------------------------
*   begin                : Saturday, July 30 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : created this page
*
*   Id: interviews_screenshots_add.tpl,v 0.10 2005/07/30 23:07 Gatekeeper
*
*************************************************************************************/

///***********************************************************************************
// This is the sub template file to generate the interviews main screenshot page
//************************************************************************************ 
*}
{literal}
<script type="text/javascript">
function deletecomment(screenshot_id, interview_id)
{	
	// CONFIRM REQUIRES ONE ARGUMENT
    var message = "Are you sure you want to delete the screenshot with its comment?";
    // CONFIRM IS BOOLEAN. THAT MEANS THAT
    // IT RETURNS TRUE IF 'OK' IS CLICKED
    // OTHERWISE IT RETURN FALSE
    var return_value = confirm(message);
	if (return_value !="0")
    {
      	url="interviews_screenshots_add.php?interview_id="+interview_id+"&screenshot_id="+screenshot_id+"&action=delete_screen";
		location.href=url;
    }
}
</script>
{/literal}
				
<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	<span class="LEFTNAVHEADING">&nbsp;Interviews screenshots - <a href="../individuals/individuals_edit.php?ind_id={$interview.interview_ind_id}" class="MAINNAV_WHITE">{$interview.interview_ind_name}</a></span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td>
	<fieldset class="category_set">
		In this section you can add screenshots to a selected interview. Use the browse buttons to select the shots and press the 
		'Submit Query' button to link them to the interview.
	</fieldset> 
	<br>
	<br>
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" width="100%">
		<fieldset class="news_set">
		<legend class="links_legend">screenshots</legend>
		{if $screenshots_nr <> ''}
			{foreach from=$screenshots item=line}
				Image {$line.count} :: 
				<a href="javascript:deletecomment({$line.id},{$interview.interview_id})" class="MAINNAV">Delete</a> ::    	
				<a href="javascript:void(window.open('../includes/showscreens.php?interview_screenshot_id={$line.id}','4','width={$line.width},height={$line.height},toolbar=no,statusbar=no'))" class="MAINNAV">Look at image</a>
				<br>
			{/foreach}
		{else}
			No screenshots attached to this interview
		{/if}
		</fieldset>	
		</td>
	</tr>
	</table>
	</td>
</tr>

<tr>
	<td align="center">
		<fieldset class="news_set">
		<legend class="links_legend">Browse</legend>
		<form enctype="multipart/form-data" name="frmUploadShot" action="interviews_screenshots_add.php" method="post">
		{section name=loop loop=11 start=1} 
			<input type="file" name="image[{$smarty.section.loop.index}]">
		{/section}	
		</fieldset> 
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td>
	<input type="hidden" name="MAX_FILE_SIZE" value="100000">
	<input type="hidden" name="interview_id" value="{$interview.interview_id}">
	<input type="hidden" name="individual" value="{$interview.interview_ind_id}">
	<input type="hidden" name="action" value="add_screens">
	<input type="submit" name="cmdSubmit">
	</form>
	</td>
</tr>
</table>
	
<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td>
 	<span class="LEFTNAVHEADING">&nbsp;&nbsp;&nbsp;</span>
	</td>
</tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
   		<td colspan="3" valign=top align=center>
			<b><a href="javascript:history.go(-1)" class="MAINNAV">back</a></b>
		</td>
	</tr>
</table>
<br>

{if $message <> ''}
	<table align="center" width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td align="center" >
			<br><br>
			<span class="MAINAV">{$message}</span>
		</td>
	</tr>
	</table>
{/if}