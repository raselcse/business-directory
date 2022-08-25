
         
			<h1>Add New Advertisement Type</h1>
            <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}?>
			<form action="admin.php?page=save_new_type" method="post">
          
				<table class="widefat" style="margin-top: .5em;">
					<tbody>
				      	<tr>
					        <th width="15%">Title</th>
					        <td colspan="2">
					        	 <input type="text" name="title" required autocomplete="off" />
					        </td>
				      	</tr>
				      
				      	
					  	<tr>
					        <th valign="top">Type Width</th>
							<td colspan="2">
								 <input type="text" name="width" required autocomplete="off"/>
						</tr>

						<tr>
					         <th width="15%" valign="top">Type Height</th>
					        <td>
					        	<input type="text" name="height" required autocomplete="off"/>
					        </td>
				 	        
				     	</tr>
				     	<tr>
					        <th width="15%" valign="top">Type Description</th>
					        <td>
					        	<textarea name="description">
								</textarea>
					        </td>
				 	        
				     	</tr>
				     	<tr>
				     		<td>
				     			<button type="submit" class=" button button-primary"/>Save</button>
				     		</td>
				     	</tr>
				     </tbody>
			     </table>
				
          
			</form>

       
        
        