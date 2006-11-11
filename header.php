<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title><?php print "Tadpole.tk " .$_POST['url'] ." ". $_POST['img']." ". $_POST['dir']." ". $_POST['file']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
//includes for javascript stuff
if(($_GET['opt']=="admin") && (!$_GET['case']=="editcomment")){ 
	include("includes/admin-mce.php"); 
} 
else {
	include("includes/user-mce.php"); 
}
	include("includes/other-mce.php"); 
	
if($_GET['opt']=="register"){
	include("includes/dob.php");
}	

// style sheets
print "<style>";
include("includes/tad.css");
if($_GET['opt']!="admin"){
	include("includes/tadextras.css");
}
print "</style>";

print "</head>";
print "<body bgcolor='#dddddd'";

if(($_GET['file']) || ($_GET['opt']=="admin")){ 
	print "onLoad=\"javascript:startup()\""; 
}
print ">";
?>
<center><a href='index.php'><img src="images/logo.gif" border=0></a>
<table cellpadding="0" cellspacing="0" border="0" width=790><tr><td align="center">
<div id="tabsJ">
  <ul>
    <li><a href="index.php?opt=blog" title="Shanes demonic rants!"><span>Blog</span></a></li>
    <li><a href="index.php?opt=listgallery" title="Personal Gallerys"><span>Gallerys</span></a></li>
    <li><a href="index.php?opt=listpgallery" title="Publicly submitted pictures"><span>Public Gallerys</span></a></li>
	<li><a href="index.php?opt=publicoptions" title="Make your own album and upload images!"><span>Upload Images</span></a></li>
	<li><a href="index.php?opt=top10" title="Top ten images as viewed by you!"><span>Top 10 Images</span></a></li>
	<li><a href="index.php?opt=contact" title="Exactly what it says on the tin!"><span>Contact Me</span></a></li>
	<?php if(getrank()==5){ ?>
	<li><a href="index.php?opt=admin" title="Get in there!"><span>The Panel</span></a></li>
	<li><a href="index.php?opt=logout" title="Outa here aight!"><span>Logout [<?php print getuser(); ?>]</span></a></li>
	<?php } elseif(getrank()==2){ ?>
	<li><a href="index.php?opt=myprofile" title="Change Loads more settings in here!"><span>My Profile</span></a></li>
	<li><a href="index.php?opt=logout" title="Outa here aight!"><span>Logout [<?php print getuser(); ?>]</span></a></li>
	<?php } else { ?>
	<li><a href="index.php?opt=login" title="For authorized users only!"><span>Login</span></a></li>
	<?php } 
	// <!---- <li><a href="index.php?opt=register" title="Get in there!"><span>Register</span></a></li> // ---->
	?>
  </ul>
</div>
</td></tr></table>

<table width=790 border=0 cellspacing=0 cellpadding=0><tr><td>
	<table width=790 border=0 cellspacing=0 cellpadding=0><tr>
  <?php
	$url = $_get['url'];
	$ttya = $_GET['opt'];
	$ttyb = $_SERVER['PHP_SELF'];

	if($ttyb!="/image.php"){
	if($ttyb!="/gallerys.php") {
	if($ttya!="listgallery") { 
	if($ttya!="listpgallery"){
	if($ttya!="login"){
	if($ttya!="admin"){
?>
    <td width=180 valign=top>
	<table border=0 cellspacing=0 cellpadding=0><tr><td  valign=top>
	<table border=0 cellspacing=0 cellpadding=0><tr><td valign=top width=100%>
<?php 
	include("includes/randomimage.php"); 
?>
	</td></tr></table></td></tr></table></td> 
<?php }}}}}} 
	
	if($ttyb=="/image.php"){
		print "<td width=180 valign=top>
			<table border=0 cellspacing=0 cellpadding=0><tr><td  valign=top>
			<table border=0 cellspacing=0 cellpadding=0><tr><td valign=top width=100%>";
		include("slider.php");
		print "</td></tr></table></td></tr></table></td> ";
	
	}
?>
    <td width=* valign=top><br><center>
	<table width=610 border=0 cellspacing=0 cellpadding=0><tr><td>
	
<?php
	if($_GET['file']){
	$file = explode("tn_",$_GET['file']);
		$dir = rawurlencode($file[0]);
		$img = rawurlencode($file[1]);
	$comments = stripslashes(rawurldecode(rawurldecode($stream->do_query("SELECT comments FROM shane_gallerys WHERE imagedir='$dir' AND imagename='$img'","one"))));
	$ppp = explode("<br>",$comments);
	$ppp = round(count($ppp)/5);
	?>
	<div id="tabsB" align=right>
  <ul>
    <li><a href="#" onclick="javascript:switchid('mimage');"><span>View Image</span></a></li>
    <li><a href="#" onclick="javascript:switchid('minfo');"><span>Information</span></a></li>
    <li><a href="#" onclick="javascript:switchid('mcomments');"><span>Comments <?php if($ppp>0){ print "[$ppp]"; }?></span></a></li>
    <li><a href="#" onclick="javascript:switchid('mpost');"><span>Add Comment</span></a></li>
    <li><a href="#" onclick="javascript:switchid('mfriend');"><span>Send to friend</span></a></li>
    </ul>
</div>
<?php
	}
	if((getrank()==5) && ($_GET['opt']=="admin")){ 
	?>
	<div id="tabsB" align=right>
  <ul>
    <li><a href="#" onclick="javascript:switchid('adminblog');"><span>Blog Entries</span></a></li>
    <li><a href="#" onclick="javascript:switchid('adminset');"><span>Settings</span></a></li>
    <li><a href="#" onclick="javascript:switchid('adminlogs');"><span>Ip logs</span></a></li>
    <li><a href="#" onclick="javascript:switchid('adminimages');"><span>Image Control</span></a></li>
    <li><a href="#" onclick="javascript:switchid('adminedit');"><span>Page Editor</span></a></li>
	 <li><a href="#" onclick="javascript:switchid('adminr');"><span>Changes Log</span></a></li>
    </ul>
</div>
	<?php
	}
	
	?>
	
  </td></tr></table>
  <table bgcolor='#999999' width=580 border=0 cellspacing=0 cellpadding=1><tr><td>
	<table bgcolor='#efefef' width=580 border=0 cellspacing=0 cellpadding=10><tr><td valign=top width=100%>
<?php if(!$_GET['file']){ ?>
	  <div align=right><a href='#bottom'>Bottom</a><a name=top>&nbsp;</a></div>
<?php } ?>
	