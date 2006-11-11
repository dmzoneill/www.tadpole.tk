<?php 
$ip = getenv("REMOTE_ADDR");
$ggg = $stream->do_query("select id from iplog where ip='$ip'","one");

if($ggg>0){
	$sr = $stream->do_query("select hits from iplog where ip='$ip'","one");
	$num = $sr = 1;
	$update = $stream->do_query("update iplog set hits = '$num' where ip='$ip'","one");
}
else {
	$sr = $stream->do_query("INSERT INTO iplog VALUES ('', '$ip', 'test dave', '0')","one");
}
 
if(!$_GET['file']){ 
?>
<div align=right><a href='#top'>Top</a><a name=bottom>&nbsp;</a></div>
<?php } ?>		
</td></tr></table></td></tr></table>
<br></td></tr></table>

<table class="bottom" width=100% border=0 cellspacing=0 cellpadding=0><tr><td>
  <table width=100% border=0 cellspacing=0 cellpadding=10><tr><td valign=top width=100% align=right>
  &copy; www.tadpole.tk <br>
  
<?php

	$end = utime(); 
	$run = $end - $start; 
	echo "Page generated in " . substr($run, 0, 5) . " secs.";

  
?>
	</td></tr></table>
  </td></tr></table>
</td></tr></table>
</body>
</html>
<?php include("includes/logging.php"); ?>