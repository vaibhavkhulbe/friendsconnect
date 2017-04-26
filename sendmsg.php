<?php
	include ("inc/header.inc.php");
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
				header("location: $username");
				exit();
			}
		}
	}
	
	if($username != $user)
	{
		if(isset($_POST['sndmsg']))
		{
			$msgbody=strip_tags($_POST['msgbody']);
			if($msgbody=="")
			{
				echo 'seems like you forgot to write the message.';
			}
			else
			{
				$date=date("Y-m-d H:i:s");
				$opened="no";
				$snd=mysql_query("insert into messages values ('','$username','$user','$msgbody','$date','$opened')");
				echo 'Your message has been sent';
				header("location: $user");
			}
		}
		
		if(isset($_POST['cncl']))
		{
			header("location: $user");
		}
		echo "<div class='container forms' style='margin:100px'><center><form action='sendmsg.php?u=$user' method='POST'>
				<h2>compose a message : ($username) </h2>
				<textarea cols='50' rows='10' name='msgbody' placeholder='Enter the text here..'></textarea><br>
				<input type='submit' value='Send Message' class='btn btn-primary  post' name='sndmsg'>
				<input  type='submit' value='Cancel' class='btn btn-primary post' name='cncl'>
				</form></center></div>";
	}