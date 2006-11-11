<?php

print "<h3>Top 10 Images</h3>";

$ttti = $stream->do_query("SELECT * FROM shane_gallerys ORDER BY viewedtimes DESC  LIMIT 0 , 10","array");
print "<table cellpadding=0 cellspacing=0 border=0><tr>";
for($o=0;$o<count($ttti);$o++){

$tmp = $ttti[$o];
	$idh = $tmp[0];
	$imagename = rawurldecode($tmp[1]);
	$imagedir = rawurldecode($tmp[2]);
	$comments = $tmp[3];
	$viewedtimes = $tmp[4];
	
	if(strlen($imagename)>3){
	
	if($o==5){
		print "</tr><tr>";
	}
	
print "<td><a href=\"image.php?page=$imagename&file=$imagedir$imagename&thumb=$imagename\"><img src='gallerys/$imagedir/tn_$imagename' width=100 border=0><br>$imagename</a></td>";	

}

}

print "</tr></table>";

?>