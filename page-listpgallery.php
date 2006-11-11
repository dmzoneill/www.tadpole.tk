<?php


		if ($album = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/Public/')) 
		{
			$filescount = 0;
			$albumscount = 0;
			
			while (false !== ($alb = readdir($album)))
			{ 
				if((stristr($alb,".")) || (stristr($alb,".."))){ continue; } 
				$albumscount++;
				$albdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/Public/$alb/";
				if ($files = opendir($albdir)) 
				{
					while (false !== ($file = readdir($files)))
					{
					
						$filescount++;
					} 
				}
				closedir($files);
			}
		}
		closedir($album);	
	$filescount = round($filescount / 2);
print "<h3>$albumscount Albums / $filescount pictures</h3>";


		$catdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/Public/";
		print "<table cellpadding=3 cellspacing=0 border=0 width=800><tr>\n";
		if ($album = opendir($catdir)) 
		{
			$break = 0;
			while (false !== ($alb = readdir($album)))
			{ 
				if((stristr($alb,".")) || (stristr($alb,".."))){ continue; } 
				$albumscount++;
				$albdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/Public/$alb/";
				$onlyonethumb = 0;
				
				if ($files = opendir($albdir)) 
				{
					while (false !== ($file = readdir($files)))
					{
						if((stristr($file,"tn_")) && ($onlyonethumb<1)){
							$name = substr($alb,0,20);
							print "<td><div class='album' align=left><a href='http://www.tadpole.tk/gallerys.php?page=$alb&url=Public/$alb'><img src='gallerys/Public/$alb/$file'  title='Click to browse this gallery' width=100 border=0></a><br>$name ...</div></td>\n";
							
							$onlyonethumb++;
						}	
						$filescount++;
					} 
				}
				$break++;
				if($break>5){
					print "</tr></table><table cellpadding=3 cellspacing=0 border=0 width=600><tr>\n";
					$break = 0;
				}
				closedir($files);
			}
		}
		if($break<6){
			for ($u=5;$u>=$break;$u--){
					print "<td><div class='album'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>\n";
			}
		}
		print "</tr></table></div>\n";
		closedir($album);	
	

?>