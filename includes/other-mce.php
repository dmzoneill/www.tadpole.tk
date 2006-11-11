<SCRIPT LANGUAGE="JavaScript">
function NoError()
{
return true;
}
window.onerror=NoError;

<?php if(($_GET['file']) || ($_GET['opt']=="admin")){

if($_GET['file'])
{
	print "var ids=new Array('mpost','mfriend','mcomments','mimage','minfo');\n";
	$first = "mimage";
}
else 
{
	print "var ids=new Array('adminblog','adminset','adminlogs','adminimages','adminedit','adminr');\n";
	$first = "adminr";
}
 
?>
function switchid(id){	
	hideallids();
	showdiv(id);
}

function hideallids(){
	for (var i=0;i<ids.length;i++){
		hidediv(ids[i]);
	}		  
}

function hidediv(id) {
	if (document.getElementById) { 
		document.getElementById(id).style.display = 'none';
	}
	else {
		if (document.layers) { 
			document.id.display = 'none';
		}
		else { 
			document.all.id.style.display = 'none';
		}
	}
}

function showdiv(id) {
	if (document.getElementById) { // DOM3 = IE5, NS6
		if (document.getElementById(id).style.display=='none') {
			document.getElementById(id).style.display = 'block';
		}
		else {
			document.getElementById(id).style.display = 'none';
		}
	}
	else {
		if (document.layers) { // Netscape 4
			if (document.id.display = 'none'){
				document.id.display = 'block';
			}
			else {
				document.id.display = 'none';	
			}
		}
		else { // IE 4
			if(document.all.id.style.display == 'none'){
				document.all.id.style.display = 'block';
			}
			else {
				document.all.id.style.display = 'none';
			}
		}
	}
}
function startup(){
hideallids();
switchid('<?php print "$first"; ?>');
}

<?php } ?>

function go(loc) {
window.location.href = loc;
}
</SCRIPT>