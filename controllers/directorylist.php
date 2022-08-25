<?php
	class Directorylist extends IsdController{
		
		function __construct()
		{
			parent::__construct();
		}


	    public	function isd_admin_menu() {
			add_menu_page(
				__( ' Directory list'),
				' Directory list',
				'manage_options',
				'directorylist',
				array( 'Directorylist','getAllDirectorylist') ,
				'',
				plugins_url( 'myplugin/images/icon.png' ),
				20
			);
		}
		public	function isd_admin_submenu() {
			
			
			// add_submenu_page('directorylist', 
			// 				'Add New Directorylist ', 
			// 				'Add New Directorylist',
			// 				'manage_options', 
			// 				'add_directorylist',
			// 				array( 'Directorylist','add_new_directorylist') 
			// 				);
			add_submenu_page('For Saving data', 
							'', 
							'',
							'manage_options', 
							'saveDirectorylist',
							array( 'Directorylist','saveDirectorylist') 
							);	
							
			// add_submenu_page('Get data for Update data', 
			// 				'', 
			// 				'',
			// 				'manage_options', 
			// 				'getDirectorylistById',
			// 				array( 'Directorylist','getDirectorylistById') 
			// 				);	
			add_submenu_page('Edit Directorylist', 
								'', 
								'',
								'manage_options', 
								'editDirectorylist',
								array( 'Directorylist','getDirectorylistById') 
			);
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'updateDirectorylist',
							array( 'Directorylist','updateDirectorylist') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'deleteDirectorylist',
							array( 'Directorylist','deleteDirectorylist') 
							);	
			
		}
		public function directorylist_shortcode(){
		
			$load              = new strativ_directory_list\Load();
			$typeModel         = $load->model('DirectorylistModel');
			$directorylists = $typeModel->getActiveAllDirectorylist('sdl_directorylist','status',1);
            ?>
            
                <?php
                $html ='<form  id="directory_category">
			
							<div class="brand">
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="bevakning" class="cat_list"><span>BEVAKNING</span>
											</label>
										</div>
									
									
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="brand" class="cat_list"><span>BRAND</span>
											</label>
										</div>
									
										
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="inbrott" class="cat_list"><span>INBROTT</span>
											</label>
										</div>
										
										
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="kamera" class="cat_list"><span>KAMERA</span>
											</label>
										</div>
									
										
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="larcentral" class="cat_list"><span>LARMCENTRAL</span>
											</label>
										</div>

										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="las" class="cat_list"><span>LÅS</span>
											</label>
										</div>
									
									
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="passage" class="cat_list"><span>PASSAGE</span>
											</label>
										</div>
									
										
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="ovriga" class="cat_list"><span>ÖVRIGA SÄKERHETSPRODUKTER</span>
											</label>
										</div>
										
										
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="grossist" class="cat_list"><span>GROSSIST/TILLVERKARE</span>
											</label>
										</div>
									
										
										<div class="ck-button">
											<label>
												<input type="checkbox" name="company_category" value="afterforsaljare" class="cat_list"><span>ÅTERFÖRSÄLJARE/INSTALLATÖR</span>
											</label>
										</div>
										
									
							</div>
						
					</form>
					<table id="front-end-datatable" class="display">
						<thead>
							<tr>
							<th scope="col">NAMN</th>
							<th scope="col">ADRESS</th>
							<th scope="col">POSTNR</th>
							<th scope="col">ORT</th>
							<th scope="col">TELEFON</th>
							</tr>
						</thead>
					<tbody>';
                $sl_no = 0;
                foreach( $directorylists as $directorylist ) {
                    $sl_no =$sl_no+1; 
                    

                    $html .= "<tr>
                      <td> <a target='blank' href='$directorylist->web_address'>$directorylist->company_name </a> </td>
                      <td> $directorylist->visiting_address </td>
					  <td> $directorylist->post_code </td>
					  <td> $directorylist->ort </td>
                      <td> $directorylist->phone_no </td>
                    </tr>";
                }

                $html.='</tbody>
                <thead>
                <tr>
					<th scope="col">NAMN</th>
					<th scope="col">ADRESS</th>
					<th scope="col">POSTNR</th>
					<th scope="col">ORT</th>
					<th scope="col">TELEFON</th>
                </tr>
                </thead>
            </table>';
            $html.='<div id="membership_modal" class="modal">

						<!-- Modal content -->
						<div class="modal-content">
							<span class="close">&times;</span>
							<div class="form-section">
								<div class=row> 
									<h3> Medlemsansökan </h3>
									<form role="form" enctype="multipart/form-data" name="membership_form" method="post" id="membership_form" action="'.site_url().'/wp-admin/admin-post.php">
                                        
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control company_name" name="company_name" placeholder="Företagets namn" type="text" />
									    </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control org_no" name="org_no" placeholder="Org nr" type="text" />
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control company_oparation" name="company_oparation" type="text" placeholder="Företagets verksamhet" />
                                        </div>

                                        <div class="col-xs-4 form-group">
                                            <input class="form-control visiting_address" name="visiting_address" type="text" placeholder="Besöksadress" />
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control mailing_address" name="mailing_address" type="text" placeholder="Postadress" />
										</div>
										
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control post_code" name="post_code" type="text" placeholder="Postnummer" />
										</div>
										
										<div class="col-xs-4 form-group">
										<input class="form-control ort" name="ort" type="text" placeholder="Ort" />
										</div>


                                        <div class="col-xs-4 form-group">
                                            <input class="form-control phone_no" name="phone_no" type="text" placeholder="Telefonnummer"  />
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control web_address" name="web_address" type="text" placeholder="Webbadress" />
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control company_email" name="company_email" type="text" placeholder="E-post till företaget" />
                                        </div>

                                        <div class="col-xs-4 form-group">
                                        <input class="form-control ceo_name" name="ceo_name" type="text" placeholder="VD namn" />
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control ceo_email" name="ceo_email" type="text" placeholder="E-post till VD" />
                                        </div>
                                       
										<div class="col-xs-4 form-group">
											<input class="form-control company_contact_name" name="company_contact_name" type="text" placeholder="Företagets kontaktperson" />
										</div>

                                        <div class="col-xs-4 form-group">
                                            <input class="form-control account_email" name="account_email" type="text" placeholder="E-post"  />
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control annual_financial_statement" name="annual_financial_statement" type="text" placeholder="Årsomsättning senaste bokslut" />
                                        </div>

                                        <div class="col-xs-4 form-group">
                                            <input class="form-control employee_total" name="employee_total" type="text" placeholder="Antal heltidsanställda 31/12"  />
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <input class="form-control other_employee_total" name="other_employee_total" type="text" placeholder="Antal övriga anställda 31/12" />
										</div>

										<div class="col-xs-12 form-group">
											<div class="col-xs-6 form-group">
												<div class="file-upload">
													<label for="upload" class="file-upload__label">Upload Taxt Certificate</label>
													<input id="upload" class="file-upload__input" type="file" name="company_file">
												</div>

												<div class="added_message" style="display:none"></div>
												
											</div>
											
											<div class="col-xs-6 form-group">
											<input type="hidden" name="action" value="directorylist_save_action"/>
											<input class="btn membership-registration" type="button" value="ANSÖK OM MEDLEMSKAP"/>
											</div>
										</div>

                            
									</form>
								</div>
							</div>
							
						</div>

					</div>
					<div id="membershipSuccessModal" class="modal">

						<!-- Modal content -->
						<div class="modal-content text-center">
							<span class="close">&times;</span>
							<div class="form-section">
								<h3 class="text-center"> Din förfrågan har ställts in.
								</h3>
							
							</div>
							
						</div>

					</div>
					<div id="membershipErrorModal" class="modal">

						<!-- Modal content -->
						<div class="modal-content text-center">
							<span class="close">&times;</span>
							<div class="form-section">
								<h3 class="text-center">your directory has not submit. Please again send info.
								</h3>
							
							</div>
							
						</div>

					</div>';
			echo $html;
            
        ?>

            
		<?php	
		}
		
		public function add_new_directorylist(){
			$load              = new strativ_directory_list\Load();

			$load->view('event/add_new_directorylist');
			//$table_advertise_types = $this->tables['advertise_types'];
			
		}
		
		public function saveDirectorylist(){
			 $event_title          = $_REQUEST['event_title'];
			 $event_details            = $_REQUEST['event_details'];
			 $event_location             = $_REQUEST['event_location'];
			 $event_start_date = $_REQUEST['event_start_date'];
			 $event_end_date       = $_REQUEST['event_end_date'];
			 $event_spaces    = $_REQUEST['event_spaces'];
			 $event_remain_spaces       = $_REQUEST['event_remain_spaces'];
			 $event_status         = $_REQUEST['event_status'];
			  
			 $data             = array();
			 $data['event_title']  =$event_title;
			 $data['event_location']=$event_location;
			 $data['event_details']     =$event_details;
			 $data['event_owner']     = get_current_user_id();
			 $data['event_start_date']      =$event_start_date;
			 $data['event_end_date']=$event_end_date;
			 $data['event_spaces']=$event_spaces;
			 $data['event_remain_spaces']=$event_remain_spaces;
			 $data['event_status']  =$event_status;
			 
			 $load = new strativ_directory_list\Load();
			 $typeModel = $load->model('DirectorylistModel');
			 $success_insert = $typeModel->save_directorylist('sdl_directorylist', $data);
				$msg = array();
				if($success_insert){
					$msg['success_msg'] = "Data has been added";
				}
				else{
					$msg['error_msg'] = "Cannot added data to server";
				}
				$load->view('event/add_new_directorylist' , $msg);
			}


		public function directorylist_save(){
			$home_url = site_url();
			$company_name          = $_REQUEST['company_name'];
			$org_no            = $_REQUEST['org_no'];
			$company_oparation             = $_REQUEST['company_oparation'];
			$visiting_address = $_REQUEST['visiting_address'];
			$mailing_address       = $_REQUEST['mailing_address'];
			$post_code    = $_REQUEST['post_code'];
			$ort    = $_REQUEST['ort'];
			$phone_no       = $_REQUEST['phone_no'];
			$web_address         = $_REQUEST['web_address'];
			$company_email          = $_REQUEST['company_email'];
			$ceo_name            = $_REQUEST['ceo_name'];
			$ceo_email             = $_REQUEST['ceo_email'];
			$company_contact_name = $_REQUEST['company_contact_name'];
			$account_email       = $_REQUEST['account_email'];
			$annual_financial_statement    = $_REQUEST['annual_financial_statement'];
			$employee_total       = $_REQUEST['employee_total'];
			$other_employee_total         = $_REQUEST['other_employee_total'];
			$company_file         = $_REQUEST['company_file'];
			 

			$current_date = date("Y-m-d H:i:s");   
			$data             = array();
			$data['approver_id']  =0;
			$data['company_name']  =$company_name;
			$data['org_no']=$org_no;
			$data['company_oparation']     =$company_oparation;
			$data['visiting_address']      =$visiting_address;
			$data['mailing_address']=$mailing_address;
			$data['post_code']=$post_code;
			$data['ort']=$ort;
			$data['phone_no']=$phone_no;
			$data['web_address']  =$web_address;
			$data['company_email']      =$company_email;
			$data['ceo_name']=$ceo_name;
			$data['ceo_email']=$ceo_email;
			$data['company_contact_name']=$company_contact_name;
			$data['account_email']  =$account_email;
			$data['annual_financial_statement']=$annual_financial_statement;
			$data['employee_total']=$employee_total;
			$data['other_employee_total']  =$other_employee_total;
			$data['company_file_name']  =$company_file;
			$data['created_at']=$current_date;
			$data['updated_at']  =$current_date;
			$data['status']  =0;
			$load = new strativ_directory_list\Load();
			$typeModel = $load->model('DirectorylistModel');
			$email_exist = $typeModel->directory_exist_with_field('sdl_directorylist', 'company_email', $company_email);
			
			if($company_email !=NULL){
				if(!$email_exist){
					$success_insert = $typeModel->save_directorylist('sdl_directorylist', $data);
					
					if($success_insert){
						echo "added";
						exit();
					}
					else{
						echo "not added";
						exit();
					}
				}
				else{
					echo "email has exist";
					exit();
				}
			}
			else{
				echo "email has empty";
				exit();
			}
			
			
				
		}
			   
		public function directory_approve_disaprove(){
			$id               = $_REQUEST['id'];
			$directory_category   =serialize($_REQUEST['directory_category']);
			
			$company_category_array =unserialize($directory_category);
						
			$categories = implode(", ", $company_category_array);
			$status         = $_REQUEST['status'];
			 //var_dump($directory_category);
			// exit;
			//echo $directory_category;
			//exit();
			$data             = array();
			$data['company_category']  =$categories;
			$data['approver_id']     = get_current_user_id();
			$data['status']  =$status;

		   

			$load = new strativ_directory_list\Load();
			$typeModel = $load->model('DirectorylistModel');
			$check_user_created = $typeModel->getById_directorylist('sdl_directorylist',$id);
			//var_dump($check_user_created[0]->approver_id);
			
			//exit();
			if($check_user_created[0]->approver_id == 0){
				$password = wp_generate_password( 12, true );
                $user_data = array(
					'ID' => '',
					'user_pass' => $password ,
					'user_login' => $check_user_created[0]->company_email,
					'user_nicename' => $check_user_created[0]->company_name,
					'user_url' => $check_user_created[0]->web_address,
					'user_email' => $check_user_created[0]->company_email,
					'display_name' => $check_user_created[0]->company_name,
					'nickname' => $check_user_created[0]->company_name,
					'first_name' => $check_user_created[0]->company_name,
					'user_registered' => '2010-05-15 05:55:55',
					'role' => get_option('subscriber') // Use default role or another role, e.g. 'editor'
				);
				
				$user_id = wp_insert_user( $user_data );
				$user = new WP_User($user_id);
				$user->set_role('subscriber');
				//wp_mail( $check_user_created[0]->company_email, 'Welcome!', 'Your password is: ' . $password );
				//sdl_send_password_reset_mail($user_id);
			}
		   

			$success_update = $typeModel->update_directorylist('sdl_directorylist',$data,$id);
			
		}
		public function directory_filter(){
			$catagory_list = $_REQUEST['choices'];
			$filter_value= array();
			foreach($catagory_list as $Key=>$value){
				
				array_push($filter_value,$value);
				
			}
			$filter_value = array_values($filter_value[0]);
			$load              = new strativ_directory_list\Load();
			$typeModel         = $load->model('DirectorylistModel');
			$filter_value = array_values($filter_value[0]);
			
			$allTypes= $typeModel->get_directory_filter('sdl_directorylist', $filter_value);

			return $allTypes;
		}

		public function getAllDirectorylist(){
			$load              = new strativ_directory_list\Load();
			$typeModel         = $load->model('DirectorylistModel');
		
			$allTypes['types'] = $typeModel->getAll_directorylist('sdl_directorylist');
			
			$load->view('directorylist/all_directorylist' , $allTypes);
		}
		
		public function getActiveAllDirectorylist(){
			$load              = new strativ_directory_list\Load();
			$typeModel         = $load->model('DirectorylistModel');
			$allTypes['types'] = $typeModel->getActiveAllDirectorylist('sdl_directorylist','status', 1);
           
			$load->view('event/all_directorylist' , $allTypes);
		}

		public function getDirectorylistById(){
			$load              = new strativ_directory_list\Load();
			$typeModel         = $load->model('DirectorylistModel');
			$id                = $_GET['id'];
			$allTypes['types'] = $typeModel->getById_directorylist('sdl_directorylist',$id);
			$load->view('directorylist/edit_directorylist' , $allTypes);
		}
		public function updateDirectorylist(){

			$id               = $_REQUEST['id'];
			$company_name          = $_REQUEST['company_name'];

			$directory_category   =serialize($_REQUEST['company_category']);
		
			$company_category_array =unserialize($directory_category);
					
			$categories = implode(", ", $company_category_array);
			$org_no            = $_REQUEST['org_no'];
			$visiting_address = $_REQUEST['visiting_address'];
			$post_code    = $_REQUEST['post_code'];
			$phone_no       = $_REQUEST['phone_no'];
			$status         = $_REQUEST['status'];
			

			$current_date = date("Y-m-d H:i:s");   
			$data             = array();
		
			$data['company_name']  =$company_name;
			$data['company_category']  =$categories;
			$data['org_no']=$org_no;
			$data['visiting_address']      =$visiting_address;
			$data['post_code']=$post_code;
			$data['phone_no']=$phone_no;
			$data['updated_at']  =$current_date;
			$data['status']  =$status;

		

			$load = new strativ_directory_list\Load();
			$typeModel = $load->model('DirectorylistModel');
			$success_update = $typeModel->update_directorylist('sdl_directorylist',$data,$id);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";

			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allTypes['types'] = $typeModel->getAll_directorylist('sdl_directorylist');
			$load->view('directorylist/all_directorylist' ,$allTypes, $msg);
		}
		public function deleteDirectorylist(){
			$load              = new strativ_directory_list\Load();
			$typeModel         = $load->model('DirectorylistModel');
			$id                = $_GET['id'];
			$deleteType        = $typeModel->deleteById_directorylist('sdl_directorylist',$id);
	

			//$deleteImage        = $typeModel->getFieldById('sdl_directorylist','company_file_name',$id);
			
			//unlink($deleteImage);
			//unlink('http://localhost/sakerhetsbranschen/wp-content/uploads/2018/10/demo-m2.xtento.com_.png');
			

			$allTypes['types'] = $typeModel->getAll_directorylist('sdl_directorylist');
			$msg = array();
			if($deleteType){
				$msg['success_msg'] = "Data has been Deleted";
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('directorylist/all_directorylist' , $allTypes, $msg);
		}

		

		public function update_directorylist_space($id){
			$load = new strativ_directory_list\Load();
			$change_directorylist_space = $load->model('DirectorylistModel');
			$change_directorylist_space->update_directorylist_space('sdl_directorylist',$id);
		}

	
}