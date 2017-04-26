<?php
include("inc/header.inc.php")
?>
<?php

$fname="";
$lname="";
$dob="";
$about="";
$current="";
$hometown="";
$rln="";
$intr="";
$in="";
$sta="";
if(isset($_POST['changes']))
{
	if(isset($_POST['fname']) && !empty($_POST['fname']))
	{
		$fname=$_POST['fname'];
		mysql_query("update user set firstname='$fname' where user_id='$userid'");
	}
	if(isset($_POST['lname']) && !empty($_POST['lname']))
	{
		$lname=$_POST['lname'];
		mysql_query("update user set lastname='$lname' where user_id='$userid'");
	}
	if(isset($_POST['ccity']) && !empty($_POST['ccity']))
	{
		$current=$_POST['ccity'];
		mysql_query("update personaldetails set current_city='$current' where user_id='$userid'");
	}
	if(isset($_POST['hcity']) && !empty($_POST['hcity']))
	{
		$hometown=$_POST['hcity'];
		mysql_query("update personaldetails set hometown='$hometown' where user_id='$userid'");
	}
	
	if(isset($_POST['dob']) && !empty($_POST['dob']))
	{
		$dob=date("Y-m-d",strtotime($_POST['dob']));
		if($dob>date("Y-m-d"))
		{
			$doberr="date of birth cannot be larger than todays date";
		}
		else
		{
			mysql_query("update personaldetails set dob='$dob' where user_id='$userid'");
		}
	}
	
	
	if(isset($_POST['rln']) && !empty($_POST['rln']))
	{
		$rln=$_POST['rln'];
		switch($rln)
		{
			case "Single": $sta="Single"; break;
			case "In a relationship": $sta="In a relationship"; break;
			case "Married": $sta="Married"; break;
			case "Divorced": $sta="Divorced"; break;
		}
		mysql_query("update personaldetails set relationship='$sta' where userid='$userid'");
	}
	
	if(isset($_POST['intr']) && !empty($_POST['intr']))
	{
		$intr=$_POST['intr'];
		switch($intr)
		{
			case "Women": $in="Women"; break;
			case "Men": $in="Men"; break;
			case "Both": $in="Both"; break;
			case "None": $in="None"; break;
		}
		mysql_query("update personaldetails set intrested_in='$in' where userid='$userid'");
	}
	
	if(isset($_POST['aboutme']) && !empty($_POST['aboutme']))
	{
		$hometown=$_POST['aboutme'];
		mysql_query("update personaldetails set hometown='$hometown' where userid='$userid'");
	}
}


?>


<?php
$hsc="";
$clg="";
$comp="";
if(isset($_POST['changeedu']))
{
	if(isset($_POST['hsc']) && !empty($_POST['hsc']))
	{
		$hsc=$_POST['hsc'];
		mysql_query("update educationdetails set highschool='$hsc' where user_id='$userid'");
	}
	if(isset($_POST['clg']) && !empty($_POST['clg']))
	{
		$clg=$_POST['clg'];
		mysql_query("update educationdetails set college='$clg' where user_id='$userid'");
	}
	if(isset($_POST['comp']) && !empty($_POST['comp']))
	{
		$comp=$_POST['comp'];
		mysql_query("update educationaldetails set company='$comp' where user_id='$userid'");
	}
}


?>

<?php

if(isset($_POST['profilepicsub']))
{
	if(isset($_POST['profilepic']))
	{
		$file_name=$_POST['profilepic'];
		$q=mysql_query("update user set profilepic='$file_name' where user_id='$userid'");
	}
}

?>



<div class="container" style="margin-top:100px;">
	<div class="row forms">
		<div class="col-lg-12"> 
			<div class="col-lg-1"></div>
			<div class="col-lg-10">
				<center><h2>Change Your Settings here : <h2></center>
			</div>
		</div>
		
		<div class="col-lg-12" style="margin:20px">
		<form action="accountsettings.php" name="propicform" method="POST">
			<div class="col-lg-12 editbox"><center><h3>Profile Picture</h3></center></div>
			<div class="col-lg-1"></div>
			<div class="col-lg-5">
				<center><img src="images/default.png"></center>
			</div>
			<div class="col-lg-5">
				<center>
				<input type="file" name="profilepic" style="margin:10px" accept="image/*">
				<input type="submit" name="profilepicsub" value="Change picture" class="btn btn-primary">
				</center>
			</div>	
		</div>
		</form>
		<div class="col-lg-12"><hr></div>
		<div class="col-lg-12 editbox"><center><h3>Personal Details</h3></center></div>
		<form action="accountsettings.php" method="POST">
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="fname">First name :</label><input type="text" name="fname" placeholder="Change first name.."> </div>
				<div class="col-lg-2"></div>
				<div class="col-lg-4 editbox">
					<label for="lname">Last name :</label><input type="text" name="lname" placeholder="Change last name.."> </div>
				<div class="col-lg-1"></div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="dob">Birthday :</label><input type="date" name="dob">
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="ccity">Current city :</label><input type="text" name="ccity" placeholder="Current City..">
				</div>
				<div class="col-lg-2"></div>
				<div class="col-lg-4 editbox">
					<label for="hcity">Hometown :</label><input type="text" name="hcity" placeholder="hometown..">
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="rln">Relationship status :</label>
					<select name="rln">
						<option>select..</option>
						<option value="Single">Single</option>
						<option value="In a relationship">In a relationship</option>
						<option value="Married">Married</option>
						<option value="Divorced">Divorced</option>
					</select>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="intr">Intrested in :</label>
					<select name="intr">
						<option>select..</option>
						<option value="Women">Women</option>
						<option value="Men">Men</option>
						<option value="Both">Both</option>
						<option value="None">None</option>
					</select>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-5 editbox">
					<label for="aboutme" class=" editbox">About You :</label><textarea class=" editbox" name="aboutme" cols="35" placeholder="Tell everyone about you"></textarea>
				</div>
			</div>
			
			<div class="col-lg-12">
				<center><input type="submit" value="Save changes" name="changes" style="margin:15px" class="btn btn-info"></center>
			</div>
		</form>
		<div class="col-lg-12"><hr></div>
		<div class="col-lg-12 editbox">
		<center><h3>Educaonal Details</h3></center></div>
		<form action="accountsettings.php" method="POST">
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="hsc">HIgh School :</label><input type="text" name="hsc" placeholder="Change high school..">
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="clg">College :</label><input type="text" name="clg" placeholder="Change college..">
				</div>
				<div class="col-lg-1"></div>
			</div>
			
			<div class="col-lg-12">
				<div class="col-lg-1"></div>
				<div class="col-lg-4 editbox">
					<label for="comp">Company :</label><input type="text" name="comp" placeholder="Change company..">
				</div>
				<div class="col-lg-1"></div>
			</div>
			
			<div class="col-lg-12">
				<center><input type="submit" value="Save changes" name="changeedu" style="margin:15px" class="btn btn-info"></center>
			</div>
			
		</form>
	</div>
</div>