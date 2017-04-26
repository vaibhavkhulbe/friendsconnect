<?php
include ("inc/connect.inc.php");
session_start();
if(!isset($_SESSION["user_login"]))
{}
else
{
	header("location:home.php");
	exit();
}
$f=1;
$f2=1;
$count=0;
$username="";
$password="";
$password2="";
$email="";
$fname="";
$lname="";
$unameerr="";
$pass1err="";
$lognameerr="";
$logpasserr="";
$pass2err="";
$matcherr="";
$emerr="";
$ferr="";
$lerr="";
$main="";
$uquey="";
$inverr="";

if(isset($_POST['su']))
{
	if(isset($_POST['username']) && !empty($_POST['username']))
	{
		$username=$_POST['username'];
		$uquery=mysql_query("select user_name from user where user_name='$username'");
		$count=mysql_num_rows($uquery);
		if($count==0)
		{
			
		}
		else
		{
			$unameerr='Username exists';
			$f=0;
		}
	}
	else
	{
		$f=0;
		$unameerr="Username cannot be blank";
	}
	
	if(isset($_POST['password']) && !empty($_POST['password']))
	{
		$password=$_POST['password'];
	}
	else
	{
		$f=0;
		$pass1err='password cannot be blank';
	}
	
	if(isset($_POST['password2']) && !empty($_POST['password2']))
	{
		$password2=$_POST['password2'];
	}
	else
	{
		$f=0;
		$pass2err='Please re-enter password';
	}
	
	if($password!=$password2)
	{
		$f=0;
		$matcherr='passwords do not match';
	}
	else
	{
		$md5password=md5($password);
	}
	
	if(isset($_POST['email']) && !empty($_POST['email']))
	{
		$email=$_POST['email'];
	}
	else
	{
		$f=0;
		$emerr='Please enter E-mail';
	}
	
	if(isset($_POST['fname']) && !empty($_POST['fname']))
	{
		$fname=$_POST['fname'];
	}
	else
	{
		$f=0;
		$ferr='Please enter your first name';
	}
	
	if(isset($_POST['lname']) && !empty($_POST['lname']))
	{
		$lname=$_POST['lname'];
	}
	else
	{
		$f=0;
		$lerr='Please enter your last name';
	}
	
	if($f==1)
	{
		$dt=date("Y-m-d H:i:s", time());
		$query=mysql_query("insert into user values ('','$username','$md5password','$email','$fname','$lname','$dt','0','')");
		header("location:index.php");
	}
}
?>

<?php
if(isset($_POST['login']))
{
	if(isset($_POST['login_username']) && !empty($_POST['login_username']))
	{
		$username=$_POST['login_username'];
	}
	else
	{
		$f2=0;
		$lognameerr="Username cannot be blank";
	}
	
	if(isset($_POST['login_password']) && !empty($_POST['login_password']))
	{
		$password=$_POST['login_password'];
		$md5password=md5($password);
	}
	else
	{
		$f2=0;
		$logpasserr='password cannot be blank';
	}
	
	if($f2==1)
	{
		$uquery=mysql_query("select user_id from user where user_name='$username' and password='$md5password' LIMIT 1");
		$count=mysql_num_rows($uquery);
		if($count==0)
		{
			$inverr='invalid username/password';
		}
		else
		{
			while($row=mysql_fetch_array($uquery))
			{
				$id=$row['user_id'];
			}
			$_SESSION['user_login']=$username;
			$_SESSION['user_id']=$id;
			header("location:home.php");
			exit();
		}
	}
}
	
?>

<html>

<head>
	<link href="css/indexstyle.css" media="screen" rel="stylesheet">
	<link href="css/animation.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="favicon .ico" type="image/x-icon">
<link rel="icon" href="favicon .ico" type="image/x-icon">
	<title> Welcome to FriendsConnect</title>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">FriendsConnect</a>
    </div>
	<div class="navbar-header col-lg-8" align="center">
      <img src="images/fc.fw.png">
    </div>
    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
        <li><a href="#about" data-toggle="tab">About</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="tab-content">
	<div class="tab-pane fade in active" id="home">
		<div style="color:white; position:fixed; top:50px; left:100px;">
			<h1><b> Welcome To FriendsConnect..</b></h1>
			<h3><b> Connect with your friends, make new friends.. <br>Share with everyone the best moments of your life..</b></h3>
		</div>
		<div class="formbox" id="signin_form" style="position:absolute; top:250px; left:600px;">
			<h1> Log In </h1>
			<form action="index.php" method="POST">
					<input type="text" class="form-control inputval" placeholder="Username.." name="login_username">
					<span class=error><?php echo $lognameerr; ?></span>
					<input type="password" class="form-control inputval" placeholder="Password.." name="login_password">
					<span class=error><?php echo $logpasserr; ?></span>
					<input type="checkbox" class="inputval"> remember me
					<span class=error><?php echo $inverr; ?></span>
					<input type="submit" value="Log In" class="btn btn-md btn-info inputval form-control" name="login">
			</form>
		</div>

		<div class="formbox" id="signup-form" style="position:absolute; top:100px; left:1000px;">
			<h4>New to FC?<h4>
			<h1> Sign Up </h1>
			<form action="index.php" method="POST">
					<input type="text" class="form-control inputval" placeholder="Username.." name="username">
					<span class=error><?php echo $unameerr; ?></span>
					<input type="password" class="form-control inputval" placeholder="Password.." name="password">
					<span class="error"><?php echo $pass1err; ?></span>
					<input type="password" class="form-control inputval" placeholder="Re-enter Password.." name="password2">
					<span class="error"><?php echo $pass2err; ?></span>
					<span class="error"><?php echo $matcherr; ?></span>
					<input type="text" class="form-control inputval" placeholder="Email.." name="email">
					<span class="error"><?php echo $emerr; ?></span>
					<input type="text" class="form-control inputval" placeholder="First Name.." name="fname">
					<span class="error"><?php echo $ferr; ?></span>
					<input type="text" class="form-control inputval" placeholder="Last Name.." name="lname">
					<span class="error"><?php echo $lerr; ?></span>
					<input type="submit" value="Sign Up" class="btn btn-md btn-primary inputval form-control" name="su">
					<span class="error"><?php echo $main; ?></span>
			</form>
		</div>
	</div>

	<div class="tab-pane fade" id="about">
		<div class="container" style="margin-top:100px">

        <div class="row">
			<div class="col-lg-2 col-md-3"></div>
            <div class="col-xs-6 col-sm-3 col-lg-3" style="margin:10px">
				<div class="wow bounceInUp" data-wow-delay="0.2s">
                <div class="team formbox">
                    <div class="inner">
					<center>
						<h5>RISHABH ARORA</h5>
                        <p class="subtitle">Front End Designer</p>
					</center>
					<div class="avatar"><img src="img/team/1.jpg" alt="" class="img-responsive img-circle" /></div>
                    </div>
                </div>
				</div>
            </div>
			<div class="col-lg-6 col-sm-3 col-lg-3" style="margin:10px">
				<div class="wow bounceInUp" data-wow-delay="0.5s">
                <div class="team formbox">
                    <div class="inner">
					<center>
						<h5>PANKAJ LAMBA</h5>
                        <p class="subtitle">SQL Handler</p>
                        <div class="avatar"><img src="img/team/2.jpg" alt="" class="img-responsive img-circle" />   </div>
					</center>
                    </div>
                </div>
				</div>
            </div>
			<div class="col-xs-6 col-sm-3 col-lg-3" style="margin:10px">
				<div class="wow bounceInUp" data-wow-delay="0.8s">
                <div class="team formbox">
                    <div class="inner">
					<center>
						<h5>VAIBHAV KHULBE</h5>
                        <p class="subtitle">PHP Ninja</p>
                        <div class="avatar"><img src="img/team/3.jpg" alt="" class="img-responsive img-circle" /></div>
					</center>
                    </div>
                </div>
				</div>
            </div>
        </div>		
		</div>
	</div>
</div>
</body>

</html>