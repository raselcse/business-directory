       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Add New Event Type</h1>
          <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
              
				?>

        </div>
		<form enctype="application/x-www-form-urlencoded" action="admin.php?page=saveEvent" method="post">
			<table class="widefat" style="margin-top: .5em;">
				<tbody>
			      	<tr>
				        <th width="15%">Event Title</th>
				        <td colspan="2">
				        	<input  name="event_title" type="text" value="" style="width: 300px;">
				        </td>
			      	</tr>
			      
			      	
				  	<tr>
				        <th valign="top"> Event Details</th>
						<td colspan="2">
						<textarea name="event_details" rows="4" cols="50">

						</textarea>
							
						</td>
					</tr>

					<tr>
				         <th width="15%" valign="top">Event Location</th>
				        <td>
				        	<input  name="event_location" type="text" style="width: 500px;">
				        </td>
			 	        
			     	</tr>

					<!-- <tr>
				        <th width="15%" valign="top">Event Type</th>
				        <td colspan="2">
				        	<select id="Advertise_AdvertiseType_select" name="event_type" style="width: 200px">
								 <option value="">No Option</option>
								 <option value="free">Free</option>
							</select>
				        </td>
			      	</tr> -->

					<tr class="date">
						<th width="15%">Start date (day/month/year)</th>
						<td>
							<input name="event_start_date" type="text" class="datetimepicker" value="" style="width: 300px;">
						</td>
						
					</tr>

					<tr class="date">
						<th width="15%">End date (day/month/year)</th>
						<td>
							<input name="event_end_date" type="text" class="datetimepicker"  value="" style="width: 300px;">
						</td>
						
					</tr>

					
					<tr>
				         <th width="15%" valign="top">Event seat </th>
				        <td>
				        	<input  name="event_spaces" type="text" style="width: 500px;">
				        </td>
			 	        
			     	</tr>

					 	<tr>
				         <th width="15%" valign="top">Event seat left</th>
				        <td>
				        	<input  name="event_remain_spaces" type="text" style="width: 500px;">
				        </td>
			 	        
			     	</tr>

					<tr>
				        <th width="15%" valign="top">Event Status</th>
				        <td colspan="2">
				        	<select id="Advertise_AdvertiseType_select" name="event_status" style="width: 200px">
								 <option value="0"> Disable</option>
								 <option value="1">Enable</option>
							</select>
				        </td>
			      	</tr>
					
			</tbody>
			</table>

			<input class="button button-primary" type="submit" value="Add">
			<a href="admin.php?page=advertisement" class="button">Cancel</a>
    	</form>
		


		
	


      
        