<?php
include ("inc/header.inc.php");
?>

<?php
$err="";
$err2="";
$f=0;
	if(isset($_POST["passchange"]))
	{
		
		if(!empty($_POST["old"]))
		{
			$f=1;
			$old=md5($_POST["old"]);
			$que=mysql_query("select password from user where user_name='$username'");
			$aoldi=mysql_fetch_assoc($que);
			$aold=$aoldi["password"];
			if($old!=$aold)
			{
				$f=0;
				$err='Old pasword do not match';
			}
		}
		if(!empty($_POST['new']) && !empty($_POST['old']))
		{
			if($_POST['new']!=$_POST['cnf'])
			{
				$f=0;
				$err2='Passwords do not match';
			}
		}
		if($f==1)
		{
			$pass=md5($_POST['new']);
			$query=mysql_query("update user set password='$pass' where user_name='$username'");
			$err='Password changed';
		}
	}
?>


<div class="container" style="margin-top:100px;">
	<div class="row forms">
		<div class="col-lg-12 editbox">
		<center><h3>Change Your Password here</h3></center></div>
		<form action="changepassword.php" method="POST">
			<div class="col-lg-12">
				
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="old">Current Password :</label><input type="password" name="old" placeholder="Enter..">
				</div>
				<div class="col-lg-4 editbox error"><?php echo "$err" ?></span></div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="new">New Password :</label><input type="password" name="new" placeholder="Enter..">
				</div>
				<div class="col-lg-1"></div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="cnf">Confirm Password :</label><input type="password" name="cnf" placeholder="Enter..">
				</div>
				<div class="col-lg-4 editbox error"><span class="error"><?php echo "$err2" ?></span></div>
			</div>
			
			<div class="col-lg-12">
				<center><input type="submit" value="Change Password" name="passchange" style="margin:15px" class="btn btn-info"></center>
			</div>
			
		</form>
	</div>
</div>