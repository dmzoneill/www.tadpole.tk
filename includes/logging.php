<?php

//logger

$browser = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$accept = $_SERVER['HTTP_ACCEPT'];
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

$isthere = count($stream->do_query("select * from shane_logging where ip='$ip'","array"));

if($isthere<1){
$insert  = $stream->do_query("insert into shane_logging values('','$ip','$browser','$accept','$lang','$port','0')","one");
}
else {
$isthere = $stream->do_query("select views from shane_logging where ip='$ip'","one");
$ggg = $isthere + 1;
$insert  = $stream->do_query("update shane_logging set views='$ggg' where ip='$ip'","one");
}

?>