<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="HEADERBAR">
<tr>    
	<td height="5" style="vertical-align:top;">
	<span class="LEFTNAVHEADING">&nbsp;&nbsp;Did you know?</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td>
	
		
		 Here you can add a new trivia by using the below text field or you can delete one of the old trivias.<br>
		<br>
		
		
		<br>
		
		<fieldset class="category_set_noGrave">
	<legend class="links_legend">Add new Trivia</legend>
	
	

	<form action="../trivia/db_trivia.php" method="post" name="trivia" id="trivia">
	
	<label for="website_description_text">Trivia Text</label>	
		<textarea name="trivia_text" id="trivia_text" class="textarea_links"></textarea>
	
	<input type="hidden" name="action" value="did_you_know_insert">
	<input type="submit" value="Submit" style="margin-left: 80%;">
	</form>
	

</fieldset> 
		
		<br>
		
		
		{foreach from=$trivia item=line}
		
<fieldset class="category_set_noGrave">
	<legend class="links_legend">Trivia ID {$line.trivia_id}</legend>
	
	<br>
	{$line.trivia_text}<br>
	<br>
	<form action="../trivia/db_trivia.php" method="post" name="trivia{$line.trivia_id}" id="trivia{$line.trivia_id}">
	<input type="hidden" name="action" value="did_you_know_delete">
	<input type="hidden" name="trivia_id" value="{$line.trivia_id}">
	<input type="submit" value="Delete" style="margin-left: 80%;">
	</form>
</fieldset> 


<br>

		{/foreach}

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