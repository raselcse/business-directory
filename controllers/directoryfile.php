<?php
	class Directoryfile extends IsdController{
		
		function __construct()
		{
			parent::__construct();
		}
		
		 
		public function getAllCandidateFile(){
			$load              = new Basecareer_load();
			$prescriptionModel         = $load->model('candidate_experience');
		    $allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllCandidate('candidate_experience');
            $load->view('candidate/job-list');
		   
		   //echo "test";
		}
		public function addNewFile($msg = null){
			$load              = new Basecareer_load();
			$load->view('candidate/candidant_apply_job', $msg);
		}
		
	    // Random code generator used for file names.
		function prescription_generate_random_code($length=10) {
		 
		   $string = '';
		   $characters = "23456789";
		 
		   for ($p = 0; $p < $length; $p++) {
			   $string .= $characters[mt_rand(0, strlen($characters)-1)];
		   }
		 
		   return $string;
		 
		}
		
		function fileSave(){
			 global $wpdb;
			// Getting old resume file of user
			
			$table_candidate_file = $wpdb -> prefix."candidate_file";
			$sql = "SELECT id, resume FROM ".$table_candidate_file." WHERE candidate_userid= '".get_current_user_id()."'";
			$sql_cover_letter = "SELECT id, cover_letter FROM ".$table_candidate_file." WHERE candidate_userid= '".get_current_user_id()."'";
			$sql_picture = "SELECT id, picture FROM ".$table_candidate_file." WHERE candidate_userid= '".get_current_user_id()."'";
			
			$rec_exits = $wpdb -> get_row($sql);
			$cover_letter_exits = $wpdb -> get_row($sql_cover_letter);
			$picture_exits = $wpdb -> get_row($sql_picture);
			
			$old_link = "";
			$old_cover_letter_link = "";
			$old_picture_link = "";
			
			if (count($rec_exits) > 0) {
				$old_link = get_home_url()."/".$rec_exits->resume;
			}
			
			if (count($cover_letter_exits) > 0) {
				$old_cover_letter_link =  get_home_url()."/".$cover_letter_exits->cover_letter;
			}
			
			if (count($picture_exits) > 0) {
				$old_picture_link = get_home_url()."/".$picture_exits->picture;
			}
            echo $old_link;
			exit();
			//exit;
			// sanitize form values
						  
			if ( ! function_exists( 'wp_handle_upload' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
			$uploadedfile = $_FILES['candidate_cv_file'];
			$candidate_cover_letter = $_FILES['candidate_cover_letter'];
			$candidate_picture = $_FILES['candidate_picture'];
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			$coverletermovefile = wp_handle_upload( $candidate_cover_letter, $upload_overrides );
			$picturemovefile = wp_handle_upload( $candidate_picture, $upload_overrides );
			if ( ($movefile && !isset( $movefile['error'] ) ) || ($coverletermovefile && !isset( $coverletermovefile['error'] ) ) || ($picturemovefile && !isset( $picturemovefile['error'] ) )) {
				$userid = get_current_user_id();
				if( $movefile && !isset( $movefile['error'] ) ){
					$data = array(
						"candidate_userid" => get_current_user_id(), 
						'resume' => strstr($movefile['url'], 'wp-content'),        
						//'picture' => strstr($picturemovefile['url'], 'wp-content'),      
					);
				}
				
					
				elseif( $coverletermovefile && !isset( $coverletermovefile['error'] ) ){
					$data = array(
						"candidate_userid" => get_current_user_id(),      
						'cover_letter' => strstr($coverletermovefile['url'], 'wp-content'),     
					);
				}
				if($movefile && !isset( $movefile['error'] ) && $coverletermovefile && !isset( $coverletermovefile['error'] ) ){
					$data = array(
						"candidate_userid" => get_current_user_id(),      
						'resume' => strstr($movefile['url'], 'wp-content'),    
						'cover_letter' => strstr($coverletermovefile['url'], 'wp-content'),        
					);
				}
				
				if( $picturemovefile && !isset( $picturemovefile['error'] ) ){
					$data ['picture'] = strstr($picturemovefile['url'], 'wp-content');     
					
				}
				
			
				
				
				
				if (count($rec_exits) > 0 || count($cover_letter_exits) > 0 || count($picture_exits) > 0) {
				
					// Deleting already saved resume of this user
					if(file_exists($old_link)){
						unlink($old_link);
					}
					if(file_exists($old_cover_letter_link)){
						unlink($old_cover_letter_link);
					}
					if(file_exists($old_picture_link)){
						unlink($old_picture_link);
						var_dump($old_picture_link);
						exit;
					}
					// Updating table
					$where = array( "candidate_userid" => get_current_user_id() );
					$wpdb->update( $table_candidate_file, $data, $where, $format, $where_format );
					header("Location:".site_url()."/edit-my-cv?msg=successfully Update your CV with file");
					
				} else {
					$rec_result = $wpdb -> insert($table_candidate_file, $data);
					$lastid = $wpdb -> insert_id;
					header("Location:".site_url()."/edit-my-cv?msg=successfully create your CV with file");
				}
        } else {
		
			header("Location:".site_url()."/edit-my-cv?msg=successfully Update your CV.");
        }  
		
	}
		
		
	
		public function getCandidateById(){
			$load              = new Basecareer_load();
			$labTestModel         = $load->model('model_candidate_experience');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('candidate_experience',$id);
            $load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updateFile(){
			$id                       = $_REQUEST['id'];
			$prescription_order_status = $_REQUEST['prescription_order_status'];
            
			$data             = array();
			$data['prescription_order_status']  = $prescription_order_status;
            var_dump($data['prescription_order_status']);
			$load = new Pres_load();
			$labTestModel = $load->model('model_candidate_experience');
			$success_update = $labTestModel->updatePrescription('candidate_experience',$data,$id);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";
			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('candidate_experience');
			$load->view('prescription/edit_prescription' ,$allPrescriptionOrder, $msg);
		}
		public function deleteCandidateFile(){
			$load             	 = new Basecareer_load();
			$labTestModel        = $load->model('model_candidate_experience');
			$id                  = $_GET['id'];
			$getPrescription = $labTestModel->getByIdPrescription('candidate_experience',$id);
			$media_id = $getPrescription[0]->prescription_media_id;
			$deleteLabTest       = $labTestModel->deleteByIdPrescription('candidate_experience',$id);
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('candidate_experience');
			$msg = array();
			
			if($deleteLabTest){
				$msg['success_msg'] = "Data has been Deleted";
				wp_delete_attachment( $media_id );
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('prescription/all_prescription' , $allPrescriptionOrder, $msg);
		}
	
}