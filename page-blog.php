<?php
	$page = rawurldecode(rawurldecode($stream->do_query("select content from shane_pages where id=1","one")));
	
	print $page;
	
	?>