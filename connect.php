<?php


/**** Edit this stuff ****/

$fcwhost = "mysql.feeditout.com"; // the database server hostname
$fcwusername = "tadpole"; // the database username
$fcwpassword2 = "b399b399"; // the database password
$fcwdb_name = "tadpole"; //  the name of the database which evobb will run from
$fcwdb_type = "mysql"; // type, none tested except mysql.  test others at your own risk.
$rand = sha1(time());
date_default_timezone_set("Australia/ACT");
/****  DON'T EDIT BELOW *****/
include($path."db_".$fcwdb_type.".php");
$stream = new db;
$db = $stream;
$stream->connect();

$sql = $stream->do_query("delete from shane_gallerys where imagename=''","one");
$sql = $stream->do_query("delete from shane_gallerys where imagedir =''","one");
$banned = $stream->do_query("select * from shane_bannedips","array");

for($e=0;$e<count($banned);$e++){
	$tmp = $banned[$e];
	$ip = $tmp[1];
	if($_SERVER['REMOTE_ADDR']==$ip){
		print "You have been banned from using this site.... have a nice day";
		exit;
	}
}

function utime (){
$time = explode( " ", microtime());
$usec = (double)$time[0];
$sec = (double)$time[1];
return $sec + $usec;
}
$start = utime(); 
$redirect = "<script language=javascript>\ndocument.location.href='http://www.tadpole.tk/index.php?opt=admin&rand=$rand';\n</script>";