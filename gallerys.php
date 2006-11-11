<?php
include("connect.php");
include("functions.php");
include("header.php");


sitedisabled();
	$url = $_GET['url'];
	$page = $_GET['page'];
	$p = $_GET['p'];

if(checkfeatures("gallerys")=="Enabled")
{
	if($url)
	{
		$crap = explode("/",$url);
		if(($_GET['vote']) && ($_GET['rated']))
		{
			$voteid = trim($_GET['vote']);
			$l = trim($_GET['rated']);
			$total = $stream->do_query("SELECT total FROM shane_gallerys WHERE id='$voteid'","one");
			$votes = $stream->do_query("SELECT votes FROM shane_gallerys WHERE id='$voteid'","one");
			$votes = $votes + 1;
			$total = $total + $l;
			$update = $stream->do_query("UPDATE shane_gallerys set total='$total', votes='$votes' WHERE id='$voteid'","one");
			$ratingmsg = "<b>Thanks for your rating!</b>";
		}

		$qw = 0;
		if ($handle = opendir("/home/.ornice/tadpole/tadpole.tk/gallerys/$url")) 
		{
			print "<center><h3>$url</h3>Jump to album : ".quickjump();
			print "<table cellpadding=0 cellspacing=10 border=0 width=800><tr>";
			$bgcolor = "#bbbbbb";
			while (false !== ($file = readdir($handle)))
			{ 
				if ($file != "." && $file != "..")
				{ 
 					if(stristr($file,"tn_"))
					{
						$page = explode("_",$file);
						$comments = "";
						$info = "";
						$ifo = explode("<br>",imageinfo("gallerys/$url/$file"));
						for($c=0;$c<count($ifo);$c++)
						{
							$crapg = explode(":",$ifo[$c]);
							if(stristr($crapg[0],"Date"))
							{
								$crg = explode(" ",$crapg[3]);
								$thingy = substr($file,3,strlen($file));
								$info = "$thingy taken on  $crapg[2] $crg[0] $crapg[1]  @ $crg[1]:$crapg[4]";
								break;
							}
						}
				
						if($qw%2>0)
						{
							$bgcolor = "#bbbbbb"; 
						}
						else {
							print "</tr><tr>";
							$bgcolor = "#bbbbbb"; 
						}
						
						print "<td>";
						
						print "<center><table bgcolor='#999999' width=350 border=0 cellspacing=0 cellpadding=1><tr><td>";
						print "<table bgcolor='#efefef' width=350 border=0 cellspacing=0 cellpadding=10><tr>";
						print "<td valign=top width=55% bgcolor='$bgcolor'><a name='$file'>&nbsp;</a><center>";
						print "<a href='image.php?page=$page[1]&p=$rand&file=$url/$file&thumb=$file'>";
						print "<img src='http://www.tadpole.tk/gallerys/$url/$file' border=0 title='$info' alt='$info'></a><br>";
						print "<a href='image.php?page=$page[1]&p=$rand&file=$url/$file'> Click image to enlarge</a>";
						print "</td><td bgcolor'#dddddd' valign=middle width=45%>";
						
						$url = rawurlencode($url);
						$fileimg = explode("_",$file);
						$img = rawurlencode($fileimg[1]);
						$shit = $stream->do_query("select * from shane_gallerys where imagename='$img'","array");
	
						for($r=0;$r<count($shit);$r++)
						{
							$avgg = "";
							$tmp = $shit[$r];
							$did = $tmp[0];
							$dimage = $tmp[1];
							$ddir = $tmp[2];
							$dcomments = $tmp[3];
							$dhits = $tmp[4];
							$dvotes = $tmp[5];
							$dtotal = $tmp[6];
							if($dvotes!=0)
							{
								$avgg = "Rating ";
								$roun = round($dtotal / $dvotes);
									for($th=0;$th<$roun;$th++)
									{
										$avgg .= " <img src='images/star.gif'>";
									}
							}
							else {
								$avgg = "";
							}
	
							$len = strlen($ddir);
							$ddir = substr($ddir,0,$len-3);
							if($ddir==$url){
								$fuck = $stream->do_query("SELECT viewedtimes FROM shane_gallerys WHERE imagename='$img'","one");
								$idr = $stream->do_query("SELECT id FROM shane_gallerys WHERE imagename='$img'","one");
								break;
							}
	
						}
						
						if($fuck=="")
						{
							$fuck = 0;
						}
	
						$comments =  rawurldecode(rawurldecode($stream->do_query("SELECT comments FROM shane_gallerys WHERE id='$idr'","one")));
						if(stristr($comments,"Name"))
						{
							$ptt = explode("<br>",$comments);
							$ppp = round(count($ptt)/5);
							$lastc = explode("<br>",$ptt[$ppp]);
							$lastc = substr($lastc[0],8,strlen($lastc[0]));
							print "<a href='image.php?page=$page[1]&p=$rand&file=$url/$file' title='Last Poster $lastc'>Comments Available [$ppp]</a><br>";
						}
						else {
							print "<a href='image.php?page=$page[1]&p=$rand&file=$url/$file' title='Why not make a comment!'>Add Comment</a><br>";
						}
	
						print "Viewed $fuck time(s)<br> $avgg <br> ";
	
						if($did==trim($_GET['vote']))
						{
							print $ratingmsg;
						}
	
						$url = rawurldecode($url);
						$fuck = "";
						$comments = "";
						print "</td></tr></table></td></tr></table>";
						print "</td>";
						
						$qw++;
					}
				}
			}
		}	
	}
	print "</tr></table>";
}
else {
	print notice();
}

include("footer.php");
?>
