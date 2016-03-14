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
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once('permissions.php');
	
	//Show the searcg and last 10 updates
	if($pageaccess==1)
	{
		
		echo "<div class='page_container mdl-shadow--4dp'>";
		echo "<div class='page'>";
					
				echo "<div class='row'><div class='col s12'><h4>Achieved Employees</h4></div></div>";	
				echo "<div id='archivedemployees'>"; include "archived.php"; echo "</div>";
						
		echo "</div>";
		echo "</div>";
		
		
		?>
												
			<script>
				
				$(function() {
														
					$("#myTable").tablesorter(); 
														
					//Restore the User
					$('#archivedemployees').on('click','.restoreuser',function(){
						var address = $(this).find("a").attr("href");
						$('.tooltipped').tooltip('remove');
						$.ajax({
							type: 'POST',
							url: address,
							data: '',
						})
															
						//Show the notification
						.done(function(response) {
							
							$( "#archivedemployees" ).load( "modules/directory/archived.php", function() {
																	
							//Register MDL Components
							var html = document.createElement('content_wrapper');
							$(document.body).append(html);      
							componentHandler.upgradeAllRegistered();
																	
							$('#form-messages').text(response);	
							$( ".notification" ).slideDown( "fast", function() {
							$( ".notification" ).delay( 2000 ).slideUp();	
							});		
						});	
						})
					});
														
					//Permanently Delete User
					$('#archivedemployees').on('click','.deleteuser',function(){
						var address = $(this).find("a").attr("href");
						$('.tooltipped').tooltip('remove');
						$.ajax({
							type: 'POST',
							url: address,
							data: '',
						})
															
						//Show the notification
						.done(function(response) {
							$( "#archivedemployees" ).load( "modules/directory/archived.php", function() {
																	
							//Register MDL Components
							var html = document.createElement('content_wrapper');
							$(document.body).append(html);      
							componentHandler.upgradeAllRegistered();
																	
							$('#form-messages').text(response);	
							$( ".notification" ).slideDown( "fast", function() {
								$( ".notification" ).delay( 2000 ).slideUp();	
							});		
						});	
						})
					});
														
				});
			</script>
	<?php
	
	}
	
?>