{* 
/***************************************************************************
                              user_search.tpl
*                            --------------------------
*   begin                : Sept 29, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : admin@atarilegend.com
*
*   Id: user_search.tpl,v 0.10 2005/09/29 Silver
*
***************************************************************************/

************************************************************************************************
User search result
************************************************************************************************
*}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	<span class="LEFTNAVHEADING">&nbsp;Search results</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td colspan="2" align="center">
	<form action="../user/user_search.php" method="post" name="user_search" id="user_search">
		<fieldset class="interview_set">
		
		
		<table>
		<tr>
			<td>
				<b>By name :</b>
			</td>
			<td>
				<select name="userbrowse">
					<option value="" SELECTED>-</option>
					<option value="num">0-9</option>
					<option value="a">A</option>
					<option value="b">B</option>
					<option value="c">C</option>
					<option value="d">D</option>
					<option value="e">E</option>
					<option value="f">F</option>
					<option value="g">G</option>
					<option value="h">H</option>
					<option value="i">I</option>
					<option value="j">J</option>
					<option value="k">K</option>
					<option value="l">L</option>
					<option value="m">M</option>
					<option value="n">N</option>
					<option value="o">O</option>
					<option value="p">P</option>
					<option value="q">Q</option>
					<option value="r">R</option>
					<option value="s">S</option>
					<option value="t">T</option>
					<option value="u">U</option>
					<option value="v">V</option>
					<option value="w">W</option>
					<option value="x">X</option>
					<option value="y">Y</option>
					<option value="z">Z</option>
				</select>
				<input type="text" name="usersearch" value="">
				<input type="hidden" name="action" id="action" value="search">
				<input type="submit" value="Search">
			</td>
		</tr>
		
		</table>

		
		
		</fieldset>
		
		</form>	
	</td>
</tr>
<tr>
	<td align="center">
		<table cellspacing="0" cellpadding="2" border="0" width="90%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
		<tr>
			<td valign="top" width="25%"><b>User Name</b></td>
			<td valign="top" width="25%"><b>Join Date</b></td>
			<td valign="top" width="25%"><b>Last Visit</b></td>
			<td valign="top" width="10%"><b>Email</b></td>
			<td valign="top" width="15%"><b>Website</b></td>			
		</tr>
		</table>
		<table cellspacing="0" cellpadding="2" border="0" width="90%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
		{foreach from=$users item=line}
		<tr bgcolor="{cycle name="tr" values="#EFEFEF,#E9E9E9"}">
			<td width="25%" valign="top">{if $line.user_name != ''}<a href="../user/user_detail.php?user_id_selected={$line.user_id}" class="MAINNAV">{$line.user_name}</a>{else}<i>n/a</i>{/if}</td>
			<td width="25%" valign="top">{if $line.join_date != ''}{$line.join_date}{else}<i>n/a</i>{/if}</td>
			<td width="25%" valign="top">{if $line.last_visit != ''}{$line.last_visit}{else}<i>n/a</i>{/if}</td>				
			<td width="10%" valign="top">{if $line.email != ''}<a href="mailto:{$line.email}"><img src="../templates/0/icons/icon_email.gif" alt="" width="59" height="18" border="0"></a>{else}<i>n/a</i>{/if}</td>
			<td width="15%" valign="top">{if $line.user_website != ''}<a href="http://{$line.user_website}"><img src="../templates/0/icons/icon_www.gif" alt="" width="59" height="18" border="0"></a>{else}<i>n/a</i>{/if}
			</td>
		</tr>
		{/foreach}
		</table>	
		<table cellspacing="0" cellpadding="2" border="0" width="90%" style="border-left: solid 1px #b2b2b2; border-left: solid 1px #b2b2b2; border-right: solid 1px #b2b2b2; border-bottom: solid 1px #b2b2b2;background-color:#E9E9E9;">
		<tr>
			<td valign="top" width="25%">Found <b>{if $nr_users != ''}{$nr_users}{else}0{/if}</b> users for this query</td>
		</tr>
		</table>
		<br>
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
<br>
<br>