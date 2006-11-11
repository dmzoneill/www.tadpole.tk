<?php

checkcookie();

if(getrank()==5){

$case = $_GET['case'];
$page = $_GET['Uploading'];
$uploadit = $_GET['uploadit'];
$url = $_GET['url'];
$images = $_FILES['images'];
$moveimage = $_POST['moveimage'];
$deleteimage = $_POST['deleteimage'];
$delcomment = $_POST['delcomment'];
$fid = $_GET['fid'];
$resethits = $_POST['resethits'];
$file = $_GET['file'];
$thumb = $_GET['thumb'];
$targetdir = $_POST['targetdir'];
$delcomment = $_GET['delcomment'];
$deleteimage = $_POST['deleteimage'];
$resethits = $_POST['resethits'];
$delcomment = $_POST['delcomment'];
$editcomment = $_POST['editcomment'];
$feature = $_GET['feature'];
$ramble = $_POST['blogdata'];
switch($case){





default:

//blogger
print "<div id='adminblog'>";
	if($_POST['blogdata']){
		$datah = $_POST['blogdata'];
		print controlblog($datah);
	}
	else {
		print controlblog("show");
	}
print "</div>";


// settings
print "<div id='adminset'>"; 
print admin_sets();
print "</div>";


//logs
print "<div id='adminlogs' width=600>" ;
print admin_ipblock();


print "</div>";

//image control
print "<div id='adminimages'> ". adminmenu() ."</div>";


//page editor
print "<div id='adminedit'></div>";

//changes log
print "<div id='adminr'>";
print show_changes();
print "</div>";

break;





case "addimage";
if(!$images){
print "<form name='main' action=\"index.php?opt=admin&case=addimage&page=Uploading&uploadit=true&url=$url\" enctype=\"multipart/form-data\" method=\"post\">\n";
print "<table border=0 cellpadding=0 width=600><tr><td align=left width=180>Target Direcrory : </td><td width=420 align=left>" . $url ."</td></tr>";

for ($f=0;$f<10;$f++){
$g = $f+1;
print "<tr><td align=left width=180>Image $g : </td><td width=420 align=left><input type=file class='file' name='images[]'></td></tr>\n";
}
print "<tr><td align=left width=180></td><td width=420 align=left><INPUT TYPE=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000000\"></td></tr>\n";
print "<tr><td align=left width=180></td><td width=420 align=left><input  class='button' type=submit value='Upload Images'></td></tr>\n";
print "</form></table>\n";
}
else {

foreach ($_FILES["images"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
	    $tmp_name = $_FILES["images"]["tmp_name"][$key];
        $name = $_FILES["images"]["name"][$key];
		$uploaddir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$url/$name";
        @copy($tmp_name, $uploaddir);
		$newname = strtolower($name);
		rename("./gallerys/".$url."/$name","./gallerys/".$url."/$newname");
		$timage = "/home/.ornice/tadpole/tadpole.tk/gallerys/$url/$newname";
		$tthumb = "/home/.ornice/tadpole/tadpole.tk/gallerys/$url/tn_$newname";
		createthumb($timage,$tthumb,139,104);
		addchange("Admin Action : Image $newname uploaded successfully");
	}
	else {
		addchange("Admin Action : Error : No file or error on upload ... Aborting...");
		
	}
}
print $redirect;
}

break;




case "moveimage":
if($moveimage && $targetdir){
for($t=0;$t<count($moveimage);$t++){
	$pars = explode("|",$moveimage[$t]);
	$nameoffile = explode("_",$pars[1]);
	$nameof = rawurlencode($nameoffile[1]);
	$filetomove = "mv \"/home/.ornice/tadpole/tadpole.tk/gallerys/$pars[0]/$nameoffile[1]\" \"/home/.ornice/tadpole/tadpole.tk/gallerys/$targetdir/$nameoffile[1]\"";
	$filetomove1 = "mv \"/home/.ornice/tadpole/tadpole.tk/gallerys/$pars[0]/$pars[1]\" \"/home/.ornice/tadpole/tadpole.tk/gallerys/$targetdir/$pars[1]\"";
	$targetdir = rawurlencode($targetdir);
	$target = $targetdir . "%2F";
	$id = returnid($nameof,$pars[0]);
	$fff = $stream->do_query("update shane_gallerys set imagedir='$target' WHERE id='$id'","one");
	shell_exec("$filetomove");
	shell_exec("$filetomove1");
	addchange("Action Action : $nameof moved!");
	print $redirect;
}				
}
else {
adminmenulisting("$case");
}

break;



case "delfolder":
$url = $_GET['url'];
if($url){
addchange("Action Action : Deleted $url");

$target = "rm -rvf \"/home/.ornice/tadpole/tadpole.tk/gallerys/$url/\"";
$crap = shell_exec("$target");
$url = rawurlencode($url);
$t = $stream->do_query("delete from shane_gallerys where imagedir='$url'","one");
print $redirect;
}

break;











case "deleteimage":
if($deleteimage){
adminmenuaction($deleteimage);
print $redirect;
}
else {
adminmenulisting("$case");
}

break;



case "delcomment":
if($delcomment){
adminmenuaction($delcomment);
print $redirect;
}
else {
adminmenulisting("$case");
}

break;


case "editcomment":
if($editcomment){
if($fid){
$editcommnet= rawurlencode($editcommnet);
$update = $stream->do_query("update shane_gallerys set comments='$editcomment' where id='$fid'","one");
addchange("Action Action : Comments updated");
print $redirect;
}
}
else {
adminmenulisting("$case");
}


break;


case "resethits":
if($resethits){
adminmenuaction($resethits);
print $redirect;
}
else {
adminmenulisting("$case");
}

break;




case "disabling":
addchange("Action Action : Attempting to enable / disable the feature : $feature");
disablefeatures($feature);
print $redirect;
break;



}
}
else {
	print "<h3>Security Override</h3>Sorry but you have insufficent priveledges to access this page, please check that you have logged in with the correct credentials and try again";
}

?>