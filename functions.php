<?php

function controlblog($data){

global $stream,$redirect;
	
	if($data=="show"){
		$page = rawurldecode($stream->do_query("select content from shane_pages where name='blog'","one"));
		$chunk = "<form action='index.php?opt=admin&blogger=true' method=post name=fuck>";
		$chunk = $chunk ."<textarea name='blogdata' cols=70 rows=40>";
		$stuff = wordwrap($page, 60, "\n",1);
		$chunk = $chunk . $stuff;
		$chunk = $chunk . "</textarea>";
		$chunk = $chunk ."</form>";
		return $chunk;
	}
	else {
		$data = rawurlencode($data);
		$update = $stream->do_query("update shane_pages set content='$data' where id=1","one");
		addchange("Admin Action : Blog updated!");
		$chunk = "<h3>Blog updated</h3>";
		$page = rawurldecode($stream->do_query("select content from shane_pages where name='blog'","one"));
		$chunk = $chunk ."<form action='index.php?opt=admin&blogger=true' method=post name=fuck>";
		$chunk = $chunk ."<textarea name='blogdata' cols=70 rows=40>";
		$stuff = wordwrap($page, 60, "\n",1);
		$chunk = $chunk . $stuff;
		$chunk = $chunk . "</textarea>";
		$chunk = $chunk ."</form>";
		return $chunk;
	}
}



function addchange($msg){
global $stream;
$time = time();
$sql = $stream->do_query("insert into shane_presults values('','$msg','$time')","one");

}


function show_changes(){
global $stream;
$res = "";
$sql = $stream->do_query("select * from shane_presults order by id Desc","array");
$res .= "All times should be Australia/ACT <br><table cellpadding=2 border=0 width=600>";
for($r=0;$r<count($sql);$r++){
$tmp = $sql[$r];
$id = $tmp[0];
$change = wordwrap($tmp[1],40,"<br>",1);
$time = date(DATE_RFC822,$tmp[2]);
if($r>20) break;
$res .= "<tr><td width=15>$id</td><td width=325>$change</td><td width=250>$time</td></tr>";

}
$res .= "</table>";
return $res;
}



function disabling($case){
global $stream;

$sql = $stream->do_query("select $case from shane_settings where id='1'","one");
if($sql==1){
return 1;
}
else {
return 0;
}
}



function admin_ipblock(){
global $stream;
$data = "";

if($_GET['banip']){
$yyy = $_GET['banip'];
$insert = $stream->do_query("insert into shane_bannedips values('','$yyy')","one");
addchange("Access Control : $yyy Banned!!!!");
}

$logs = $stream->do_query("SELECT * from shane_logging order by views desc","array");
$data .=  "<table cellpadding=0 cellspacing=0 width=600><tr><td>IP</td><td>Port</td><td>Broswer</td><td>Views</td><td>Ban</td></tr>";
for($x=0;$x<count($logs);$x++){
	$tmp = $logs[$x];
	$id = $tmp[0];
	$ip = $tmp[1];
	$browser = $tmp[2];
	$apps = $tmp[3];
	$lang = $tmp[4];
	$port = $tmp[5];
	$views = $tmp[6];
	
	$data .=  "<tr>
	<td><input class='text' type=text name=logip  size=11 width=11 value='$ip'></td> 
	<td><input class='text' type=text size=4 width=4 name=logport value='$port'></td> 
	<td><input class='text' type=text size=15 width=15 name=logbrowser value='$browser'></td> 
	<td><input class='text' type=text size=3 width=3 name=logviews value='$views'></td>  <td><input type=button  onClick=\"document.location.href='index.php?opt=admin&banip=$ip';\" class='button' value='Ban IP'></td> 
	</tr>";
}
$data .=  "</table>";
return $data;
}




function admin_sets(){
$menu = "";
$menu .= "<select class='select'  size=10 name=blah ONCHANGE=\"location = this.options[this.selectedIndex].value;\">";

$menu .= "<option value=''>--- Disable Features ---</option>";
if(checkfeatures("site")=="Enabled"){
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\" ";
}
else {
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:red;\" ";
}
$menu .= "<option value='index.php?opt=admin&case=disabling&page=Site disabling - enabling&feature=site' $css>
   Site " .checkfeatures("site") ."</option>";
   
if(checkfeatures("gallerys")=="Enabled"){
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\" ";
}
else {
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:red;\" ";
}   
$menu .= "<option value='index.php?opt=admin&case=disabling&page=Gallerys disabling - enabling&feature=gallerys' $css>
   Gallerys " .checkfeatures("gallerys") ."</option>";
if(checkfeatures("publicgallerys")=="Enabled"){
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\" ";
}
else {
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:red;\" ";
}   
$menu .= "<option value='index.php?opt=admin&case=disabling&page=Public Gallerys disabling - enabling&feature=publicgallerys' $css>   
Public Gallerys " .checkfeatures("publicgallerys") ."</option>";
if(checkfeatures("uploading")=="Enabled"){
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\" ";
}
else {
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:red;\" ";
}
$menu .= "<option value='index.php?opt=admin&case=disabling&page=Uploading disabling - enabling&feature=uploading' $css>   
Uploading " .checkfeatures("uploading") ."</option>";
if(checkfeatures("makedir")=="Enabled"){
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\" ";
}
else {
$menu .= " STYLE=\"font-family : verdana; font-size : 10pt; color:red;\" ";
}
$menu .= "<option value='index.php?opt=admin&case=disabling&page=Make Directory disabling - enabling&feature=makedir' $css>    
Make Directory " .checkfeatures("makedir") ."</option>";
if(checkfeatures("contact")=="Enabled"){
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\" ";
}
else {
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:red;\" ";
}
$menu .= "<option value='index.php?opt=admin&case=disabling&page=Contact disabling - enabling&feature=contact' $css>   
Contact " .checkfeatures("contact") ."</option>";
if(checkfeatures("guestbook")=="Enabled"){
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\" ";
}
else {
$css = " STYLE=\"font-family : verdana; font-size : 10pt; color:red;\" ";
}
$menu .= "<option value='index.php?opt=admin&case=disabling&page=Guestbook disabling - enabling&feature=guestbook' $css>Guestbook " .checkfeatures("guestbook") ."</option>";


$menu .= "</select>";

return $menu;
}




function adminmenu(){

global $stream,$_SERVER;

$data = explode(":",$_COOKIE['tadpole']);

$userinfo = returnuserinfo($data[0],$data[1]);
$rand = sha1(time());
$data = $_COOKIE['tadpole'];
if($data=="$userinfo"){

$thestuff = "";

$thestuff .= " <table cellpadding=5 width=500 border=0><tr><td align=left><h3>Personal </h3><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\">";
$thestuff .= " <option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Add Images ---- </option>\n";
$thestuff .= admingallerys("addimage");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Move Images ---- </option>\n";
$thestuff .= admingallerys("moveimage");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Delete Images ---- </option>\n";
$thestuff .= admingallerys("deleteimage");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Delete Folder ---- </option>\n";
$thestuff .= admingallerys("delfolder");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Delete Comments ---- </option>\n";
$thestuff .= admingallerys("delcomment");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Edit Comments ---- </option>\n";
$thestuff .= admingallerys("editcomment");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Reset Hits ---- </option>\n";
$thestuff .= admingallerys("resethits");
$thestuff .= " </select></td><td align=left>";
$thestuff .= " <h3>Public </h3><select class='select'   name=imagecontrolp>";
$thestuff .= " <option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Add Images ---- </option>\n";
$thestuff .= adminpublicgallerys("addimage");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Move Images ---- </option>\n";
$thestuff .= adminpublicgallerys("moveimage");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Delete Images ---- </option>\n";
$thestuff .= adminpublicgallerys("deleteimage");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Delete Folder ---- </option>\n";
$thestuff .= adminpublicgallerys("delfolder");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Delete Comments ---- </option>\n";
$thestuff .= adminpublicgallerys("delcomment");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Edit Comments ---- </option>\n";
$thestuff .= adminpublicgallerys("editcomment");
$thestuff .= " </select><br><select class='select'  name=imagecontrol ONCHANGE=\"location = this.options[this.selectedIndex].value;\"><option STYLE=\"font-family : verdana; font-size : 10pt; color:red;\"> ---- Reset Hits ---- </option>\n";
$thestuff .= adminpublicgallerys("resethits");
$thestuff .= " </select></td></tr></table>";
}
else {
$thestuff .= " {|Administration Panel,index.php?opt=admin&page=Administrators Login&p=$rand,_parent}";
}
	return $thestuff;
}





function targetdir(){

print "<br>Target Directory<br><select class='select'  name=targetdir>";
if ($handle = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/')) {

	while (false !== ($file = readdir($handle))){ 
		$dir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$file/";
		if (($file != ".") && ($file != "..")){ 
			//print "{|||$file }\n";
				if ($dh = opendir($dir)) {
	       			 while (($fileg = readdir($dh)) !== false) {
						if ($fileg != "." && $fileg != ".."){ 
							if(!stristr($fileg,".jpg")){
							print "<option value='$file/$fileg'>$file/$fileg</option>\n";	
						}
					}
				}
   			}
			closedir($dh);			
		}
	}	
}		
print "</select><br>";

}


function adminmenulisting($case){

global $stream,$url;

if($case!="editcomment"){
print "<form action='index.php?opt=admin&case=$case&doit=true' method=post><input class='button' type=submit value='$case(s)'><input type=reset class='button'>";
}
if($url){

$crap = explode("/",$url);

$c=0;

if ($handle = opendir("/home/.ornice/tadpole/tadpole.tk/gallerys/$url")) {
while (false !== ($file = readdir($handle))){ 
	if ($file != "." && $file != ".."){ 
 		if(stristr($file,"tn_")){
		$page = explode("_",$file);
		
	$fileimg = explode("_",$file);
	$img = rawurlencode($fileimg[1]);
	
	$shit = $stream->do_query("select * from shane_gallerys where imagename='$img'","array");
	
	for($r=0;$r<count($shit);$r++){
	
	$tmp = $shit[$r];
	$did = $tmp[0];
	$dimage = $tmp[1];
	$ddir = $tmp[2];
	$dcomments = $tmp[3];
	$dhits = $tmp[4];
	
	$idr = "";
	$len = strlen($ddir);
	$ddir = substr($ddir,0,$len-3);
	$dick = rawurlencode($url);
	if($ddir==$dick){
	$fuck = $stream->do_query("SELECT viewedtimes FROM shane_gallerys WHERE id='$did'","one");
	$idr = $did;
	break;
	}
	}
	$comments = "";
	$comments =  rawurldecode(rawurldecode($stream->do_query("SELECT comments FROM shane_gallerys WHERE id='$idr'","one")));
		
if($case=="moveimage"){
$option = "Move <input  class='button' type='checkbox' value='$url|$file' name='moveimage[]'>";
if($c==0){
targetdir();
}
}
if($case=="deleteimage"){
$option = "Delete <input class='button' type='checkbox' value='$url|$file'  name='deleteimage[]'>";
if($c==0){

}
}
if($case=="delcomment"){
$option = "Delete Comment<input type='checkbox' value='$url|$file'  name='delcomment[]'>";
if($c==0){

}
}
if($case=="editcomment"){
if($c==0){

}

$option = "Edit Comment <br><form action='index.php?opt=admin&case=$case&doit=true&fid=$idr' method=post><input type=submit value='$case(s)' class='button'><br><textarea rows=5 cols=40 name='editcomment'>$comments</textarea></form>";
}
if($case=="resethits"){
if($c==0){

}
$option = "Reset hits <input type='checkbox'  value='$url|$file'  name='resethits[]'>";
}

		print " <br>
  <table bgcolor='#BBBBBB' width=90% border=0 cellspacing=0 cellpadding=1>
  <tr><td>$option
	
<table bgcolor='#efefef' width=100% border=0 cellspacing=0 cellpadding=10>
  <tr>
    <td valign=top width=50% bgcolor='#cccccc'><center>
		<a href='image.php?page=$page[1]&p=$rand&file=$url/$file&thumb=$file'><img src='http://www.tadpole.tk/gallerys/$url/$file' border=0></a><br>
	
	<a href='image.php?page=$page[1]&p=$rand&file=$url/$file'> Click image to enlarge</a><a name='$file'>&nbsp;</a>
	
	";
	
		
	print "</td>
	<td bgcolor'#dddddd' valign=middle width=50%>";
	$url = rawurlencode($url);
	$fileimg = explode("_",$file);
	$img = rawurlencode($fileimg[1]);
	
	$shit = $stream->do_query("select * from shane_gallerys where imagename='$img'","array");
	
	for($r=0;$r<count($shit);$r++){
	
	$tmp = $shit[$r];
	$did = $tmp[0];
	$dimage = $tmp[1];
	$ddir = $tmp[2];
	$dcomments = $tmp[3];
	$dhits = $tmp[4];
	
	$len = strlen($ddir);
	$ddir = substr($ddir,0,$len-3);
	if($ddir==$url){
	$fuck = $stream->do_query("SELECT viewedtimes FROM shane_gallerys WHERE imagename='$img'","one");
	$idr = $stream->do_query("SELECT id FROM shane_gallerys WHERE imagename='$img'","one");
	break;
	}
	
	}
	if($fuck==""){
	$fuck = 0;
	}
	
	$comments =  $stream->do_query("SELECT comments FROM shane_gallerys WHERE id='$idr'","one");
	if(stristr($comments,"Name")){
	print "<a href='image.php?page=$page[1]&p=$rand&file=$url/$file#comments'>Comments Available</a><br>";
	}
	else {
	print "<a href='image.php?page=$page[1]&p=$rand&file=$url/$file#comments'>Add Comment</a><br>";
	}
	
	print "viewed $fuck time(s)";
	$url = rawurldecode($url);
	$fuck = "";
	$comments = "";
	$c++;
	print "
	</td>
  </tr>
</table>
	</td>
  </tr>
</table>";
	

}
}
}	
}	
if($case!="editcomment"){
print "</form>";
}
}



}


function adminpublicgallerys($case){


if ($handle = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/')) {
$thestuff = "";
	while (false !== ($file = readdir($handle))){ 
		$dir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$file/";
		if (($file != ".") && ($file != "..") && (stristr($dir,"public"))){ 
				if ($dh = opendir($dir)) {
	       			 while (($fileg = readdir($dh)) !== false) {
						if ($fileg != "." && $fileg != ".."){ 
							if(!stristr($fileg,".jpg")){
							$rand = sha1(time());
							$newdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$file/$fileg/";
							$num=0;
									if ($newdir = opendir($newdir)) {
										while (($filegg = readdir($newdir)) !== false) {
											if ($filegg != "." && $filegg != ".."){ 
												if(stristr($filegg,".")){
														$num++;
												}
											}
										}
									}	
										$num = $num /2;
							$thestuff .= "<option value=\"index.php?opt=admin&p=$rand&page=$fileg&case=$case&url=$file/$fileg\">$fileg [$num]</option>\n";	
						}
					}
				}
   			}
			closedir($dh);			
		}
	}	
}		

return $thestuff;
}


function admingallerys($case){
$thestuff = "";
if ($handle = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/')) {

	while (false !== ($file = readdir($handle))){ 
		$dir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$file/";
		if (($file != ".") && ($file != "..") && (!stristr($dir,"public"))){ 
			$thestuff .= "<option  STYLE=\"font-family : verdana; font-size : 10pt; color:blue;\">Cat : $file</option>";
				if ($dh = opendir($dir)) {
	       			 while (($fileg = readdir($dh)) !== false) {
						if ($fileg != "." && $fileg != ".."){ 
							if(!stristr($fileg,".")){
							$rand = sha1(time());
							$newdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$file/$fileg/";
							$num=0;
									if ($newdir = opendir($newdir)) {
										while (($filegg = readdir($newdir)) !== false) {
											if ($filegg != "." && $filegg != ".."){ 
												if(stristr($filegg,".")){
														$num++;
												}
											}
										}
									}	
										$num = $num /2;
							$thestuff .=  "<option value='index.php?opt=admin&p=$rand&page=$fileg&case=$case&url=$file/$fileg'> --- $fileg [$num]</option>\n";	
					
						}
					}
				}
   			}
			closedir($dh);			
		}
	}	
}	

return $thestuff;
}


function quickjump(){
$thestuff .= "<select class='select'  name=quickjump ONCHANGE=\"location = this.options[this.selectedIndex].value;\">";
if ($handle = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/')) {
	while (false !== ($file = readdir($handle))){ 
		$dir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$file/";
		if (($file != ".") && ($file != "..")){ 
$thestuff .= "<option  STYLE=\"font-family:verdana;font-size:8pt;color:#005588;background-color:#ffffff;\">Category : $file</option>";
				if ($dh = opendir($dir)) {
	       			 while (($fileg = readdir($dh)) !== false) {
						if ($fileg != "." && $fileg != ".."){ 
							if(!stristr($fileg,".")){
							$rand = sha1(time());
							$newdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$file/$fileg/";
							$num=0;
							$th = 0;
									if ($newdir = opendir($newdir)) {
										while (($filegg = readdir($newdir)) !== false) {
											if ($filegg != "." && $filegg != ".."){ 
												if(stristr($filegg,".")){
														$num++;
														if(($th==0) && (stristr($filegg,"tn_"))){
															$thum = $filegg;
															$th++;
														}
												}
											}
										}
									}	
										$num = $num /2;
$thestuff .=  "<option style=\"background-image:url('$file/$fileg/$thum');height:30;padding-left: 40px;background-repeat:no-repeat;\" value='gallerys.php?page=$fileg&url=$file/$fileg'> --- $fileg [$num]</option>\n";	
					
						}
					}
				}
   			}
			closedir($dh);			
		}
	}	
}		
$thestuff .= "</select>";
return $thestuff;
}

function checkcookie(){

global $stream,$_SERVER,$_COOKIE;
$data = explode(":",$_COOKIE['tadpole']);
$userinfo = explode(":",returnuserinfo($data[0],$data[1]));

if(($data[0]==$userinfo[0]) && ($data[1]==$userinfo[1])){
	return 1;
}
else {
	header("Location:index.php?opt=login");
	exit;
	
}
return 0;
}






function disablecookie(){
global $_COOKIE;
$data = "";
setcookie("tadpole", $data, time()-3600, "/", ".tadpole.tk");
if(getrank()==5){
	addchange("User Tracking : Logged out!");
}
header("Location: http://www.tadpole.tk/index.php?opt=login");
}



function returnuserinfo($name,$pass){

global $stream;
$userd = $stream->do_query("select username,password from shane_users where username='$name' AND password='$pass'","array");
for($d=0;$d<count($userd);$d++){
$tmp = $userd[$d];
$u = $tmp[0];
$p = $tmp[1];
break;
}
$userinfo = "$u:$p";
return $userinfo;
}


function cookiestuff($tadpolename,$tadpolepass){
global $stream;
$tadpolename = rawurlencode($tadpolename);
$tadpolepass = sha1($tadpolepass);
$userinfo = explode(":",returnuserinfo($tadpolename,$tadpolepass));
$cookietime = $stream->do_query("select cookietime from shane_users where username='$tadpolename'","one");
$data = "$userinfo[0]:$userinfo[1]";
	if(($tadpolename==$userinfo[0]) && ($tadpolepass==$userinfo[1])){
		if(setcookie("tadpole", $data, time()+$cookietime, "/", ".tadpole.tk")){
			if(getrank()==5){
				addchange("User Tracking : $userinfo[0] Logged in!");
				header("Location: http://www.tadpole.tk/index.php?opt=admin");
			}
			elseif (getrank()==2){
				header("Location: http://www.tadpole.tk/index.php?opt=myprofile");	
			}
			else {
				header("Location: http://www.tadpole.tk/index.php?opt=myprofile");
			}
			exit;
		}
		else {
			/* Sorry, your credentials are wrong */
		}
	}
	else {
	}
return;	
	
}


function loginform($auth){
if($auth=="no"){
print "Authentication Failed";
}
print "
	<form method='POST' action='index.php?opt=login'>
	<br><br>
	<center><h3>Login </h3> 
	  <Center>
	    <table border='0' width='auto'>
	    <tr>
	      <td>Username : </td>
	      <td><input class='text' type='text' name='tadpolename' size='20'></td>
	     </tr>
	    <tr>
	      <td>Password : </td>
	      <td><input class='text' type='password' name='tadpolepass' size='20'></td>
	    </tr>
	  
	<tr><td></td><td>
	<p><input class='button' type='submit' value='Submit' name='sub'>
	<input type='reset' class='button' value='Reset' name='res'></p>
	</td></tr></table>
	</form>";
}



function disablefeatures($thething){
global $stream;

$sql = $stream->do_query("select $thething from shane_settings where id='1'","one");

if($sql==1){
$sql = "update shane_settings set $thething='0' where id='1'";
$sql = $stream->do_query($sql,"one");
addchange("Feature management : $thething disabled");
}
else {
$sql = "update shane_settings set $thething='1' where id='1'";
$sql = $stream->do_query($sql,"one");
addchange("Feature management : $thething Enabled");
}
}


function checkfeatures($thething){
global $stream;

$sql = $stream->do_query("select $thething from shane_settings where id='1'","one");

if($sql==1){
$msg = "Enabled";
return $msg;
}
else {
$msg = "Disabled";
return $msg;
}
}



function notice(){
global $stream;
$site = $stream->do_query("select site from shane_settings where id='1'","one");
if($site==0){
$sql = $stream->do_query("select notice2 from shane_settings where id='1'","one");
return $sql;
}
else {
$sql = $stream->do_query("select notice from shane_settings where id='1'","one");
return $sql;
}
}


function sitedisabled(){
global $stream;

$sql2 = $stream->do_query("select site from shane_settings where id='1'","one");

if($sql2==0){
print notice();

print "
	<form method='POST' action='enable.php?enable=true'>
	<br><br>
	<center><h1>Administrator password</h1> 
	  <Center>
	    <table border='0' width='auto'>
	      <tr>
	      <td width='33%'>Password</td>
	      <td width='33%'><input  class='text' type='password' name='passg' size='20'></td>
	      <td width='34%'></td>
	    </tr>
	  </table>
	<center>
	<p><input  class='button' type='submit' value='Submit'>
	</p>
	</center>
	</form>";

include("footer.php");
die();

}
}




function returnid($nameof,$pars){
global $stream;

$shit = $stream->do_query("select * from shane_gallerys where imagename='$nameof'","array");
	
		for($r=0;$r<count($shit);$r++){
	addchange("Selecting files");
		$tmp = $shit[$r];
		$id = $tmp[0];
		$image = $tmp[1];
		$dir = $tmp[2];
		$comments = $tmp[3];
		$hits = $tmp[4];
	
	$dirnamedb = substr("$dir", 0, strlen($dir)-3);
	$dirname = rawurlencode($pars);
	addchange("$dir <br> $dirname <br>");
		
		if($dirnamedb==$dirname){
		
			return $id;
			break;
		}
	}
	return 0;
}


function adminmenuaction($thecase){
addchange("Image Control : See Above");
global $stream,$deleteimage,$resethits,$delcomment,$editcomment;

for($l=0;$l<count($thecase);$l++){

	$pars = explode("|",$thecase[$l]);
	$nameoffile = explode("_",$pars[1]);
	$nameof = rawurlencode($nameoffile[1]);
	$filedelete = "rm -rvf \"/home/.ornice/tadpole/tadpole.tk/gallerys/$pars[0]/$pars[1]\"";
	$filedelete1 = "rm -rvf \"/home/.ornice/tadpole/tadpole.tk/gallerys/$pars[0]/$nameoffile[1]\"";
	$id = returnid($nameof,$pars[0]);
		
				
		if($id){
			if($deleteimage){
				$fff = $stream->do_query("delete FROM shane_gallerys WHERE id='$id'","one");
				shell_exec("$filedelete");
				shell_exec("$filedelete1");
				addchange("Admin Action : $nameof deleted");
			}
			if($resethits){
				$fff = $stream->do_query("update shane_gallerys set viewedtimes='0' WHERE id='$id'","one");
				addchange("Admin Action : Hit Count updated for $thecase[$l]");
			}
			if($delcomment){
				$fff = $stream->do_query("update shane_gallerys set comments='' WHERE id='$id'","one");
				addchange("Admin Action : Comments deleted for $thecase[$l]");
			}
			if($editcomment){
				$fff = $stream->do_query("update shane_gallerys set comments='' WHERE id='$id'","one");
				addchange("Admin Action : Comments edited for $thecase[$l]");
			}
		}
	}
}



function createthumb($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	$num = count($system) -1;
	print $system[$num];
	if (preg_match('/jpg|jpeg/',$system[$num])){
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/',$system[$num])){
		$src_img=imagecreatefrompng($name);
	}
	
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y) {
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	
	if (preg_match("/png/",$system[$num])){
		imagepng($dst_img,$filename); 
	} else {
		imagejpeg($dst_img,$filename); 
	}
	imagedestroy($dst_img); 
	imagedestroy($src_img); 
}

function imageinfo($what){
$data = "";
	$exif = @exif_read_data("$what", 'IFD0');
	if(!$exif===false){
		$exif = exif_read_data("$what", 0, true);
		foreach ($exif as $key => $section) {
		
		
  			 foreach ($section as $name => $val) {
			 
			 if("$key.$name"=="EXIF.DateTimeOriginal"){
			 		$data .= "Date taken : " .$val . "<br>";
			 }
			 if("$key.$name"=="EXIF.FocalLength"){
			 		$data .= "Focal Lenght : " .$val . "<br>";
			 }
			 if("$key.$name"=="EXIF.DigitalZoomRatio"){
			 		$data .= "Digital Zoom : " .$val . "<br>";
			 }
			 if("$key.$name"=="EXIF.ExposureTime"){
			 		$data .= "Exposure Time : " .$val . "<br>";
			 }
			  if("$key.$name"=="COMPUTED.ExposureTime"){
			 		$data .= "Exposure Time : " .$val . "<br>";
			 }
			 if("$key.$name"=="IFD0.ImageDescription"){
			 		$data .= "Image Info : " .$val . "<br>";
			 }
			 if("$key.$name"=="EXIF.ISOSpeedRatings"){
			 		$data .= "Iso : " .$val . "<br>";
			 }
			 if("$key.$name"=="IFD0.Make"){
			 		$data .= "Camera Make : " .$val . "<br>";
			 }
			 if("$key.$name"=="IFD0.Model"){
			 		$data .= "Camera Model : " .$val . "<br>";
			 }
			
			
			 			 			 
       		//echo "$key.$name: $val<br />\n";
   			}
		}
	}
	
	if(strlen($data)>0){
		return $data;
	}
	else {
		return "No information available!";
	}	
}



	function check_tags($data, $allowed){
		$data = preg_replace("/<(.*?)>/e",
			"process_tag(StripSlashes('\\1'), \$allowed)",
			$data);
		$data = str_replace('javascript:','#',$data);
		return $data;
	}


	function process_tag($data, $allowed){

		# ending tags
		if (preg_match("/^\/([a-z0-9]+)/i", $data, $matches)){
			$name = StrToLower($matches[1]);
			if (in_array($name, array_keys($allowed))){
				return '</'.$name.'>';
			}else{
				return '';
			}
		}

		# starting tags
		if (preg_match("/^([a-z0-9]+)(.*?)(\/?)$/i", $data, $matches)){
			$name = StrToLower($matches[1]);
			$body = $matches[2];
			$ending = $matches[3];
			if (in_array($name, array_keys($allowed))){
				$params = "";
				preg_match_all("/([a-z0-9]+)=\"(.*?)\"/i", $body, 
					$matches_2, PREG_SET_ORDER);
				preg_match_all("/([a-z0-9]+)=([^\"\s]+)/i", $body,
					$matches_1, PREG_SET_ORDER);
				$matches = array_merge($matches_1, $matches_2);
				foreach($matches as $match){
					$pname = StrToLower($match[1]);
					if (in_array($pname, $allowed[$name])){
						$params .= " $pname=\"$match[2]\"";
					}
				}
				return '<'.$name.$params.$ending.'>';
			}else{
				return '';
			}
		}

		# garbage, ignore it
		return '';
	}

function getrank(){

global $stream,$_SERVER,$_COOKIE;
$data = explode(":",$_COOKIE['tadpole']);
$userinfo = $stream->do_query("select rank from shane_users where username='$data[0]' AND password='$data[1]'","one");
return $userinfo;

}

function getuser(){

global $stream,$_SERVER,$_COOKIE;
$data = explode(":",$_COOKIE['tadpole']);
return $data[0];
}

?>
