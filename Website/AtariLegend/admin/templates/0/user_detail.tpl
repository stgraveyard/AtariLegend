{* 
***************************************************************************
*                                games_upload.tpl
*                            ------------------------
*   begin                : Tuesday, november 9, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : admin@atarilegend.com
*	 actual update        : Creation of file
*
*   Id: games_upload.tpl,v 0.10 2005/11/09 15:10 ST Gravedigger
*
***************************************************************************/

************************************************************************************************
The game upload page
************************************************************************************************
*}

{literal}
<script type="text/javascript">
function delete_user() 
{
	document.user.method="post";
	document.user.action="../user/user_detail.php?action=delete_user";
   	document.user.submit();
}

function reset_pwd() 
{
	document.user.method="post";
	document.user.action="../user/user_detail.php?action=reset_pwd";
   	document.user.submit();
}

function user_stats() 
{
	document.user.method="post";
	document.user.action="../user/user_statistics.php";
   	document.user.submit();
}
</script>
{/literal}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	&nbsp;Details for user <a href="mailto:{$users.user_email}" class="MAINNAV_WHITE">{$users.user_name}</a>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td colspan="2">
	<fieldset class="category_set">
		Overhere you can maintain the log on data of a user and have a look at his activities. Press 'modify' to change certain
		data. 'Delete' will completely remove the account. You are also able to reset the password of the user. After resetting, you are
		able to enter and save a new password for the account. Finally, press 'statistics' to see what this user has done at AL so far.
	</fieldset> 
	</td>
</tr>
</table>


<table width="100%" cellspacing="2" cellpadding="15" class="CELLCOLOR">
<tr>
	<td>
	<form action="../user/user_detail.php?action=modify_user" method="post" name="user">
	<fieldset class="game_set">
		<legend class="links_legend">User details</legend>
		<table width="100%">
		<tr>
			<td width="20%">
				<b>User name :</b>
			</td>
			<td width="30%">
				<input type="text" name="user_name"  maxlength="60" value="{$users.user_name}">
			</td>
			<td width="20%">
				<b>User pwd :</b>
			</td>
			{if $users.user_pwd ==! ''}
				<td width="30%">
					<input type="button" value="reset" onClick="reset_pwd();">
				</td>
			{else}
				<td width="30%">
					<input type="text" name="user_pwd"  maxlength="255">
				</td>
			{/if}
		</tr>
		<tr>
			<td width="20%">
				<b>User email :</b>
			</td>
			<td width="30%">
				<input type="text" name="user_email"  maxlength="255" value="{$users.user_email}">
			</td>
			<td width="20%">
				<b>User permission :</b>
			</td>
			<td width="30%">
				<input type="text" name="user_permission"  maxlength="60" value="{$users.user_permission}">
			</td>
		</tr>
		<tr>
			<td width="20%">
				<b>User website :</b>
			</td>
			<td width="30%">
				<input type="text" name="user_website"  maxlength="255" value="{$users.user_website}">
			</td>
			<td width="20%">
				<b>User ICQ :</b>
			</td>
			<td width="30%">
				<input type="text" name="user_icq"  maxlength="255" value="{$users.user_icq}">
			</td>
		</tr>
		<tr>
			<td width="20%">
				<b>User MSNM :</b>
			</td>
			<td width="30%">
				<input type="text" name="user_msnm"  maxlength="255" value="{$users.user_msnm}">
			</td>
			<td width="20%">
				<b>User AIM :</b>
			</td>
			<td width="30%">
				<input type="text" name="user_aim"  maxlength="255" value="{$users.user_aim}">
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<br>
				<br>
				<input type="hidden" name="user_id_selected" value="{$users.user_id}">
				<input type="submit" value="Modify">
				<input type="button" value="Delete" onClick="delete_user();">
				<input type="button" value="Statistics" onClick="user_stats();"">
			</td>
		</tr>	
		</table>
	</fieldset>
	</form>
	<br><br>
	<fieldset class="game_set">
		<legend class="links_legend">Avatar</legend>
	
	{if $users.avatar_ext !=''}
	
	<table width="100%">
	<tr>
	<td>
	
	<form action="../user/user_detail.php?action=delete_avatar" method="post" name="delete_avatar">
	<label for="delete_image">Delete Image?</label>
	<div class="links_screenshot">
	 <img src="../includes/showimage.php?img={$users.image}&amp;w={$users.width}&amp;shadow=0&amp;bgcolour=a2a2a2" width={$users.width} alt="Avatar">
	 </div>
	 <input type="hidden" name="user_id_selected" value="{$users.user_id}">
	 <input type="submit" value="Delete">
	</form>
	</td>
		
	</tr>
	</table>
	
	{else}
	<form enctype="multipart/form-data" action="../user/user_detail.php" method="post" name="avatar" id="avatar">
	<table width="100%">
	<tr>
	<td width="20%" align="left">
	<label for="image" style="cursor: help; margin:5px;" accesskey="1" title="Choose an image from your harddrive to attach to be associated with this user."><strong>Attach image</strong></label>
	</td>
	<td width="30%" align="left">
	<input type="hidden" name="MAX_FILE_SIZE" value="50000">
	<input type="file" name="image" class="links_file-box">
	</td>
	<td width="50%" align="left">
	<input type="hidden" name="user_id_selected" value="{$users.user_id}">
	<input type="hidden" name="action" value="avatar_upload">
	<input type="submit" name="Modify" value="Upload" class="submit-button">
	</td>
	</tr>
	</table>
	</form>
	</fieldset>
	{/if}
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