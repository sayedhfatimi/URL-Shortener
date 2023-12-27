<?php
	include("connect.php");
	mysql_select_db($mysql_database, $connect);
	$i = $_GET['i'];
	if(isset($i)) {
		$result = mysql_query("SELECT * FROM links WHERE slink='$i'");
		while($row = mysql_fetch_array($result)) {
?>
<html>
<head>
<meta http-equiv="REFRESH" content="0;url=<?=$row['olink'];?>"></HEAD>
</HTML>
<?php
		}
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HomePage</title>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">TheOliveBranchdotCom</div>
<div id="container">
<div id="seperator"></div>
<div id="navbar">
<ul class="menu">
<li><a href="#">HomePage</a></li>
<li><a href="#">Account</a></li>
<li><a href="#">Register</a></li>
</ul>
</div>
<div id="content">
<?php
	if(isset($_POST['submit'])) {
		$olink = $_POST['olink'];
		$slink = md5($olink);
		$slink = strtoupper(substr($slink,0,5));
		$sql = "INSERT INTO links (username, olink, slink) VALUES ('guest', '$olink', '$slink')";
		$submiturl = mysql_query($sql);
		if($submiturl) {
?>
<p align="center">http://limited4.webuda.com/<?=$slink;?></p>
<?php
			mysql_close($connect);
		}
	}
	else {
?>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
<tr>
<td align="center"><input name="olink" type="text" /></td>
</tr>
<tr>
<td align="center"><input name="submit" type="submit" value="Shorten" /></td>
</tr>
</table>
</form>
<?php
	}
?>
</div>
<div id="footer"></div>
</div>
</body>
</html>
<?php
	}
?>