<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="HEADERBAR">
<tr>    
	<td height="5" style="vertical-align:top;">
	<span class="LEFTNAVHEADING">&nbsp;&nbsp;Set Review Score</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td>
	
		
		<br>
		{$game.magazine_name} issue {$game.magazine_issue_nr} Selected. <br><br>
		
<fieldset class="category_set_noGrave">
	<legend class="links_legend">Set review score.</legend>
	<br>
	{* Marty! Hi mate! here you need to add the search variables. Take care /Matt *}
	<form action="../magazine/db_magazine.php?source=gameinfo&game_id={$game.game_id}" method="post" name="set_score" id="set_score">
			
	<label for="name">{$game.game_name} Overall score</label>
	<input type="text" name="score" id="score" size="10" maxlength="10" class="links_input-box">
	<input type="hidden" name="magazine_issue_id" value="{$game.magazine_issue_id}">
	<input type="hidden" name="action" value="set_score">	
	<input type="submit" value="Add">
	</form>
	
</fieldset>
		
		
<br>

<a href="../magazine/magazine_review_score.php?game_id={$game.game_id}" class="MAINNAV">Back</a>

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