<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'Crypto.php';
require_once _CONST_CLASS_PATH . 'swiftmailer/lib/swift_required.php';
/**
 *
 */
class marketMentorsModel extends Database {
	private $_details = array();
	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnData = NULL;
	private $_userInputUid = NULL;
	private $_userInputName = NULL;
	private $_userInputPwd = NULL;
	private $_userInputEmail = NULL;
	private $_userInputMobileNo = NULL;
	private $_pkgId = NULL;
	private $_orderby = NULL;
	private $_whereCondition = NULL;

	private $_chngOrigPassword = NULL;
	private $_chngNewPassword = NULL;
	private $_chngCnfrmNewPassword = NULL;

	private $_forgotEmailId = NULL;

	public function __construct($_id, $_postParams) {
		if (isset($_postParams['pkgId']) || isset($_postParams['loginPkgId']) || isset($_postParams['regPkgId'])) {
			if (isset($_postParams['pkgId'])) {
				$this->_pkgId = (int) $_postParams['pkgId'];
			} else if (isset($_postParams['loginPkgId'])) {
				$this->_pkgId = (int) $_postParams['loginPkgId'];
			} else if (isset($_postParams['regPkgId'])) {
				$this->_pkgId = (int) $_postParams['regPkgId'];
			}
		}
		if (isset($_postParams['loginEmail'])) {
			$this->_userInputUid = $_postParams['loginEmail'];
		}
		if (isset($_postParams['loginPassword'])) {
			$this->_userInputPwd = $_postParams['loginPassword'];
		}

		if (isset($_postParams['regEmail'])) {
			$this->_userInputEmail = $_postParams['regEmail'];
		}

		if (isset($_postParams['regMobileNo'])) {
			$this->_userInputMobileNo = $_postParams['regMobileNo'];
		}

		if (isset($_postParams['regName'])) {
			$this->_userInputName = $_postParams['regName'];
		}

		if (isset($_postParams['chngNewPassword'])) {
			$this->_chngNewPassword = $_postParams['chngNewPassword'];
		}

		if (isset($_postParams['chngCnfrmNewPassword'])) {
			$this->_chngCnfrmNewPassword = $_postParams['chngCnfrmNewPassword'];
		}

		if (isset($_postParams['chngOrigPassword'])) {
			$this->_chngOrigPassword = $_postParams['chngOrigPassword'];
		}

		if (isset($_postParams['forgotEmailId'])) {
			$this->_forgotEmailId = $_postParams['forgotEmailId'];
		}
		parent::__construct();
	}

	private function sendRegistrationMailer($password) {
		$subject = 'Dalal Times Magazine Registration';
		$from = array('subscription@dalaltimes.com' => 'Dalal Times');
		$to = array(
			$this->_userInputEmail => $this->_userInputName,
		);
		$html = '<!DOCTYPE HTML>
              <html>
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <title>Untitled Document</title>
              </head>

              <body >
              <div style="width:650px;margin: 0px auto;padding-top:20px;border:1px solid #e1e1e1;font-family:Verdana;font-size:12px;">
              <div style="margin:0 25px;">
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:left">
                          <img src="http://marketmentors.dalaltimes.com/public/images/mm_logo.jpg" style="vertical-align:middle;display:inline-block; text-align:left;">
                      </div>
                  </div>
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:right;">
                          <img src="http://marketmentors.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
                      </div>
                  </div>
              </div>
              <div style="margin:0 25px;">
                <div style="margin-top:40px;text-align:center;border-bottom:1px solid #e1e1e1;color:#00a7dd; font-size:20px; text-transform:uppercase;">
                    Thank You For Registeration
                  </div>
                  <div style="color:#434343;">
                  <p>Thank You for registering to Dalal Times. We are excited to have you join us and start discovering new ways to make most from the Indian stock market.</p>
                  <p>Please take note of your login details:</p>
                      <p>
                        Username – [[USERNAME]]
                          <br>
                        Password – [[PASSWORD]]
                      </p>
                  </div>
                  <div style="margin-top:40px;text-align:left;border-bottom:1px solid #e1e1e1;color:#434343;">
                    <strong>Tips to get started</strong>
                  </div>
                  <div style="color:#434343;">
                  <p>Need someone to guide you?</p>
                  <p>Reach out to our dedicated customer service by calling our toll free number 1800-2700-479.</p>
                  </div>
              </div>
              <div style=" background-color:#434343; padding:15px; text-align:center;color:#FFFFFF;">
                About Us  |  Products and Services  |  Contact Us  |  Feedback <br>
              Advertise with us  |  Careers  |  Blog  |  FAQs  |  Archive  |  Privacy Policy<br>
              Terms of use  |  Grievance Redressal Policy  |  Sitemap
              </div>
              </div>
              </body>
              </html>';
		$html = str_replace(array('[[USERNAME]]', '[[PASSWORD]]'), array($this->_userInputEmail, $password), $html);
		$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
		$transport->setUsername('ronak.shah@dalaltimes.com');
		$transport->setPassword('0-8np7jSlC_pDxQNp4JPSA');

		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);

		if ($recipients = $swift->send($message, $failures)) {
			return true;
		} else {
			return false;
		}

	}

	private function sendChangePasswordMailer() {
		$subject = 'Dalal Times - Change Password';
		$from = array('subscription@dalaltimes.com' => 'Dalal Times');
		$to = array(
			base64_decode($_SESSION['_emailid']) => base64_decode($_SESSION['_name']),
		);
		$html = '<!DOCTYPE HTML>
              <html>
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <title>Untitled Document</title>
              </head>

              <body >
              <div style="width:650px;margin: 0px auto;padding-top:20px;border:1px solid #e1e1e1;font-family:Verdana;font-size:12px;">
              <div style="margin:0 25px;">
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:left">
                          <img src="http://marketmentors.dalaltimes.com/public/images/mm_logo.jpg" style="vertical-align:middle;display:inline-block; text-align:left;">
                      </div>
                  </div>
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:right;">
                          <img src="http://marketmentors.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
                      </div>
                  </div>
              </div>
              <div style="margin:0 25px;">
                <div style="margin-top:40px;text-align:center;border-bottom:1px solid #e1e1e1;color:#00a7dd; font-size:20px; text-transform:uppercase;">
                    Change Password Confirmation
                  </div>
                  <div style="color:#434343;">
                  <p>Your password has been successfully changed.</p>
                  <p>You New password is :</p>
                      <p>
                        New Password – [[NEW-PASSWORD]]
                      </p>
                  </div>
                  <div style="margin-top:40px;text-align:left;border-bottom:1px solid #e1e1e1;color:#434343;">
                    <strong>Tips to get started</strong>
                  </div>
                  <div style="color:#434343;">
                  <p>Need someone to guide you?</p>
                  <p>Reach out to our dedicated customer service by calling our toll free number 1800-2700-479.</p>
                  </div>
              </div>
              <div style=" background-color:#434343; padding:15px; text-align:center;color:#FFFFFF;">
                About Us  |  Products and Services  |  Contact Us  |  Feedback <br>
              Advertise with us  |  Careers  |  Blog  |  FAQs  |  Archive  |  Privacy Policy<br>
              Terms of use  |  Grievance Redressal Policy  |  Sitemap
              </div>
              </div>
              </body>
              </html>';
		$html = str_replace(array('[[NEW-PASSWORD]]'), array($this->_chngNewPassword), $html);
		$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
		$transport->setUsername('ronak.shah@dalaltimes.com');
		$transport->setPassword('0-8np7jSlC_pDxQNp4JPSA');

		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);

		if ($recipients = $swift->send($message, $failures)) {
			return true;
		} else {
			return false;
		}

	}

	private function sendForgotPasswordMailer($password) {
		$subject = 'Dalal Times - Forgot Password';
		$from = array('subscription@dalaltimes.com' => 'Dalal Times');
		$to = array(
			$this->_forgotEmailId => '',
		);
		$html = '<!DOCTYPE HTML>
              <html>
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <title>Untitled Document</title>
              </head>

              <body >
              <div style="width:650px;margin: 0px auto;padding-top:20px;border:1px solid #e1e1e1;font-family:Verdana;font-size:12px;">
              <div style="margin:0 25px;">
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:left">
                          <img src="http://marketmentors.dalaltimes.com/public/images/mm_logo.jpg" style="vertical-align:middle;display:inline-block; text-align:left;">
                      </div>
                  </div>
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:right;">
                          <img src="http://marketmentors.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
                      </div>
                  </div>
              </div>
              <div style="margin:0 25px;">
                <div style="margin-top:40px;text-align:center;border-bottom:1px solid #e1e1e1;color:#00a7dd; font-size:20px; text-transform:uppercase;">
                    Forgot Password Confirmation
                  </div>
                  <div style="color:#434343;">
                  <p>Your password has been resetted successfully.</p>
                  <p>
                        New Password – [[NEW-PASSWORD]]
                      </p>
                  <p>You can change your password by logging in to your account </p>
                  </div>
                  <div style="margin-top:40px;text-align:left;border-bottom:1px solid #e1e1e1;color:#434343;">
                    <strong>Tips to get started</strong>
                  </div>
                  <div style="color:#434343;">
                  <p>Need someone to guide you?</p>
                  <p>Reach out to our dedicated customer service by calling our toll free number 1800-2700-479.</p>
                  </div>
              </div>
              <div style=" background-color:#434343; padding:15px; text-align:center;color:#FFFFFF;">
                About Us  |  Products and Services  |  Contact Us  |  Feedback <br>
              Advertise with us  |  Careers  |  Blog  |  FAQs  |  Archive  |  Privacy Policy<br>
              Terms of use  |  Grievance Redressal Policy  |  Sitemap
              </div>
              </div>
              </body>
              </html>';
		$html = str_replace(array('[[NEW-PASSWORD]]'), array($password), $html);
		$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
		$transport->setUsername('ronak.shah@dalaltimes.com');
		$transport->setPassword('0-8np7jSlC_pDxQNp4JPSA');

		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);

		if ($recipients = $swift->send($message, $failures)) {
			return true;
		} else {
			return false;
		}

	}

	private function loadUserSession($user_id, $password) {
		$this->_whereCondition = NULL;
		$this->_modelQuery = "SELECT uid, name, password, emailid FROM users WHERE user_id=:user_id";
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $user_id);
		$this->_queryResult = $this->single();
		if (password_verify($password, $this->_queryResult['password'])) {
			$_SESSION['_loggedIn'] = 1;
			$_SESSION['_uid'] = base64_encode($this->_queryResult['uid']);
			$_SESSION['_name'] = base64_encode($this->_queryResult['name']);
			$_SESSION['_emailid'] = base64_encode($this->_queryResult['emailid']);
		}
	}

	private function checkEmailExists($email_id) {
		$this->_whereCondition = NULL;
		$this->_modelQuery = "SELECT count(1) as cnt FROM users WHERE user_id=:user_id";
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $email_id);
		$this->_queryResult = $this->single();
		return $this->_queryResult['cnt'];
	}

	private function verifyUserCredentials($verificationBy = 'email_id', $uid = NULL) {
		$this->_whereCondition = NULL;
		if ($verificationBy == "email_id") {
			$this->_modelQuery = "SELECT uid, password FROM users WHERE user_id=:user_id";
			$this->query($this->_modelQuery);
			$this->bindByValue('user_id', $this->_userInputUid);
			$this->_queryResult = $this->single();
			return password_verify($this->_userInputPwd, $this->_queryResult['password']);
		} else if ($verificationBy == "uid") {
			$this->_modelQuery = "SELECT password FROM users WHERE uid=:uid";
			$this->query($this->_modelQuery);
			$this->bindByValue('uid', $uid);
			$this->_queryResult = $this->single();
			return password_verify($this->_chngOrigPassword, $this->_queryResult['password']);
		}
	}

	private function generatePassword() {
		return substr(md5($this->_userInputEmail), rand(0, 26), 6);
	}

	private function updatePassword($updateBy = 'uid') {
		if ($updateBy == 'system') {
			$_generatedPassword = $this->generatePassword();
			$this->_modelQuery = 'UPDATE users set `password` = :newpassword where user_id=:user_id';
			$this->query($this->_modelQuery);
			$this->bindByValue('user_id', $this->_forgotEmailId);
			$this->bindByValue('newpassword', password_hash($_generatedPassword, PASSWORD_BCRYPT));
			if ($this->execute()) {
				$this->sendForgotPasswordMailer($_generatedPassword);
				return true;
			} else {
				return false;
			}
		} else {
			$this->_modelQuery = 'UPDATE users set `password` = :newpassword where uid=:uid';
			$this->query($this->_modelQuery);
			$this->bindByValue('uid', base64_decode($_SESSION['_uid']));
			$this->bindByValue('newpassword', password_hash($this->_chngNewPassword, PASSWORD_BCRYPT));
			if ($this->execute()) {
				$this->sendChangePasswordMailer();
				return true;
			} else {
				return false;
			}
		}
	}

	private function saveUser() {
		$_generatedPassword = $this->generatePassword();
		$this->_modelQuery = 'INSERT INTO users(`user_id`,`password`,`name`,`emailid`,`mobileno`,`registered_from`) VALUES(:user_id,:password,:name,:emailid,:mobileno,:registered_from)';
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $this->_userInputEmail);
		$this->bindByValue('emailid', $this->_userInputEmail);
		$this->bindByValue('password', password_hash($_generatedPassword, PASSWORD_BCRYPT));
		$this->bindByValue('name', $this->_userInputName);
		$this->bindByValue('mobileno', $this->_userInputMobileNo);
		$this->bindByValue('registered_from', '7');
		if ($this->execute()) {
			$this->sendRegistrationMailer($_generatedPassword);
			//return $this->lastInsertId();
			return $_generatedPassword;
		} else {
			return false;
		}
	}

	protected function registerUser() {
		$this->_details = array();
		/**
		 * check email-ID exists in the system. If it exists don't register. else register & send mail
		 */
		if ((int) $this->checkEmailExists($this->_userInputEmail) == (int) 0 && $this->_userInputEmail != '') {
			/**
			 * Insert records into the DB & register session & send email to the user
			 */
			$passwd = $this->saveUser();
			if ($passwd !== false) {
				/**
				 * Load User Session
				 */
				$this->loadUserSession($this->_userInputEmail, $passwd);
				/**
				 * if the verification is complete redirect the form to the payment gateway
				 */
				$this->_details['password'] = $passwd;
				$this->_details['data'] = 'redirect';
				echo json_encode($this->_details);
			} else {
				echo json_encode(array('error' => 'generic'));
			}
		} else {
			echo json_encode(array('error' => 'regEmail'));
		}
	}

	protected function loginUser() {
		/**
		 * check if the records exists into the DB
		 * if it exists register session else throw error
		 */
		if ($this->verifyUserCredentials() == true) {
			/**
			 * Load User Session
			 */
			$this->loadUserSession($this->_userInputUid, $this->_userInputPwd);
			$this->_details['data'] = 'redirect';

			echo json_encode($this->_details);
		} else {
			echo json_encode(array('error' => 'generic'));
		}
	}

	protected function logoutUser() {
		unset($_SESSION['_loggedIn']);
		unset($_SESSION['_uid']);
		unset($_SESSION['_name']);
		session_destroy();
		$this->_details['data'] = "reload";
		//echo json_encode($this->_details);
	}

	protected function resetPassword() {
		$this->_details = array();
		if ((int) $this->checkEmailExists($this->_forgotEmailId) == (int) 1) {
			if ($this->updatePassword('system') == true) {
				echo json_encode(array('data' => 'success'));
			} else {
				echo json_encode(array('error' => 'sys'));
			}
		} else {
			echo json_encode(array('error' => 'generic'));
		}
	}

	protected function changePassword() {
		$this->_details = array();
		if (!isset($_SESSION['_loggedIn'])) {
			echo json_encode(array('error' => 'generic'));
		} else {
			if ($this->_chngNewPassword != $this->_chngCnfrmNewPassword) {
				echo json_encode(array('error' => 'mismatch'));
			} else {
				if ($this->verifyUserCredentials("uid", base64_decode($_SESSION['_uid'])) == true) {
					if ($this->updatePassword() == true) {
						echo json_encode(array('data' => 'success'));
					} else {
						echo json_encode(array('error' => 'sys'));
					}
				} else {
					echo json_encode(array('error' => 'orig-mismatch'));
				}
			}
		}
	}
}
?>
