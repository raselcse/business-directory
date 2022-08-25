

       <style type="text/css">



       </style>

        <div id="">   

			<h1>Edit directory</h1>
			

            <?php if(isset($success_msg)){

					echo '<h3 style="color:green">'.$success_msg ."</h3>";



				}

				else{

					echo '<h3 style="color:red">'.$error_msg."</h3>";

				}

				if(isset($types)){

					foreach( $types as $type ) {
						
						$id=  $type->id ;

						$company_name=  $type->company_name ;

						$company_category = $type->company_category;
					//	$company_category_main = explode(",",$company_category);

						$org_no= $type->org_no ;

						$visiting_address=  $type->visiting_address ;

						$post_code= $type->post_code ;
						$ort= $type->ort ;

						$phone_no=  $type->phone_no ;

						$status=  $type->status ;

					}
					//echo $company_category;
				
					//$company_category =array ('bevakning', 'brand', 'kamera');
					//$company_category_values = array_values($company_category);
					//print_r( array_values($company_category_main));
					//var_dump(in_array( "brand", $company_category));
					?>

			<form enctype="application/x-www-form-urlencoded" action="admin.php?page=updateDirectorylist" method="post">

			<table class="widefat" style="margin-top: .5em;">

				<tbody>

			      	<tr>

				        <th width="15%"> NAMN</th>

				        <td colspan="2">

				        	<input  name="company_name" type="text" value="<?php echo $company_name; ?>" style="width: 300px;">

							<input  name="id" type="hidden" value="<?php echo $id; ?>" style="width: 300px;">

				        </td>

			      	</tr>
					 
					  <tr>

						<th width="15%" valign="top">Directory category</th>

						<td colspan="2">

						<select name="company_category[]" class="company_category" multiple="multiple">

							<option value="bevakning" <?php echo (strpos($company_category,'bevakning')===true)?"selected":"" ?>>BEVAKNING</option>

							<option value="brand" <?php echo (strpos($company_category,'brand')===true)?"selected":"" ?>>BRAND</option>

							<option value="inbrott" <?php echo (strpos($company_category,'inbrott')==true)?"selected":"" ?>>INBROTT</option>

							<option value="kamera" <?php echo (strpos($company_category,'kamera')==true)?"selected":"" ?>>KAMERA</option>

							<option value="larcentral" <?php echo (strpos($company_category,'larcentral')==true)?"selected":"" ?>>LARMCENTRAL</option>

							<option value="las" <?php echo (strpos($company_category,'las')==true)?"selected":"" ?>>LÅS</option>

							<option value="passage" <?php echo (strpos($company_category,'passage')==true)?"selected":"" ?>>PASSAGE</option>

							<option value="ovriga"<?php echo (strpos($company_category,'ovriga')==true)?"selected":"" ?>>ÖVRIGA SÄKERHETSPRODUKTER</option>

							<option value="grossist" <?php echo (strpos($company_category,'grossist')==true)?"selected":"" ?>>GROSSIST/TILLVERKARE</option>

							<option value="afterforsaljare" <?php echo (strpos($company_category,'afterforsaljare')==true)?"selected":"" ?>>ÅTERFÖRSÄLJARE/INSTALLATÖR</option>

							</select>

						</td>

					</tr>
			      
					<tr>

				         <th width="15%" valign="top">Org no</th>

				        <td>

				        	<input  name="org_no" type="text" value="<?php echo $org_no; ?>" style="width: 500px;">

				        </td>

			 	        

			     	</tr>

					 <tr>

						<th width="15%" valign="top">Org no</th>

						<td>

						<input  name="ort" type="text" value="<?php echo $ort; ?>" style="width: 500px;">

						</td>



						</tr>



					<tr>

					<th width="15%" valign="top">Visiting address</th>

					<td>

					<input  name="visiting_address" type="text" value="<?php echo $visiting_address; ?>" style="width: 500px;">

					</td>



					</tr>



					

					<tr>

				         <th width="15%" valign="top">Post code </th>

				        <td>

				        	<input  name="post_code" type="text" value="<?php echo $post_code; ?>" style="width: 500px;">

				        </td>

			 	        

			     	</tr>



					 	<tr>

				         <th width="15%" valign="top">Phone no</th>

				        <td>

				        	<input  name="phone_no" type="text" value="<?php echo $phone_no; ?>" style="width: 500px;">

				        </td>

			 	        

			     	</tr>



					<tr>

				        <th width="15%" valign="top">Directory status</th>

				         <td colspan="2">

						<select  name="status" style="width: 300px">

							<option value="0" <?php echo ($status == '0')?"selected":"" ?>> Disable</option>

							<option value="1" <?php echo ($status == '1')?"selected":"" ?> >Enable</option>

						</select>

						</td>

			      	</tr>

					

			</tbody>

			</table>



			<input class="button button-primary" type="submit" value="Update">

			<a href="admin.php?page=directorylist" class="button">Cancel</a>

    	</form>

	<?php

	}

	?>  