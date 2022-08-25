<?php
	class IsdDatabase{
		protected $tables;
		public function __construct(){
			global $wpdb;
			
			$this->tables = array('directory_list'=> $wpdb->prefix.'sem_directorylist'
								);
		}
		
		
	}