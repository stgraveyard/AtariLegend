<script language="JavaScript">



function commentdelete(JScomID,JSusers_id)
{literal}{ {/literal}  
	
	JSview = "{$links.view}";
	JSv_count = {$links.v_counter};
	
	{if $links.c_counter !=''}JSc_count = {$links.c_counter}{/if}
	
	
    	// CONFIRM REQUIRES ONE ARGUMENT
    	var message = "Are you sure you want to delete this comment?";
    	// CONFIRM IS BOOLEAN. THAT MEANS THAT
    	// IT RETURNS TRUE IF 'OK' IS CLICKED
    	// OTHERWISE IT RETURN FALSE
    	var return_value = confirm(message);

    	if (return_value !="0")
    	{literal}{ {/literal} 
    		url="../demos/db_demos_comment.php?action=delete_comment&comment_id="+JScomID+"&v_counter="+JSv_count+"&view="+JSview+"users_id"+JSusers_id+{if $links.c_counter !=''}"&c_counter="+JSc_count+{/if}""
			location.href=url;
    	{literal}}  {/literal} 

{literal}} {/literal} 
</script>
<a name="top"></a>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="HEADERBAR">
<tr>    
	<td height="5" style="vertical-align:top;">
	<span class="LEFTNAVHEADING">&nbsp;&nbsp;Demo Comments</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" class="CELLCOLOR">
<tr>
	<td align="center">
	<fieldset class="category_set">
		<table>
		<tr>
			<td width="100%" valign="top">
				This is the user comment edit page. Overhere you can edit or delete user comments for demos. 
				There is currently a total of <b>{$total_nr_comments}</b> comments in the AL DB!
			</td>
		</tr>
		</table>
	</fieldset> 
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td align="center">
		{if $links.view eq "users_comments"}<a href="../demos/demos_comment.php?v_counter={$links.c_counter}" class="MAINNAV">Sort by latest comments</a><br>{/if}
		<br>
		
		
		{foreach from=$comments item=line}
				<table cellspacing="0" cellpadding="2" border="0" width="95%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
				<tr>
						<td class="main_text" valign="top" width="150" style="border-right: solid 1px #b2b2b2;"><b>Posted by {$line.user_name}</b></td>
						<td class="main_text" valign="top" ><b><a href="../demos/demos_detail.php?demo_id={$line.demo_id}" class="links_links">{$line.demo}</a></b> </td>
						<td class="main_text" valign="top" align="right"><b>{$line.date}</b></td>			
				</tr>
				</table>
				<table cellspacing="0" cellpadding="0" border="0" width="95%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
				<tr bgcolor="#EFEFEF">
					<td class="main_text" width="150" valign="top" style="line-height: 13px; border-right: solid 1px #b2b2b2;">
					<br>
					Joined: {$line.user_joindate}<br>
					<a href="../demos/demos_comment.php?c_counter={$links.v_counter}&users_id={$line.users_id}&view=users_comments" class="MAINNAV">Demo Comments: {$line.user_comment_nr}</a><br>
					Demo Submissions: {$line.usersubmit_number}
					
					</td>
					<td class="main_text" valign="top" style="line-height: 13px;">
						<br>
						<br>
						{if $line.image != "../../../images/demo_screenshots/."}<span style="float:right;"><a href="../demos/demos_detail.php?demo_id={$line.demo_id}"><img src="../includes/showimage.php?img={$line.image}&w=120&shadow=1&bgcolour=EFEFEF" alt="{$line.demo_name}" border="0"></a></span>{/if}
						{$line.comment}
						<br>
						<br>
						<br>		
					</td>
				</tr>
				</table>	
				<table cellspacing="0" cellpadding="2" border="0" width="95%" style="border-left: solid 1px #b2b2b2; border-right: solid 1px #b2b2b2; border-bottom: solid 1px #b2b2b2;background-color:#E9E9E9;">
				<tr>
					<td width="150" valign="middle" class="main_text" style="line-height: 13px; border-right: solid 1px #b2b2b2;">
					
					<strong><a href="#top" class="MAINNAV">Back to top</a></strong>
					
					</td>
				
					<td valign="top" class="main_text">
						{if $line.email != ''}
							<a href="mailto:{$line.email}?subject=Comment of {$line.demo} at Atari Legend">
							<img src="../templates/0/icons/icon_email.gif" alt="Email User" title="Email User" width="59" height="18" border="0">
							</a>{/if}
							<a href="../demos/demos_comment_edit.php?demo_user_comments_id={$line.demo_user_comments_id}{$links.users_comments}&v_counter={$links.v_counter}">
							<img src="../templates/0/icons/icon_edit.gif" alt="Edit Comment" title="Edit Comment" width="59" height="18" border="0">
							</a>
							<a  onClick="commentdelete({$line.comment_id},{$line.users_id})" style="cursor: pointer;">
							<img src="../templates/0/icons/icon_delete.gif" alt="Delete Comment" title="Delete Comment" width="16" height="18" border="0">
							</a>					
					</td>
					<td valign="middle" class="main_text" style="text-align: right;">
					
					</td>		
				</tr>
				</table>
				<br>
				{/foreach}

				
				<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width="50%" align=center>
			{if $links.linkback != ''}
			<a href="../demos/demos_comment.php{$links.linkback}" class="MAINNAV">Previous page</a>
			{/if}
		</td>
		<td width="50%" align=center>
			{if $links.linknext != ''}
			<a href="../demos/demos_comment.php{$links.linknext}" class="MAINNAV">Next page</a>
			{/if}
		</td>
	</tr>
	</table>
				
				
	</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="HEADERBAR">
<tr>
	<td>
	<span class="LEFTNAVHEADING">&nbsp;&nbsp;&nbsp;</span>
 	</td>
</tr>
</table>