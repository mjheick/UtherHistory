<?php
$link=mysql_connect("localhost","kraqur","");
mysql_select_db("kraqur", $link);
$q="SELECT * FROM `tbl_uvtexture_main` WHERE NOT (filename like 'HM%' or filename like 'HF%' or filename like 'UM%' or filename like 'UF%')";
$res=mysql_query($q, $link);
while ( $r=mysql_fetch_assoc($res) ) {
  $uploaddir = "/home/kraqur/www/uvtexture/".$r['path'];
  @unlink($uploaddir);
  $q2="DELETE FROM tbl_uvtexture_main WHERE checksum='".$r['checksum']."';";
  $res2=mysql_query($q2, $link);
}
mysql_close($link);
header("Location: http://www.uvtexture.com/texture-administrator.php");
die();
?>
