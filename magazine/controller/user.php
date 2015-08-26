<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class user extends userModel {

	private $_data = array();
	private $_userModel = NULL;
	private $_formParams = array();
	private $_operationStatus = NULL;
	private $_crudID = NULL;

	public static $_formFields = array(
		'uid' => array('skip' => array('insert')),
		'user_id' => array('labelTitle' => 'User ID', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => true, 'required' => true, 'fieldValue' => '', array('skip' => array('insert'))),
		'title' => array('labelTitle' => 'Title', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'name' => array('labelTitle' => 'User Name', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'emailid' => array('labelTitle' => 'Email Id', 'inputType' => 'text', 'fieldType' => 'email', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'password' => array('labelTitle' => 'Password', 'inputType' => 'text', 'fieldType' => 'password', 'remoteValidate' => false, 'required' => true, 'fieldValue' => '', 'skip' => array('update')),
		'confirmpassword' => array('labelTitle' => 'Confirm Password', 'inputType' => 'text', 'fieldType' => 'password', 'remoteValidate' => false, 'required' => true, 'fieldValue' => '', 'skip' => array('update', 'insert')),
		'company' => array('labelTitle' => 'Company Name', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'designation' => array('labelTitle' => 'Designation', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'address' => array('labelTitle' => 'Address', 'inputType' => 'textarea', 'fieldType' => 'textarea', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'pincode' => array('labelTitle' => 'Pincode', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'city' => array('labelTitle' => 'City', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'state' => array('labelTitle' => 'State', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'phoneno' => array('labelTitle' => 'Phone No', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'mobileno' => array('labelTitle' => 'Mobile No', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
	);

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array()) {
		foreach ($params as $key => $value) {
			if (array_key_exists($key, self::$_formFields)) {
				self::$_formFields[$key]['fieldValue'] = $value;
			}
		}
		$this->_crudID = ($id == '' || $id == NULL) ? NULL : $id;
		$this->_userModel = new userModel($this->_crudID, self::$_formFields);
	}

	public function login() {
		$this->_operationStatus = $this->_userModel->loginUser();
	}

	public function register() {
		$this->_operationStatus = $this->_userModel->registerUser();
	}
}

?>
