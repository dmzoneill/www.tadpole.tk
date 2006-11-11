<?php
include("connect.php");
include("functions.php");
if(($_POST['tadpolename']) && ($_POST['tadpolepass'])){
$tadpolename = $_POST['tadpolename'];
$tadpolepass = $_POST['tadpolepass'];
cookiestuff($tadpolename,$tadpolepass);
}


$g=0;
if(!$_GET['opt']){
	$opt = "blog";
}
else {
	$opt = $_GET['opt'];
}

$pagesi = array("blog","listgallery","listpgallery","top10","publicoptions","contact","login","logout","admin","register","myprofile");

for($j=0;$j<count($pagesi);$j++){
	if($opt==$pagesi[$j]){
		if($pagesi[$j]=="logout"){
		disablecookie();
		}
		if($pagesi[$j]=="admin"){
		checkcookie();
		}
		if($pagesi[$j]=="myprofile"){
		checkcookie();
		}
	include("header.php");
	//var_dump($_POST);
	//var_dump($_REQUEST);
	//var_dump($_GET);
	include("page-$opt.php");
	include("footer.php");
	exit;
	}
}

print "just what exactly are you trying to do?";


include("footer.php");
?>