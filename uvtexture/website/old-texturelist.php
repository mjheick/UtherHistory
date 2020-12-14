<?php

if ((isset($_GET['var'])) && (!isset($_GET['tex']))) {
  $link=mysql_connect("localhost","kraqur","");
  mysql_select_db("kraqur", $link);
  $q="SELECT * FROM tbl_uvtexture_main WHERE (class='".$_GET['var']."' AND approved='1')";
  $res=mysql_query($q, $link);
  while ($r=mysql_fetch_assoc($res)) {
    echo $r['filename'].chr(13).chr(10);
  }
  mysql_close($link);
}

if ((isset($_GET['var'])) && (isset($_GET['tex']))) {
  $link=mysql_connect("localhost","kraqur","");
  mysql_select_db("kraqur", $link);
  $q="SELECT * FROM tbl_uvtexture_main WHERE (class='".$_GET['var']."' AND filename='".$_GET['tex']."' AND approved='1')";
  $res=mysql_query($q, $link);
  $r=mysql_fetch_assoc($res);
  echo $r['path'];
  mysql_close($link);
}


?>
