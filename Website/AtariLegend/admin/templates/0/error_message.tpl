{* 
/***************************************************************************
*                                 error_message.tpl
*                            --------------------------
*   begin                : 2005-01-06
*   copyright            : (C) 2005 Atari Legend
*   email                : admin@atarilegend.com
*
*   Id: error_message.tpl,v 0.10 2005/01/06 Silver
*
***************************************************************************/ 
*}
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="HEADERBAR">
<tr>    
	<td height="5" style="vertical-align:top;">
	<span class="LEFTNAVHEADING">&nbsp;&nbsp;{$error_msg.section}</span>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="15" align="center" class="CELLCOLOR">
<tr>
	<td width="100%" align="center">		
		<div style="border: 1px black solid;background-color:white;">
		<span class="MAINAV">
			{$error_msg.message}
		</span>
		</div>
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