<?php
include("connect.php");
include("header.php");
include("functions.php");


$sql3 = $stream->do_query("select password from users where id='1'","one");

if(sha1("themaster")==$sql3){
$passs = explode(":",returnuserinfo());
$passg = sha1($passg);
if($enable){
if($passg==$passs[1]){
$sql = $stream->do_query("update shane_settings set site='1' where id='1'","one");
print "Site Renabled!";
}
else {
print "Bad Password";
}
}
}
else {
print "Foleys you were warned";
?>

<script language=javascript>
document.location.href='http://www.feeditout.com';
</script>

<?php
}
include("footer.php");

?>