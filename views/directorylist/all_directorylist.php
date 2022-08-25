   



    <div id="opl-advertisement">

		

			<h2> Directory list </h2>


			

			 <?php 

				if(isset($success_msg)){

					echo '<h3 style="color:green">'.$success_msg ."</h3>";

				}

				else{

					echo '<h3 style="color:red">'.$error_msg."</h3>";

				}

				?>

                   <?php

					$html = '<table id="datatable-event" class="display">

					<thead>

						<tr>

						  <th scope="col">Sl No.</th>

						  <th scope="col">Company name</th>

						  <th scope="col">Org no</th>

						  <th scope="col">Visiting address</th>

						  <th scope="col">Post code</th>

						  <th scope="col">Ort</th>

						  <th scope="col">Phone no</th>
						
						  <th scope="col">Category</th>

						  <th scope="col">Tax certificate</th>

						  <th scope="col">Status</th>

						  <th scope="col"></th>
						  <th scope="col"></th>


						</tr>

					</thead>

					<tbody>';

					$sl_no = 0;

					foreach( $types as $type ) {

						// $company_category_array =unserialize($type->company_category);
						
						// $company_categories = implode(", ", $company_category_array);
						$company_categories =$type->company_category;

					    $sl_no =$sl_no+1; 

					    if($type->status ==1){

							$approveButton="<a href='#' class='approve_disapprove_btn' data-toggle='modal' data-status='$type->status' data-id='$type->id'> Disaprove</a>";

						}

						else{

							$approveButton="<a href='#'  class='approve_disapprove_btn' data-status='$type->status' data-id='$type->id'>Approve</a>";

						}



						if($type->company_file_name != NULL){

							$download="<a href='$type->company_file_name' target='_blank' class='download' data-id='$type->id'> Download</a>";

						}

						else{

							$download="<a href='#'  class='download' data-status='$type->status' data-id='$type->id'>Not Available</a>";

						}



						$html .= "<tr>

						<td> $sl_no </td>

						<td> $type->company_name </td>

						<td> $type->org_no </td>

						<td> $type->visiting_address </td>

						<td> $type->post_code </td>

						<td> $type->ort </td>

						<td> $type->phone_no </td>

						<td> $company_categories </td>

						<td> $download </td>

						<td> $approveButton </td>

					

						<td> <a href='admin.php?page=editDirectorylist&id=$type->id'>Edit</a> </td>
						<td> <a href='admin.php?page=deleteDirectorylist&id=$type->id'>Delete</a> </td>

					  </tr>";

					}

					echo  $html;

					?>



				</tbody>

                <thead>

                <tr>

				<tr>

					<th scope="col">Sl no.</th>

					<th scope="col">Company name</th>

					<th scope="col">Org no</th>

					<th scope="col">Visiting address</th>

					<th scope="col">Post code</th>

					<th scope="col">Ort</th>

					<th scope="col">Phone no</th>

					<th scope="col">Category</th>

					<th scope="col">Tax certificate</th>

					<th scope="col">Status</th>

					<th scope="col"></th>
					<th scope="col"></th>


					</tr>

                </thead>

			</table>







			









			<div id="approve_membership_modal" class="modal">



						<!-- Modal content -->

						<div class="modal-content">

							<span class="close">&times;</span>

							<div class="form-section">

								<div class=row> 

									<h3> Medlemsansökan </h3>

									<form role="form" name="approve_membership_form" method="post" id="approve_membership_form">

                                        

                                      

                                        <div class="col-xs-12 form-group">
										<!-- <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
											<option value="AL">Alabama</option>
												...
											<option value="WY">Wyoming</option>
										</select> -->

										<select name="directory_category[]" class="directory_category" multiple="multiple">

											<option value="bevakning">BEVAKNING</option>

											<option value="brand">BRAND</option>

											<option value="inbrott">INBROTT</option>

											<option value="kamera">KAMERA</option>

											<option value="larcentral">LARMCENTRAL</option>

											<option value="las">LÅS</option>

											<option value="passage">PASSAGE</option>

											<option value="ovriga">ÖVRIGA SÄKERHETSPRODUKTER</option>

											<option value="grossist">GROSSIST/TILLVERKARE</option>

											<option value="afterforsaljare">ÅTERFÖRSÄLJARE/INSTALLATÖR</option>

										</select>

											

                                        </div>

                                        

                                        <input class="btn btn-success approve-membership-btn" type="button" value="Confirm for Approval"/>

										

									</form>

								</div>

							</div>

							

						</div>



					</div>







		

		</div>