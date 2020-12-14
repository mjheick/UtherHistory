<?php

if ((isset($_GET['var'])) && (isset($_GET['tex']))) {
  $link=mysql_connect("localhost","kraqur","");
  mysql_select_db("kraqur", $link);
  $q="SELECT * FROM tbl_uvtexture_main WHERE (class='".$_GET['var']."' AND filename='".$_GET['tex']."')";
  $res=mysql_query($q, $link);
  $r=mysql_fetch_assoc($res);
  echo $r['filesize'];
  mysql_close($link);
}

?>
