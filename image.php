<?php
include("connect.php");
include("functions.php");
include("header.php");


$file = $_GET['file'];
$url = $_GET['url'];
$page = $_GET['page'];
$dir = $_GET['dir'];
$id = $_GET['id'];
$img = $_GET['img'];
$p = $_GET['p'];
$thumb = $_GET['thumb'];
$person = $_POST['person'];
$email = $_POST['email'];
$msg = $_POST['msg'];

sitedisabled();
if(checkfeatures("gallerys")=="Enabled")
{
	if(isset($id))
	{
		include("image-addcomment.php");
	}

	if($file)
	{
		$file = explode("tn_",$file);
		$dir = rawurlencode($file[0]);
		$img = rawurlencode($file[1]);
		$timesg = $stream->do_query("SELECT viewedtimes FROM shane_gallerys WHERE imagedir='$dir' AND imagename='$img'","one");
		if($timesg=="")
		{
			$inserts = $stream->do_query("INSERT INTO shane_gallerys values('','$img','$dir','','0','0','0')","one");
			$timesg="0";
		}
		$newnum = $timesg + 1;	
		$times = $stream->do_query("UPDATE shane_gallerys set viewedtimes='$newnum' WHERE imagedir='$dir' AND imagename='$img'","one");
		$len = strlen($file[0]) -1;
		$shitty = substr($file[0],0,$len);
		$backurl = $shitty;
		$backthumb = $thumb;
		
		print "<div align=center id='mimage'><center><a href='gallerys.php?url=$shitty&p=$rand&page=Gallery#$thumb'>";
		print "<img src='http://www.tadpole.tk/gallerys/$file[0]$file[1]' title='Click to go back!' alt='Click to go back!' width=550 border=0>";
		print "</a></center><br>";
	
		$ddddd = $stream->do_query("SELECT id FROM shane_gallerys WHERE imagedir='$dir' AND imagename='$img'","one");

		print "<form action=image.php?vote=ddddd method=post>Rate this photo :"; 
		print "<input type=radio name=rated value=1 onClick=\"go('gallerys.php?vote=$ddddd&rated=1&url=$backurl&page=Gallery#$backthumb');\"> 1 "; 
		print "<input type=radio name=rated value=2 onClick=\"go('gallerys.php?vote=$ddddd&rated=2&url=$backurl&page=Gallery#$backthumb');\"> 2 "; 
		print "<input type=radio name=rated value=3 onClick=\"go('gallerys.php?vote=$ddddd&rated=3&url=$backurl&page=Gallery#$backthumb');\"> 3 "; 
		print "<input type=radio name=rated value=4 onClick=\"go('gallerys.php?vote=$ddddd&rated=4&url=$backurl&page=Gallery#$backthumb');\"> 4 "; 
		print "<input type=radio name=rated value=5 onClick=\"go('gallerys.php?vote=$ddddd&rated=5&url=$backurl&page=Gallery#$backthumb');\"> 5 </form>";

		$infos = imageinfo("./gallerys/$file[0]/$file[1]");

		print "</div>";
	}

	print "<div id='minfo' align=left>$infos</div>";

	$comments = stripslashes(rawurldecode(rawurldecode($stream->do_query("SELECT comments FROM shane_gallerys WHERE imagedir='$dir' AND imagename='$img'","one"))));
		
	if(strlen($comments)<4)
	{
		$comments = "No comments available<br><br><a href=\"javascript:switchid('mpost');\">Add yours now!</a>";
	}
	else 
	{
		$comments = "<a href=\"javascript:switchid('mpost');\">Add your comments now!</a><br><br>" . $comments;
	}
		
	$id = $stream->do_query("SELECT id FROM shane_gallerys WHERE imagedir='$dir' AND imagename='$img'","one");

	print "<div id='mcomments' align=left>$comments</div>";
	print "<div id='mpost' align=left>";
	print "<form action='image.php?url=$file&page=edit&dir=$dir&img=$img&id=$id&wheretogo=$id' method=post>";
	print "Person<br><input class='text' type=text name=person><br>Email<br><input class='text' type=text name=email><br>";
	print "Comment<br><textarea cols=40 rows=8 name=msg></textarea><br>";
	print "<input class='button' type=submit value='Post Comment'></form></div>";
	print "<div id='mfriend' align=left></div>";

}
else 
{
	print notice();
}

include("footer.php");
?>