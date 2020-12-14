<?php
$link=mysql_connect("localhost","kraqur","");
mysql_select_db("kraqur", $link);

if (isset($_GET['nuke'])) {
  if ((strlen($_GET['nuke']))>0) {
    $q="SELECT * FROM `tbl_uvtexture_main` WHERE checksum='".$_GET['nuke']."'";
    $res=mysql_query($q, $link);
    $r=mysql_fetch_assoc($res);
    $uploaddir = "/home/kraqur/www/uvtexture/".$r['path'];
    @unlink($uploaddir);
    $q="DELETE FROM tbl_uvtexture_main WHERE checksum='".$_GET['nuke']."';";
    $res=mysql_query($q, $link);
    header("Location: http://www.uvtexture.com/texture-administrator.php");
    die();
  }
}
if (isset($_GET['approve'])) {
  if ((strlen($_GET['approve']))>0) {
    $q="UPDATE `tbl_uvtexture_main` SET approved='1' WHERE checksum='".$_GET['approve']."';";
    $res=mysql_query($q, $link);
    $q="SELECT * FROM `tbl_uvtexture_main` WHERE checksum='".$_GET['approve']."'";
    $res=mysql_query($q, $link);
    $r=mysql_fetch_assoc($res);
    $theclass=$r['class'];
    $q="UPDATE tbl_uvtexture_vars SET val=NOW() WHERE var='".$theclass."';";
    $res=mysql_query($q, $link);
    header("Location: http://www.uvtexture.com/texture-administrator.php");
    die();
  }
}
if (isset($_GET['banip'])) {
  if ((strlen($_GET['banip']))>0) {
    $q="INSERT INTO `tbl_uvtexture_vars` (`var`,`val`) VALUES ('ipban', '".$_GET['banip']."');";
    $res=mysql_query($q, $link);
    header("Location: http://www.uvtexture.com/texture-administrator.php");
    die();
  }
}
if (isset($_GET['warn'])) {
  if ((strlen($_GET['warn']))>0) {
    $q="INSERT INTO `tbl_uvtexture_vars` (`var`,`val`) VALUES ('warn', '".$_GET['warn']."');";
    $res=mysql_query($q, $link);
    header("Location: http://www.uvtexture.com/texture-administrator.php");
    die();
  }
}

if (isset($_POST['dban'])) {
  if ((strlen($_POST['dban']))>0) {
    $q="INSERT INTO `tbl_uvtexture_vars` (`var`,`val`) VALUES ('dban', '".$_POST['dban']."');";
    $res=mysql_query($q, $link);
    header("Location: http://www.uvtexture.com/texture-administrator.php");
    die();
  }
}

?>
<head>
<title>texture admin</title>
</head>
<body>
<center>
<table border=1 cellpadding=5 cellspacing=5>
 <tr>
  <th>del | approve<br />ip address</th><th width=300>file name</th><th>file size</th><th>preview</th>
 </tr>
<?php

  if (isset($_GET['page'])) {
    $vpage=$_GET['page'];
    $ppage=$vpage-10;
    if ($ppage<0) { $ppage=0; }
  } else {
    $vpage=0;
    $ppage=0;
  }
  echo " <tr><td align=center colspan=2><a href='texture-administrator.php?page=".$ppage."'>Previous</a> | ";
  echo " <a href='texture-administrator.php?page=".($vpage+10)."'> Next</a>";
?><br /><br />
<form method='get' action='texture-administrator.php'><input type='text' name='srch'<?php
if (strlen($_GET['srch'])>0) {
  echo " value='".$_GET['srch']."' ";
}
?>size=40><input type='submit' value='search'>&nbsp;&nbsp;&nbsp;<a href='texture-administrator.php'>clear</a></form>
</td>
<td align=center colspan=2>Designer Ban<br>
<form method='post' action='texture-administrator.php'><input type='text' name='dban' size='10'><input type='submit' value='ban'></form><br>
<a href='texture-administrator.php?listdbans=1'>List DBans</a><?php
if (isset($_GET['listdbans'])) {
  $q="SELECT * FROM `tbl_uvtexture_vars` WHERE `var`='dban';";
  $res=mysql_query($q, $link);
  if (mysql_num_rows($res)>0) {
    while ($r=mysql_fetch_assoc($res)) {
      echo "<br>|".$r['val']."|";
    }
  }
  mysql_free_result($res);
}
?></td>
</tr>
<?php
  echo "\n";
  echo " <tr>\n";
  echo "  <td align=center colspan=4>";
  $q="SELECT COUNT(filesize) as iCnt FROM `tbl_uvtexture_main`";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);
  echo $r['iCnt']." file(s) consuming\n";
  $q="SELECT SUM(filesize) as iCnt FROM `tbl_uvtexture_main`";$res=mysql_query($q, $link);$r=mysql_fetch_assoc($res);
  echo number_format($r['iCnt'], 0, ',', '.')." bytes</td>\n";
  echo " </tr>\n";
  
  // check for search
  if (strlen($_GET['srch'])>0) {
    $q="SELECT * FROM `tbl_uvtexture_main` WHERE filename like ".chr(34)."%".$_GET['srch']."%".chr(34)." ORDER BY `approved`, `path` DESC";
  } else {
    $q="SELECT * FROM `tbl_uvtexture_main` ORDER BY `approved`, `path` DESC LIMIT ".$vpage.",10";
  }
  $res=mysql_query($q, $link);
  while ( $r=mysql_fetch_assoc($res) ) {
    echo " <tr>\n";
    // nuke?
    echo "  <td align=center>";
    echo "<a href='texture-administrator.php?nuke=".$r['checksum']."'><img src='nuke.png' border=0 alt='delete'/></a>";
    // approve?
    if ($r['approved']==0) {
      echo " | <a href='texture-administrator.php?approve=".$r['checksum']."'><img src='checkmark.jpg' border=0 alt='approve'/></a>";
    }
    if ($r['ipaddy']!="0.0.0.0") {
      echo "<hr />".$r['ipaddy'];
      $q2="SELECT COUNT(*) as iCnt FROM `tbl_uvtexture_vars` WHERE val='" . $r['ipaddy'] . "';";
      $res2=mysql_query($q2, $link);
      $r2=mysql_fetch_assoc($res2);
      if ($r2['iCnt']==0) {
        echo "<br /><a href='texture-administrator.php?warn=".$r['ipaddy']."'>Warn</a>";
      }
      if ($r2['iCnt']==1) {
        echo "<br /><a href='texture-administrator.php?banip=".$r['ipaddy']."'>Ban</a>";
      }
      if ($r2['iCnt']==2) {
        echo "<br />Banned!";
      }
    }
    echo "</td>";
    echo "  <td align=left width=300>".$r['filename']."</td>\n";
    echo "  <td align=right>".$r['filesize']."</td>\n";
    echo "  <td align=center><a href='/".$r['path']."' target='_blank'><img src='/".$r['path']."' width='100' height='100' border=1></a></td>\n";
    echo " </tr>\n";
  }
  mysql_close($link);
?>
</table>
</center>
</body>
</html>
