<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * admin_user_role_id_option_list Model Action
     * @return array
     */
	function admin_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * admin_Username_value_exist Model Action
     * @return array
     */
	function admin_Username_value_exist($val){
		$db = $this->GetModel();
		$db->where("Username", $val);
		$exist = $db->has("admin");
		return $exist;
	}

	/**
     * admin_Email_value_exist Model Action
     * @return array
     */
	function admin_Email_value_exist($val){
		$db = $this->GetModel();
		$db->where("Email", $val);
		$exist = $db->has("admin");
		return $exist;
	}

	/**
     * admin_account_status_option_list Model Action
     * @return array
     */
	function admin_account_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM user_status";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_consultation Model Action
     * @return Value
     */
	function getcount_consultation(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM consultation";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_patients Model Action
     * @return Value
     */
	function getcount_patients(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM patients";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_admin Model Action
     * @return Value
     */
	function getcount_admin(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM admin";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
