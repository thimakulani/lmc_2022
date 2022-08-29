<?php 
/**
 * Admin Page Controller
 * @category  Controller
 */
class AdminController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "admin";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("admin.Id", 
			"admin.Name", 
			"admin.LastName", 
			"admin.Email", 
			"admin.Username", 
			"user_status.name AS user_status_name", 
			"admin.user_role_id");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				admin.Id LIKE ? OR 
				admin.Name LIKE ? OR 
				admin.LastName LIKE ? OR 
				admin.Email LIKE ? OR 
				admin.Username LIKE ? OR 
				admin.Password LIKE ? OR 
				admin.account_status LIKE ? OR 
				user_status.name LIKE ? OR 
				user_status.status_id LIKE ? OR 
				admin.user_role_id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "admin/search.php";
		}
		$db->join("user_status", "admin.account_status = user_status.status_id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("admin.Id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "USERS";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "admin/ajax-list.php" : "admin/list.php");
		$this->render_view($view_name, $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("admin.Id", 
			"admin.Name", 
			"admin.LastName", 
			"admin.Email", 
			"admin.Username", 
			"user_status.name AS user_status_name", 
			"admin.user_role_id");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("admin.Id", $rec_id);; //select record based on primary key
		}
		$db->join("user_status", "admin.account_status = user_status.status_id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
		//Email Notification
		$time = datetime_now();
		$site_addr = SITE_ADDR;
		$mailtitle = "Admin Record Viewed";
		$mailbody = "Hi Admin, New Admin record has been viewed . 
			Link : <a href='$site_addr#/admin/view/$rec_id'>$rec_id</a> 
			Date viewed : $time";
		$rec_email = DEFAULT_EMAIL;
		$mailer = new Mailer;
		$mailer->send_mail($rec_email, $mailtitle, $mailbody);
			$page_title = $this->view->page_title = "View  USER";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("admin/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("Name","LastName","Email","Username","Password","account_status","user_role_id");
			$postdata = $this->format_request_data($formdata);
			$cpassword = $postdata['confirm_password'];
			$password = $postdata['Password'];
			if($cpassword != $password){
				$this->view->page_error[] = "Your password confirmation is not consistent";
			}
			$this->rules_array = array(
				'Name' => 'required',
				'LastName' => 'required',
				'Email' => 'required|valid_email',
				'Username' => 'required',
				'Password' => 'required',
				'account_status' => 'required',
				'user_role_id' => 'required',
			);
			$this->sanitize_array = array(
				'Name' => 'sanitize_string',
				'LastName' => 'sanitize_string',
				'Email' => 'sanitize_string',
				'Username' => 'sanitize_string',
				'account_status' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$password_text = $modeldata['Password'];
			//update modeldata with the password hash
			$modeldata['Password'] = $this->modeldata['Password'] = password_hash($password_text , PASSWORD_DEFAULT);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("Email", $modeldata['Email']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['Email']." Already exist!";
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where("Username", $modeldata['Username']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['Username']." Already exist!";
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("admin");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Admin";
		$this->render_view("admin/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("Id","Name","LastName","Username","user_role_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'Name' => 'required',
				'LastName' => 'required',
				'Username' => 'required',
				'user_role_id' => 'required',
			);
			$this->sanitize_array = array(
				'Name' => 'sanitize_string',
				'LastName' => 'sanitize_string',
				'Username' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['Username'])){
				$db->where("Username", $modeldata['Username'])->where("Id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['Username']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("admin.Id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("admin");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("admin");
					}
				}
			}
		}
		$db->where("admin.Id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Admin";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("admin/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("Id","Name","LastName","Username","user_role_id");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'Name' => 'required',
				'LastName' => 'required',
				'Username' => 'required',
				'user_role_id' => 'required',
			);
			$this->sanitize_array = array(
				'Name' => 'sanitize_string',
				'LastName' => 'sanitize_string',
				'Username' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['Username'])){
				$db->where("Username", $modeldata['Username'])->where("Id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['Username']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("admin.Id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("admin.Id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("admin");
	}
}
