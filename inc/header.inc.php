<?php
include("inc/connect.inc.php");
session_start();
if(isset($_GET['u']))
{
	$user=mysql_real_escape_string($_GET['u']);
	if(ctype_alnum($user))
	{
		$check=mysql_query("select user_name,user_id from user where user_name='$user'") or die("user_name");
		if(mysql_num_rows($check)==1)
		{
		}
		else
		{
			header('location:notfound.php');
			exit();
		}
	}
	if(isset($_SESSION["user_login"]))
	{
		$username=$_SESSION["user_login"];
		$userid=$_SESSION["user_id"];
	}
}
else if(!isset($_SESSION["user_login"]))
{
	header("location:index.php");
	exit();
}
else
{
	$username=$_SESSION["user_login"];
	$userid=$_SESSION["user_id"];
}
?>



<html>
	<head>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/homestyle.css" rel="stylesheet">
		<base href="//localhost/new/">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		<title><?php echo "FriendsConnect-$username" ?></title>
</head>
<!--<body style="margin:0px; background-color:#DDDDFF">-->
<body>

	<nav style="background-color:#000000;" class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">FriendsConnect</a>
		</div>
		<div class="col-lg-1"></div>
		<div class=" col-lg-5 nav navbar-header searchbox">
			<form action="profile.php" method="GET">
				<div class="col-lg-11"><input type="text" name="u" placeholder="Search FC..."></div>
				<div class="col-lg-1"><button type="submit" class="btn btn-default srchbtn"></button></div>
			</form>
		</div>
		<?php
			
			if(isset($_GET['search']))
			{
				$val=$_GET['u'];
				header("location : $val");
			}
		?>

		<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
		  <ul class="nav navbar-nav">
			<li><a href="home.php"">Home</a></li>
			<li><a href="<?php echo"$username" ?>"><?php echo "$username" ?></a></li>
			<li><button class="dropdown-toggle" type="button" style="border:0px;padding:0px; margin-top:20px;" data-toggle="dropdown">
				<span class="arrow-down caret" style="background-color:#000; margin:0px;"></span>
				</button>
					<ul class="dropdown-menu list">
						<li><a href="friendrequest.php">Friend Requests</a></li>
						<li><a href="messages.php">Messages</a></li>
						<li><hr></li>
						<li><a href="accountsettings.php">Account Settings</a></li>
						<li><a href="changepassword.php">Change Password</a></li>
						<li><hr></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
