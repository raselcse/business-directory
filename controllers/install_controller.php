<?php
class Install_controller
{
	var $db_version = "1.1";
	var $tables;
	
	public function __construct()
	{
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$this->tables = array(
				'directory_list' 	=> $wpdb->prefix.'sdl_directorylist',
				'directory_file' 	=> $wpdb->prefix.'sdl_directoryfile',
				'directory_file_type' 	=> $wpdb->prefix.'sdl_directorytype',
		);
	}
	
	public function activate()
	{
			
		//$this->activate_app(__FILE__);
		
		
		
		add_option('strativ_directory_list', $this->db_version);
		$table_directory_listing = $this->tables['directory_list'];
		
		$sql_directory_listing = "CREATE TABLE ".$table_directory_listing." (
			id int(11) NOT NULL auto_increment,
			approver_id bigint(11) NOT NULL,
			company_name varchar(100) NULL,
			company_category varchar(100) NOT NULL DEFAULT 'retailer',
			org_no varchar(100) NULL,
			company_oparation varchar(100) NULL,
			visitig_address varchar(100)  NULL,
			post_code varchar(100) NULL,
			phone_no varchar(100) NULL,
			web_address varchar(100) NULL,
			company_email varchar(100)  NULL,
			ceo_name varchar(100) NULL,
			ceo_email varchar(100) NULL,
			company_contact_name varchar(100) NULL,
			account_email varchar(100)  NULL,
			annual_financial_statement bigint(20) NULL,
			employee_total varchar(100) NULL,
			other_employee_total varchar(100)  NULL,
			company_file_name varchar(250) NULL,
			status int(2) NOT NULL DEFAULT '1',
			created_at datetime NULL,
			updated_at datetime NULL,
			PRIMARY KEY  (id)
		  ) $charset_collate;";
		
		  $directory_file = $this->tables['directory_file'];
		
		  $sql_directory_file = "CREATE TABLE ".$directory_file." (
			  id int(11) NOT NULL auto_increment,
			  directory_id int(11) NOT NULL,
			  file_name varchar(250) NOT NULL,
			  file_type_id tinyint  NOT NULL DEFAULT '1',
			  PRIMARY KEY  (id)
			) $charset_collate;";

			$directory_file_type= $this->tables['directory_file_type'];
		
			$sql_directory_file_type = "CREATE TABLE ".$directory_file_type." (
				id int(11) NOT NULL auto_increment,
				file_type_name varchar(100) NOT NULL,
				PRIMARY KEY  (id)
			  ) $charset_collate;";
			require_once ABSPATH.'wp-admin/includes/upgrade.php';
			dbDelta($sql_directory_listing);
			dbDelta($sql_directory_file);
			dbDelta($sql_directory_file_type);
	} 
	
	public function deactivate()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		// add_option('opl_ad_db_version', $this->db_version);
			
		// $table_event = $this->tables['event'];
		// $table_booking = $this->tables['booking'];
		// $wpdb->query("DROP TABLE IF EXISTS ".$table_event."");
		// $wpdb->query("DROP TABLE IF EXISTS ".$table_booking."");

	}
}