
     
			<h1>Add New Advertisement Type</h1>
            <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
				if(isset($types)){
					foreach( $types as $type ) {
						$id = $type->id;
						$title = $type->title;
						$width = $type->width;
						$height = $type->height;
						$description = $type->description;
					}
					?>
				
			<form action="admin.php?page=update_type" method="post">
                <table class="widefat" style="margin-top: .5em;">
					<tbody>
				      	<tr>
					        <th width="15%">Title</th>
					        <td colspan="2">
					        	  <input type="hidden" name="id" required value ="<?php echo $id; ?>" autocomplete="off" />
					  			<input type="text" name="title" required value ="<?php echo $title; ?>" autocomplete="off" />
					        </td>
				      	</tr>
				      
				      	
					  	<tr>
					        <th valign="top">Type Width</th>
							<td colspan="2">
								 <input type="text" name="width" required value ="<?php echo $width; ?>" autocomplete="off"/>
						</tr>

						<tr>
					         <th width="15%" valign="top">Type Height</th>
					        <td>
					        	<input type="text" name="height" required  value ="<?php echo $height; ?>" autocomplete="off"/>
					        </td>
				 	        
				     	</tr>
				     	<tr>
					        <th width="15%" valign="top">Type Description</th>
					        <td>
					        	<textarea name="description">
					<?php echo $description; ?>
					</textarea>
					        </td>
				 	        
				     	</tr>
				     	<tr>
				     		<td>
				     			<button type="submit" class=" button button-primary"/>Update</button>
				     		</td>
				     	</tr>
				     </tbody>
          
			</form>
			
			<?php
				}
				?>

        
        