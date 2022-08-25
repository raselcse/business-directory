<?php
class DirectoryListModel extends IsdModel{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function save_directorylist($table , $data){
		
		return $this->save($table , $data);
	}
	
	public function getAll_directorylist($table){
		
		return $this->getAll($table);
	}

	public function get_directory_filter($table, $filter_array){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		// var_dump($fiter_array);
		// exit();
		//$test = array('brand','inbrott');
		$whereIn = implode("','", $filter_array); 
		$sql = "SELECT * FROM $table WHERE company_category IN ('".$whereIn."')";
		// var_dump($wpdb->get_results($sql));
		//  exit();
		$results = $wpdb->get_results($sql);
		
        //exit();
		$data = array();

		$col = array(
			0 =>'id',
			1 =>'company_name',
			2 => 'org_no',
			3 => 'company_category'

		);

		foreach($results as $result){
			$sub_array = array();
			$sub_array[] = $result->id;
			$sub_array[] = $result->company_name;
			$sub_array[] = $result->org_no;
			$sub_array[] = $result->company_category;
			$data[] = $sub_array;
		}
 
		$output = array(
			"draw"    => 2,
			"recordsTotal"  =>  count($results),
			"recordsFiltered" => count($results),
			"data"    => $data
		   );
		   
		   echo json_encode($output);

				// echo $result;
	}

	public function getActiveAllDirectorylist($table, $field, $value ){
		
		return $this->getByWhere($table, $field, $value);
	}
	
	public function getById_directorylist($table,$id){
		
		return $this->getById($table ,$id);
	}

	public function getFieldById($table,$field,$advertisement_id){
		
		return $this->getFieldById($table,$field,$advertisement_id);
	}

	public function getByDirectorylistWhere($table,$field,$value){
		
		return $this->getByWhere($table,$field,$value);
	}

	public function deleteById_directorylist($table,$id){
		
		return $this->deleteById($table,$id);
	}
	
	public function update_directorylist($table,$data,$id){
		
		return $this->update($table,$data,$id);
	}

	public function update_directorylist_space($table,$id){
		
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "UPDATE $table SET event_remain_spaces = event_remain_spaces - 1 WHERE id = $id and event_remain_spaces > 0";
		return $wpdb->query($sql);
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
	public function directory_exist_with_field($table,$field_name,$field_value){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT COUNT(*) FROM $table WHERE $field_name='$field_value'";
		return $wpdb->get_var($sql);
	}
	public function get_directorylist_name($id){
		global $wpdb;
		$table = $wpdb->prefix.'sem_directorylist';
		$sql   = "SELECT event_title FROM $table WHERE id=$id";
		$name_array = $wpdb->get_results($sql);
		return $name_array[0]->event_title;
	}
}