{* 
/***************************************************************************
*                                Individuals_main.tpl
*                            --------------------------
*   begin                : Saturday, August 6, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : Creation of file
*   Id: Individuals_main.tpl,v 0.10 2005/08/06 15:04 Gatekeeper
*
***************************************************************************/

************************************************************************************************
The main individual page
************************************************************************************************
*}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	<span class="LEFTNAVHEADING">&nbsp;Add/Edit an individual</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td colspan="2">
	<fieldset class="category_set">
		In this section you can add or edit an individual. To edit an existing individual, look up the name
		in the dropdown box and press the 'Edit' button. To add an individual, use the input field and press 'add'
	</fieldset> 
	</td>
</tr>
<tr>
	<td align="center">
	<form action="../individuals/individuals_edit.php" method="post" name="ind_edit" id="ind_edit">
	<fieldset class="interview_set">
	<legend class="links_legend">Edit an individual</legend>
	<select name="ind_id">
		<option value="-">-</option>
		{foreach from=$individuals item=line}
			<option value="{$line.ind_id}">{$line.ind_name}</option>
		{/foreach}	
	</select>
	<input type="submit" value="Edit">
	</fieldset>
	<input type="hidden" name="action" id="action" value="search_ind">
	<input type="hidden" name="user_id" id="user_id" value="{$user_id}">
	</form>	
	</td>
	<td align="center">
	<form action="../individuals/individuals_main.php" method="post" name="ind_add" id="ind_add">
	<fieldset class="interview_set">
	<legend class="links_legend">Add an individual</legend>
	<input type="text" name="ind_name">
	<input type="submit" value="Add">
	</fieldset>
	<input type="hidden" name="action" id="action" value="insert_ind">
	<input type="hidden" name="user_id" id="user_id" value="{$user_id}">
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