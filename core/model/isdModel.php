<?php
Class IsdModel extends IsdDatabase{
	
	public function __construct(){
     	parent::__construct();
     }
	public function save($table , $data){
		 global $wpdb;
		 $table = $wpdb->prefix.$table;
		return $wpdb->insert($table , $data);
	}
	
	public function getAll($table){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table";
		return $wpdb->get_results($sql);
	}

	public function getField($table,$fieldName){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT $fieldName FROM $table";
		return $wpdb->get_results($sql);
	}

	public function getFieldById($table,$fieldName,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT $fieldName FROM $table WHERE id=$id";
		return $wpdb->get_results($sql);
	}
	
	public function getById($table,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table WHERE id=$id";
		return $wpdb->get_results($sql);
	}
	public function get_field_multiple_condition($table,$first_field, $second_field,$first_value,$second_value){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table WHERE $first_field=$first_value and $second_field=$second_value";
		return $wpdb->get_results($sql);
	}

	public function getByWhere($table ,$field , $value){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table WHERE $field = '$value'";
		return $wpdb->get_results($sql);
	}
	

	public function deleteById($table,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		return $wpdb->delete( $table, array( 'id' => $id ));
	}
	
	public function update($table,$data,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		return $wpdb->update($table, $data, array('id'=>$id));
	}
}