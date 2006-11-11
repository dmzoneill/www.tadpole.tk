<?php

sitedisabled();

$name = $_POST['name'];
$email = $_POST['email'];
$type = $_POST['type'];
$person = $_POST['person'];
$domain = $_POST['domain'];
$message = $_POST['message'];
$m = $_GET['m'];

if(checkfeatures("contact")=="Enabled"){
if(!$m) {
$m=1;
}
if($m==1){

echo("
<center><h3>Anonymous e-mail</h3></center><FORM method='POST' ACTION='index.php?opt=contact&m=2'>
<table cellpadding=5 cellspacing=0 border=0>
<tr>
<td valign=top>Your Name :</td><td valign=top><input class='text' type=text value='' name=name size=21></td>
</tr><tr>
<td valign=top>Your e-mail : </td><td valign=top>        <input class='text' type=text name=email size=30></td>
</tr><tr>
<td valign=top>
Subject : </td><td valign=top>        <input class='text' type=text value='Mail from Tadpole.tk' name=type size=30>
</td>
</tr>
<tr>
<td valign=top>
Mail To : </td><td valign=top>
<input class='text' type=text name=person value=shane size=21></td></tr>
<tr>
<td valign=top>Domain : </td><td align=left>
@<input class='text' type=text name=domain value=evobb.com size=19>

</td>
</tr>
<tr><td valign=top>Message :</td><td valign=top>
<textarea rows=10 cols=45 wrap='off' name='message'>
</textarea></td>
</tr><tr><td></td><td valign=top><input class='button' type=submit value=Send></form></td></tr></table>");

} else if($m==2){
$ofender = $stream->do_query("SELECT lastdate FROM shane_emailer WHERE ip='$REMOTE_ADDR'","one");
$last = $ofender + 300;
$current = time();
if($current>$last){
	$subject = "You have mail from $name";
	$headers = "From: $email";
	$address = "$person@$domain";
	$msg .= "$message\n";
	$date = time();
	$hammer = $stream->do_query("insert into shane_emailer values('','$date','$REMOTE_ADDR')","one");
	if((!$name) || (!$email) || (!$message)) {
		die("<font><br><br><br><center>All fields not correct");
	} else {
		mail($address, $subject, $msg, $headers);
	echo "<font><br><br><br><center>Thanks $name for your mail!";
	}
}
else {
	print "Please wait a couple of minutes before emailing again";
}	
}

}
else {
print notice();
}

?>