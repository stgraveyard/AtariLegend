{* 
/***************************************************************************
*                                Individuals_edit.tpl
*                            --------------------------
*   begin                : Saturday, August 6, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : Creation of file
*   Id: Individuals_edit.tpl,v 0.10 2005/08/06 15:25 Gatekeeper
*
***************************************************************************/

/*
************************************************************************************************
The individuals edit page
************************************************************************************************
*}

{literal}
<script type="text/javascript">
function individual_pic_delete(ind_id)
{ 
    // CONFIRM REQUIRES ONE ARGUMENT
    var message = "Are you sure you want to delete this picture from the database?";
    // CONFIRM IS BOOLEAN. THAT MEANS THAT
    // IT RETURNS TRUE IF 'OK' IS CLICKED
    // OTHERWISE IT RETURN FALSE
    var return_value = confirm(message);

    if (return_value !="0")
    {
    	url="individuals_edit.php?ind_id="+ind_id+"&action=delete_pic";
		location.href=url;
    } 
}
</script>

<script type="text/javascript">
function individualdelete(ind_id)
{ 
   	// CONFIRM REQUIRES ONE ARGUMENT
   	var message = "Are you sure you want to delete this individual from the database?";
   	// CONFIRM IS BOOLEAN. THAT MEANS THAT
   	// IT RETURNS TRUE IF 'OK' IS CLICKED
   	// OTHERWISE IT RETURN FALSE
   	var return_value = confirm(message);

   	if (return_value !="0")
   	{
   		url="individuals_main.php?ind_id="+ind_id+"&action=delete_ind";
		location.href=url;
   	} 	
}
</script>

<script type="text/javascript">
function nickdelete(nick_id,ind_id)
{ 
   	// CONFIRM REQUIRES ONE ARGUMENT
   	var message = "Are you sure you want to delete this nickname from the database?";
   	// CONFIRM IS BOOLEAN. THAT MEANS THAT
   	// IT RETURNS TRUE IF 'OK' IS CLICKED
   	// OTHERWISE IT RETURN FALSE
   	var return_value = confirm(message);

   	if (return_value !="0")
   	{
   		url="individuals_edit.php?nick_id="+nick_id+"&ind_id="+ind_id+"&action=delete_nick";
		location.href=url;
   	} 	
}
</script>

{/literal}

{* load the button javascripts *}
{include file="../templates/0/js/game_comment.js"}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	<span class="LEFTNAVHEADING">&nbsp;Edit {$individuals.ind_name}</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td colspan="2">
	<fieldset class="category_set">
		In this section you can edit an individual. You can use the profile box for additional info on the person.
		A photo can be uploaded as well. If a picture is already linked, you can delete it and upload a new one.
	</fieldset> 
	</td>
</tr>
<tr>
	<td>
	<form action="../individuals/individuals_edit.php" method="post" name="post" id="ind_edit">
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%" colspan="2">
				<b>Name :</b>
				<br>
				<input type="text" name="ind_name" value="{$individuals.ind_name}">
			</td>
		</tr>
		<tr>
			<td width="100%" colspan="2">
				<br>
				<b>Email :</b>
				<br>
				<input type="text" name="ind_email" value="{$individuals.ind_email}">
			</td>
		</tr>
		<tr>
			<td width="100%" colspan="2">
				<br>
				<b>Profile :</b>
			</td>
		</tr>
		<tr>
			<td width="100%" align="left" colspan="2">
			<br>
			<input type="button" accesskey= "b" name="addbbcode0" value="B" onclick="bbstyle(0,'textfield')" onMouseOver="helpline('b')" />
			<input type="button" accesskey= "u" name="addbbcode4" value="U" onclick="bbstyle(4,'textfield')" onMouseOver="helpline('u')" />
			<input type="button" accesskey= "i" name="addbbcode2" value="I" onclick="bbstyle(2,'textfield')" onMouseOver="helpline('i')" />
			<input type="button" accesskey="w" name="addbbcode6" value="URL" onClick="bbstyle(6,'textfield')" onMouseOver="helpline('h')" />			  
			<input type="button" accesskey="x" name="addbbcode8" value="@" onClick="bbstyle(8,'textfield')" onMouseOver="helpline('e')" />			  			
			&nbsp;
			&nbsp;
			<a href="javascript:setsmileyn(' :-D ')"><img src="../templates/0/emoticons/icon_biggrin.gif" alt="Very Happy" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :) ')"><img src="../templates/0/emoticons/icon_smile.gif" alt="Smile" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :( ')"><img src="../templates/0/emoticons/icon_sad.gif" alt="sad" border="0" onMouseOver="helpline('x')"></a> 
			<a href="javascript:setsmileyn(' 8O ')"><img src="../templates/0/emoticons/icon_eek.gif" alt="shocked" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :? ')"><img src="../templates/0/emoticons/icon_confused.gif" alt="confused" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' 8)')"><img src="../templates/0/emoticons/icon_cool.gif" alt="Cool" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :x ')"><img src="../templates/0/emoticons/icon_mad.gif" alt="Mad" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :P ')"><img src="../templates/0/emoticons/icon_razz.gif" alt="Razz" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :oops: ')"><img src="../templates/0/emoticons/icon_redface.gif" alt="Embarassed" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :evil: ')"><img src="../templates/0/emoticons/icon_evil.gif" alt="Evil or Very mad" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :twisted: ')"><img src="../templates/0/emoticons/icon_twisted.gif" alt="Twisted Evil" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :roll: ')"><img src="../templates/0/emoticons/icon_rolleyes.gif" alt="Rolling eyes" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :frown: ')"><img src="../templates/0/emoticons/icon_frown.gif" alt="Frowning" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :| ')"><img src="../templates/0/emoticons/icon_neutral.gif" alt="Neutral" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :mrgreen: ')"><img src="../templates/0/emoticons/icon_mrgreen.gif" alt="Mr. Green" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :o ')"><img src="../templates/0/emoticons/icon_surprised.gif" alt="Surprised" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :lol: ')"><img src="../templates/0/emoticons/icon_lol.gif" alt="Laughing" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :cry: ')"><img src="../templates/0/emoticons/icon_cry.gif" alt="Crying or Very sad" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :wink: ')"><img src="../templates/0/emoticons/icon_wink.gif" alt="Wink" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :!: ')"><img src="../templates/0/emoticons/icon_exclaim.gif" alt="Exclamation" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :arrow: ')"><img src="../templates/0/emoticons/icon_arrow.gif" alt="smilie" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :?: ')"><img src="../templates/0/emoticons/icon_question.gif" alt="Question" border="0" onMouseOver="helpline('x')"></a>
			<a href="javascript:setsmileyn(' :idea: ')"><img src="../templates/0/emoticons/icon_idea.gif" alt="Idea" border="0" onMouseOver="helpline('x')"></a>
			</td>
		</tr>
		<tr>
			<td width="100%" colspan="2">
				<textarea name="textfield" ONSELECT="javascript:storeCaret(this);" ONCLICK="javascript:storeCaret(this);" ONKEYUP="javascript:storeCaret(this);" ONCHANGE="javascript:storeCaret(this);" rows="5" class="textarea_interviews">{$individuals.ind_profile}</textarea>
			</td>
		</tr>
		<tr>
			<td width="50%">
				<br>
				<input type="submit" value="Update">
				<input type="submit" value="Delete Individual" onClick="individualdelete({$individuals.ind_id}); return false;">	
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="ind_id" value="{$individuals.ind_id}">
			</td>
			<td align="right" width="50%">
				<br>
				&nbsp;<input type="text" size="60" name="helpbox" maxlength="100" style="font-size:10px; border=0px; background-color:#D0D1DF" value="Tip: Styles can be applied quickly to selected text.">
			</td>
		</tr>
		</form>	
		<tr>
			<td width="100%">
				<br>
				<br>
				<br>
				{if $individuals.ind_image !== 'none'}
					<fieldset class="links_set">
					<legend class="links_legend">Individual Image</legend>
						<img src="../includes/showimage.php?img={$individuals.ind_image}&amp;w=60&amp;shadow=1&amp;bgcolour=FFFFFF;">
						<a href="javascript:individual_pic_delete({$individuals.ind_id});" class="MAINNAV">delete photo</a>
					</fieldset>
				{else}
					<form action="../individuals/individuals_edit.php" method="post" enctype="multipart/form-data" name="individual_pic" id="individual_pic">
					<fieldset class="links_set">
					<legend class="links_legend">Individual Image</legend>
						<input type="file" name="individual_pic">
						<br>
						<br>
						<input type="submit" name="inserter" value="Upload">
					</fieldset>
					<input type="hidden" name="action" value="add_photo">
					<input type="hidden" name="ind_id" value="{$individuals.ind_id}">
					</form>
				{/if}
			</td>
			<td width="50%">
				<br>
				<br>
				<br>
			<fieldset class="links_set">
					<legend class="links_legend">Individuals nick (AKAs)</legend>
			<form action="../individuals/individuals_edit.php" method="post" name="ind" id="NickAdd">		
			<input type="text" name="ind_nick" value=""><br>		
			<input type="submit" value="Add Nick">
			<input type="hidden" name="action" value="add_nick">
			<input type="hidden" name="ind_id" value="{$individuals.ind_id}">		
			</form>
			<br>
			<b>Known Nicks</b><br><br>
			{foreach from=$nicks item=line}
			{$line.nick_name} - <a style="cursor:pointer" class="MAINNAV" onClick="nickdelete({$line.nick_id},{$individuals.ind_id}); return false;">Delete</a><br>
			{/foreach}
			</fieldset>
			</td>
			
		</tr>
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
			<b><a href="../individuals/individuals_main.php" class="MAINNAV">back</a></b>
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