<?php

sitedisabled();

if($_GET['con_u']){
$conf = $_GET['con_u'];
$sql = $stream->do_query("update shane_users set activated='1',rank='2' where password='$conf'","one");
print "Congratulations!<br><br>Your registration has been a complete success, please <a href='index.php?opt=login'>login</a> to take advantage of all the mintiness that is tadpole.tk<br><br>Take it handy, <br><br> - tadpole";

}

else {


if(($_POST['reg_real'])&&($_POST['reg_real_s'])&&($_POST['reg_days'])&&($_POST['reg_months'])&&($_POST['reg_years'])&&($_POST['reg_country'])&&($_POST['reg_gender'])&&($_POST['reg_state'])&&($_POST['reg_email'])&&($_POST['reg_username'])&&($_POST['reg_pass1'])&&($_POST['reg_pass2'])){

$r_real = rawurlencode($_POST['reg_real']);
$r_sur = rawurlencode($_POST['reg_real_s']);
$r_days = rawurlencode($_POST['reg_days']);
$r_mons = rawurlencode($_POST['reg_months']);
$r_years = rawurlencode($_POST['reg_years']);
$r_country = rawurlencode($_POST['reg_country']);
$r_gender = rawurlencode($_POST['reg_gender']);
$r_state = rawurlencode($_POST['reg_state']);
$r_email = $_POST['reg_email'];
$r_user = rawurlencode($_POST['reg_username']);
$r_pass = sha1($_POST['reg_pass1']);
$r_pass2 = sha1($_POST['reg_pass2']);

	$checkuser = $stream->do_query("SELECT username FROM shane_users WHERE username='$r_username'","one");

	if($checkuser=="")
	{
		$checkmail = $stream->do_query("SELECT username FROM shane_users WHERE email='$r_email'","one");
		if($checkmail=="")
		{
			if($r_pass==$r_pass2)
			{	// id  	 username  	 password  	 rank  	 email  	 views  	 activated  	 browsing
				//  cookietime  	 avatar  	 lastact  	 realname  	 realname_s  	 dob  	 country  	 area  	 gender
				$dob = mktime(0, 0, 0, $r_mons, $r_days, $r_years);
				$lastact = time();
				$insert = $stream->do_query("insert into shane_users values('','$r_user','$r_pass','1','$r_email','0','0','1','3600','http://','$lastact','$r_real','$r_sur','$dob','$r_country','$r_state','$r_gender')","one"); 
				
				$msg = "Hello $r_user,\n\n Thank you for signing up on my site, to confirm your registration please follow the link below\n\n http://www.tadpole.tk/index.php?opt=register&con_u=$r_pass \n\nTake it handy\n\n - tadpole";
				$subject = "You have mail from tadpole.tk";
				$headers = "From: \"No Reply\" <shane@tadpole.tk>";
				$address = "$r_email";
				$msg .= "$message\n";
									
				mail($address, $subject, $msg, $headers);
								
				print "All signed up, please check your mail inbox for registration confirmation<br><br>You must follow the link in this email before you are able to use your account!";			
			}
			else {
				print "Sorry but your passwords did not match...";
			}		
		}
		else 
		{
			print "That email address is already in use by another user...";
		}
	}
	else 
	{
		print "Sorry that username already exists...";
	}
	

}

else {

?><script language="javascript">
  	
	function reg_checkit(){
	

	error = 0;
	
	var reg_vals = new Array();
	reg_vals[0] = document.FRM.reg_real.value;
	reg_vals[1] = document.FRM.reg_real_s.value;
	reg_vals[2] = document.FRM.reg_gender.value;
	reg_vals[3] = document.FRM.reg_country.value;
	reg_vals[4] = document.FRM.reg_state.value;
	reg_vals[5] = document.FRM.reg_email.value;
	reg_vals[6] = document.FRM.reg_username.value;
	reg_vals[7] = document.FRM.reg_pass1.value;
	reg_vals[8] = document.FRM.reg_pass2.value;
	
	var reg_what = new Array();
	reg_what[0] = "Your name";
	reg_what[1] = "Your surname";
	reg_what[2] = "Your gender";
	reg_what[3] = "Your Country";
	reg_what[4] = "Your state / province or county";
	reg_what[5] = "Your email address";
	reg_what[6] = "Your prefered username";
	reg_what[7] = "Your prefered password";
	reg_what[8] = "Your password confirmation";

		for(x=0;x<9;x++){
			if(reg_vals[x]==""){
				alert("You are missing some required information : " + reg_what[x]);
				error++;
			}
		}
		
		if(reg_vals[7]!=reg_vals[8]){
			alert("Your passwords do not match");
			error++;
		}
		
		if(reg_vals[7].length<6){
			alert("Your password is too short");
			error++;
		}
		
		if(reg_vals[6].length<=2){
			alert("Your username is too short");
			error++;
		}
		
		if(reg_vals[5].indexOf("@")<0){
		alert("Your email address is not valid");
			error++;
		}
		
		if(error==0){
			document.FRM.reg_sub.value="Please Wait....";
			document.FRM.reg_sub.disabled=true;
			document.FRM.submit();
		}	
	
	}
  
  </script>

 <form name='FRM' action=index.php?opt=register method=post>
  <table width="600" border="0" cellspacing="0" cellpadding="5">
   <tr>
  <td colspan="2"><h3>Personal Information</h3><hr /></td>
  </tr>
  <tr>
    <td valign=top align=left>Name</td>
    <td valign=top align=left><input class="text" type="text" name="reg_real"/> * <font class='required'>required</font></td>
    
    
    
  </tr>
  <tr>
    <td valign=top align=left>Surname</td>
    <td valign=top align=left><input class="text" type="text" name="reg_real_s"/> * <font class='required'>required</font></td>
    
    
    
  </tr>
  <tr>
    <td valign=top align=left>Date of Birth</td>
    <td valign=top align=left><SCRIPT>fill_select(document.FRM);year_install(document.FRM)</script> * <font class='required'>required</font></td>    
    
  </tr>
    <tr>
    <td valign=top align=left></td>
    <td valign=top align=left>So shane can send you a birthday card</td>
    
    
  </tr>
  <tr>
    <td valign=top align=left>Gender</td>
    <td valign=top align=left><select name='reg_gender' class="select"><option value=f>Female</option><option value=m>Male</option></select> * <font class='required'>required</font></td>
    
    
    
  </tr>
   <tr>
    <td valign=top align=left>Country</td>
    <td valign=top align=left><?php include("includes/countries.php"); ?> * <font class='required'>required</font></td>
    
    
    
  </tr>
   <tr>
    <td valign=top align=left>County / State / Province</td>
    <td valign=top align=left><input class="text" type="text" name="reg_state" /> * <font class='required'>required</font></td>
    
    
    
  </tr>
   <tr>
    <td valign=top align=left>Email Address</td>
    <td valign=top align=left><input class="text" type="text" name="reg_email" /> * <font class='required'>required</font></td>
   
    
  </tr>
      <tr>
    <td valign=top align=left></td>
    <td valign=top align=left>Required for activation</td>
    
    
  </tr>
  <tr>
  <td colspan="2"><h3>Preferred Login Details</h3><hr /></td>
  </tr>
  <tr>
    <td valign=top align=left>Username</td>
    <td valign=top align=left><input class="text" type="text" name="reg_username" /> * <font class='required'>required</font></td>
    
    
    
  </tr>
    <tr>
    <td valign=top align=left></td>
    <td valign=top align=left>3 Characters minimum</td>
    
    
  </tr>
  <tr>
    <td valign=top align=left>Password</td>
    <td valign=top align=left><input class="text" type="text" name="reg_pass1" /> * <font class='required'>required</font></td>
    
    
    
  </tr>
    <tr>
    <td valign=top align=left></td>
    <td valign=top align=left>6 Characters minimum</td>
    
    
  </tr>
  <tr>
    <td valign=top align=left>Confirm Password</td>
    <td valign=top align=left><input class="text" type="text" name="reg_pass2" /> * <font class='required'>required</font></td>
    
    
    
  </tr>
  <tr>
  <td colspan="2"><h3>Finish up!</h3><hr /></td>
 </tr>
  <tr>
    
	<td colspan="2">No personal information will be viewable by others on the site except for tadpole.tk administrators (shane).<br /><input class=button name=reg_sub type="button" onclick='reg_checkit();' value="Sign up!" /> <input class=button type="reset" /></td>
  </tr>
</table>
</form>
<?php
}
}
?>