<?php
/*
Plugin Name: Strativ Bussiness Directory Listing
Plugin URI: http://strativ.se/
Description: Strativ Bussiness Directory Listing
Author: Rasel.
Version: 1.0.0
Author URI: http://strativ.se/
*/


register_activation_hook(__FILE__,'sdl_adman_activator');
register_deactivation_hook(__FILE__,'sdl_adman_deactivator');


include_once dirname(__FILE__).'/core/controller/isdController.php';
include_once dirname(__FILE__).'/core/controller/load.php';
include_once dirname(__FILE__).'/core/database/isdDatabase.php';
include_once dirname(__FILE__).'/core/model/isdModel.php';
include_once dirname(__FILE__).'/controllers/directorylist.php';
include_once dirname(__FILE__).'/controllers/directoryfile.php';
// if ( ! class_exists( 'WP_List_Table' ) ) {
// 	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
// }

function sdl_adman_activator(){
	global $wp_rewrite;
	include_once dirname(__FILE__).'/controllers/install_controller.php';
	$loader = new install_controller();
	$loader->activate();
	$wp_rewrite->flush_rules( true );
}

function sdl_adman_deactivator(){
	global $wp_rewrite;
	include_once  dirname(__FILE__).'/controllers/install_controller.php';
	$loader = new install_controller();
	$loader->deactivate();
	$wp_rewrite->flush_rules( true );
}


/**
 * Register a custom menu page.
 */
//add_action( 'init', array('booking','add_new'));

add_action( 'admin_menu', array('directorylist', 'isd_admin_menu'));
add_action( 'admin_menu', array('directorylist', 'isd_admin_submenu'));

add_shortcode('directorylist', array('directorylist', 'directorylist_shortcode'));
// add_filter ('the_content', array('event', 'opl_advertise_area_auto_create'));


function sdl_css_and_js_front() {
	
	wp_register_style('bootstrap_css', plugins_url('public/css/bootstrap.min.css',__FILE__ ));
	wp_enqueue_style('bootstrap_css');
	wp_register_style('isd_ad_css', plugins_url('public/css/sdl_main.css',__FILE__ ));
	wp_enqueue_style('isd_ad_css');

    wp_register_style('datatable-css', plugins_url('public/css/datatable.min.css',__FILE__ ));
	wp_enqueue_style('datatable-css');

	wp_register_style('datetime_picker_css', plugins_url('public/css/jquery.datetimepicker.css',__FILE__ ));
	wp_enqueue_style('datetime_picker_css');
     
    wp_register_script( 'bootstrap_js', plugins_url( 'public/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('bootstrap_js');

	wp_register_script( 'datatable_js', plugins_url( 'public/js/datatable.min.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('datatable_js');

	wp_register_script( 'schedule_js', plugins_url( 'public/js/custom.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('schedule_js');
	
	wp_register_script( 'datetime_picker_js', plugins_url( 'public/js/jquery.datetimepicker.full.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('datetime_picker_js');

	wp_register_script( 'isd_ad_js', plugins_url( 'public/js/directory_list.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('isd_ad_js');
	
	wp_localize_script( 'isd_ad_js', 'ajax_path', array(
						'ajax_url' => admin_url( 'admin-ajax.php' )
					));


}

function sdl_css_and_js_back() {
	
	wp_register_style('bootstrap_css', plugins_url('public/css/bootstrap.min.css',__FILE__ ));
	wp_enqueue_style('bootstrap_css');

	wp_register_style('isd_ad_css', plugins_url('public/css/sdl_main.css',__FILE__ ));
	wp_enqueue_style('isd_ad_css');

	wp_register_style('sdl_select2_css', plugins_url('public/css/select2.min.css',__FILE__ ));
	wp_enqueue_style('sdl_select2_css');

    wp_register_style('datatable-css', plugins_url('public/css/datatable.min.css',__FILE__ ));
	wp_enqueue_style('datatable-css');

	wp_register_style('datetime_picker_css', plugins_url('public/css/jquery.datetimepicker.css',__FILE__ ));
	wp_enqueue_style('datetime_picker_css');
     
    wp_register_script( 'bootstrap_js', plugins_url( 'public/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('bootstrap_js');

	wp_register_script( 'datatable_js', plugins_url( 'public/js/datatable.min.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('datatable_js');

	wp_register_script( 'schedule_js', plugins_url( 'public/js/custom.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('schedule_js');
	
	wp_register_script( 'datetime_picker_js', plugins_url( 'public/js/jquery.datetimepicker.full.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('datetime_picker_js');

	wp_register_script( 'sdl_select2_js', plugins_url( 'public/js/select2.min.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('sdl_select2_js');

	wp_register_script( 'isd_ad_js', plugins_url( 'public/js/directory_list.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('isd_ad_js');
	
	wp_localize_script( 'isd_ad_js', 'ajax_path', array(
						'ajax_url' => admin_url( 'admin-ajax.php' )
					));


}


add_action( 'admin_enqueue_scripts','sdl_css_and_js_back');
add_action( 'wp_enqueue_scripts','sdl_css_and_js_front');





add_action( 'wp_ajax_directorylist_save_action',  array('directorylist', 'directorylist_save') );
add_action( 'wp_ajax_nopriv_directorylist_save_action',  array('directorylist', 'directorylist_save') );

add_action( 'wp_ajax_directory_approve_disaprove_action',  array('directorylist', 'directory_approve_disaprove') );

// add_action( 'wp_ajax_directory_filter_action',  array('directorylist', 'directory_filter') );
// add_action( 'wp_ajax_nopriv_directory_filter_action',  array('directorylist', 'directory_filter') );

add_action( 'wp_ajax_directory_filter_new',  'directory_filter_new') ;
add_action( 'wp_ajax_nopriv_directory_filter_new',  'directory_filter_new') ;

add_action( 'wp_ajax_directory_filter_action',  'directory_filter_action') ;
add_action( 'wp_ajax_nopriv_directory_filter_action',  'directory_filter_action') ;



function directory_filter_new() 

{


	$col = array(
		0 =>'id',
		1 =>'company_name',
		2 =>'org_no',
		3 =>'company_category' 
	);

	global $wpdb;
	$table = $wpdb->prefix."sdl_directorylist";
 

	$sql = "SELECT * FROM $table";
	// var_dump($wpdb->get_results($sql));
	//  exit();
	$results = $wpdb->get_results($sql);

$totalData = count($results);
	 
$totalFilter = $totalData;

$data = array(); 

foreach($results as $result){
	$sub_array = array();
	$sub_array[] = $result->id;
	$sub_array[] = $result->company_name;
	$sub_array[] = $result->approver_id;
	$sub_array[] = $result->company_category;
	$data[] = $sub_array;
}


$output = array(
	//"draw"    => 1,
	"recordsTotal"  => intval($totalData),
	"recordsFiltered" => intval($totalData),
	"data"    => $data
   );
   

   
   echo json_encode($output);
   exit();
	 
}

function directory_filter_action() 

{
	$params = $columns = $totalRecords = $data = array();
	$params=$_REQUEST;

	$columns = array(
		0 =>'company_name',
		1 =>'visiting_address',
		2 =>'post_code',
		3 =>'ort',
		4 =>'phone_no',
	);

	global $wpdb;
	$catagory_list = $_REQUEST['choices'];
	$filter_value= array();
	foreach($catagory_list as $Key=>$value){
		
		array_push($filter_value,$value);
		
	}
	$filter_value = array_values($filter_value[0]);

	$table = $wpdb->prefix."sdl_directorylist";
 
	//$whereIn = implode("','", $filter_value); 

	$where_condition = $sqlTot = $sqlRec = "";
	if( !empty($filter_value) )  {
		$where_condition .=	" AND ";
		
		//('".$whereIn."') 

		
		for ($i=0; $i < sizeof($filter_value); $i++) { 

			$where_condition .= " company_category ";    
			$where_condition .= " like '%";
			$where_condition .= $filter_value[$i];
			$where_condition .= "%'";
			if($i < sizeof($filter_value)-1 ){
				$where_condition .= " and "; 
			}
			
		}
		
	}
	$sql_query = " SELECT * FROM $table WHERE status=1 ";
	$sqlTot .= $sql_query;
	$sqlRec .= $sql_query;
	
	if(isset($where_condition) && $where_condition != '') {

		$sqlTot .= $where_condition;
		$sqlRec .= $where_condition;
	}

	
	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";


	//echo $sqlRec;
	// exit();
	$total_result = $wpdb->get_results($sqlTot);
	$total_result_data = count($total_result);

	$results = $wpdb->get_results($sqlRec);
		
	$totalFilter = count($results);

	$data = array(); 

	foreach($results as $result){
		$sub_array = array();
		$sub_array[] = $result->company_name;
		$sub_array[] = $result->visiting_address;
		$sub_array[] = $result->post_code;
		$sub_array[] = $result->ort;
		$sub_array[] = $result->phone_no;
		$data[] = $sub_array;
	}


	$output = array(
		"draw"    => intval( $params['draw'] ),
		"recordsTotal"  => intval($total_result_data),
		"recordsFiltered" => intval($total_result_data),
		"data"    => $data
	);
	
	if ( ! function_exists( 'wp_handle_upload' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}
	

	
	echo json_encode($output);
	exit();
	 
}


function fiu_upload_file(){


    if(!(is_array($_POST) && is_array($_FILES) && defined('DOING_AJAX') && DOING_AJAX)){
        return;
    }

    if(!function_exists('wp_handle_upload')){
        require_once(ABSPATH . 'wp-admin/includes/file.php');
	}
	//$uploadedfile = $_FILES['file'];
    $upload_overrides = array('test_form' => false);
   

   
    
    $response = array();

    foreach($_FILES as $file){
        $file_info = wp_handle_upload($file, $upload_overrides);

        // do something with the file info...
        $response['message'] = 'Done!';
		$response['file_info'] = $file_info;
		
    }

    echo $file_info['url'];
    die();
}

add_action('wp_ajax_fiu_upload_file', 'fiu_upload_file');
add_action('wp_ajax_nopriv_fiu_upload_file', 'fiu_upload_file');

function send_welcome_email_to_new_user($user_id) {
    $user = get_userdata($user_id);
    $user_email = $user->user_email;
    // for simplicity, lets assume that user has typed their first and last name when they sign up
	$user_full_name = $user->user_firstname . $user->user_lastname;
	$adt_rp_key = get_password_reset_key( $user );
	$user_login = $user->user_login;
	$rp_link = '<a href="' . wp_login_url()."?action=rp&key=".$adt_rp_key."&login=" . $user_login . '">' . wp_login_url()."?action=rp&key=".$adt_rp_key."&login==" . rawurlencode($user_login) . '</a>';

	
	// $key = get_password_reset_key( $user );

	// $reset_link = wp_login_url() . '?action=rp&key=' . $key . '&login=' . $user_login;

	$message = "Hi ".$user_full_name.",<br>";
	$message .= "An account has been created on ".get_bloginfo( 'name' )." for email address ".$user_email."<br>";
	$message .= "Click here to set the password for your account: <br>";
	$message .= $rp_link.'<br>';

    // Now we are ready to build our welcome email
    $to = $user_email;
    $subject = "Hi " . $user_full_name . ", welcome to our site!";

    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (wp_mail($to, $subject, $message, $headers)) {
      error_log("email has been successfully sent to user whose email is " . $user_email);
    }else{
      error_log("email failed to sent to user whose email is " . $user_email);
    }
  }

  // THE ONLY DIFFERENCE IS THIS LINE
  add_action('user_register', 'send_welcome_email_to_new_user');

// function sdl_send_password_reset_mail($user_id){

//     $user = get_user_by('id', $user_id);
//     $firstname = $user->first_name;
//     $email = $user->user_email;
//     $adt_rp_key = get_password_reset_key( $user );
//     $user_login = $user->user_login;
//     $rp_link = '<a href="' . wp_login_url()."/resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login) . '">' . wp_login_url()."/resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login) . '</a>';

//     if ($firstname == "") $firstname = "gebruiker";
//     $message = "Hi ".$firstname.",<br>";
//     $message .= "An account has been created on ".get_bloginfo( 'name' )." for email address ".$email."<br>";
//     $message .= "Click here to set the password for your account: <br>";
//     $message .= $rp_link.'<br>';

//     //deze functie moet je zelf nog toevoegen. 
//    $subject = __("Your account on ".get_bloginfo( 'name'));
//    $headers = array();

//    add_filter( 'wp_mail_content_type', function( $content_type ) {return 'text/html';});
//    $headers[] = 'From:  SakerhetsbranschenS<info@sakerhetsbranschen.se>'."\r\n";
//    wp_mail( $email, $subject, $message, $headers);

//    // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
//    remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
// }


// add_filter( 'wp_new_user_notification_email' , 'edit_user_notification_email', 10, 3 );

// function edit_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {

//     $message = sprintf(__( "Welcome to %s! Here's how to log in:" ), $blogname ) . "\r\n";
//     $message .= wp_login_url() . "\r\n";
//     $message .= sprintf(__( 'Username: %s' ), $user->user_login ) . "\r\n";
//     $message .= sprintf(__( 'Password: %s' ), $user->user_pass ) . "\r\n\r\n";
//     $message .= sprintf(__( 'If you have any problems, please contact me at %s.'), get_option( 'admin_email' ) ) . "\r\n";
//     $message .= __('Adios!');

//     $wp_new_user_notification_email['message'] = $message;

//     return $wp_new_user_notification_email;

// }
