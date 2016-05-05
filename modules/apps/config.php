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
	require(dirname(__FILE__) . '/../../configuration.php'); 
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');	
	
	//Setup tables if new module
	if(!$resultapps = $db->query("SELECT *  FROM apps"))
	{
			$sql = "CREATE TABLE apps (id int(11) NOT NULL,icon text NOT NULL,student int(11) NOT NULL,staff int(11) NOT NULL,title text NOT NULL,image text NOT NULL,link text NOT NULL,required int(11) NOT NULL,sort int(11) NOT NULL,minor_disabled int(11) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `apps` ADD PRIMARY KEY (`id`);";
  			$sql .= "ALTER TABLE `apps` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  		if ($db->multi_query($sql) === TRUE) { }
	}
	
	
	$pageview=1;
	$drawerhidden=1;
	$pagetitle="Apps";
	$pagepath="apps";
	
?>

	<!--Apps modal-->
	<div id='viewapps_arrow' style='width:20px; height:10px; position:absolute; right:94px; top:52px; background-image: url("core/images/arrow.png"); z-index:1000; display:none;'></div>
	<div id="viewapps" class="modal apps_modal modal-mobile-full">
		<div class="modal-content" id="modal-content-section">
			<a class="modal-close black-text hide-on-med-and-up" style='position:absolute; right:20px; top:25px;'><i class='material-icons'>clear</i></a>
			<div id='loadapps'></div>
    	</div>
	</div>

<script>
	
	//Load apps into modal
	$( "#loadapps" ).load( "modules/apps/apps.php" );
	
	$(document).ready(function(){
    	$('.modal-viewapps').leanModal({
	    	in_duration: 0,
			out_duration: 0,
			opacity: 0,
	    	ready: function() { 
		    	$("#viewapps_arrow").show(); 
		    	$("#viewapps").scrollTop(0);
		    	$('#viewprofile').closeModal({
			    	in_duration: 0,
					out_duration: 0,
			   	});
		    	$("#viewprofile_arrow").hide();
		    },
	    	complete: function() { $("#viewapps_arrow").hide(); }
	   	});
  	});
  	
  	//Make the Icons Clickable
	$(document).on("click", ".app", function ()
	{
		window.open($(this).find("a").attr("href"), '_blank');
		
		$("#viewapps_arrow").hide();
		 
		 //Close the app modal
    	$('#viewapps').closeModal({
	    	in_duration: 0,
			out_duration: 0,
	   	});
	});

</script>