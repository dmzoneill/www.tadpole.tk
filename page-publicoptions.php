<?php


if(checkfeatures("makedir")=="Enabled"){
 $rand = sha1(time());
$mkdir = $_POST['mkdir'];
print "<div align=center><h3>Album Options</h3><table width=\"400\"  border=\"0\" cellpadding=\"2\"><tr>
    <td align=left>Album Name</td><td align=left><form action='index.php?opt=publicoptions' method=post><input class='text' type=text name='mkdir'></td></tr><tr><td></td><td align=left><input class='button' type=submit value='Make Album'></form></td></tr>";
  
if($mkdir){
$mkdir = stripslashes($mkdir);
  	$dirname = "mkdir \"/home/.ornice/tadpole/tadpole.tk/gallerys/Public/$mkdir\"";
  	$dirname2 = "chmod 777 \"/home/.ornice/tadpole/tadpole.tk/gallerys/Public/$mkdir\"";
  	$dirmake = shell_exec($dirname);
  	$dirmakeg = shell_exec($dirname2);

  	if(strlen($dirmake)>0){
  		$msg = "<font color=red>Error : Unable to create directory '$mkdir'</font>";
  	}
  	else {
  		$msg = "Created Album '$mkdir'</font>";
 	 }
  	print "<tr><td>Result</td><td>$msg</td></tr>";
}

print "</table>";

}

if(checkfeatures("uploading")=="Enabled"){

$page = $_GET['page'];
$uploadit = $_GET['uploadit'];
$images = $_FILES['images'];
$MAX_FILE_SIZE = $_POST['MAX_FILE_SIZE'];
$updir = $_POST['updir'];

if(!$images){
print "<h3>Upload pictures to an album</h3><table border=0 cellpadding=2 width=400><form name='main' action=\"index.php?opt=publicoptions&page=Uploading&uploadit=true\" enctype=\"multipart/form-data\" method=\"post\">\n";
print "<tr><td width=160 align=left>Target Album :</td><td width=240 align=left><select class='select'  name=updir>\n";

if ($handle = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/Public/')) {
while (false !== ($file = readdir($handle))){ 
if(($file==".") or ($file=="..")){
continue;
}
else {
print "<option value=\"$file\">$file</option>";	
}
}
}
print "</select></td></tr><table border=0 cellpadding=2 width=400><tr>\n";
for ($f=0;$f<10;$f++){
$g = $f+1;
print "<tr><td width=160 align=left>Image $g : </td><td align=left width=240><input type=file class='file' name='images[]'></td></tr>\n";
}
print "<tr><td colspan=2><INPUT TYPE=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000000\"></td></tr>\n";
print "<tr><td></td><td align=left><input  class='button' type=submit value='Upload Images'></td></tr>\n";
print "</form></table></div>\n";
}
else {


$max_files=count($images);




foreach ($_FILES["images"]["error"] as $key => $error) {
    if(!$_FILES["images"]["name"][$key]==""){
		if ($error == UPLOAD_ERR_OK) {
		   	$tmp_name = $_FILES["images"]["tmp_name"][$key];
        	$name = $_FILES["images"]["name"][$key];
			$uploaddir = "/home/.ornice/tadpole/tadpole.tk/gallerys/Public/". $updir ."/$name";
        	@copy($tmp_name, $uploaddir);
			$newname = strtolower($name);
			rename("./gallerys/Public/". $updir ."/$name","./gallerys/Public/". $updir ."/$newname");
			$timage = "/home/.ornice/tadpole/tadpole.tk/gallerys/Public/". $updir ."/$newname";
			$tthumb = "/home/.ornice/tadpole/tadpole.tk/gallerys/Public/". $updir ."/tn_$newname";
			createthumb($timage,$tthumb,139,104);
			print "<font class='dick'>Image " .$newname ."uploaded successfully</font><br>";
	   	}
		else {
			print ("<br><font class='dick'>Error : No file or error on upload ... Aborting...</font><br>");
		}
	}
	else {
		print "";
	}	
}

}
}
