{* 
/***************************************************************************
*                                company_main.tpl
*                            --------------------------
*   begin                : Sunday, August 7, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : Creation of file
*   Id: company_main.tpl,v 0.10 2005/08/07 14:29 Gatekeeper
*
***************************************************************************/

************************************************************************************************
The main company (developer/publisher) page
************************************************************************************************
*}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	<span class="LEFTNAVHEADING">&nbsp;Add/Edit a company (publisher/developer)</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td colspan="2">
	<fieldset class="category_set">
		In this section you can add or edit a publisher or developer. To edit an existing entry, look up the name
		in the dropdown box and press the 'Edit' button. To add a new entry, use the input field and press 'add'
	</fieldset> 
	</td>
</tr>
<tr>
	<td align="center">
	<form action="../company/company_edit.php" method="post" name="comp_edit" id="comp_edit">
	<fieldset class="interview_set">
	<legend class="links_legend">Edit a company</legend>
	<select name="comp_id">
		<option value="-">-</option>
		{foreach from=$company item=line}
			<option value="{$line.comp_id}">{$line.comp_name}</option>
		{/foreach}	
	</select>
	<input type="submit" value="Edit">
	</fieldset>
	<input type="hidden" name="action" id="action" value="search_comp">
	<input type="hidden" name="user_id" id="user_id" value="{$user_id}">
	</form>	
	</td>
	<td align="center">
	<form action="../company/company_main.php" method="post" name="comp_add" id="comp_add">
	<fieldset class="interview_set">
	<legend class="links_legend">Add a company</legend>
	<input type="text" name="comp_name">
	<input type="submit" value="Add">
	</fieldset>
	<input type="hidden" name="action" id="action" value="insert_comp">
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