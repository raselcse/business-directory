<?php
	class IsdController{
		protected $load ;
		 function __construct(){
		   $this->load = new Load();
		}

		public function opl_ad_is_mobile() {
			
			$detect = new Opl_Mobile_Detect;
			 
			if($detect->isMobile() AND !$detect->isTablet()) {
				return true;
			}
			return false;
		}

		public function opl_ad_is_tablet() {
			
			$detect = new Opl_Mobile_Detect;
			 
			if($detect->isTablet()) {
				return true;
			}
			return false;
		}
	}