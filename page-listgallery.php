<?php


if ($category = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/')) 
{
	$filescount = 0;
	$albumscount = 0;
	$categorycount = 0;
	while (false !== ($cat = readdir($category)))
	{ 
		if((stristr($cat,".")) || (stristr($cat,"..")) || (stristr($cat,"Public"))){ continue; } 
		$categorycount++;
		$catdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$cat/";
		if ($album = opendir($catdir)) 
		{
			while (false !== ($alb = readdir($album)))
			{ 
				if((stristr($alb,".")) || (stristr($alb,".."))){ continue; } 
				$albumscount++;
				$albdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$cat/$alb/";
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
	}
	$filescount = round($filescount / 2);
}	
closedir($category);
print "<h3>$categorycount Catagories / $albumscount Albums / $filescount pictures</h3>";


if ($category = opendir('/home/.ornice/tadpole/tadpole.tk/gallerys/')) 
{
	$filescount = 0;
	$albumscount = 0;
	$categorycount = 0;
	while (false !== ($cat = readdir($category)))
	{ 
		if((stristr($cat,".")) || (stristr($cat,"..")) || (stristr($cat,"Public"))){ continue; } 
		$categorycount++;
		$catdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$cat/";
		print "<div align=left><h3>Category $cat</h3><div class='category'>\n";
		print "<table cellpadding=3 cellspacing=0 border=0 width=800><tr>\n";
		if ($album = opendir($catdir)) 
		{
			$break = 0;
			while (false !== ($alb = readdir($album)))
			{ 
				if((stristr($alb,".")) || (stristr($alb,".."))){ continue; } 
				$albumscount++;
				$albdir = "/home/.ornice/tadpole/tadpole.tk/gallerys/$cat/$alb/";
				$onlyonethumb = 0;
				if ($files = opendir($albdir)) 
				{
					while (false !== ($file = readdir($files)))
					{
						if((stristr($file,"tn_")) && ($onlyonethumb<1)){
							$name = substr($alb,0,50);
							print "<td><div class='album' align=left><a href='http://www.tadpole.tk/gallerys.php?page=$alb&url=$cat/$alb'><img src='gallerys/$cat/$alb/$file' title='Click to browse this gallery' width=100 border=0></a><br>$name ...</div></td>\n";
							$onlyonethumb++;
						}	
						$filescount++;
					} 
				}
				$break++;
				if($break>5){
					print "</tr></table></div><table cellpadding=3 cellspacing=0 border=0 width=800><tr>\n";
					$break = 0;
				}
				closedir($files);
			}
		}
		if($break<6){
			for ($u=5;$u>=$break;$u--){
					print "<td><div class='album'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>\n";
			}
		}
		print "</tr></table></div>\n";
		closedir($album);	
	}
	$filescount = round($filescount / 2);
}	
closedir($category);



?>