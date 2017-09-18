<?php
	class Cv extends Basecareer_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		
		 
		public function getAllCv(){
			$load              = new Basecareer_load();
			// $prescriptionModel         = $load->model('model_candidate');
			// $allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllCandidate('candidate');
            $load->view('candidate/job-list');
		   
		   //echo "test";
		}
		public function addNewCv($msg = null){
		
		}
		
	
		public function saveCandidate(){
				
			
		}
		
		
	
		public function getCvByUserId(){
			$load              = new Basecareer_load();
			$candidateModel      = $load->model('model_candidate');
			$current_user = wp_get_current_user();
			$userid = $current_user->ID;
			$candidate['basicinfo'] = $candidateModel->getByWhere('candidate' , 'candidate_userid', $userid);
			$candidate['experiences'] = $candidateModel->getByWhere('candidate_experience' , 'candidate_userid', $userid);
			$candidate['academic_qualifications'] = $candidateModel->getByWhere('candidate_academic_qualification' , 'candidate_userid', $userid);
			$candidate['professional_qualifications'] = $candidateModel->getByWhere('candidate_professional_qualification' , 'candidate_userid', $userid);
			$candidate['references'] = $candidateModel->getByWhere('candidate_reference' , 'candidate_userid', $userid);
            $load->template('candidate_profile_edit' , $candidate);
			
		}
		public function updateCV(){
			$load                = new Basecareer_load();
			$candidateModel      = $load->model('model_candidate');
			$current_user = wp_get_current_user();
			$userid = $current_user->ID;

            $data             = array();
			$data['name']  = $_REQUEST['name'];
			$success_update = $candidateModel->updateWhere('candidate',$data, 'candidate_userid', $userid);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";
			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('candidate');
			$load->view('prescription/edit_prescription' ,$allPrescriptionOrder, $msg);
		}
		public function deleteCv(){
			$load             	 = new Basecareer_load();
			$labTestModel        = $load->model('model_candidate');
			$id                  = $_GET['id'];
			$getPrescription = $labTestModel->getByIdPrescription('candidate',$id);
			$media_id = $getPrescription[0]->prescription_media_id;
			$deleteLabTest       = $labTestModel->deleteByIdPrescription('candidate',$id);
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription(candidate);
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