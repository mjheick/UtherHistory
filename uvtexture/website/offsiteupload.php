<html>
<head>
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
  s=document.getElementById("u2c");s.style.display="none";s=document.getElementById("u2f");s.style.display="none";
  s=document.getElementById("u3c");s.style.display="none";s=document.getElementById("u3f");s.style.display="none";
  s=document.getElementById("u4c");s.style.display="none";s=document.getElementById("u4f");s.style.display="none";
  s=document.getElementById("u5c");s.style.display="none";s=document.getElementById("u5f");s.style.display="none";
  s=document.getElementById("u6c");s.style.display="none";s=document.getElementById("u6f");s.style.display="none";
  s=document.getElementById("u7c");s.style.display="none";s=document.getElementById("u7f");s.style.display="none";
  s=document.getElementById("u8c");s.style.display="none";s=document.getElementById("u8f");s.style.display="none";
  s=document.getElementById("u9c");s.style.display="none";s=document.getElementById("u9f");s.style.display="none";
  s=document.getElementById("u10c");s.style.display="none";s=document.getElementById("u10f");s.style.display="none";
  vqty=document.getElementById("idqty");
  v=vqty.value;
  if (v>1) { s=document.getElementById("u2c");s.style.display="block";s=document.getElementById("u2f");s.style.display="block"; }
  if (v>2) { s=document.getElementById("u3c");s.style.display="block";s=document.getElementById("u3f");s.style.display="block"; }
  if (v>3) { s=document.getElementById("u4c");s.style.display="block";s=document.getElementById("u4f");s.style.display="block"; }
  if (v>4) { s=document.getElementById("u5c");s.style.display="block";s=document.getElementById("u5f");s.style.display="block"; }
  if (v>5) { s=document.getElementById("u6c");s.style.display="block";s=document.getElementById("u6f");s.style.display="block"; }
  if (v>6) { s=document.getElementById("u7c");s.style.display="block";s=document.getElementById("u7f");s.style.display="block"; }
  if (v>7) { s=document.getElementById("u8c");s.style.display="block";s=document.getElementById("u8f");s.style.display="block"; }
  if (v>8) { s=document.getElementById("u9c");s.style.display="block";s=document.getElementById("u9f");s.style.display="block"; }
  if (v>9) { s=document.getElementById("u10c");s.style.display="block";s=document.getElementById("u10f");s.style.display="block"; }
}
-->
</script>
</head>

<body text='black'>
<center>
<form method='post' enctype="multipart/form-data" action='http://www.uvtexture.com/uploadfile.php'>
<table border=1 cellspacing=2 cellpadding=5>
<tr>
 <td width=400 colspan=3 align=center><strong>Sending Textures</strong></td>
</tr>
<tr>
 <th align=center>Storage Location</th>
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
 <td align=center>
  <select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select>
  <div id='u2c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u3c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u4c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u5c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u6c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u7c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u8c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u9c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div>
  <div id='u10c' style='display:none;'><select name='storage[]'><option value=''></option><option value='lmf'>Female Textures</option><option value='lmfa'>Female Attachments Textures</option><option value='lmm'>Male Textures</option><option value='lmma'>Male Attachments Textures</option></select></div></td>
 <td colspan=2 align='right'>
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
 <td width=400 colspan=3 align=right><input type='reset' value='Clear Slots'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Send it up'></td>
</tr>
</table>
</form>
</center>
</body>
</html>