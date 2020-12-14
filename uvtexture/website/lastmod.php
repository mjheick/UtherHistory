<?php

if (isset($_GET['var'])) {
  $link=mysql_connect("localhost","kraqur","");
  mysql_select_db("kraqur", $link);
  $q="SELECT * FROM tbl_uvtexture_vars WHERE var='".$_GET['var']."'";
  $res=mysql_query($q, $link);
  $r=mysql_fetch_assoc($res);
  echo $r['val'];
  mysql_close($link);
}

?>
