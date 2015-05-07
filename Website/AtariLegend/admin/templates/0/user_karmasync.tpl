{* 
/***************************************************************************
*                               user_karmasync.tpl
*                            -----------------------
*   begin                : friday, November 11, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : file creation
*							
*
*   Id: user_karmasync.tpl,v 0.10 2005/11/13 silver
*
***************************************************************************/

************************************************************************************************
The the user karma sync page
************************************************************************************************
*}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	&nbsp;Karma sync
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td colspan="2" align="center">
	<fieldset class="category_set">
		Syncing karma values.
	</fieldset> 
	</td>
</tr>
</table>


<table width="100%" cellspacing="2" cellpadding="15" class="CELLCOLOR">
<tr>
	<td align="center">
		<table cellspacing="0" cellpadding="2" border="0" width="90%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
		<tr>
			<td valign="top" width="25%"><b>User Name</b></td>
			<td valign="top" width="25%"><b>Karma Value</b></td>
			<td valign="top" width="25%"><b>-</b></td>
			<td valign="top" width="10%"><b>-</b></td>
			<td valign="top" width="15%"><b>-</b></td>			
		</tr>
		</table>
		<table cellspacing="0" cellpadding="2" border="0" width="90%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
		{foreach from=$sync item=line}
		<tr bgcolor="{cycle name="tr" values="#EFEFEF,#E9E9E9"}">
			<td width="25%" valign="top">{if $line.user_name != ''}<a class="MAINNAV">{$line.user_name}</a>{/if}</td>
			<td width="25%" valign="top">{if $line.karma_value != ''}<a class="MAINNAV">{$line.karma_value}</a>{/if}</td>
			<td width="25%" valign="top"></td>				
			<td width="10%" valign="top"></td>
			<td width="15%" valign="top"></td>
		</tr>
		{/foreach}
		</table>	
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
			<b><a href="../user/user_main.php" class="MAINNAV">back</a></b>
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