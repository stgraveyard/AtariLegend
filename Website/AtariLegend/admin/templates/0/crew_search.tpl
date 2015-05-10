{* 
/***************************************************************************
                              crew_search.tpl
*                            --------------------------
*   begin                : Sunday, August 28, 2005
*   copyright            : (C) 2005 Atari Legend
*   email                : admin@atarilegend.com
*
*   Id: crew_search.tpl,v 0.10 2005/10/29 Silver
*
***************************************************************************/

************************************************************************************************
The main game page
************************************************************************************************
*}

{literal}
<script type="text/javascript">
function crewinsert()
{
    JSnewcrew=document.forms["insertcrew"].newcrew.value;
	
	if (JSnewcrew=='')
	{
		alert('Please fill in a crew name');
	}
	else
	{
    	// CONFIRM REQUIRES ONE ARGUMENT
    	var message = "Are you sure you want to insert this crew into the database?";
    	// CONFIRM IS BOOLEAN. THAT MEANS THAT
    	// IT RETURNS TRUE IF 'OK' IS CLICKED
    	// OTHERWISE IT RETURN FALSE
    	var return_value = confirm(message);
		
    	if (return_value !="0")
    	{
    		url="db_crew.php?new_crew="+JSnewcrew+"&action=insert_crew";
			location.href=url;
    	} 
	}
}
{/literal}

{if $crew_action.action eq 'main'}

{literal} 
function CrewDelete(crew_select) 
{ 
            // CONFIRM REQUIRES ONE ARGUMENT 
         var message = "Are you sure you want to delete this crew????"; 
         // CONFIRM IS BOOLEAN. THAT MEANS THAT 
         // IT RETURNS TRUE IF 'OK' IS CLICKED 
         // OTHERWISE IT RETURN FALSE 
         var return_value = confirm(message); 
 
         if (return_value !="0") 
         { 
              url="db_crew.php?crew_select="+crew_select+"&action=delete_crew"; 
               location.href=url; 
         }  
} 
{/literal}

{/if}
</script>

{* load the button javascripts *}
{if (isset($crew_action.action) and $crew_action.action eq 'main')}
{include file="../0/js/game_comment.js"}
{/if}

{if (isset($crew_action.action) and $crew_action.action eq 'genealogy')}














<META content=history name=save>
<STYLE>.saveHistory {literal}{{/literal}
	BEHAVIOR: url(#default#savehistory)
{literal}}{/literal}
</STYLE>
<!-- you need this stuff above-->

<SCRIPT language=JavaScript>
<!--
v=false;
//-->
</SCRIPT>

<SCRIPT language=JavaScript1.1>
<!--
if (typeof(Option)+"" != "undefined") v=true;
//-->
</SCRIPT>

<SCRIPT language=JavaScript>
<!--
{literal}
if(v){a=new Array(22);}

function getFormNum (formName) {
	var formNum =-1;
	for (i=0;i<document.forms.length;i++){
		tempForm = document.forms[i];
		if (formName == tempForm) {
			formNum = i;
			break;
		}
	}
	return formNum;
}

function jmp(form, elt)
// The first parameter is a reference to the form.
{
	if (form != null) {
		with (form.elements[elt]) {
			if (0 <= selectedIndex)
				location = options[selectedIndex].value;
		}
	}
}

var catsIndex = -1;
var itemsIndex;

if (v) { // ns 2 fix
function newCat(){
	catsIndex++;
	a[catsIndex] = new Array();
	itemsIndex = 0;
}

function O(txt,url) {
	a[catsIndex][itemsIndex]=new myOptions(txt,url);
	itemsIndex++;
}

function myOptions(text,value){
	this.text = text;
	this.value = value;
}
{/literal}
{$ind_array.names}
{literal} } // if (v)



function relate(formName,elementNum,j) {
    if(v){
        var formNum = getFormNum(formName);
         if (formNum>=0) {
        	formNum++; // reference next form, assume it follows in HTML
        	with (document.forms[formNum].elements[elementNum]) {
        		for(i=options.length-1;i>0;i--) options[i] = null; // null out in reverse order (bug workarnd)
        		for(i=0;i<a[j].length;i++){
        			options[i] = new Option(a[j][i].text,a[j][i].value);
        		}
        		options[0].selected = true;
        	}
        }
    }
    else {
        jmp(formName,elementNum);
    }
}

// BACK BUTTON FIX for ie4+- or
// MEMORY-CACHE-STORING-ONLY-INDEX-AND-NOT-CONTENT
//
// from peter belesis:
// IE4+ remembers the index of each SELECT but NOT the CONTENTS of each
// SELECT, so it gets it wrong.
//
// it has to do with MEMORY CACHE (where form input is stored) and how
// IE stores information about SELECT menus.
//
// IE stores the selectedINDEX ONLY of the SELECT menu, not the
// CONTENTS-AT-THE-TIME-OF-SELECTION
//
// when we return to a page, it displays the default contents of each
// SELECT, grabs the stored index from cache and aligns the default
// contents to that index.
// 
// Netscape, on the other hand, seems to remember both INDEX and CONTENTS
// added ie5 persistence 990714

function IEsetup(){
	if(!document.all) return;
	IE5 = navigator.appVersion.indexOf("5.")!=-1;
	if(!IE5) {
		for (i=0;i<document.forms.length;i++) {
			document.forms[i].reset();
		}
	}
}
{/literal}
window.onload = IEsetup;

//-->
</SCRIPT>















{/if}

<table align="center" class="HEADERBAR" width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<td style="vertical-align:top;" height="5" colspan=6>
	<span class="LEFTNAVHEADING">&nbsp;Crew editor</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="5" align="center" class="CELLCOLOR">
<tr>
	<td align="center" width="50%">
		<form action="../crew/crew_search.php" method="post" name="crew_search" id="crew_search">
		<fieldset class="interview_set">
		<legend class="links_legend">Search crews</legend>
		<table>
		<tr>
			<td>
				<b>By name :</b>
			</td>
			<td>
				<select name="crewbrowse">
					<option value=""{if $tracking.crewbrowse eq ''} SELECTED{/if}>-</option>
					<option value="num"{if $tracking.crewbrowse eq 'num'} SELECTED{/if}>0-9</option>
					<option value="a"{if $tracking.crewbrowse eq 'a'} SELECTED{/if}>A</option>
					<option value="b"{if $tracking.crewbrowse eq 'b'} SELECTED{/if}>B</option>
					<option value="c"{if $tracking.crewbrowse eq 'c'} SELECTED{/if}>C</option>
					<option value="d"{if $tracking.crewbrowse eq 'd'} SELECTED{/if}>D</option>
					<option value="e"{if $tracking.crewbrowse eq 'e'} SELECTED{/if}>E</option>
					<option value="f"{if $tracking.crewbrowse eq 'f'} SELECTED{/if}>F</option>
					<option value="g"{if $tracking.crewbrowse eq 'g'} SELECTED{/if}>G</option>
					<option value="h"{if $tracking.crewbrowse eq 'h'} SELECTED{/if}>H</option>
					<option value="i"{if $tracking.crewbrowse eq 'i'} SELECTED{/if}>I</option>
					<option value="j"{if $tracking.crewbrowse eq 'j'} SELECTED{/if}>J</option>
					<option value="k"{if $tracking.crewbrowse eq 'k'} SELECTED{/if}>K</option>
					<option value="l"{if $tracking.crewbrowse eq 'l'} SELECTED{/if}>L</option>
					<option value="m"{if $tracking.crewbrowse eq 'm'} SELECTED{/if}>M</option>
					<option value="n"{if $tracking.crewbrowse eq 'n'} SELECTED{/if}>N</option>
					<option value="o"{if $tracking.crewbrowse eq 'o'} SELECTED{/if}>O</option>
					<option value="p"{if $tracking.crewbrowse eq 'p'} SELECTED{/if}>P</option>
					<option value="q"{if $tracking.crewbrowse eq 'q'} SELECTED{/if}>Q</option>
					<option value="r"{if $tracking.crewbrowse eq 'r'} SELECTED{/if}>R</option>
					<option value="s"{if $tracking.crewbrowse eq 's'} SELECTED{/if}>S</option>
					<option value="t"{if $tracking.crewbrowse eq 't'} SELECTED{/if}>T</option>
					<option value="u"{if $tracking.crewbrowse eq 'u'} SELECTED{/if}>U</option>
					<option value="v"{if $tracking.crewbrowse eq 'v'} SELECTED{/if}>V</option>
					<option value="w"{if $tracking.crewbrowse eq 'w'} SELECTED{/if}>W</option>
					<option value="x"{if $tracking.crewbrowse eq 'x'} SELECTED{/if}>X</option>
					<option value="y"{if $tracking.crewbrowse eq 'y'} SELECTED{/if}>Y</option>
					<option value="z"{if $tracking.crewbrowse eq 'z'} SELECTED{/if}>Z</option>
				</select>
				<input type="text" name="crewsearch" value="{if (isset($new_crew) and $new_crew <> '')}{$new_crew}{/if}" style="width:70px;">
			</td>
			<td>
			<input type="submit" value="Search">
			</td>
		</tr>
			
		</table>
		
		
		
		
		
		
		</fieldset>
		<input type="hidden" name="action" id="action" value="search">
		</form>	
	
	</td>
	<td align="center" width="50%">
	{if (isset($new_crew) and $new_crew <> '')}<span class="MAINNAV" style="text-align:center;">{$new_crew} added to the database!<br></span>{/if}
		<form method="post" name="insertcrew">
		<fieldset class="interview_set">
		<legend class="links_legend">Add Crew</legend>
			<input type="text" name="newcrew">
			<input type="submit" value="Insert" onClick="crewinsert(); return false;">	
		</fieldset>
		</form>
		<br>
	</td>
</tr>
<tr>
	<td colspan="2">
	
	<table>
	<tr>
	<td width="12%" style="vertical-align:top;">
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
		<tr>
    		<td style="text-align: left;" class="HEADERBAR">
				<span class="LEFTNAVHEADING">&nbsp;Search Results</span>
    		</td>
		</tr>
	</table>
	<span class="LEFTNAV">
	{* SEARCH RESULTS - UNDERLINE IF SELECTED *}
	{foreach from=$crew item=line}
			
			{if (isset($crew_select.crew_id) and $crew_select.crew_id eq $line.crew_id)}
			<a href="../crew/crew_search.php?crew_select={if isset($line.crew_id)}{$line.crew_id}{/if}&crewsearch={$tracking.crewsearch}&crewbrowse={$tracking.crewbrowse}" class="LEFTNAV" style="text-decoration:underline;">{$line.crew_name}</a><br>
			{else}
			<a href="../crew/crew_search.php?crew_select={if isset($line.crew_id)}{$line.crew_id}{/if}&crewsearch={$tracking.crewsearch}&crewbrowse={$tracking.crewbrowse}" class="LEFTNAV">{$line.crew_name}</a><br>
			{/if}
	{/foreach}	
	
	
	</span>
	</td>
	
	
	
	
	<td width="88%" style="margin-left: auto; margin-right: auto;width:75%">
	
	{* Start crew editing table	*}
	
	{if (isset($crew_select.crew_id) and $crew_select.crew_id <> '')}
	<table width="100%" cellspacing="2" cellpadding="0" border="0" style="margin-left: auto; margin-right: auto;">
		<tr>
			<td style="width:25%;" align="center">
				<form action="../crew/crew_search.php" method="post" name="main_edit" id="main_edit">
		
					<input type="submit" value="Main edit">
					<input type="hidden" name="action" id="action1" value="main">
					<input type="hidden" name="crew_select" id="crew_select1" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
					<input type="hidden" name="crewsearch" id="crewsearch1" value="{$tracking.crewsearch}">
					<input type="hidden" name="crewbrowse" id="crewbrowse1" value="{$tracking.crewbrowse}">
				</form>	
			</td>
			<td style="width:25%;" align="center">
				<form action="../crew/crew_search.php" method="get" name="Genealogy" id="Genealogy">
		
					<input type="submit" value="Genealogy">
					<input type="hidden" name="action" id="action2" value="genealogy">
					<input type="hidden" name="crew_select" id="crew_select2" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
					<input type="hidden" name="crewsearch" id="crewsearch2" value="{$tracking.crewsearch}">
					<input type="hidden" name="crewbrowse" id="crewbrowse2" value="{$tracking.crewbrowse}">
				</form>
			</td>
			<td style="width:25%;" align="center">
				<form action="" method="post" name="Statistics" id="Statistics">
		
					<input type="submit" value="Statistics">
					<input type="hidden" name="action" id="action3" value="statistics">
					<input type="hidden" name="crew_select" id="crew_select3" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
					<input type="hidden" name="crewsearch" id="crewsearch3" value="{$tracking.crewsearch}">
					<input type="hidden" name="crewbrowse" id="crewbrowse3" value="{$tracking.crewbrowse}">
				</form>
			</td>
			<td style="width:25%;" align="center">
				<form action="" method="post" name="Comments_Submissions" id="Comments_Submissions">
		
					<input type="submit" value="Comments/Submissions">
					<input type="hidden" name="action" id="action4" value="comments">
					<input type="hidden" name="crew_select" id="crew_select4" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
					<input type="hidden" name="crewsearch" id="crewsearch4" value="{$tracking.crewsearch}">
					<input type="hidden" name="crewbrowse" id="crewbrowse4" value="{$tracking.crewbrowse}">
				</form>
			</td>
		</tr>
		<tr>
			<td colspan="4">
			{if (isset($crew_action.action) and $crew_action.action eq 'main')}
			{* START THE CREW MAIN EDIT *}
			
			<table width="100%" cellspacing="2" cellpadding="15" align="center">
<tr>
	<td colspan="2">
	<fieldset class="category_set_noGrave" style="margin-left: 5%;margin-right: 5%; width:90%;">
		In this section you can edit different aspects of the crew.
	</fieldset> 
	</td>
</tr>
<tr>
	<td>
	<form action="../crew/db_crew.php" method="post" name="crew_edit" id="crew_edit">
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%" colspan="2">
				<b>Name :</b>
				<br>
				<input type="text" name="crew_name" value="{if isset($crew_select.crew_name)}{$crew_select.crew_name}{/if}">
			</td>
		</tr>
		<tr>
			<td width="100%" colspan="2">
				<br>
				<b>History :</b>
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
				<textarea name="textfield" ONSELECT="javascript:storeCaret(this);" ONCLICK="javascript:storeCaret(this);" ONKEYUP="javascript:storeCaret(this);" ONCHANGE="javascript:storeCaret(this);" rows="8" class="textarea_interviews">{$crew_select.crew_history}</textarea>
			</td>
		</tr>
		<tr>
			<td width="50%">
				<br>
				<input type="submit" value="Update">
				<input type="button" value="Delete Crew" onClick="CrewDelete({if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}); return false;">	
				<input type="hidden" name="action" value="update_main_info">
				<input type="hidden" name="crew_select" id="crew_select5" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
				<input type="hidden" name="crewsearch" id="crewsearch5" value="{$tracking.crewsearch}">
				<input type="hidden" name="crewbrowse" id="crewbrowse5" value="{$tracking.crewbrowse}">
			</td>
			<td align="right" width="50%">
				<br>
				&nbsp;<input type="text" size="60" name="helpbox" maxlength="100" style="font-size:10px; border=0px; background-color:#D0D1DF" value="Tip: Styles can be applied quickly to selected text." />
			</td>
		</tr>
		</form>	
		<tr>
			<td width="100%" colspan="2">
				<br>
				<br>
				<br>
				{if (isset($crew_select.crew_logo) and $crew_select.crew_logo <> '')}
					<fieldset class="links_set">
					<legend class="links_legend">Crew Logo</legend>
						<img src="../includes/showscreens.php?crew_id={if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}" border="0">
						
						<form action="../crew/db_crew.php" method="post" name="crew_pic_delete" id="crew_pic_delete">
						<input type="submit" name="inserter" value="Delete" onClick="deletelogo(); return false;">
						<input type="hidden" name="action" value="delete_logo">
						<input type="hidden" name="crew_select" id="crew_select6" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
						<input type="hidden" name="crewsearch" id="crewsearch6" value="{$tracking.crewsearch}">
						<input type="hidden" name="crewbrowse" id="crewbrowse6" value="{$tracking.crewbrowse}">
						</form>
						{*<a href="javascript:crew_pic_delete({if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if});" class="MAINNAV">delete logo</a>*}
					</fieldset>
				{else}
					<form action="../crew/db_crew.php" method="post" enctype="multipart/form-data" name="crew_pic" id="crew_pic">
					<fieldset class="links_set">
					<legend class="links_legend">Crew Logo</legend>
						<input type="file" name="crew_pic" accept="image/jpeg,image/x-png">
						<br>
						<br>
						<input type="submit" name="inserter" value="Upload">
					</fieldset>
					<input type="hidden" name="action" value="add_logo">
					<input type="hidden" name="crew_select" id="crew_select7" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
					<input type="hidden" name="crewsearch" id="crewsearch7" value="{$tracking.crewsearch}">
					<input type="hidden" name="crewbrowse" id="crewbrowse7" value="{$tracking.crewbrowse}">
					</form>
				{/if}
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
			
			
			
			{* END THE CREW MAIN EDIT *}
			{/if}
			
			
			{if (isset($crew_action.action) and $crew_action.action eq 'genealogy')}
			{* START THE CREW GENEALOGY EDIT *}
			
			
			<table width="100%" cellspacing="2" cellpadding="15" align="center">
<tr>
	<td colspan="2">
	<fieldset class="category_set_noGrave" style="margin-left: 5%;margin-right: 5%; width:90%;">
		This is the scene genealogy page where we can add members to crews. We can add both indiviual members and subcrews.
	</fieldset> 
	</td>
</tr>
<tr>
	<td>
	
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="50%">
			<form action="../crew/db_crew.php" method="post" name="crew_gene" id="crew_gene">
			
			<select name="sub_crew[]" id="sub_crew" size="10" multiple>
				
				<option value="" SELECTED>-</option>
			
					{foreach from=$crew_gene item=line}
				{if $line.crew_id <> $crew_select.crew_id}
				<option value="{$line.crew_id}">{$line.crew_name}</option>
				{/if}
					{/foreach}	
			
			</select>
			<br>
			<input type="hidden" name="action" value="parent_crew">
			<input type="hidden" name="parent_id" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
			<input type="hidden" name="crew_select" id="crew_select8" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
			<input type="hidden" name="crewsearch" id="crewsearch8" value="{$tracking.crewsearch}">
			<input type="hidden" name="crewbrowse" id="crewbrowse8" value="{$tracking.crewbrowse}">
			<input type="submit" value="Add Subcrew">
			
			</form>
			
			</td>
			<td width="50%">
			
			
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="25%" style="vertical-align:top;">
					
					 <FORM action= method=post name=f1
      onsubmit="return false;">
      <SELECT class=saveHistory id=m1 name=m1 onchange=relate(this.form,0,this.selectedIndex)>

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

        				</SELECT>

      				</FORM>
					
					</td>
					<td width="75%" style="vertical-align:top;" align="left">
					
					      <FORM action="../crew/db_crew.php" method=post name=f2
      onsubmit="return false;">
      <SELECT class=saveHistory id=m2 name=m2 size="10">

        {foreach from=$ind_gene item=line}
				<option value="{$line.ind_id}">{$line.ind_name}</option>
	{/foreach}	



        </SELECT><br>
			<input type="hidden" name="action" value="stop">
			<input type="hidden" name="parent_id" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
			<input type="hidden" name="crew_select" id="crew_select8" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
			<input type="hidden" name="crewsearch" id="crewsearch8" value="{$tracking.crewsearch}">
			<input type="hidden" name="crewbrowse" id="crewbrowse8" value="{$tracking.crewbrowse}">
        <INPUT onclick=jmp(this.form,0); type=submit value="Add Crewmember">
<INPUT name=baseurl type=hidden value=../crew/db_crew.php?action=stop&crew_select={if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}&crewsearch={$tracking.crewsearch}&crewbrowse={$tracking.crewbrowse}&ind_id=>
</FORM>
					
					</td>
				</tr>
			</table>

			</td>
		</tr>
		<tr>{* MEMBERS OF CREW *}
			<td width="100%" colspan="2">
			<br>
			<fieldset>
			<legend class="links_legend">Members</legend>
			
			<table cellspacing="2" cellpadding="2" border="0" width="100%">
				<tr>
					<td width="50%" valign="top">
					
					<table cellspacing="0" cellpadding="2" border="0" width="100%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
					<tr>
						<td valign="top" width="25%"><b>SubCrews</b></td>
					</tr>
					</table>	
					<table cellspacing="0" cellpadding="2" border="0" width="100%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
					{foreach from=$subcrew item=line}
					<tr bgcolor="{cycle name="tr" values="#EFEFEF,#E9E9E9"}">
						<td width="75%" valign="top">
							{$line.crew_name}</td>
						<td width="25%" valign="top">
						<a href="../crew/db_crew.php?action=delete_subcrew&crew_select={if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}&crewsearch={$tracking.crewsearch}&crewbrowse={$tracking.crewbrowse}&sub_crew_id={$line.sub_crew_id}" class="MAINNAV">Delete</a>
						</td>
					</tr>
					{/foreach}
					</table>
					
					
					</td>
					<td width="50%" valign="top" align="right">
					
					<table cellspacing="0" cellpadding="2" border="0" width="100%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
					<tr>
						<td valign="top" width="30%"><b>"Sceners"</b></td>
						<td valign="top" width="30%"><b>Used nick</b></td>
						<td valign="top" width="40%"></td>
					</tr>
					</table>	
					<table cellspacing="0" cellpadding="2" border="0" width="100%" style="border: solid 1px #b2b2b2; background-color:#E9E9E9;">
					
	
					
					
					{foreach name=outer item=individual from=$crew_individuals}
					<tr bgcolor="{cycle name="tr" values="#EFEFEF,#E9E9E9"}">
						<td width="30%" valign="top">
							{$individual.ind_name}</td>
						<form action="../crew/db_crew.php" method="post" name="nick_edit{$individual.id}" id="nick_edit{$individual.ind_id}">
						<td width="30%" valign="top">
						<select name="individual_nicks_id" id="individual_nicks_id" size="1">
						<option value="-" {if $individual.individual_nicks_id <> ''} {else}SELECTED{/if}>None</option>

						{foreach name=inner item=line from=$nick_names}
						{if $individual.ind_id eq $line.ind_id}
						<option value="{$line.individual_nicks_id}" {if $individual.individual_nicks_id eq $line.individual_nicks_id}SELECTED{/if}>{$line.nick}</option>
						{/if}
						{/foreach}

						</select>
						</td>
						<td width="30%" valign="top">
						<input type="hidden" name="action" value="update_nick">
						<input type="hidden" name="crew_individual_id" value="{$individual.crew_individual_id}">
						<input type="hidden" name="parent_id" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
						<input type="hidden" name="crew_select" id="crew_select8" value="{if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}">
						<input type="hidden" name="crewsearch" id="crewsearch8" value="{$tracking.crewsearch}">
						<input type="hidden" name="crewbrowse" id="crewbrowse8" value="{$tracking.crewbrowse}">		
						<input type="submit" name="inserter" value="Update">
						</td>
						</form>
						<td width="10%" valign="top">
							<a href="../crew/db_crew.php?action=delete_crew_member&crew_select={if isset($crew_select.crew_id)}{$crew_select.crew_id}{/if}&crewsearch={$tracking.crewsearch}&crewbrowse={$tracking.crewbrowse}&crew_individual_id={$individual.crew_individual_id}" class="MAINNAV">Delete</a>
						</td>
					</tr>
					{/foreach}
					</table>
	
					</td>
				</tr>
			</table>
			

			
			
			
			
			
			
			
			
			</fieldset>
			</td>
		</tr>
		<tr>
			<td width="100%" align="left" colspan="2">
			</td>
		</tr>
		<tr>
			<td width="100%" colspan="2">

			</td>
		</tr>
		<tr>
			<td width="50%">
				<br>
			</td>
			<td align="right" width="50%">


			</td>
		</tr>

		<tr>
			<td width="100%" colspan="2">
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
			
			
			
			{* END THE CREW GENEALOGY EDIT *}
			{/if}
			
			</td>
			
		</tr>
		<tr>
			<td colspan="4"></td>
		</tr>
	</table>
	{/if}
	{* End crew editing table	*}
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

{if (isset($message) and $message <> '')}
	<table align="center" width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td align="center" >
			<br><br>
			<span class="MAINAV">{$message}</span>
		</td>
	</tr>
	</table>
{/if}
