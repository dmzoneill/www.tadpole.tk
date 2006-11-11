<?php



function randomimage()
{
	global $stream;
	$dirs = array();
	if ($handle = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/')) 
	{
		while (false !== ($file = readdir($handle)))
		{ 
			if(($file==".") or ($file=="..")){
				continue;
			}
			else 
			{
				if($file=="Public")
				{
					continue;
				}
				else 
				{
					array_push($dirs,$file);
				}
			}
		}
	}

	$crap = count($dirs) -1;
	$fed = rand(1, $crap);
	$dirs1 = array();
	$filth = "/home/.ornice/tadpole/tadpole.tk/gallerys/$dirs[$fed]/";

	if ($handle = opendir("$filth")) 
	{
		while (false !== ($file = readdir($handle)))
		{ 
			if(($file==".") or ($file=="..")){
				continue;
			}
			else 
			{
				array_push($dirs1,$file);
			}
		}
	}


	$crap1 = count($dirs1) -1;
	$fed1 = rand(0, $crap1);
	$img = array();
	$filth = "/home/.ornice/tadpole/tadpole.tk/gallerys/$dirs[$fed]/$dirs1[$fed1]/";

	if ($handle = opendir("$filth")) 
	{
		while (false !== ($file = readdir($handle)))
		{ 
			if(($file==".") or ($file==".."))
			{
				continue;
			}
			else 
			{
				if(stristr($file,"_"))
				{
					array_push($img,$file);
				}
			}
		}
	}

	$crap2 = count($img) -1;
	$fed2 = rand(0, $crap2);

	print "<br><br><table width=\"90%\" bgcolor='#cccccc' border=\"0\" cellspacing=\"0\" cellpadding=\"1\">";
	print "<tr><td><table width=\"100%\" bgcolor='#ffffff' border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";

	$fuck = explode("_",$img[$fed2]);
	$url = rawurlencode("$dirs[$fed]/$dirs1[$fed1]/");
	$imgg = rawurlencode("$fuck[1]");
	$comments =  rawurldecode(rawurldecode($stream->do_query("SELECT comments FROM shane_gallerys WHERE imagedir='$url' and imagename='$imgg'","one")));

	if(stristr($comments,"<hr>"))
	{
		$comments2 = explode(":",$comments);
		$dik =$comments2[3];
	}
	else 
	{
		$comments = "<br><a href='http://www.tadpole.tk/image.php?page=$fuck[1]&file=$dirs[$fed]/$dirs1[$fed1]/$img[$fed2]#comments'>Get your comment in first</a>";
		$dik = $comments;
	}
	print "<center>Random Image<br>";
	print "<a href='image.php?page=$fuck[1]&file=$dirs[$fed]/$dirs1[$fed1]/$img[$fed2]&thumb=$img[$fed2]'>";
	print "<img src='http://www.tadpole.tk/gallerys/$dirs[$fed]/$dirs1[$fed1]/$img[$fed2]' border=0></a>";
	print $dik ."</td></tr></table></td></tr></table>";

}

$ttya = $_GET['opt'];
$ttyb = $_SERVER['PHP_SELF'];

if($ttyb!="/image.php")
{
	if($ttya!="login")
	{
		if($ttya!="admin")
		{
			if($ttyb!="/gallerys.php") 
			{
				if($ttya!="listgallery") 
				{ 
					if($ttya!="listpgallery")
					{
						randomimage();
					}	
				}
			}
		}
	}
}


?>