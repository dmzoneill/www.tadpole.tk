<?php

$ofender = $stream->do_query("SELECT lastdate FROM shane_hammer WHERE ip='$REMOTE_ADDR'","one");
$last = $ofender + 300;
$current = time();
$backto = $_GET['wheretogo'];
if($current>$last){

$comments = stripslashes(rawurldecode($stream->do_query("SELECT comments FROM shane_gallerys WHERE id='$id'","one")));

$post .= "$comments";
$post .= "<br><hr>";
$post .= "Name : $person<br>";
$post .= "Email : $email<br>";

$allowed = array(
'a' => array('href', 'target'),
'b' => array(),
'i' => array(),
'u' => array(),
's' => array(),
'ul' => array(),
'li' => array(),
'ol' => array(),
'dl' => array(),
'dt' => array(),
'strike' => array(),
'img' => array('src', 'width', 'height', 'alt')
);

	$processed_data = check_tags($msg, $allowed);

$post .= "Comments : " .rawurlencode(nl2br($msg)) ."<br>";
$post .= "<br>";

$post = rawurlencode($post);
$comments = $stream->do_query("update shane_gallerys set comments='$post' WHERE id='$id'","one");
$date = time();
$hammer = $stream->do_query("insert into shane_hammer values('','$date','$REMOTE_ADDR')","one");

$subject = "$person has added a comment to tadpole.tk";
$headers = "From: $email";
$address = "shane@tadpole.tk";
$msg .= "$msg\n\n < image.php?page=edit&dir=$dir&img=$img > \n\n Shane if your being spammed log into the admi panel and ban this ip : " .$REMOTE_ADDR;
mail($address, $subject, $msg, $headers);

print "post added!";
}
else {
print "Please wait a couple of minutes before posting again";
}
//image.php?page=A%20billabong%202.jpg&p=de4e767221f07e5722ccd1ce0e70627366e6d354&file=Australia%202005/Grampians%20and%20McKenzies%20Waterfall%2026-3-05/tn_A%20billabong%202.jpg&thumb=tn_A%20billabong%202.jpg
$timg = rawurldecode($stream->do_query("SELECT imagename FROM shane_gallerys WHERE id='$backto'","one"));
$id3 = rawurldecode($stream->do_query("SELECT imagedir FROM shane_gallerys WHERE id='$backto'","one"));
$tdir = $id3."tn_".$timg;
$href = "image.php?page=".$timg."&file=".$tdir."&thumb=tn_".$timg;
?>
<script language=javascript>
setTimeout("document.location.href='<?php print $href; ?>'",2000);</script>

<?php
include("footer.php");
exit;



?>