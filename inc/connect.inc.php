<?php
 $server="localhost";
 $username="root";
 $password="";
 $database="friendsconnect";
 mysql_connect($server,$username,$password) or die("could not connect to server.");
 mysql_select_db($database)or die("could not select database ");
 $query = mysql_query("select * from user");
 $rows = mysql_num_rows($query);
  echo $rows;

 ?>