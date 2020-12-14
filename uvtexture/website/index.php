<html>
<head>
<title>uvtexture.com - UVTexSync / custom utherverse clothing sharing</title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<style type="text/css">
<!--
body {
 font-family: arial;
 font-size: 12;
}
p {
 font-family: arial;
 font-size: 12;
}
td {
 font-family: arial;
 font-size: 12;
}
th {
 font-family: arial;
 font-size: 12;
}
a {
 font-family: arial;
 font-size: 12;
}
-->
</style>

<script language=javascript>
<!--
function ChangeUploadCount() {
  s=document.getElementById("u2f");s.style.display="none";
  s=document.getElementById("u3f");s.style.display="none";
  s=document.getElementById("u4f");s.style.display="none";
  s=document.getElementById("u5f");s.style.display="none";
  s=document.getElementById("u6f");s.style.display="none";
  s=document.getElementById("u7f");s.style.display="none";
  s=document.getElementById("u8f");s.style.display="none";
  s=document.getElementById("u9f");s.style.display="none";
  s=document.getElementById("u10f");s.style.display="none";
  vqty=document.getElementById("idqty");
  v=vqty.value;
  if (v>1) { s=document.getElementById("u2f");s.style.display="block"; }
  if (v>2) { s=document.getElementById("u3f");s.style.display="block"; }
  if (v>3) { s=document.getElementById("u4f");s.style.display="block"; }
  if (v>4) { s=document.getElementById("u5f");s.style.display="block"; }
  if (v>5) { s=document.getElementById("u6f");s.style.display="block"; }
  if (v>6) { s=document.getElementById("u7f");s.style.display="block"; }
  if (v>7) { s=document.getElementById("u8f");s.style.display="block"; }
  if (v>8) { s=document.getElementById("u9f");s.style.display="block"; }
  if (v>9) { s=document.getElementById("u10f");s.style.display="block"; }
}
-->
</script>

</head>
<body background='17.gif' text='black'>
<center>
<br><br>

<!-- master table -->
<table border=0 cellspacing=0 cellpadding=0>
 <tr>
  <td valign=top> <!-- left partition -->

<table border=2 cellspacing=0 cellpadding=5>
<tr>
<td align=center width=600 bgcolor='#eeeeee'>
<br>
<img src='banner.jpg'><br>
<p align=left>
<u><font style="font-size: 12pt;" size="3"><b>Introduction</b></font></u><font style="font-size: 12pt;" size="3"><br></font><br>&nbsp;&nbsp;&nbsp;uvtexture is an attempt to gather available custom textures to be distributed amongst <a href='http://www.utherverse.com'>Utherverse</a> users.  This program is created by people independent from the Utherverse personnel.  This program is provided for use until Utherverse determines the release of its own texture distribution system.<br>
<br>&nbsp;&nbsp;&nbsp;Please be aware that the textures you upload will be massively redistributed to users utilizing our free program.  This means that users will able to open, view, or edit your texture while it exists on their computer.  By submitting textures for distribution you understand this concept and hold us harmless of any violated use of your textures by other users.<br>
<br>&nbsp;&nbsp;&nbsp;This program is completely free, safe, and not prohibited by the Utherverse Terms of Service.  We do not modify any existing files on your computer, nor prompt for any login information related with Utherverse.  Files sent to our server are verified as images, and images of specific types, so it is highly unlikely that there will be viruses within.<br>
<br><u><font style="font-size: 12pt;" size="3"><b>How does it work?</b></font></u><br>
<br><b>How to name your texture:</b><br>&nbsp;&nbsp;&nbsp;Please read the <a href='http://uvdesign.jimdo.com/texture-design/texture-faq/'>Texture FAQ</a> to see how to name your texture correctly.  You can, however, name your texture the way you want.  The guidelines provided helps make your texture better organized.  Do not name your texture the same name with the existing textures in resource folder.  It will not get overwritten, and your texture will be just "considered exist" in the folder and will not be downloaded.<br>
<br><b>Upload:</b><br>&nbsp;&nbsp;&nbsp;You do not need to register to upload custom textures to our server. Choose the folder destination, browse the texture(s) you want to upload, and send them up. Wait until confirmation that you have successfully uploaded your texture(s) before you close the page. Please be aware which folder destination you choose before upload the texture. Users will not able to view your male texture if you send it to female texture folder. We will not correct the mistake you made. If it say that "your texture is already exist in our system", that mean that either your texture is already in our system, or the name you choose for your texture is already taken and exist in our system.<br>
<br><b>Download:</b><br>&nbsp;&nbsp;&nbsp;Download the program below and install it to your computer. Open the program and it will begin to check for availiable textures on the server and automatically download ones you do not have.  You can close it on completion, or you can keep it open and it will automatically re-check for updates couple minutes.<br>
<br><font style="" color="#0070c0"><b>Copyright Issue</b></font><br>&nbsp;&nbsp;&nbsp;We <u>strongly</u> suggest that you will NOT upload any textures that belong to other users, especially ones that belong to designers who use their textures for commercial purposes.  If we get a report about this violation, we will require more information about your identity in Utherverse, and perhaps limit access to our program only for UV members who are active as it would seems from the profile.  For everyone sake, please respect others work.<br>
<br><font style="" color="#ff0000"><b>Texture Upload Size</b></font><br>&nbsp;&nbsp;&nbsp;The maximum texture upload size is 100 kb. if a texture exceeds the limit, it's denied before it gets to thescript. If this happen, you will only see a blank Upload Status afteryour upload. If your texture size exceed the limit, please resize your texture to 512x512 or 256x256.<br>
</p>
<hr>
<p align=center>
<br>
<form method='post' enctype="multipart/form-data" action='http://www.uvtexture.com/uploadfile.php'>
<table border=1 cellspacing=2 cellpadding=5>
<tr>
 <td width=450 colspan=2 align=center><strong>Sending Textures</strong></td>
</tr>
<tr>
 <th align=center>File to send</th>
 <th align=right>Quantity: <select id='idqty' name='qty' onchange="javascript:ChangeUploadCount();"><option value=1 selected>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>
<option value=5>5</option>
<option value=6>6</option>
<option value=7>7</option>
<option value=8>8</option>
<option value=9>9</option>
<option value=10>10</option>
</select></th>
</tr>

<tr>
 <td colspan=2 align='center'>
  <input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'>
  <div id='u2f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u3f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u4f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u5f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u6f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u7f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u8f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u9f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div>
  <div id='u10f' style='display:none;'><input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type='file' name='imgname[]'></div></td>  
</tr>

<tr>
 <td width=450 colspan=2 align=right><input type='reset' value='Clear Slots'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Send it up'></td>
</tr>
</table>
</form>
<br>
<hr>
<br>
<table border=1 cellspacing=2 cellpadding=5>
 <tr>
  <td width=450 colspan=2 align=center><strong>Receiving Textures</strong></td>
 </tr>
 <tr>
  <td width=450 align=left colspan=2>&nbsp;&nbsp;&nbsp;The program <strong>UVTexSync</strong> periodically checks this site for any changes, and automatically downloads the new textures directly to your computer. The program can be downloaded from this site.</td>
 </tr>
 <tr>
  <td width=450 align=center colspan=2><img src='uvtexsync.jpg'></td>
 </tr>
 <tr>
  <td width=450 align=center colspan=2>You can download from the following locations:<br><p align=left>
<ul>
<li type=square><a href='http://www.uvtexture.com/uvtexsync-installer.exe'>uvtexture.com Main Site</a>
</ul>
</p></td>
 </tr>
</table>
<br>
<hr>
<br>
<?php
 $link=mysql_connect("localhost","kraqur","");
 mysql_select_db("kraqur", $link);
?>
<table border=1 cellspacing=2 cellpadding=5>
 <tr>
  <th colspan=4>Our current texture storage contains</th>
 </tr>
 <tr>
  <td align=left><strong>Location</strong></td>
  <td align=center><strong>Approved<br />Textures</strong></td>
  <td align=center><strong>Pending<br />Textures</strong></td>
  <td align=right><strong>Bytes</strong></td>
 </tr>
 <tr>
  <td align=left>Female Textures</td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmf' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmf' and approved='0';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=right><?php
$q="select SUM(filesize) as iCnt from tbl_uvtexture_main where class='lmf' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo number_format($r['iCnt'], 0, ',', '.');
?></td>
 </tr>
 <tr>
  <td align=left>Female Attachments Textures</td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmfa' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmfa' and approved='0';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=right><?php
$q="select SUM(filesize) as iCnt from tbl_uvtexture_main where class='lmfa' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo number_format($r['iCnt'], 0, ',', '.');
?></td>
 </tr>
 <tr>
  <td align=left>Male Textures</td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmm' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmm' and approved='0';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=right><?php
$q="select SUM(filesize) as iCnt from tbl_uvtexture_main where class='lmm' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo number_format($r['iCnt'], 0, ',', '.');
?></td>
 </tr>
 <tr>
  <td align=left>Male Attachments Textures</td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmma' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=center><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where class='lmma' and approved='0';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></td>
  <td align=right><?php
$q="select SUM(filesize) as iCnt from tbl_uvtexture_main where class='lmma' and approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo number_format($r['iCnt'], 0, ',', '.');
?></td>
 </tr>
 <tr>
  <td align=left><strong>Totals</strong></td>
  <td align=center><strong><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></strong></td>
  <td align=center><strong><?php
$q="select count(*) as iCnt from tbl_uvtexture_main where approved='0';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo $r['iCnt'];
?></strong></td>
  <td align=right><strong><?php
$q="select SUM(filesize) as iCnt from tbl_uvtexture_main where approved='1';";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);echo number_format($r['iCnt'], 0, ',', '.');
?></strong></td>
 </tr>
</table>
<?php
 mysql_close($link);
?>
<br>
<hr>
<br>
<p align='center'><i>
<a href='http://uvdesign.jimdo.com/contact-us/'>For any questions or comments relating to uvtexture, uvdesign, or uvtexsync, please click here</a></i>
</p>
</td>
</tr>
</table>
  </td>
  <td valign=top> <!-- right partition -->
 <a href="http://www.utherverse.com/ZabyInfo/index.html" target="_blank">
  <img src="http://uvdesign.jimdo.com/cc_images/cache_456678513.jpg?t=1230098211" id="image_456678513" alt="" width="180" height="70"> 
 </a>
<br>
 <a href="http://www.utherverse.com/PropEditorGuide/index.html" target="_blank">
  <img src="http://uvdesign.jimdo.com/cc_images/cache_456688513.jpg?t=1230098267" id="image_456688513" alt="" width="180" height="70"> 
 </a>
<br>
 <a href="http://uvdesign.jimdo.com/profile-goodies/">
  <img src="http://uvdesign.jimdo.com/cc_images/cache_416924013.jpg?t=1228404407" id="image_416924013" alt="" width="180" height="100"> 
 </a>
<br>
 <a href="http://uvdesign.jimdo.com/sponsorship/">
  <img src="http://uvdesign.jimdo.com/cc_images/cache_412662613.jpg?t=1228247975" id="image_412662613" alt="" width="180" height="68"> 
 </a>
<br>
 <a href="http://refer.ccbill.com/cgi-bin/clicks.cgi?CA=924161-0000&amp;PA=1859805&amp;BAN=0">
  <img src="http://www.hentaiwebsite.com/zan/banner.jpg" alt="" border="1">
 </a>
<br>
 <a href="http://www.redlightcenter.com/net/profile/view_profile.aspx?MemberID=91627827" target="_blank">
  <img src="http://uvdesign.jimdo.com/cc_images/cache_414263413.jpg?t=1229618746" id="image_414263413" alt="" width="180" height="150"> 
</a>
<br>
 <a href="http://www.surge.fm" target="_blank">
  <img src="http://uvdesign.jimdo.com/cc_images/cache_447248113.jpg?t=1229700866" id="image_447248113" alt="" width="180" height="150"> 
 </a>
<br>
 <embed id="pingbox" type="application/x-shockwave-flash" src="http://wgweb.msg.yahoo.com/badge/Pingbox.swf" flashvars="wid=9N0fPy26UHtfjNpHdFiQtd0yxszfWBc-" allowscriptaccess="always" width="180" height="420">

  </td>
 </tr>
</table> <!-- end of master table -->
<br><br>
</center>
</body>
</html>
