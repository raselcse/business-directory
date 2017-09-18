<?php
	class Candidate_file extends Basecareer_controller{
		
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
		
	
		public function saveFile(){
			 $data             = array();
			 $current_user =  wp_get_current_user();
			 $data['candidate_userid']  =$current_user->ID;
			 $data['company_name']  =$_REQUEST['company_name'];
			 $data['designation']=$_REQUEST['designation'];
			 $data['responsibility']=$_REQUEST['responsibilities'];
			 $data['start_date']=$_REQUEST['start_date'];
			 $data['end_date']=$_REQUEST['end_date'];
			 
			 $load = new Basecareer_load();
			 $labTestModel = $load->model('model_candidate_experience');
			 $success_insert = $labTestModel->save('candidate_experience' , $data);

				
			header("Location:/solar/apply-job?msg=successfully create your Biodata");
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