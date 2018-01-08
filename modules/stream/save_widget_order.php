<?php

	/*
	* Copyright (C) 2016-2017 Abre.io LLC
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */

	//Required configuration files
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');

	if($_SESSION['usertype'] == "staff" || $_SESSION['usertype'] == "student"){

		$list = $_POST['list'];

		$output = array();
		$list = parse_str($list, $output);
		$a = implode(',', $output['item']);

		//Check to see if profile record exists
		include "../../core/abre_dbconnect.php";
		$query = "SELECT * FROM profiles WHERE email = '".$_SESSION['useremail']."'";
		$results = databasequery($query);
		$records = count($results);

		if($records==0){
			$stmt = $db->stmt_init();
			$sql = "INSERT INTO profiles (email, startup) VALUES (?, ?)";
			$stmt->prepare($sql);
			$stmt->bind_param("si", $_SESSION['useremail'], 0);
			$stmt->execute();
			$stmt->close();
		}

		$stmt = $db->stmt_init();
		$sql = "UPDATE profiles SET widgets_order = ? WHERE email = ?";
		$stmt->prepare($sql);
		$stmt->bind_param("ss", $a, $_SESSION['useremail']);
		$stmt->execute();
		$stmt->close();
		$db->close();
	}

?>