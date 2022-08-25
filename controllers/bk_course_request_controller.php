<?php
	class Course_request_controller extends IsdController{
		
		function __construct()
		{
			parent::__construct();
		}

	    //shortcode function
		public function course_request_button_shortcode() {
			global $post;
			$user_id = get_current_user_id();
			//$course_id = $post->ID;
			$course_id   = (int)$_REQUEST['course_id'];
			$course_name = get_the_title($course_id);
			$allready_send_request = 0;
			$obj = new Course_request_controller();
			//check already apply
			$allready_send_request =$obj->request_course_count_user($user_id, $course_id); 
			$allready_send_request =count($allready_send_request);

			$enrolled_users = get_course_groups_users_access($course_id);
			//course enroll check 
			$allready_enroll  = in_array($user_id,$enrolled_users);
			//group exist check
			$exist_group = count($obj->get_user_group($user_id));
			//categories define for active request form
			$categories = get_the_terms( $course_id, 'ld_course_category' );
			if ( $categories && ! is_wp_error( $categories ) ){
				foreach($categories as $key => $category) {
					$all_cat [] =  $category->slug;
				}
				$check_with = array(0=>'developmental-individual', 1=>'developmental-manager');
				$is_exist_cat =count(array_intersect($all_cat,$check_with));
			}
			

			$current_user_data = wp_get_current_user();
			$is_group_leader = in_array( 'group_leader', (array) $current_user_data->roles);
			if( !$allready_enroll && !is_admin() && !$is_group_leader ){
				$group_id =(int) $obj->get_user_group_id($user_id);
				$leader_list = $obj->get_group_leader_id($group_id);
				
				$leader_html = "";
				foreach($leader_list as $leader){
					$leader_id =$leader->user_id;
					$leader_username = get_userdata($leader_id)->user_login;
					$leader_html .= "<option value=$leader_id>$leader_username</option>";
				}
				// Any mobile device (phones or tablets).
				if(isset($_GET['msg'])){
					$notic_message = '<div class="message_notice"> '.$_GET["msg"].'  </div>';
				}
				else{
					$notic_message='';
				}
				if(is_page() && !$allready_send_request ){

					//$notic_message = $notic_message . '<br/> Course Name: ' .  $course_name;
					$custom_content = $notic_message ; //.'<div id="btn-join" class="course-request-active"><span class="course-request-button apply-button">Apply To Group admin</span></div>';
					
					$custom_content .='<div class="course-request-from">
										<form methode="post" action="'.site_url().'/wp-admin/admin-post.php">
											
										<fieldset>
										<legend> Name of Course: ' . $course_name . '</legend>
										<legend> Please explain why you are interested to take this course:</legend>
										<textarea name="request_text" placeholder="Why do you like this course?" required></textarea>
										</fieldset>
										<input type="hidden" name="action" value="course_request_action"/>
										<input type="hidden" name="course_id" value='.$course_id.' >
										<input type="hidden" name="request_status" value="pending">
										<input type="submit" value="Apply" />
										</form>
										</div>';
					return $custom_content;
				}
				else{
					return $notic_messag.'<span class="course-request-notice">You have already requested for this course</span><br/><br/><br/>';
				}
			
			}
			else{
				return '<button class="course-request-button">Already Enrolled test or you are a leader</button>';
			}
		}
        //After submit request and save 
		public function save_course_request(){
		
			$user_id               = get_current_user_id();
			$course_id             = (int)$_REQUEST['course_id'];
			$group_leader_id       = (int)$_REQUEST['group_leader_id'];
			$request_text          = $_REQUEST['request_text'];
			$status                = $_REQUEST['request_status'];
			  
			$data            	   = array();
			$data['user_id']  	   = $user_id;
			$data['course_id']	   = $course_id;
			$data['request_text']  = $request_text;
			$data['request_status']= $status;
			$load = new Load();
			$typeModel = $load->model('course_request_model');
			$success_insert = $typeModel->save_course_request('course_request' , $data);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been added";
				$course_link = get_permalink($course_id);
				wp_redirect($course_link.'?msg='.$msg['success_msg']);
			}
			else{
				$msg['error_msg'] = "Cannot added data to server";
				$course_link = get_permalink($course_id);
				wp_redirect($course_link.'?msg='.$msg['error_msg']);
			}
		}
        // enroll user to group
		public function enroll_user_to_group(){
		    $users = array();
			$all_checked_request     = $_REQUEST['request_id'];
			$group_id    = $_REQUEST['group_id'];
			$group_user_limit = get_post_meta($group_id, 'wdm_group_users_limit_'.$group_id, true);
			if($group_user_limit > 0){
				foreach($all_checked_request as $request_id){
					$request_id = (int)$request_id;
					$request_info = $this->course_request_by_id($request_id);
					$user_id = (int)$request_info[0]->user_id;
					ld_update_group_access($user_id, $group_id);
					update_user_meta( $user_id, 'learndash_group_users_'.$group_id.'', $group_id );
					$this->update_course_request($request_id);
				}
			}
		}
		//get all course request
		public function all_course_request(){
			$load              = new Load();
			$request_model      = $load->model('course_request_model');
			$all_course_request = $request_model->get_all_course_request('course_request');
           
			return $all_course_request;
		}
        //get all course request status "pending"
		public function all_pending_course_request(){
			$load              = new Load();
			$request_model      = $load->model('course_request_model');
			$all_course_request = $request_model->getByWhere('course_request','request_status','pending');
           
			return $all_course_request;
		}
        //get all course request status "enroll"
		public function all_enroll_course_request(){
			$load              = new Load();
			$request_model      = $load->model('course_request_model');
			$all_course_request = $request_model->getByWhere('course_request','request_status','enroll');
           
			return $all_course_request;
		}
        //get all course request info
		public function course_request_by_id($request_id){
			$load              = new Load();
			$request_model      = $load->model('course_request_model');
			$request_info = $request_model->get_all_course_request_by_id('course_request',$request_id);
           
			return $request_info;
		}

		public function get_user_group_id($user_id){
			global $wpdb;
			$results = $wpdb->get_results( "SELECT * FROM $wpdb->usermeta WHERE user_id=$user_id and meta_key like 'learndash_group_users_%'" );
			$vale=count($results)-1;
			$group_id=$results[$vale]->meta_value;
			return $group_id;
		}

		public function get_user_group($user_id){
			global $wpdb;
			$results = $wpdb->get_results( "SELECT meta_value FROM $wpdb->usermeta WHERE user_id=$user_id and meta_key like 'learndash_group_users_%'" );
			
			return $results;
		}

		public function get_group_for_leader($user_id){
			global $wpdb;
			$results = $wpdb->get_results( "SELECT meta_value FROM $wpdb->usermeta WHERE user_id=$user_id and meta_key like 'learndash_group_leader_%'" );
			
			return $results;
		}

		public function get_group_associate_course($course_id){
			
			global $wpdb;
			$sql = $wpdb->prepare( "SELECT meta_key FROM $wpdb->postmeta WHERE post_id=$course_id and meta_key like 'learndash_group_enrolled_%'", NULL );
			$results = $wpdb->get_results( $sql );
			
			return $results;
		}

		public function get_group_by_course_id($course_id){
			$group_key_lists = $this->get_group_associate_course($course_id);
			if($group_key_lists !=NULL){
				$group_enroll = array();

				foreach($group_key_lists as $group_key){
						$group['id'] = (int)str_replace( 'learndash_group_enrolled_', '',$group_key->meta_key);
						array_push($group_enroll,$group);
				}

				return $group_enroll;
			}

		    return false;

		}

		public function get_group_leader_id($group_id){
			global $wpdb;
			$results = $wpdb->get_results( "SELECT user_id FROM $wpdb->usermeta WHERE meta_key like 'learndash_group_leaders_".$group_id."'" );
			return $results;
		}
		public function get_group_users($group_id){
			global $wpdb;
			$results = $wpdb->get_results( "SELECT user_id FROM $wpdb->usermeta WHERE meta_key like 'learndash_group_users_".$group_id."'" );
			return $results;
		}

		public function request_course_count_user($user_id, $course_id){
			$load              = new Load();
			$request_model      = $load->model('course_request_model');
			$all_course_request = $request_model->get_field_multiple_condition('course_request','user_id','course_id', $user_id, $course_id);
			return $all_course_request;
		}
		
	    public function update_course_request($request_id){
			$user_id               = get_current_user_id();
			  
			$data            	   = array();
			$data['manager_id']	   =$user_id;
			$data['request_status'] ='enroll';

			 $load = new Load();
			 $typeModel = $load->model('course_request_model');
			 $success_update = $typeModel->update_course_request_by_id('course_request',$data,$request_id);
			 $msg = array();
			 if($success_update){
				 $msg['success_msg'] = "Enrolled%20Successfully";
				 $course_link = get_permalink( get_page_by_path( 'group-management' ));
				 wp_redirect($course_link.'?msg='.$msg['success_msg']);
			 }
			 else{
				 $msg['error_msg'] = "Cannot%20Enroll";
				 $course_link = get_permalink( get_page_by_path( 'group-management' ));
				 wp_redirect($course_link.'?msg='.$msg['error_msg']);
			 }
		}

	
}