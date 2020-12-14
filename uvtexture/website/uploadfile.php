<?php

$dstoutput="";

$link=mysql_connect("localhost","kraqur","");
mysql_select_db("kraqur", $link);

if (!isset($_POST['qty'])) {
  header("Location: http://www.uvtexture.com/", 302);
}

// create folder structure
$FolderYear=date("Y");
$FolderMonth=date("m");
$FolderDay=date("d");
@mkdir($FolderYear);
@chmod($FolderYear, 0777);
@mkdir($FolderYear."/".$FolderMonth);
@chmod($FolderYear."/".$FolderMonth, 0777);
@mkdir($FolderYear."/".$FolderMonth."/".$FolderDay);
@chmod($FolderYear."/".$FolderMonth."/".$FolderDay, 0777);
// prepare location
$uploaddir = "/home/kraqur/www/uvtexture/".$FolderYear."/".$FolderMonth."/".$FolderDay."/";

$uploadcnt=0;

// Upload files
foreach ($_FILES["imgname"]["error"] as $key => $error) {
  if ($error==UPLOAD_ERR_OK) { // good file...work with it
    $todo=TRUE;
    $tmp_name=$_FILES["imgname"]["tmp_name"][$key];
    $file_name=$_FILES["imgname"]["name"][$key];
    $dstoutput.="<br>Filename: ".$file_name."<br />";
    $uploadfile = $uploaddir . basename($file_name);

    // check for duplicate
    $q="SELECT COUNT(*) AS iCnt FROM tbl_uvtexture_main WHERE checksum='".md5_file($tmp_name)."';";
    $res=mysql_query($q, $link);
    $r=mysql_fetch_assoc($res);
    if ($r['iCnt']=="1") {  // file exists
      $uploadcnt--;
      $todo=FALSE;
      $dstoutput.="Status: Duplicate file exists.  File not stored<br />";
    }

    // check for same filename
    $q="SELECT COUNT(*) AS iCnt FROM tbl_uvtexture_main WHERE filename='".$file_name."';";
    $res=mysql_query($q, $link);
    $r=mysql_fetch_assoc($res);
    if ($r['iCnt']=="1") {  // file exists
      $uploadcnt--;
      $todo=FALSE;
      $dstoutput.="Status: Duplicate filename exists.  File not stored<br />";
    }
    
    // check for dban -> designer ban
    $q="SELECT * FROM `tbl_uvtexture_vars` WHERE `var`='dban';";
    $res=mysql_query($q, $link);
    if (mysql_num_rows($res)>0) {
      while ($r=mysql_fetch_assoc($res)) {
        if (stristr($file_name, $r['val'])===FALSE) { // this is good

        } else { // flag it
          $uploadcnt--;
          $todo=FALSE;
          $dstoutput.="Status: Designer marking [".$r['val']."] found.  The designer requested this not be in distribution<br />";
        }
      }
    }
    mysql_free_result($res);

    // check for Warned, Banned IP
    $q="SELECT COUNT(*) AS iCnt FROM tbl_uvtexture_vars WHERE val='".$_SERVER['REMOTE_ADDR']."';";
    $res=mysql_query($q, $link);
    $r=mysql_fetch_assoc($res);
    if ($r['iCnt']==1) {  // warned
      $dstoutput.="Status: Your IP has been identified as uploading non-texture files.  If you continue this, you will be banned.<br />";
    }
    if ($r['iCnt']==2) {  // Banned
      $uploadcnt--;
      $todo=FALSE;
      $dstoutput.="Status: Your IP Address is Banned.<br />";
    }


    // Move it
    if ($todo) { 
      @move_uploaded_file($tmp_name, $uploadfile);
    }

    // Set permissions
    if ($todo) {
      @chmod($uploadfile, 0777);
    }

    if ($todo) {
      // Check if it's an image, abort if not
      if (!getimagesize($uploadfile)) {
        unlink($uploadfile);
        $uploadcnt--;
        $todo=FALSE;
        $dstoutput.="Status: File is not a recognizable image.  It was deleted.<br />";
      }
    }
    
    if ($todo) {
      // determine storage
      $classify="";
      $lnk=strtolower(substr(basename($file_name),0,3));
      if (($lnk=="hf_") || ($lnk=="uf_")) { $classify="lmfa"; }
      if (($lnk=="hm_") || ($lnk=="um_")) { $classify="lmma"; }
      if (strlen($classify)==0) {
        $lnk=strtolower(substr(basename($file_name),1,1));
        if ($lnk=="f") { $classify="lmf"; }
        if ($lnk=="m") { $classify="lmm"; }
      }
      if (strlen($classify)==0) {
        unlink($uploadfile);
        $uploadcnt--;
        $todo=FALSE;
        $dstoutput.="Status: Cannot clasify image type based on filename.  It was deleted.<br />";
      }
    }

    if ($todo) {
      // SQL Insertion
      $q="INSERT INTO tbl_uvtexture_main (`class`,`filename`,`path`,`filesize`,`checksum`,`ipaddy`) VALUES ";
      $q=$q."('".$classify."','".basename($file_name)."','".$FolderYear."/".$FolderMonth."/".$FolderDay."/".basename($file_name)."','".filesize($uploadfile)."','".md5_file($uploadfile)."','".$_SERVER['REMOTE_ADDR']."')";
      $res=mysql_query($q, $link);
      $uploadcnt++;
      $dstoutput.="Status: Saved OK, Pending approval<br />";
    }
  }
}

mysql_close($link);
?><html>
<head>
<title>uvtexture.com - Upload Results</title>
<meta http-equiv="refresh" content="60;url=http://www.uvtexture.com/" />
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
</head>
<body background='17.gif' text='black'>
<center>
<br><br>
<table border=2 cellspacing=0 cellpadding=5>
 <tr>
  <td align=left width=600 bgcolor='#eeeeee'>
  <br>
<p>
<strong>Upload Status</strong><br>
<?php
 echo $dstoutput;
?>
</p>
<p align='center'><a href='http://www.uvtexture.com'>Click to return to main page</a></p>
  <br>
  </td>
 </tr>
</table>
<br>
<br>
</center>
</body>
</html>
