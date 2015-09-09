<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'Crypto.php';
require_once _CONST_CLASS_PATH . 'swiftmailer/lib/swift_required.php';
class magazineModel extends Database {
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

	protected function enrypt_string($message) {
		return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, 'secret key', $message, MCRYPT_MODE_ECB));
	}

	protected function decrypt_string($encrypted_string) {
		return mcrypt_decrypt(MCRYPT_BLOWFISH, 'secret key', base64_decode($encrypted_string), MCRYPT_MODE_ECB);
	}

	private function sendRegistrationMailer($password) {
		$subject = 'Dalal Times Registration';
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
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtmagazinelogo.png" style="vertical-align:middle;display:inline-block; text-align:left;">
                      </div>
                  </div>
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:right;">
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
                      </div>
                  </div>
              </div>
              <div style="margin:0 25px;">
                  <div style="color:#434343;">
                  <p>Dear [[USERNAME]],</p>
                  <p>Greetings from Dalal Times. Thank you for registering with us. </p>
                  <p>The brand Dalal Times has been built with expertise and diligence to give the latest stock market updates to our readers through various media. </p>
                  <p>We try to provide meaningful information to our readers every now and then, so that they don’t miss out on a single opportunity or chance to upscale their portfolio.</p>
                  <p>To get access to our complete knowledge platform, kindly subscribe to our magazine by logging onto <a href="http://www.dalaltimes.in">www.dalaltimes.in</a> or <a href="http://magazine.dalaltimes.com">magazine.dalaltimes.com</a></p>
                  <p>Your trial issues are now available. Please click on the link below and sign in to access your <strong><em>FREE</em></strong> copy </p>
                      <p>
                        Email-Id – [[USEREMAIL]]
                          <br>
                        Password – [[PASSWORD]]
                         <br>
                        Link – <a href="http://magazine.dalaltimes.com">magazine.dalaltimes.com</a>
                      </p>
                  </div>

                  <div style="color:#434343;">
                  <p>Do get in touch with us to share your feedback or comments via <a href="mailto:feedback@dalaltimes.in">feedback@dalaltimes.in</a>.  </p>
                  <p>For any queries or complaints you can call our toll free number <strong>1800-2700-479</strong>. You can also write to us at <a href="mailto:subscription@dalaltimes.in">subscription@dalaltimes.in</a>.  </p>
                  </div>
              </div>
              <div style=" background-color:#434343; padding:15px; text-align:center;color:#FFFFFF;">
                &nbsp;
              </div>
              </div>
              </body>
              </html>';
		$html = str_replace(array('[[USERNAME]]', '[[USEREMAIL]]', '[[PASSWORD]]'), array($this->_userInputName, $this->_userInputEmail, $password), $html);
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

	private function sendMagazineSubscriptionMailer($details) {
		$subject = 'Congratulations! Your preferred financial planning guide, Dalal Times Magazine is now in your hands';
		$from = array('subscription@dalaltimes.com' => 'Dalal Times');
		$to = array(
			$details['useremail'] => $details['username'],
		);
		$html = '<!DOCTYPE HTML>
              <html>
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <title>Untitled Document</title>
              </head>

              <body >
              <div style="width:650px;margin: 0px auto;padding-top:20px;border:1px solid #e1e1e1;font-family:Arial,Verdana;font-size:13px;">
              <div style="margin:0 25px;">
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:left">
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtmagazinelogo.png" style="vertical-align:middle;display:inline-block; text-align:left;">
                      </div>
                  </div>
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:right;">
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
                      </div>
                  </div>
              </div>
              <div style="margin:0 25px;">
                  <div style="color:#434343;">
                  <p>Dear [[USERNAME]],</p>
                  <p>Thank you for subscribing to Dalal Times Magazine.</p>
                  <p>Our monthly publication has been crafted with expertise & diligence to give the latest updates to our readers. We try to provide meaningful information to our subscribers every month, so that they don’t miss out on a single opportunity or chance to upscale their portfolio.</p>
                  <p>You have subscribed to our <strong>“[[PACKAGE_DETAILS]]”</strong> which starts from <strong>“[[PACKAGE_STARTDATE]]”</strong> to <strong>“[[PACKAGE_ENDDATE]]”</strong> and we hope you enjoy this year of profound knowledge sharing with us.</p>
                  <p>To read your E-copy of Dalal Times Magazine (available from the 1st of every Month), kindly follow the below mentioned steps</p>
                  <p>
                    <strong>Step 1:</strong> Log on to <a href="http://magazine.dalaltimes.com/#emagazine">magazine.dalaltimes.com</a>
                    <br>
                    <strong>Step 2:</strong> Sign in with your email Id & Password
                  </p>
                  <p>In case you have subscribed for our print edition as well, the same shall be sent to you on the mentioned address soon</p>
                  </div>

                  <div style="color:#434343;">
                  <p>Do get in touch with us to share your feedback or comments via <a href="mailto:feedback@dalaltimes.in">feedback@dalaltimes.in</a>.  </p>
                  <p>For any queries or complaints you can call our toll free number <strong>1800-2700-479</strong>. You can also write to us at <a href="mailto:subscription@dalaltimes.in">subscription@dalaltimes.in</a>.  </p>
                  </div>
              </div>
              <div style=" background-color:#434343; padding:15px; text-align:center;color:#FFFFFF;">
                &nbsp;
              </div>
              </div>
              </body>
              </html>';
		$html = str_replace(array('[[USERNAME]]', '[[PACKAGE_DETAILS]]', '[[PACKAGE_STARTDATE]]', '[[PACKAGE_ENDDATE]]'), array($details['username'], $details['pkg_details'], $details['pkg_startdt'], $details['pkg_enddt']), $html);
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
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtmagazinelogo.png" style="vertical-align:middle;display:inline-block; text-align:left;">
                      </div>
                  </div>
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:right;">
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
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
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtmagazinelogo.png" style="vertical-align:middle;display:inline-block; text-align:left;">
                      </div>
                  </div>
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:right;">
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
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

	private function getSubscriptionPackages($pkg_id = NULL) {
		$this->_orderby = NULL;
		$this->_whereCondition = NULL;
		if (isset($_SESSION['q'])) {
			$this->_modelQuery = "SELECT count(1) as cnt FROM expired_users where (expired_user_subscribed='' OR expired_user_subscribed is NULL) and expired_user_unique_id='" . $_SESSION['q'] . "'";
			$this->query($this->_modelQuery);
			$this->_queryResult = $this->single();
			if ($this->_queryResult['cnt'] == 1) {
				$this->_modelQuery = "SELECT * FROM subscription_packages where status='active' and site_id='6' and package_id in (4,5)";
			} else {
				unset($_SESSION['q']);
				$this->_modelQuery = "SELECT * FROM subscription_packages where status='active' and site_id='6' and package_id in (1,2,3)";
			}
		} else {
			unset($_SESSION['q']);
			$this->_modelQuery = "SELECT * FROM subscription_packages where status='active' and site_id='6' and package_id in (1,2,3)";
		}

		if (!isset($pkg_id)) {
			$this->_orderby = ' order by no_of_months asc';
			$this->_modelQuery .= $this->_orderby;
			$this->query($this->_modelQuery);
			return $this->resultset();
		} else {
			$this->_modelQuery = "SELECT * FROM subscription_packages where status='active' and site_id='6' ";
			$this->_whereCondition = ' and package_id = :package_id';
			$this->_modelQuery .= $this->_whereCondition;
			$this->query($this->_modelQuery);
			$this->bindByValue('package_id', $pkg_id, PDO::PARAM_INT);
			return $this->single();
		}
	}

	private function verifySubscriptionPackage($pkg_id) {
		$this->_whereCondition = NULL;
		$this->_modelQuery = "SELECT count(1) as cnt FROM subscription_packages WHERE status='active' and site_id='6'";
		$this->_whereCondition = ' and package_id = :package_id';
		$this->_modelQuery .= $this->_whereCondition;
		$this->query($this->_modelQuery);
		$this->bindByValue('package_id', $pkg_id, PDO::PARAM_INT);
		$this->execute();
		return $this->rowCount();
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
		$this->bindByValue('registered_from', '6');
		if ($this->execute()) {
			$this->sendRegistrationMailer($_generatedPassword);
			//return $this->lastInsertId();
			return $_generatedPassword;
		} else {
			return false;
		}
	}

	private function getUserSelectedPackageDetails() {
		$pkgPriceDtl = '';
		$courier_mumbai = $this->_queryResult['package_value'] + $this->_queryResult['courier_mumbai'];
		$courier_roi = $this->_queryResult['package_value'] + $this->_queryResult['courier_roi'];
		if ($this->_queryResult['subscription_type'] == 'digital') {
			$type = 'eMagazine';
			$copy = 'eMagazine';
			$pkgPriceDtl = '<li>
                        <div class="price">
                          <div class="price_border"></div>
                          You Pay : Rs ' . $this->_queryResult['package_value'] . '
                        </div>
                      </li>';
		} else {
			$type = 'Magazine';
			$copy = 'Print + eMagazine';
			$pkgPriceDtl = '<li>
                        <div class="price">
                          via Postal
                          <div class="price_border"></div>
                          You Pay : Rs ' . $this->_queryResult['package_value'] . '
                        </div>
                      </li>
                      <li>
                        <div class="price">
                          via Courier
                          <div class="price_border"></div>
                          <span>Within Mumbai : Rs ' . $courier_mumbai . '</span>
                          <div style="clear:both;"></div>
                          <span>Rest of India : Rs ' . $courier_roi . '</span>
                        </div>
                      </li>';
		}

		return '<div class="seperator-right">
                <div class="price_box_selected">
                  <div class="price_header_selected pkg_name_selected">
                      <h3 style="text-transform:none"> ' . $this->_queryResult['no_of_months'] . ' Months <br> ' . $type . '</h3>
                  </div>
                  <div class="pkg_plan selectedpkg">
                    <ul>
                      <li>No of Issues ' . $this->_queryResult['no_of_issues'] . '</li>
                      ' . $pkgPriceDtl . '
                      <li>' . $copy . '</li>
                      <li class="li-last-pink">
                        <a class="btn_pink" href="http://' . $_SERVER['SERVER_NAME'] . '/#registration" onclick="custom_reload()">change package</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>';
	}

	private function getLoginRegisterSection() {

		return '<div class="PTB20">
        <div class="container subscribe_box" id="registration_sub">
          <div class="row">
            <div class="col-sm-6">
              ' . $this->getUserSelectedPackageDetails() . '
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-12 text-center">
                  <!-- <span class="sub-head wow fadeInLeft">unbelievable</span> -->
                  <div class="title wow fadeInRight">
                    <h2><a href="#user_login" role="tab" data-toggle="tab">Sign In</a></h2> |
                    <h2><a href="#user_register" role="tab" data-toggle="tab">Sign Up</a></h2>
                  </div>
                </div>
              </div>
              <div class="tab-content">
                <div class="tab-pane active" id="user_login">
                  <div class="row">
                    <div class="col-sm-12 ">
                      <form class="form-horizontal" name="login-form" action="redirect" id="login-form" role="form" method="POST">
                        <input type="hidden" name="loginPkgId" id="loginPkgId" value="' . $this->_pkgId . '" readonly >
                        <div class="form-group form-fields-width">
                          <p class="login-success">Your Message has been Successfully Sent!</p>
                          <p class="login-error">Error! Something went wrong!</p>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-fields-width">
                              <input class="form-control validate" type="email" name="loginEmail" id="loginEmail" placeholder="Email-ID" required="required">
                          </div>
                          <div class="form-group form-fields-width">
                              <input type="password" class="form-control validate" placeholder="Password" name="loginPassword" id="loginPassword" required="required">
                              <div class="forgot-password"><a href="javascript:void(0);" onclick="load_popup(2);">Forgot Password?</a></div>
                          </div>
                          <div class="form-group form-fields-width">
                            <input type="submit" class="btn btn-block" id="login" value="Login">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="user_register">
                  <div class="row">
                    <div class="col-sm-12">
                      <form class="form-horizontal" name="register-form" id="register-form" role="form" action="redirect" method="POST">
                        <input type="hidden" name="regPkgId" id="regPkgId" value="' . $this->_pkgId . '" readonly >
                        <div class="col-sm-12">
                          <div class="form-group form-fields-width">
                            <p class="register-success">Your Message has been Successfully Sent!</p>
                            <p class="register-error">Error! Something went wrong!</p>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-fields-width">
                              <input type="text" class="form-control validate" placeholder="Name" name="regName" id="regName" required="required">
                          </div>
                          <div class="form-group form-fields-width">
                              <input class="form-control validate" type="email" placeholder="Email-ID" name="regEmail" id="regEmail" required="required">
                          </div>
                          <div class="form-group form-fields-width">
                              <input type="text" class="form-control validate" placeholder="Mobile No (optional)" name="regMobileNo" id="regMobileNo" maxlength="10">
                          </div>
                          <div class="form-group form-fields-width">
                            <div class="checkbox" style="color:#000000;" id="register_terms_container" onclick="removeErrorMsg(this);">
                              <label><input type="checkbox" class="validate" value="yes" name="t_c" id="t_c" checked>I agree to the <a data-toggle="modal" href="#tc-pg">Terms & Conditions</a></label>
                            </div>
                          </div>
                          <div class="form-group form-fields-width">
                            <input type="submit" class="btn btn-block" id="register" value="Register">
                          </div>
                          <div class="form-group form-fields-width text-center">
                            <em><strong>Sign-Up Now To Grab Your Free eMagazine</strong></em>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div> <!-- /.trans-bg -->';
	}

	private function getMagazineDeliveryForm() {

		return '<div class="PTB20">
        <div class="container subscribe_box" id="registration_sub">
          <div class="row">
            <div class="col-sm-12 text-center">
              <!-- <span class="sub-head wow fadeInLeft">unbelievable</span> -->
              <div class="title wow fadeInRight">
                <h2>Subscription Form</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <form class="form-horizontal" action="redirect" method="POST" name="subscribeorder-form" id="subscribeorder-form" role="form">
		<input type="hidden" name="loginPkgId" id="loginPkgId" value="' . $this->_pkgId . '" readonly >
                <div class="col-sm-6">
                ' . $this->getUserSelectedPackageDetails() . '
                </div>
                <div class="col-sm-6 ">
                  <div class="form-group">
                    <textarea class="form-control btn-block validate" rows="3" name="billing_address" id="billing_address" placeholder="Kindly provide your address..."></textarea>
                  </div>
                  <div class="form-group">
                    <select class="form-control validate" id="billing_state" name="billing_state">
                      <option value="">Select State</option>
                      <option value="AN">Andaman and Nicobar Islands</option>
                      <option value="AP">Andhra Pradesh</option>
                      <option value="AR">Arunachal Pradesh</option>
                      <option value="AS">Assam</option>
                      <option value="BR">Bihar</option>
                      <option value="CH">Chandigarh</option>
                      <option value="CT">Chhattisgarh</option>
                      <option value="DN">Dadra and Nagar Haveli</option>
                      <option value="DD">Daman and Diu</option>
                      <option value="DL">Delhi</option>
                      <option value="GA">Goa</option>
                      <option value="GJ">Gujarat</option>
                      <option value="HR">Haryana</option>
                      <option value="HP">Himachal Pradesh</option>
                      <option value="JK">Jammu and Kashmir</option>
                      <option value="JH">Jharkhand</option>
                      <option value="KA">Karnataka</option>
                      <option value="KL">Kerala</option>
                      <option value="LD">Lakshadweep</option>
                      <option value="MP">Madhya Pradesh</option>
                      <option value="MH">Maharashtra</option>
                      <option value="MN">Manipur</option>
                      <option value="ML">Meghalaya</option>
                      <option value="MZ">Mizoram</option>
                      <option value="NL">Nagaland</option>
                      <option value="OR">Odisha</option>
                      <option value="PY">Puducherry</option>
                      <option value="PB">Punjab</option>
                      <option value="RJ">Rajasthan</option>
                      <option value="SK">Sikkim</option>
                      <option value="TN">Tamil Nadu</option>
                      <option value="TG">Telangana</option>
                      <option value="TR">Tripura</option>
                      <option value="UT">Uttar Pradesh</option>
                      <option value="UP">Uttarakhand</option>
                      <option value="WB">West Bengal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control validate" placeholder="City" id="billing_city" name="billing_city" required="required">
                    <!--<select class="form-control validate">
                      <option>Select City</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>-->
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control validate" name="billing_zip" id="billing_zip" placeholder="Pincode" required="required">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control validate" placeholder="Mobile No" name="billing_tel" id="billing_tel" maxlength="10" required="required">
                  </div>
                  <div class="form-group" style="color:#00a7dd;font-weight: bold;margin-bottom:0px;">
                    <div class="col-sm-6" style="padding-top: 6px;">
                      Delivery Options
                    </div>
                    <div class="col-sm-6">
                      <div>
                        <div class="span-form">
                          <label class="radio-inline" style="color:#000000;font-weight: bold"><input type="radio" name="delivery_option" id="delivery_option" value="Postal" >Postal</label>
                        </div>
                        <div class="span-form">
                          <label class="radio-inline" style="color:#000000;font-weight: bold"><input type="radio" name="delivery_option" id="delivery_option" value="Courier" checked>Courier</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <p class="notes">**Courier charges will be extra</p>
                  </div>
                  <div class="form-group">
                    <div class="checkbox" style="color:#000000;">
                      <label><input type="checkbox" value="yes" name="promotional_offer" id="promotional_offer">Send me other promotional offers I\'m entitled to</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-block" id="subscribeorder" name="subscribeorder" value="Place Order">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->';
	}

	private function getPackagesList() {
		$packages = $this->getSubscribeSection();
		foreach ($packages as $key => $value) {
			$type = ($value['type'] == 'digital') ? 'eMagazine' : 'Print';
			$modulus_val = $key % 3;
			switch ($modulus_val) {
				case '0':
					$price_header = 'price_header_black';
					$subscribe_button = 'btn_pink';
					$background_button_color = 'li-last-pink';
					break;
				case '1':
					$price_header = 'price_header_purple';
					$subscribe_button = 'btn_purple';
					$background_button_color = 'li-last-purple';
					break;
				case '2':
					$price_header = 'price_header_blue';
					$subscribe_button = 'btn_blue';
					$background_button_color = 'li-last-blue';
					break;
				default:
					$price_header = 'price_header_black';
					$subscribe_button = 'btn_pink';
					$background_button_color = 'li-last-pink';
					break;
			}
			$pkgList .= '<li>
                <div class="price_box">
                  <div class="' . $price_header . ' pkg_name">
                      <h3> ' . $value['no_of_months'] . ' Months <br> ' . $type . ' </h3>
                  </div>
                  <div class="pkg_plan">
                    <ul>
                      <li>' . $value['no_of_issues'] . ' issues</li>
                      <li>Cover Price - Rs' . $value['cover_price'] . '</li>
                      <li>You Pay - Rs' . $value['package_value'] . '</li>
                      <li>You Save - Rs' . $value['amount_saved'] . '</li>
                      <li>Discount - ' . $value['discount_given'] . '%</li>
                      <li>eMagazine Free</li>
                      <li class="' . $background_button_color . '">
                        <a class="' . $subscribe_button . '" href="javascript:;" onclick="getPackage(' . $value['package_id'] . ')">subscribe</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>';
		}
		'<div class="">
        <div class="container subscribe_box">
          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="sub-head wow fadeInLeft">unbelievable</span>
              <div class="title wow fadeInRight">
                <h2>Pricing</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <form method="POST" name="subscribe-form" id="subscribe-form" action="redirect">
            </form>
            <ul class="dummy" style="margin: auto;">
            ' . $pkgList . '
            </ul>
          </div>
        </div>
      </div> <!-- /.trans-bg -->';
	}

	protected function getAboutSection() {
		return array('img' => 'public/images/magazine_cover.jpg', 'content' => '<p>Dalal Times Magazine, a monthly publication, takes into account events, news and views of an entire month and helps translate them in to its impact on the share market.</p>
          <p>We leverage this form of media to reach out to our readers who not only constitute of investors and traders but also keen individuals who desire to benefit from our teams research and analytics expertise in equity market.</p>
          <p>Our aim is to keep you ahead of the market fluctuations and stay true to the magazine’s motto ‘Voice Of The Indian Stock Market’.</p>', );
	}

	protected function getWhyDtSection() {
		$this->_details = array();
		$this->_details['featurelist-left'][0] = array(
			'mouseover' => 'public/images/dtx30.jpg',
			'heading' => 'DTX30',
			'content' => '<p>Do only big corporates govern market movement? No, our performance based index DTX30 - first of its kind, determines state of the market as a whole rather than focus on the big-wigs from the corporate world.</p>',
		);

		$this->_details['featurelist-left'][1] = array(
			'mouseover' => 'public/images/gems_in_the_offing.jpg',
			'heading' => 'Gems In The Offing',
			'content' => '<p>Confused about portfolio creation? Gems In The Offing offers sound suggestions for your portfolio based on fundamental and technical parameters.</p>',
		);

		$this->_details['featurelist-left'][2] = array(
			'mouseover' => 'public/images/how_good_a_bet.jpg',
			'heading' => 'How Good A Bet',
			'content' => '<p>What does an announcement by a company mean? Over and above regular interpretation, How Good A Bet also scrutinizes finer connotations that come along any announcement made by a script.</p>',
		);

		$this->_details['featurelist-right'][0] = array(
			'mouseover' => 'public/images/bulls_and_bears.jpg',
			'heading' => 'Make Or Break',
			'content' => '<p>Any penny stock that could make you a fortune? On the request of our readers Dalal Times Magazine introduced this section to make the most from penny stocks that could make it big. Of course such scrips do carry their own share of risk, but what gain without risk.</p>',
		);

		$this->_details['featurelist-right'][1] = array(
			'mouseover' => 'public/images/pink_stock.jpg',
			'heading' => 'Pink Stock',
			'content' => '<p>Is there something specific for women? Pink Stock has been specially designed to cater to the modern genre of female investors looking to either</p>',
		);

		$this->_details['featurelist-right'][2] = array(
			'mouseover' => 'public/images/promising_india.jpg',
			'heading' => 'Technically Speaking',
			'content' => '<p>Need short-term options? The master minds of technical analysis spot some such opportunities for you to make the most from. Know your entry......</p>',
		);

		$this->_details['cover_img'] = 'public/images/whyread_cover.jpg';
		return $this->_details;
	}

	protected function getSneakPreviewSection() {
		$this->_details = array();
		$this->_details[] = 'public/images/sneak_1.jpg';
		$this->_details[] = 'public/images/sneak_2.jpg';
		$this->_details[] = 'public/images/sneak_3.jpg';
		$this->_details[] = 'public/images/sneak_4.jpg';
		$this->_details[] = 'public/images/sneak_5.jpg';
		$this->_details[] = 'public/images/sneak_6.jpg';
		$this->_details[] = 'public/images/sneak_7.jpg';
		$this->_details[] = 'public/images/sneak_8.jpg';
		return $this->_details;
	}

	protected function getSubscribeSection() {
		$this->_details = array();
		$this->_queryResult = $this->getSubscriptionPackages();
		foreach ($this->_queryResult as $key => $value) {
			$this->_details[$key]['package_id'] = $value['package_id'];
			$this->_details[$key]['type'] = $value['subscription_type'];
			$this->_details[$key]['no_of_months'] = $value['no_of_months'];
			$this->_details[$key]['no_of_issues'] = $value['no_of_issues'];
			$this->_details[$key]['cover_price'] = (int) $value["cover_price"];
			$this->_details[$key]['courier_mumbai'] = (int) $value["courier_mumbai"] + (int) $value["package_value"];
			$this->_details[$key]['courier_roi'] = (int) $value["courier_roi"] + (int) $value["package_value"];
			$this->_details[$key]['package_value'] = (int) $value["package_value"];
			$this->_details[$key]['amount_saved'] = (int) $this->_details[$key]['cover_price'] - $this->_details[$key]['package_value'];
			$this->_details[$key]['discount_given'] = (int) (($this->_details[$key]['amount_saved'] / $this->_details[$key]['cover_price']) * 100);
		}
		return $this->_details;
	}

	protected function performVerification() {
		$this->_details = array();
		/**
		 * check for the package ID
		 */
		if ($this->verifySubscriptionPackage($this->_pkgId) == 1) {

			/** if package id valid
			 * check if the user is logged in or not
			 */
			if (!isset($_SESSION['_loggedIn'])) {
				$this->_queryResult = $this->getSubscriptionPackages($this->_pkgId);
				$this->_details['data'] = $this->getLoginRegisterSection();
			} else {
				/**
				 * if the user is logged in
				 * check the package type if subscription type is magazine ask delivery address details
				 */
				$this->_queryResult = $this->getSubscriptionPackages($this->_pkgId);
				if ($this->_queryResult['subscription_type'] == 'magazine') {
					$this->_details['data'] = $this->getMagazineDeliveryForm();
				} else {
					/**
					 * if the verification is complete redirect the form to the payment gateway
					 */
					$this->_details['data'] = 'redirect';
				}
			}
		} else {
			$this->_details['data'] = 'invalid';
		}
		return $this->_details;
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
				 * Load the form if the package selected by user is a print package else redirect to payment gateway
				 */
				$this->_queryResult = $this->getSubscriptionPackages($this->_pkgId);
				if ($this->_queryResult['subscription_type'] == 'magazine') {
					$this->_details['password'] = $passwd;
					$this->_details['data'] = $this->getMagazineDeliveryForm();
				} else {
					/**
					 * if the verification is complete redirect the form to the payment gateway
					 */
					$this->_details['password'] = $passwd;
					$this->_details['data'] = 'redirect';
				}
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
			/**
			 * Load the form if the package selected by user is a print package else redirect to payment gateway
			 */
			$this->_queryResult = $this->getSubscriptionPackages($this->_pkgId);
			if ($this->_queryResult['subscription_type'] == 'magazine') {
				$this->_details['data'] = $this->getMagazineDeliveryForm();
			} else {
				/**
				 * if the verification is complete redirect the form to the payment gateway
				 */
				$this->_details['data'] = 'redirect';
			}
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

	protected function askDt() {
		$this->_details = array();
		$this->_modelQuery = 'INSERT INTO `magazine_stock_queries` (`name`,`email_id`,`mobile_no`,`city`,`state`,`stock_name`,`stock_ref_id`,`query`,`status`) VALUES(:name,:email_id,:mobile_no,:city,:state,:stock_name,:stock_ref_id,:query,:status)';
		$this->query($this->_modelQuery);
		$this->bindByValue('name', $_POST['billing_name']);
		$this->bindByValue('email_id', $_POST['billing_email']);
		$this->bindByValue('mobile_no', $_POST['billing_tel']);
		$this->bindByValue('city', $_POST['billing_city']);
		$this->bindByValue('state', $_POST['billing_state']);
		$this->bindByValue('stock_name', $_POST['search_stock']);
		$this->bindByValue('stock_ref_id', $_POST['stock_ref_id']);
		$this->bindByValue('query', $_POST['user_query']);
		$this->bindByValue('status', 'new');
		if ($this->execute()) {
			//echo "666";die();
			setcookie("_QUERY_TIME_REQUEST", base64_encode('1'), time() + 3600, '/'); /* expire in 1 hour */
			//echo "5555";die();
			echo json_encode(array('data' => 'success'));
			//echo '555';die();
		} else {
			//echo json_encode(array('error' => 'generic'));
		}
	}

	private function preg_grep_keys($pattern, &$input, $flags = 0) {
		static $counter = 0;
		$keys = preg_grep($pattern, array_keys($input), $flags);
		$vals = array();
		foreach ($keys as $key) {
			$vals[$counter] = $input[$key];
			unset($input[$key]);
			$counter++;
		}
		return $vals;
	}

	protected function autoSuggestStock() {
		if (empty($_GET['term'])) {
			exit;
		}

		$q = strtolower($_GET["term"]);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) {
			$q = stripslashes($q);
		}

		$this->_modelQuery = "SELECT * FROM company_name where company_name like '%" . $q . "%' OR short_name like '%" . $q . "%' OR bse_code like '%" . $q . "%' order by company_name asc";
		$this->query($this->_modelQuery);
		$this->_queryResult = $this->resultset();
		foreach ($this->_queryResult as $key => $value) {
			$unsorted_list[$value['company_name'] . ' ' . $value['short_code'] . ' ' . $value['bse_code']] = array("id" => $value['id'], "label" => $value['company_name'], "value" => $value['company_name']);
		}

		$pattern = '/^' . $q . '/im';
		$pattern_matching_start_string = $this->preg_grep_keys($pattern, $unsorted_list);

		$pattern = '/' . $q . '\b/im';
		$pattern_matching_block_string = $this->preg_grep_keys($pattern, $unsorted_list);

		$pattern = '/' . $q . '/im';
		$pattern_matching_anywhere_string = $this->preg_grep_keys($pattern, $unsorted_list);

		$sorted_list = array_merge($pattern_matching_start_string, $pattern_matching_block_string, $pattern_matching_anywhere_string);

		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		echo json_encode($sorted_list);
	}

	private function userInputVerification($verificationType = NULL) {
		return true;
	}

	private function generateOrder($_insertVals = array()) {
		$this->beginTransaction();
		if (isset($_SESSION['brtr'])) {
			$decrypted_string = $this->decrypt_string($_SESSION['brtr']);
		}
		if (trim($decrypted_string) == 'zerodha') {
			$this->_modelQuery = 'INSERT INTO `order_details`(`package_id`,`uid`,`subscription_type`,`subscription_amount`,`delivery_method`,`promotional`)VALUES(:package_id,:uid,:subscription_type,:subscription_amount,:delivery_method,"zerodha")';
		} else {
			$this->_modelQuery = 'INSERT INTO `order_details`(`package_id`,`uid`,`subscription_type`,`subscription_amount`,`delivery_method`)VALUES(:package_id,:uid,:subscription_type,:subscription_amount,:delivery_method)';
		}
		$this->query($this->_modelQuery);
		$this->bindByValue('package_id', $_insertVals['package_id']);
		$this->bindByValue('uid', base64_decode($_SESSION['_uid']));
		$this->bindByValue('subscription_type', $_insertVals['subscription_type']);
		$this->bindByValue('subscription_amount', $_insertVals['subscription_amount']);
		$this->bindByValue('delivery_method', $_insertVals['delivery_method']);
		//print_r($_insertVals);die();
		if ($this->execute()) {
			$insertedId = $this->lastInsertId();
			$this->endTransaction();
			return $insertedId;
		} else {
			$this->cancelTransaction();
			return false;
		}
	}

	protected function goToCCAvenue() {
		$this->_details = array();
		/**
		 * check if user is logged IN
		 */
		if (!isset($_SESSION['_loggedIn'])) {
			$this->_details['data'] = 'invalid';
		} else {
			/**
			 * verify user input
			 */
			if ($this->userInputVerification('order-form') == true) {
				/**
				 * check if the pkgID is valid
				 */
				$this->_queryResult = $this->getSubscriptionPackages($this->_pkgId);
				if ($this->_queryResult) {
					/**
					 * if the subscription_type = magazine calculate the amount based on the delivery option
					 */
					if ($this->_queryResult['subscription_type'] == 'magazine') {
						/**
						 * if option = courrier  check billing city
						 */
						if (strtolower($_POST['delivery_option']) == "courier") {
							$_POST['delivery_option'] == 'courier';
							/**
							 * if city = mumbai or city = bombay
							 * amount = package_value + mumbai courier prices
							 */
							if (trim(strtolower($_POST['billing_city'])) == 'mumbai' || trim(strtolower($_POST['billing_city'])) == 'bombay') {
								$amount = $this->_queryResult['package_value'] + $this->_queryResult['courier_mumbai'];
							} else {
								/**
								 * if city != mumbai and city != bombay
								 * amount = package_value + rest of india courier prices
								 */
								$amount = $this->_queryResult['package_value'] + $this->_queryResult['courier_roi'];
							}
						} else {
							/**
							 * if option = postal
							 *  amount = package_value
							 */
							$_POST['delivery_option'] = 'postal';
							$amount = $this->_queryResult['package_value'];
						}
					} else {
						/**
						 * if subscription_type = digital
						 * amount = package value
						 */
						$_POST['delivery_option'] = 'digital';
						$amount = $this->_queryResult['package_value'];
					}
					if (base64_decode($_SESSION['_uid']) == 14) {
						$amount = 1;
					}

					$_orderParams = array('package_id' => $this->_pkgId, 'subscription_type' => 'new', 'subscription_amount' => $amount, 'delivery_method' => $_POST['delivery_option']);
					$order_id = $this->generateOrder($_orderParams);
					//echo $order_id;die();
					if ($order_id !== false) {
						$merchant_data = '';
						$working_key = 'D4FF55DE4F8AE8C3E614C9C96145718D'; //Shared by CCAVENUES
						$access_code = 'AVRG05CG85CJ97GRJC'; //Shared by CCAVENUES
						foreach ($_POST as $key => $value) {
							$merchant_data .= $key . '=' . $value . '&';
						}

						$merchant_data .= "billing_name=" . base64_decode($_SESSION['_name']) . '&';
						$merchant_data .= "billing_email=" . base64_decode($_SESSION['_emailid']) . '&';
						$merchant_data .= "merchant_id=55153&";
						$merchant_data .= "currency=INR&";
						$merchant_data .= "redirect_url=http://magazine.dalaltimes.com/gateway-response&";
						$merchant_data .= "cancel_url=http://magazine.dalaltimes.com/gateway-response&";
						$merchant_data .= "language=EN&";
						$merchant_data .= "order_id=" . $order_id . "&";
						$merchant_data .= "amount=" . $amount;
						//echo $merchant_data;die();
						$encrypted_data = encrypt($merchant_data, $working_key); // Method for encrypting the data.

						$this->_details['data'] = '<html>
              <head>
              <title>Dalaltimes Subscription</title>
              </head>
              <body>
              <center>
              <form method="post" name="redirect" action="http://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
              <input type=hidden name="encRequest" value="' . $encrypted_data . '">
              <input type=hidden name="access_code" value="' . $access_code . '">
              </form>
              </center>
              <script language="javascript">document.redirect.submit();</script>
              </body>
              </html>';
					} else {
						$this->_details['data'] = 'invalid';
					}
				} else {
					$this->_details['data'] = 'invalid';
				}
			} else {
				$this->_details['data'] = 'invalid';
			}
		}
		return $this->_details;
	}

	private function getMagazineStartEndDate($months, $type) {
		$curMonth = date('n');
		$curYear = date('Y');
		$firstIssue = ($curMonth == 12) ? date('Y-m-d H:i:s', mktime(0, 0, 0, 0, 0, $curYear + 1)) : date('Y-m-d H:i:s', mktime(0, 0, 0, $curMonth + 1, 1));
		$lastIssue = date('Y-m-01 23:59:59', strtotime('+' . ($months - 1) . ' months', strtotime($firstIssue)));
		return array('startDt' => $firstIssue, 'endDt' => $lastIssue);
	}

	protected function handleCCAvenueResponse() {
		$workingKey = 'D4FF55DE4F8AE8C3E614C9C96145718D'; //Working Key should be provided here.
		$encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
		$rcvdString = decrypt($encResponse, $workingKey); //Crypto Decryption used as per the specified working key.
		$order_status = "";
		$decryptValues = explode('&', $rcvdString);
		$dataSize = sizeof($decryptValues);

		for ($i = 0; $i < $dataSize; $i++) {
			$information = explode('=', $decryptValues[$i]);
			$parameter[$information[0]] = $information[1];
			if ($i == 3) {
				$order_status = $information[1];
			}
		}
		if ($order_status != 'Success') {
			$updt_status = 'error';
		} else {
			$updt_status = 'processed';
		}
		$this->beginTransaction();
		$mailerDetails = array();
		$this->_modelQuery = "SELECT usr.user_id, usr.name, usr.emailid,  ordr.package_id, pkgs.subscription_type,pkgs.no_of_months, pkgs.package_name,ordr.uid, ordr.promotional from order_details ordr JOIN subscription_packages pkgs ON pkgs.package_id = ordr.package_id JOIN users usr on usr.uid = ordr.uid where order_id=:order_id and ordr.order_status IN ('pending','processing') LOCK IN SHARE MODE";
		$this->query($this->_modelQuery);
		$this->bindByValue('order_id', $parameter['order_id']);
		$this->_queryResult = $this->resultset();
		if ($this->_queryResult) {
			if ($this->_queryResult[0]['promotional'] == 'zerodha') {
				switch ($this->_queryResult[0]['no_of_months']) {
					case '12':
						$magazineIssueDt = array('startDt' => '2015-09-01 00:00:00', 'endDt' => '2016-08-01 23:59:59');
						break;
					case '24':
						$magazineIssueDt = array('startDt' => '2015-09-01 00:00:00', 'endDt' => '2017-08-01 23:59:59');
						break;
					default:
						$magazineIssueDt = $this->getMagazineStartEndDate($this->_queryResult[0]['no_of_months']);
						break;
				}
				//$magazineIssueDt = array('startDt' => '2015-01-09 00:00:00', 'endDt' => $lastIssue);
			} else {
				$magazineIssueDt = $this->getMagazineStartEndDate($this->_queryResult[0]['no_of_months']);
			}

			$this->_modelQuery = 'UPDATE `order_details`
            SET
            `order_status` = "' . $updt_status . '",
            `bank_ref_no` = "' . $parameter['bank_ref_no'] . '",
            `tracking_id` = "' . $parameter['tracking_id'] . '",
            `failure_message` = "' . $parameter['failure_message'] . '",
            `payment_mode` = "' . $parameter['payment_mode'] . '",
            `card_name` = "' . $parameter['card_name'] . '",
            `status_code` = "' . $parameter['status_code'] . '",
            `status_message` = "' . $parameter['status_message'] . '",
            `currency` = "' . $parameter['currency'] . '",
            `amount` = "' . $parameter['amount'] . '",
            `billing_name` = "' . $parameter['billing_name'] . '",
            `billing_address` = "' . $parameter['billing_address'] . '",
            `billing_city` = "' . $parameter['billing_city'] . '",
            `billing_state` = "' . $parameter['billing_state'] . '",
            `billing_zip` = "' . $parameter['billing_zip'] . '",
            `billing_country` = "' . $parameter['billing_country'] . '",
            `billing_telephone` = "' . $parameter['billing_tel'] . '",
            `delivery_name` = "' . $parameter['delivery_name'] . '",
            `delivery_address` = "' . $parameter['delivery_address'] . '",
            `delivery_city` = "' . $parameter['delivery_city'] . '",
            `delivery_state` = "' . $parameter['delivery_state'] . '",
            `delivery_zip` = "' . $parameter['delivery_zip'] . '",
            `delivery_country` = "' . $parameter['delivery_country'] . '",
            `delivery_telephone` = "' . $parameter['delivery_tel'] . '",
            `gateway_response` = "' . addslashes(serialize($parameter)) . '",
            `vault` = "' . $parameter['vault'] . '",
            `offer_type` = "' . $parameter['offer_type'] . '",
            `offer_code` = "' . $parameter['offer_code'] . '",
            `discount_value` = "' . $parameter['discount_value'] . '",
            `issue_startdt` = "' . $magazineIssueDt['startDt'] . '",
            `issue_enddt` = "' . $magazineIssueDt['endDt'] . '"
            WHERE `order_id` = "' . $parameter['order_id'] . '"';
			$this->query($this->_modelQuery);
			if ($this->execute()) {
				if ($order_status == 'Success') {
					//if (base64_decode($_SESSION['_uid']) == 14) {
					$mailerDetails['username'] = $this->_queryResult[0]['name'];
					$mailerDetails['useremail'] = $this->_queryResult[0]['emailid'];
					if ($this->_queryResult[0]['subscription_type'] == 'digital') {
						$mailerDetails['pkg_details'] = $this->_queryResult[0]['no_of_months'] . ' months eMagazine';
					} else {
						$mailerDetails['pkg_details'] = $this->_queryResult[0]['no_of_months'] . ' months Magazine (Print + Digital)';
					}
					$mailerDetails['pkg_startdt'] = date('F Y', strtotime($magazineIssueDt['startDt']));
					$mailerDetails['pkg_enddt'] = date('F Y', strtotime($magazineIssueDt['endDt']));
					//}

					$pkg_details = $this->getSubscriptionPackages($this->_queryResult[0]['package_id']);
					$this->_modelQuery = "INSERT INTO products_subscribed(uid,site_id,expiry_date) VALUES (:uid,:site_id,timestampadd(MONTH,:months,current_timestamp())) ON DUPLICATE KEY UPDATE expiry_date=timestampadd(MONTH,:updtmonths,expiry_date)";
					$this->query($this->_modelQuery);
					$this->bindByValue('uid', $this->_queryResult[0]['uid']);
					$this->bindByValue('site_id', 6);
					$this->bindByValue('months', $pkg_details[0]['no_of_months']);
					$this->bindByValue('updtmonths', $pkg_details[0]['no_of_months']);
					if ($this->execute()) {
						$this->endTransaction();
						if (base64_decode($_SESSION['_uid']) == 14) {
							$this->_modelQuery = "UPDATE expired_users set expired_user_subscribed=1 where expired_user_unique_id = '" . $_SESSION['q'] . "'";
							$this->query($this->_modelQuery);
							$this->execute();
							unset($_SESSION['q']);

							$this->sendMagazineSubscriptionMailer($mailerDetails);
						}
						return base64_encode($parameter['order_id']);
					} else {
						$this->cancelTransaction();
						return false;
					}
				} else {
					$this->endTransaction();
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

	protected function getOrderDetails() {
		$this->_modelQuery = "SELECT ordr.order_id, ordr.delivery_name, ordr.delivery_address, ordr.delivery_city, ordr.delivery_state, ordr.delivery_zip, ordr.delivery_telephone, pkg.subscription_type,ordr.created_date, ordr.tracking_id, ordr.payment_mode, ordr.card_name, ordr.bank_ref_no, pkg.no_of_months, ordr.delivery_method FROM order_details ordr JOIN subscription_packages pkg ON ordr.package_id = pkg.package_id where ordr.order_id=:order_id and ordr.uid=:uid";
		$this->query($this->_modelQuery);
		$this->bindByValue('order_id', base64_decode($_POST['order_id']));
		$this->bindByValue('uid', base64_decode($_SESSION['_uid']));
		$this->_queryResult = $this->resultset();
		return $this->_queryResult;
	}

	protected function getPartialIssueList() {
		$this->_modelQuery = 'select order_id,created_date from order_details where order_status="processed" and uid=:uid and substr(created_date,1,10) > "2015-07-28"';
		$this->query($this->_modelQuery);
		$this->bindByValue('uid', base64_decode($_SESSION['_uid']));
		$this->_queryResult = $this->resultset();
		if (empty($this->_queryResult)) {
			$this->_modelQuery = 'select created_date from users where uid=:uid';
			$this->query($this->_modelQuery);
			$this->bindByValue('uid', base64_decode($_SESSION['_uid']));
			$this->_queryResult = $this->resultset();
			$months = array();
			if (date('Ymd', strtotime($this->_queryResult[0]['created_date'])) < '20150801') {
				$partial_issue_startdt = (int) date('m', strtotime('-4 months', strtotime($this->_queryResult[0]['created_date'])));
			} else {
				$partial_issue_startdt = (int) date('m', strtotime('-5 months', strtotime($this->_queryResult[0]['created_date'])));
			}

			for ($x = $partial_issue_startdt; $x < $partial_issue_startdt + 3; $x++) {
				$months[] = strtolower(date('FY', mktime(0, 0, 0, $x, 1)));
			}
		} else {
			$months = array();
			if (date('Ymd', strtotime($this->_queryResult[0]['created_date'])) < '20150831') {
				$partial_issue_startdt = (int) date('m', strtotime('-5 months', strtotime($this->_queryResult[0]['created_date'])));
				for ($x = $partial_issue_startdt; $x < $partial_issue_startdt + 5; $x++) {
					$months[] = strtolower(date('FY', mktime(0, 0, 0, $x, 1)));
				}
			} else {
				$partial_issue_startdt = (int) date('m', strtotime('-6 months', strtotime($this->_queryResult[0]['created_date'])));
				for ($x = $partial_issue_startdt; $x < $partial_issue_startdt + 6; $x++) {
					$months[] = strtolower(date('FY', mktime(0, 0, 0, $x, 1)));
				}
			}
		}
		return $months;
	}

	protected function checkAccessValidity() {
		$this->_modelQuery = 'select issue_startdt, issue_enddt from order_details where order_status="processed" and uid=:uid order by order_id asc';
		$this->query($this->_modelQuery);
		$this->bindByValue('uid', base64_decode($_SESSION['_uid']));
		$this->_queryResult = $this->resultset();
		foreach ($this->_queryResult as $key => $value) {
			$start = (new DateTime($value['issue_startdt']))->modify('first day of this month');
			$end = (new DateTime($value['issue_enddt']))->modify('first day of this month');
			$interval = DateInterval::createFromDateString('1 month');
			$period = new DatePeriod($start, $interval, $end);

			foreach ($period as $dt) {
				$months[] = strtolower($dt->format("FY"));
			}
		}

		return $months;
	}
}
?>
