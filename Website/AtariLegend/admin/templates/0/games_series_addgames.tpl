		<form action="../games/games_series_main.php" method="post" name="game_search" id="game_search">
		<div align="left"><fieldset class="category_set_noGrave" style="margin-left: 2em">
		<legend class="links_legend" style="text-align: left; -moz-border-radius:10px;">Search games</legend>
		<table align="left">
		<tr>
			<td>
				<strong>By name :</strong>
			</td>
			<td>
				<select name="gamebrowse">
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
				<input type="text" name="gamesearch" value="">
				<input type="submit" value="Search">
			</td>
		</tr>

		</table>

		
		
		</fieldset></div>
		<input type="hidden" name="series_page" id="series_page" value="addgames_series">
		<input type="hidden" name="game_series_id" id="game_series_id" value="{$series_info.game_series_id}">
		</form>	

					
					<br>
					
					
					<form action="../games/db_games_series.php" method="post" name="add_to_series" id="add_to_series">	
				<table cellspacing="0" cellpadding="2" border="0" width="95%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
					<tr>
						<td valign="top" width="5%"><b>Info</b></td>
						<td valign="top" width="30%"><b>Game Name</b></td>
						<td valign="top" width="20%"><b>Publisher</b></td>
						<td valign="top" width="20%"><b>Developer</b></td>
						<td valign="top" width="15%"><b>Year</b></td>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="2" border="0" width="95%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
				{foreach from=$series_link item=line}
					<tr bgcolor="{cycle name="tr" values="#EFEFEF,#E9E9E9"}">
						<td width="5%" valign="top"><input type="checkbox" name="game_id[]" value="{$line.game_id}"></td>
						<td width="30%" valign="top">{if $line.game_name != ''}<a href="../administration/construction.php" class="MAINNAV">{$line.game_name}</a>{else}<i>n/a</i>{/if}</td>
						<td width="25%" valign="top">{if $line.publisher_name != ''}<a href="games_main.php?publisher={$line.publisher_id}&amp;action=search" class="MAINNAV">{$line.publisher_name}</a>{else}<i>n/a</i>{/if}</td>
						<td width="25%" valign="top">{if $line.developer_name != ''}<a href="games_main.php?developer={$line.developer_id}&amp;action=search" class="MAINNAV">{$line.developer_name}</a>{else}<i>n/a</i>{/if}</td>				
						<td width="15%" valign="top">{if $line.year != ''}<a href="games_main.php?year={$line.year}&amp;action=search" class="MAINNAV">{$line.year}</a>{else}<i>n/a</i>{/if}</td>
					</tr>
				{/foreach}
					
				<input type="hidden" name="series_page" value="series_editor">
				<input type="hidden" name="action" value="add_to_series">
				<input type="hidden" name="game_series_id" value="{$series_info.game_series_id}">
					<tr style="border-top: solid 2px #b2b2b2; background-color:#ffffff;">
						<td colspan="5" style="border-top: solid 2px #b2b2b2; background-color:#ffffff;">
						<img src="../templates/0/images/arrow_ltr.gif" alt="" width="38" height="22" border="0"><input type="submit" value="Add to series"></td>
					</tr>

				</table>
				</form>