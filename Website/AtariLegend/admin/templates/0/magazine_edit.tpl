<script language="JavaScript">
function issueinsert()
{literal} { {/literal} 
    JSnewissue=document.forms["insertissue"].newissue.value;
	
	JSmagid=document.forms["insertissue"].magazine_id.value;
	
	if (JSnewissue=='')
	{literal}{ {/literal} 
		alert('Please fill in an issue number');
	{literal}} {/literal} 
	else
	{literal}{ {/literal} 
    	// CONFIRM REQUIRES ONE ARGUMENT
    	var message = "Are you sure you want to insert this issue into the database?";
    	// CONFIRM IS BOOLEAN. THAT MEANS THAT
    	// IT RETURNS TRUE IF 'OK' IS CLICKED
    	// OTHERWISE IT RETURN FALSE
    	var return_value = confirm(message);

    	if (return_value !="0")
    	{literal}{ {/literal} 
    		url="../magazine/db_magazine.php?action=add_issue&newissue="+JSnewissue+"&magazine_id="+JSmagid+"&choice=insert_issue"
			location.href=url;
    	{literal}}  {/literal} 
	{literal}} {/literal} 
{literal}} {/literal} 

function issuedelete(JSmagID,JSmagazine_issue_id)
{literal}{ {/literal}  
	
    	// CONFIRM REQUIRES ONE ARGUMENT
    	var message = "Deleting an issue means that scans and review information will be lost! Are you sure you want to delete this Issue?";
    	// CONFIRM IS BOOLEAN. THAT MEANS THAT
    	// IT RETURNS TRUE IF 'OK' IS CLICKED
    	// OTHERWISE IT RETURN FALSE
    	var return_value = confirm(message);

    	if (return_value !="0")
    	{literal}{ {/literal} 
    		url="../magazine/db_magazine.php?action=delete_issue&magazine_id="+JSmagID+"&magazine_issue_id="+JSmagazine_issue_id+""
			location.href=url;
    	{literal}}  {/literal} 

{literal}} {/literal} 

</script>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="HEADERBAR">
<tr>    
	<td height="5" style="vertical-align:top;">
	<span class="LEFTNAVHEADING">&nbsp;&nbsp;Magazines Issues</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td>
	
		
		  {$magazine.magazine_name} selected.<br>
		<br>
		
		
		<br>
		
		
<fieldset class="category_set_noGrave">
	<legend class="links_legend">{$magazine.magazine_name} issues in archive</legend>
	
	<br>
	{foreach from=$issues item=line}
	
	<a href="../magazine/magazine_issue_edit.php?magazine_issue_id={$line.magazine_issue_id}" class="MAINNAV">Issue {$line.magazine_issue_nr}</a> | 
	{$line.scan} 
	 | <a href="../magazine/magazine_review_list.php?magazine_issue_id={$line.magazine_issue_id}" class="MAINNAV">List reviews</a> 
	| <a onClick="issuedelete({$magazine.magazine_id},{$line.magazine_issue_id})" style="cursor: pointer;" class="MAINNAV">Delete Issue</a><br>
	
	{/foreach}
	<br>
	
	
</fieldset> 

<br>
<fieldset class="category_set_noGrave">
	<legend class="links_legend">Add a new issue to the database</legend>
	<br>
	<form action="" method="post" name="insertissue" id="insertissue">

	<label for="name">Issue Number</label>
	<input type="text" name="newissue" id="newissue" size="50" maxlength="50" class="links_input-box">
	<br>
	<input type="hidden" name="magazine_id" value="{$magazine.magazine_id}">
	<input type="submit" name="inserter" value="Insert" onClick="issueinsert(); return false;">		
	</form>
</fieldset>

<br>
<a href="../magazine/magazine_manage.php" class="MAINNAV">Back</a>

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