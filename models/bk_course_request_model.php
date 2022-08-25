<?php
class Course_request_model extends IsdModel{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function save_course_request($table , $data){
		
		return $this->save($table , $data);
	}
	
	public function get_all_course_request($table){
		
		return $this->getAll($table);
	}

	
	public function get_all_course_request_by_id($table,$id){
		
		return $this->getById($table ,$id);
	}


	public function get_all_course_request_by_field($table,$field,$value){
		
		return $this->getByWhere($table,$field,$value);
	}

	public function delete_course_request_by_id($table,$id){
		
		return $this->deleteById($table , $id);
	}
	
	public function update_course_request_by_id($table,$data,$id){
		
		return $this->update($table,$data,$id);
	}

	public function getAdByMultipleWhere($table1, $table2, $id1, $id2, $cond_filed, $cond_value, $fields=false){
        if($fields == false){
            $fields = '*';
        }
		global $wpdb;
		$table1 = $wpdb->prefix.$table1;
		$table2 = $wpdb->prefix.$table2;

		$sql   = "SELECT $fields FROM $table1 JOIN $table2 ON $table1.$id1=$table2.$id2 WHERE $cond_filed=$cond_value";

		return $wpdb->get_results($sql);
	}
}