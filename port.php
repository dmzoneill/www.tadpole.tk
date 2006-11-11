<?php

include("connect.php");


$sql = $stream->do_query("select * from shane_gallerys","array");

for($p=0;$p<count($sql);$p++){

//id   	 imagename   	 imagedir   	 comments   	 viewedtimes   	 votes   	 total
	$tmp = $sql[$p];
	$id = $tmp[0];
	$imagename = $tmp[1];
	$imagedir = $tmp[2];
	$comments = stripslashes(rawurldecode(rawurldecode($tmp[3])));
	$viewedtimes = $tmp[4];
	$votes = $tmp[5];
	$total = $tmp[6];
	
	if(strlen($comments)>0){
	
		$comments = explode(":",$comments);
		$comments[3] = eregi_replace("<br>","",$comments[3]);
		$comments[3] = eregi_replace("<hr>","",$comments[3]);
		$comments[3] = eregi_replace("<strong>","",$comments[3]);
		$comments[3] = eregi_replace("</strong>","",$comments[3]);
		$comments[3] = eregi_replace("&nbsp;"," ",$comments[3]);
		$comments[3] = eregi_replace("\n"," ",$comments[3]);
		$comments[3] = eregi_replace("<br />"," ",$comments[3]);
		$comments[3] = eregi_replace(chr(23)," ",$comments[3]);
		$dated = time();
		$stuff = $comments[3];
		//$newsl = $stream->do_query("insert into shane_comments values('','$id','$dated','$stuff','-1','0')","one");
	}
	
}
print "done!";