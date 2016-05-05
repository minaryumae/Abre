<?php
	
	/*
	* Copyright 2015 Hamilton City School District	
	* 		
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 3 of the License, or
    * (at your option) any later version.
	* 
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU General Public License for more details.
	* 
    * You should have received a copy of the GNU General Public License
    * along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */
	
	//Required configuration files
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');  
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require_once(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	
	$streamUrl=$_REQUEST['url'];
	$streamTitle=$_REQUEST['title'];
	$streamUrldecoded=base64_decode($streamUrl);
	$streamTitledecoded=base64_decode($streamTitle);
	
	$userposter=$_SESSION['useremail'];

	if($streamUrldecoded!="" && $streamTitledecoded!="")
	{
		
		//Check to see if like already exists for this user
		$query = "SELECT * FROM streams_comments where url='$streamUrldecoded' and liked='1' and user='".$_SESSION['useremail']."'";
		$dbreturn = databasequery($query);
		$num_rows_like_count = count($dbreturn);
		
		if($num_rows_like_count==0)
		{
			//Insert comment into database
			$sql = "INSERT INTO streams_comments (url, title, user, liked) VALUES ('$streamUrldecoded', '$streamTitledecoded', '$userposter', '1');";
			$dbreturn = databaseexecute($sql);
		}
		else
		{
			//Remove commment from database
			$sql = "DELETE FROM streams_comments WHERE url='$streamUrldecoded' and liked='1' and user='".$_SESSION['useremail']."'";
			$dbreturn = databaseexecute($sql);
		}

	}
	
	$streamUrldecoded=base64_encode($streamUrldecoded);
	echo $streamUrldecoded;
	
?>