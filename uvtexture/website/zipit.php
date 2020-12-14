<?php

$r=mysql_connect("localhost","kraqur","");
mysql_select_db("kraqur");

// remove and recreate blank temp file
$zipfile="lmf";
@unlink($zipfile."_temp.zip");
$fp=fopen($zipfile."_temp.zip", "w");
fclose($fp);
// setup all: query sql for zip
if ($zipfile=="lmf") { $zippath="female\\textures\\"; }
if ($zipfile=="lmfa") { $zippath="female\\attachments\\textures\\"; }
if ($zipfile=="lmm") { $zippath="male\\textures\\"; }
if ($zipfile=="lmma") { $zippath="male\\attachments\\textures\\"; }
$q=mysql_query("SELECT path FROM tbl_uvtexture_main WHERE class='".$zipfile."' and approved='1'");
// create archive
$zip = new ZipArchive();
if ($zip->open($zipfile."_temp.zip")===TRUE) {
  while ($row = mysql_fetch_assoc($q)) { 
    echo "Adding ".basename($row['path'])."<br>";
    $zip->addFile($row['path'],$zippath.basename($row['path']));
  }
  $zip->close();
} else {
  echo "Failed creating ".$zipfile."_temp.zip file<br />";
}
@unlink($zipfile.".zip");
rename($zipfile."_temp.zip",$zipfile.".zip");

// remove and recreate blank temp file
$zipfile="lmfa";
@unlink($zipfile."_temp.zip");
$fp=fopen($zipfile."_temp.zip", "w");
fclose($fp);
// setup all: query sql for zip
if ($zipfile=="lmf") { $zippath="female\\textures\\"; }
if ($zipfile=="lmfa") { $zippath="female\\attachments\\textures\\"; }
if ($zipfile=="lmm") { $zippath="male\\textures\\"; }
if ($zipfile=="lmma") { $zippath="male\\attachments\\textures\\"; }
$q=mysql_query("SELECT path FROM tbl_uvtexture_main WHERE class='".$zipfile."' and approved='1'");
// create archive
$zip = new ZipArchive();
if ($zip->open($zipfile."_temp.zip")===TRUE) {
  while ($row = mysql_fetch_assoc($q)) { 
    echo "Adding ".basename($row['path'])."<br>";
    $zip->addFile($row['path'],$zippath.basename($row['path']));
  }
  $zip->close();
} else {
  echo "Failed creating ".$zipfile."_temp.zip file<br />";
}
@unlink($zipfile.".zip");
rename($zipfile."_temp.zip",$zipfile.".zip");

// remove and recreate blank temp file
$zipfile="lmm";
@unlink($zipfile."_temp.zip");
$fp=fopen($zipfile."_temp.zip", "w");
fclose($fp);
// setup all: query sql for zip
if ($zipfile=="lmf") { $zippath="female\\textures\\"; }
if ($zipfile=="lmfa") { $zippath="female\\attachments\\textures\\"; }
if ($zipfile=="lmm") { $zippath="male\\textures\\"; }
if ($zipfile=="lmma") { $zippath="male\\attachments\\textures\\"; }
$q=mysql_query("SELECT path FROM tbl_uvtexture_main WHERE class='".$zipfile."' and approved='1'");
// create archive
$zip = new ZipArchive();
if ($zip->open($zipfile."_temp.zip")===TRUE) {
  while ($row = mysql_fetch_assoc($q)) { 
    echo "Adding ".basename($row['path'])."<br>";
    $zip->addFile($row['path'],$zippath.basename($row['path']));
  }
  $zip->close();
} else {
  echo "Failed creating ".$zipfile."_temp.zip file<br />";
}
@unlink($zipfile.".zip");
rename($zipfile."_temp.zip",$zipfile.".zip");

// remove and recreate blank temp file
$zipfile="lmma";
@unlink($zipfile."_temp.zip");
$fp=fopen($zipfile."_temp.zip", "w");
fclose($fp);
// setup all: query sql for zip
if ($zipfile=="lmf") { $zippath="female\\textures\\"; }
if ($zipfile=="lmfa") { $zippath="female\\attachments\\textures\\"; }
if ($zipfile=="lmm") { $zippath="male\\textures\\"; }
if ($zipfile=="lmma") { $zippath="male\\attachments\\textures\\"; }
$q=mysql_query("SELECT path FROM tbl_uvtexture_main WHERE class='".$zipfile."' and approved='1'");
// create archive
$zip = new ZipArchive();
if ($zip->open($zipfile."_temp.zip")===TRUE) {
  while ($row = mysql_fetch_assoc($q)) { 
    echo "Adding ".basename($row['path'])."<br>";
    $zip->addFile($row['path'],$zippath.basename($row['path']));
  }
  $zip->close();
} else {
  echo "Failed creating ".$zipfile."_temp.zip file<br />";
}
@unlink($zipfile.".zip");
rename($zipfile."_temp.zip",$zipfile.".zip");


mysql_close($r);
?>
