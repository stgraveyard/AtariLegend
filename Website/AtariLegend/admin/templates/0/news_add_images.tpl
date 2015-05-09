{* 
***************************************************************************
*                                news_images.php
*                            -----------------------
*   begin                : Sunday, May 1, 2005
*   copyright            : (C) 2003 Atari Legend
*   email                : maarten.martens@freebel.net
*   actual update        : File creation
*							 
*   Id: news_images.php,v 0.10 2004/05/01 ST Graveyard
*
***************************************************************************/
//****************************************************************************************
// This is the sub template file to generate the newsimages page
//**************************************************************************************** 
*}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	<span class="LEFTNAVHEADING">&nbsp;Add a News Image</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td>
		<a href="../news/news_add_images.php" class="MAINNAV"><b>Add images</b></a> / 
		<a href="../news/news_edit_images.php" class="MAINNAV"><b>Edit images</b></a>
	</td
</tr>
<tr>	
	<td>
	<fieldset class="category_set">
		Here you can add news images to go with a news update, add a name to describe the 
		image and to what kind of news it should be used. You can use either jpg, 
		png or gif images but png images are prefered. Keep the size to a minimun, we are talking icons here, no 300Kb images.
	</fieldset> 
	<br>
	<br>
	<br>
	<form  enctype="multipart/form-data" action="../news/news_add_images.php" method="post" name="imageadd" id="imageadd">
	<label for="name">Image Name</label>
	<input type="text" name="image_name" id="image_name" size='50' maxlength='64' class="links_input-box">
	<br>
	<label for="icon">Image File</label>
	<input type="file" name="news_image" id="news_image">
	<br>
	<br>
	<br>
	<br>
	<input type="hidden" name="action" id="action" value="image_upload">
	<input type="hidden" name="user_id" id="user_id" value="{$user_id}">
	<input type="submit" value="Submit">
	<input type="reset">
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