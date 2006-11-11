<?php

$a_imgs = array();
$a_hrefs = array();
$a_info = array();
$a_comments = array();

	if($file)
	{
		$file = explode("/tn_",$file);
		$url = $file[0];
		$qw = 0;
		if ($handle = opendir("/home/.ornice/tadpole/tadpole.tk/gallerys/$url")) 
		{
			while (false !== ($file = readdir($handle)))
			{ 
				if ($file != "." && $file != "..")
				{ 
 					if(stristr($file,"tn_"))
					{
						$page = explode("_",$file);
									
						array_push($a_imgs,"http://www.tadpole.tk/gallerys/$url/$file");
						array_push($a_hrefs,"image.php?page=$page[1]&p=$rand&file=$url/$file&thumb=$file");				
										
						$url = rawurlencode($url);
						$fileimg = explode("_",$file);
						$img = rawurlencode($fileimg[1]);
						$shit = $stream->do_query("select * from shane_gallerys where imagename='$img'","array");
						
						$info = imageinfo("gallerys/$url/$file");
						
						array_push($a_info,$info);
						
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
						array_push($a_comments,$comments);
	
						
						$url = rawurldecode($url);
						$fuck = "";
						$comments = "";
									
						$qw++;
					}
				}
			}
		}	
	}
	
	if(count($a_imgs)>0)
	{
	
		for($e=0;$e<count($a_imgs);$e++)
		{
		
			print "";
		
		}
	
	}
	
?>