<?php
require_once _CONST_CLASS_PATH . 'class.database.php';

/**
 *
 */
class userModel extends Database {
	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnData = NULL;
	private $_userId = NULL;
	protected static $_userFields = NULL;

	public function __construct($userId = NULL, $userParams = array()) {
		parent::__construct();
		$this->_userId = $userId;
		self::$_userFields = $userParams;
	}

	protected function loginUser() {
		$this->beginTransaction();
		$this->_modelQuery = 'SELECT count(1) as cnt FROM users WHERE user_id=:user_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', self::$_userFields['user_id']['fieldValue']);
		if ($this->execute()) {
			$this->_queryResult = $this->single();
			if ($this->_queryResult[0]['cnt'] == 1) {
				$this->_modelQuery = 'SELECT * FROM users WHERE user_id=:user_id';
				$this->query($this->_modelQuery);
				$this->bindByValue('user_id', self::$_userFields['user_id']['fieldValue']);
				$this->_queryResult = $this->single();
				if (password_verify(self::$_userFields['password']['fieldValue'], $this->_queryResult[0]['password'])) {
					$_SESSION['loggedin'] = 1;
					$_SESSION['user']['details'] = array('uid' => $this->_queryResult[0]['uid'], 'name' => $this->_queryResult[0]['name']);
					$this->_modelQuery = 'SELECT uid, site_id, expiry_date FROM products_subscribed WHERE user_id=:user_id';
					$this->query($this->_modelQuery);
					$this->bindByValue('user_id', self::$_userFields['user_id']['fieldValue']);
					$this->_queryResult = $this->single();
				} else {
					$this->cancelTransaction();
					return false;
				}
			} else {
				$this->cancelTransaction();
				return false;
			}
		} else {
			$this->cancelTransaction();
			return false;
		}
	}

	protected function registerUser() {

	}
}
?>
