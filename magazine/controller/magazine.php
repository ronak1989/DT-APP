<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class magazine extends magazineModel {

	static private $_pageType = 'nonloggedin';
	private $_magazineModel = NULL;
	private $_data = array();
	private $_issue = NULL;

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array(), $issue = NULL) {
		$this->_magazineModel = new magazineModel($id, $params);
		$this->_issue = $issue;
	}

	public function getHomePage() {
		if ($_SESSION['_loggedIn'] == 1) {

			$this->_data['show_login'] = 0;
			$this->_data['header_text'] = '<div style="display:inline-block;vertical-align: bottom; padding-right:10px;">';
			$this->_data['header_text'] .= '<div class="loggedin-name">Welcome <strong>' . base64_decode($_SESSION['_name']) . '</strong></div>';
			$this->_data['header_text'] .= '<div class="loggedin-name"><a href="logout">Logout</a></div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '<div style="display:inline-block;vertical-align: top" id="settings">';
			$this->_data['header_text'] .= '<img src="public/images/settings.png" width="20px" height="20px;">';
			$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['settingsNav'] = '<li class="active"><a href="#change-password" role="tab" data-toggle="tab">Change Password</a></li>';
			$this->_data['settingsTab'] = '<div class="tab-pane active" id="change-password">
                    <div class="row">
                      <div class="col-sm-12">
                        <form class="form-horizontal MB5" name="changepassword-form" id="changepassword-form" role="form" action="redirect" method="POST">
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                              <div class="changepassword-success"><div class="alert alert-success"></div></div>
                              <div class="changepassword-error"><div class="alert alert-error"></div></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Old Password" name="chngOrigPassword" id="chngOrigPassword" required="required" value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="New Password" name="chngNewPassword" id="chngNewPassword" value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Confirm New Password" name="chngCnfrmNewPassword" id="chngCnfrmNewPassword" value="">
                            </div>
                            <div class="form-group form-fields-width">
                              <input type="submit" class="btn btn-block" id="changepassword" value="Change Password">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>';
			$this->_data['result'] = $this->_magazineModel->checkAccessValidity();
			$this->_data['partialIssues'] = $this->_magazineModel->getPartialIssueList();
			$this->_data['partialIssues'];
		} else {
			$this->_data['show_login'] = 1;
			$this->_data['header_text'] = '<div style="display:inline-block;vertical-align: bottom; padding-right:10px;">';
			$this->_data['header_text'] .= '<div class="loggedin-name"><strong><a href="javascript:void(0);" onclick="load_popup(0);" style="text-transform:uppercase">Sign In</a></strong> | <strong><a href="javascript:void(0);" onclick="load_popup(1);" style="text-transform:uppercase">Sign Up</a></strong></div>';
			//$this->_data['header_text'] .= '<div class="loggedin-name"><a href="javascript:void;" onclick="load_popup(2);"><em>Forgot password?</em></a></div>';
			$this->_data['header_text'] .= '</div>';
			//$this->_data['header_text'] .= '<div style="display:inline-block;vertical-align: bottom" id="settings">';
			//$this->_data['header_text'] .= '<img src="public/images/settings.png" width="26px" height="26px;">';
			//$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['settingsNav'] = '<li class="active"><a href="#sign-in" role="tab" data-toggle="tab">Sign In</a></li>
			<li><a href="#sign-up" role="tab" data-toggle="tab">Sign Up</a></li>
      <li style="display:none;"><a href="#forgot-password" role="tab" data-toggle="tab"></a></li>';
			$this->_data['settingsTab'] = '
								<div class="tab-pane active" id="sign-in">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal" name="signin-form" action="redirect" id="signin-form" role="form" method="POST">
			                    <div class="form-group form-fields-width">
			                      <div class="signin-success"><div class="alert alert-success"></div></div>
			                      <div class="signin-error"><div class="alert alert-error"></div></div>
			                    </div>
			                    <div class="col-sm-12">
			                      <div class="form-group form-fields-width">
			                          <input class="form-control validate" type="email" name="loginEmail" id="loginEmail" placeholder="Email-ID" required="required"  value="">
			                      </div>
			                      <div class="form-group form-fields-width">
			                          <input type="password" class="form-control validate" placeholder="Password" name="loginPassword" id="loginPassword" required="required"  value="">
			                          <div class="forgot-password"><a href="javascript:void(0);" onclick="load_popup(2);">Forgot Password?</a></div>
			                      </div>
			                      <div class="form-group form-fields-width">
			                        <input type="submit" class="btn btn-block" id="signin" value="Login">
			                      </div>
			                    </div>
			                  </form>
                      </div>
                    </div>
                  </div>
								<div class="tab-pane" id="sign-up">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal" name="signup-form" id="signup-form" role="form" action="redirect" method="POST">
			                    <div class="col-sm-12">
			                      <div class="form-group form-fields-width">
			                        <div class="signup-success"><div class="alert alert-success"></div></div>
			                        <div class="signup-error"><div class="alert alert-error"></div></div>
			                      </div>
			                    </div>
			                    <div class="col-sm-12">
			                      <div class="form-group form-fields-width">
			                          <input type="text" class="form-control validate" placeholder="Name" name="regName" id="regName" required="required"  value="">
			                      </div>
			                      <div class="form-group form-fields-width">
			                          <input class="form-control validate" type="email" placeholder="Email-ID" name="regEmail" id="regEmail" required="required"  value="">
			                      </div>
			                      <div class="form-group form-fields-width">
			                          <input type="text" class="form-control validate" placeholder="Mobile No (optional)" name="regMobileNo" id="regMobileNo" maxlength="10"  value="">
			                      </div>
                            <div class="form-group form-fields-width">
                              <div class="checkbox" id="term_condition_container" style="color:#000000;" onclick="removeErrorMsg(this);">
                                <label><input type="checkbox" class="validate" value="yes" name="t_c" id="t_c" checked>I agree to the <a data-toggle="modal" href="#tc-pg">Terms & Conditions</a></label>
                              </div>
                            </div>
			                      <div class="form-group form-fields-width">
			                        <input type="submit" class="btn btn-block" id="signup" value="Sign Up">
			                      </div>
                            <div class="form-group form-fields-width text-center">
                              <em><strong>Sign-Up Now To Grab Your Free eMagazine</strong></em>
                            </div>
			                    </div>
			                  </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="forgot-password">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal MB5" name="forgotpassword-form" id="forgotpassword-form" role="form" method="POST">
                          <div class="form-group form-fields-width">
                            <div class="forgotpassword-success"><div class="alert alert-success"></div></div>
                            <div class="forgotpassword-error"><div class="alert alert-error"></div></div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input class="form-control validate" type="email" name="forgotEmailId" id="forgotEmailId" placeholder="Registered Email-Id"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                            	<div class="col-sm-6">
                            		<div class="forgot-password"><a href="javascript:void(0);" onclick="load_popup(0);" class="btn btn-block">Back to Sign In?</a></div>
                            	</div>
                            	<div class="col-sm-6">
                              	<input type="submit" class="btn btn-block" id="forgotpassword" value="Reset Password">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>';
			$this->_data['result'] = 0;
		}

		$this->_data['aboutdt'] = $this->_magazineModel->getAboutSection();
		$this->_data['whydt'] = $this->_magazineModel->getWhyDtSection();
		$this->_data['sneakpreview'] = $this->_magazineModel->getSneakPreviewSection();
		$this->_data['subscribe'] = $this->_magazineModel->getSubscribeSection();
		$this->_data['load_js'] = true;
		require_once _CONST_VIEW_PATH . 'home.tpl.php';
	}

	public function doVerification() {
		$this->_data = $this->_magazineModel->performVerification();
		echo json_encode($this->_data);
	}

	public function register() {
		$this->_magazineModel->registerUser();
		/*echo json_encode($this->_data);*/
	}

	public function login() {
		$this->_magazineModel->loginUser();
		/*echo json_encode($this->_data);*/
	}

	public function signup() {
		$this->_magazineModel->registerUser();
		/*echo json_encode($this->_data);*/
	}

	public function signin() {
		$this->_magazineModel->loginUser();
		/*echo json_encode($this->_data);*/
	}

	public function logout() {
		$this->_magazineModel->logoutUser();
		$this->redirect("303", _CONST_WEB_URL);
		/*echo json_encode($this->_data);*/
	}

	public function changePassword() {
		$this->_magazineModel->changePassword();
	}

	public function forgotPassword() {
		$this->_magazineModel->resetPassword();
	}

	public function askDt() {
		$this->_magazineModel->askDt();
	}

	public function searchStock() {
		$this->_magazineModel->autoSuggestStock();
	}

	public function gatewayRedirect() {
		$this->_data = $this->_magazineModel->goToCCAvenue();
		if ($this->_data['data'] == 'invalid') {

		} else {
			header("HTTP/1.1 303 OK");
			echo $this->_data['data'];
		}
	}

	public function gatewayResponse() {
		$this->_data['response'] = $this->_magazineModel->handleCCAvenueResponse();
		if ($this->_data['response'] === false) {
			$this->redirect(200, 'http://magazine.dalaltimes.com/payment-error');
		} else {
			echo '<html>
    <head>
    <title>Dalaltimes Subscription</title>
    </head>
    <body>
    <center>
    <form method="post" name="redirect" action="http://magazine.dalaltimes.com/payment-success">
      <input type="hidden" name="order_id" value=" ' . $this->_data['response'] . '">";
    </form>
    </center>
    <script language="javascript">document.redirect.submit();</script>
    </body>
    </html>';
		}
	}

	public function gatewayResponseSuccess() {
		$this->_data['order_details'] = $this->_magazineModel->getOrderDetails();
		if ($_SESSION['_loggedIn'] == 1) {
			$this->_data['header_text'] = '<div style="display:inline-block;vertical-align: bottom; padding-right:10px;">';
			$this->_data['header_text'] .= '<div class="loggedin-name">Welcome <strong>' . base64_decode($_SESSION['_name']) . '</strong></div>';
			$this->_data['header_text'] .= '<div class="loggedin-name"><a href="logout">Logout</a></div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '<div style="display:inline-block;vertical-align: top" id="settings">';
			$this->_data['header_text'] .= '<img src="public/images/settings.png" width="20px" height="20px;">';
			$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['settingsNav'] = '<li class="active"><a href="#change-password" role="tab" data-toggle="tab">Change Password</a></li>';
			$this->_data['settingsTab'] = '<div class="tab-pane active" id="change-password">
                    <div class="row">
                      <div class="col-sm-12">
                        <form class="form-horizontal MB5" name="changepassword-form" id="changepassword-form" role="form" action="redirect" method="POST">
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                              <div class="changepassword-success"><div class="alert alert-success"></div></div>
                              <div class="changepassword-error"><div class="alert alert-error"></div></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Old Password" name="chngOrigPassword" id="chngOrigPassword" required="required" value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="New Password" name="chngNewPassword" id="chngNewPassword" value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Confirm New Password" name="chngCnfrmNewPassword" id="chngCnfrmNewPassword" value="">
                            </div>
                            <div class="form-group form-fields-width">
                              <input type="submit" class="btn btn-block" id="changepassword" value="Change Password">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>';

		} else {
			$this->_data['header_text'] = '<div style="display:inline-block;vertical-align: bottom; padding-right:10px;">';
			$this->_data['header_text'] .= '<div class="loggedin-name"><strong><a href="javascript:void(0);" onclick="load_popup(0);" style="text-transform:uppercase">Sign In</a></strong> | <strong><a href="javascript:void(0);" onclick="load_popup(1);" style="text-transform:uppercase">Sign Up</a></strong></div>';
			//$this->_data['header_text'] .= '<div class="loggedin-name"><a href="javascript:void;" onclick="load_popup(2);"><em>Forgot password?</em></a></div>';
			$this->_data['header_text'] .= '</div>';
			//$this->_data['header_text'] .= '<div style="display:inline-block;vertical-align: bottom" id="settings">';
			//$this->_data['header_text'] .= '<img src="public/images/settings.png" width="26px" height="26px;">';
			//$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['settingsNav'] = '<li class="active"><a href="#sign-in" role="tab" data-toggle="tab">Sign In</a></li>
      <li><a href="#sign-up" role="tab" data-toggle="tab">Sign Up</a></li>
      <li style="display:none;"><a href="#forgot-password" role="tab" data-toggle="tab"></a></li>';
			$this->_data['settingsTab'] = '
                <div class="tab-pane active" id="sign-in">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal" name="signin-form" action="redirect" id="signin-form" role="form" method="POST">
                          <div class="form-group form-fields-width">
                            <div class="signin-success"><div class="alert alert-success"></div></div>
                            <div class="signin-error"><div class="alert alert-error"></div></div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input class="form-control validate" type="email" name="loginEmail" id="loginEmail" placeholder="Email-ID" required="required"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Password" name="loginPassword" id="loginPassword" required="required"  value="">
                                <div class="forgot-password"><a href="javascript:void(0);" onclick="load_popup(2);">Forgot Password?</a></div>
                            </div>
                            <div class="form-group form-fields-width">
                              <input type="submit" class="btn btn-block" id="signin" value="Login">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <div class="tab-pane" id="sign-up">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal" name="signup-form" id="signup-form" role="form" action="redirect" method="POST">
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                              <div class="signup-success"><div class="alert alert-success"></div></div>
                              <div class="signup-error"><div class="alert alert-error"></div></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input type="text" class="form-control validate" placeholder="Name" name="regName" id="regName" required="required"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input class="form-control validate" type="email" placeholder="Email-ID" name="regEmail" id="regEmail" required="required"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="text" class="form-control validate" placeholder="Mobile No (optional)" name="regMobileNo" id="regMobileNo" maxlength="10"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                              <div class="checkbox" style="color:#000000;">
                                <label><input type="checkbox" value="yes" name="t_c" id="t_c" checked>I agree to the <a data-toggle="modal" href="#tc-pg">Terms & Conditions</a></label>
                              </div>
                            </div>
                            <div class="form-group form-fields-width">
                              <input type="submit" class="btn btn-block" id="signup" value="Sign Up">
                            </div>
                            <div class="form-group form-fields-width text-center">
                              <em><strong>Sign-Up Now To Grab Your Free eMagazine</strong></em>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="forgot-password">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal MB5" name="forgotpassword-form" id="forgotpassword-form" role="form" method="POST">
                          <div class="form-group form-fields-width">
                            <div class="forgotpassword-success"><div class="alert alert-success"></div></div>
                            <div class="forgotpassword-error"><div class="alert alert-error"></div></div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input class="form-control validate" type="email" name="forgotEmailId" id="forgotEmailId" placeholder="Registered Email-Id"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                              <div class="col-sm-6">
                                <div class="forgot-password"><a href="javascript:void(0);" onclick="load_popup(0);" class="btn btn-block">Back to Sign In?</a></div>
                              </div>
                              <div class="col-sm-6">
                                <input type="submit" class="btn btn-block" id="forgotpassword" value="Reset Password">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>';
		}
		$this->_data['show_header_menu'] = "show";
		require_once _CONST_VIEW_PATH . 'gateway-success.tpl.php';
	}

	public function gatewayResponseError() {
		if ($_SESSION['_loggedIn'] == 1) {
			$this->_data['header_text'] = '<div style="display:inline-block;vertical-align: bottom; padding-right:10px;">';
			$this->_data['header_text'] .= '<div class="loggedin-name">Welcome <strong>' . base64_decode($_SESSION['_name']) . '</strong></div>';
			$this->_data['header_text'] .= '<div class="loggedin-name"><a href="logout">Logout</a></div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '<div style="display:inline-block;vertical-align: top" id="settings">';
			$this->_data['header_text'] .= '<img src="public/images/settings.png" width="20px" height="20px;">';
			$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['settingsNav'] = '<li class="active"><a href="#change-password" role="tab" data-toggle="tab">Change Password</a></li>';
			$this->_data['settingsTab'] = '<div class="tab-pane active" id="change-password">
                    <div class="row">
                      <div class="col-sm-12">
                        <form class="form-horizontal MB5" name="changepassword-form" id="changepassword-form" role="form" action="redirect" method="POST">
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                              <div class="changepassword-success"><div class="alert alert-success"></div></div>
                              <div class="changepassword-error"><div class="alert alert-error"></div></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Old Password" name="chngOrigPassword" id="chngOrigPassword" required="required" value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="New Password" name="chngNewPassword" id="chngNewPassword" value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Confirm New Password" name="chngCnfrmNewPassword" id="chngCnfrmNewPassword" value="">
                            </div>
                            <div class="form-group form-fields-width">
                              <input type="submit" class="btn btn-block" id="changepassword" value="Change Password">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>';

		} else {
			$this->_data['header_text'] = '<div style="display:inline-block;vertical-align: bottom; padding-right:10px;">';
			$this->_data['header_text'] .= '<div class="loggedin-name"><strong><a href="javascript:void(0);" onclick="load_popup(0);" style="text-transform:uppercase">Sign In</a></strong> | <strong><a href="javascript:void(0);" onclick="load_popup(1);" style="text-transform:uppercase">Sign Up</a></strong></div>';
			//$this->_data['header_text'] .= '<div class="loggedin-name"><a href="javascript:void;" onclick="load_popup(2);"><em>Forgot password?</em></a></div>';
			$this->_data['header_text'] .= '</div>';
			//$this->_data['header_text'] .= '<div style="display:inline-block;vertical-align: bottom" id="settings">';
			//$this->_data['header_text'] .= '<img src="public/images/settings.png" width="26px" height="26px;">';
			//$this->_data['header_text'] .= '</div>';
			$this->_data['header_text'] .= '</div>';
			$this->_data['settingsNav'] = '<li class="active"><a href="#sign-in" role="tab" data-toggle="tab">Sign In</a></li>
      <li><a href="#sign-up" role="tab" data-toggle="tab">Sign Up</a></li>
      <li style="display:none;"><a href="#forgot-password" role="tab" data-toggle="tab"></a></li>';
			$this->_data['settingsTab'] = '
                <div class="tab-pane active" id="sign-in">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal" name="signin-form" action="redirect" id="signin-form" role="form" method="POST">
                          <div class="form-group form-fields-width">
                            <div class="signin-success"><div class="alert alert-success"></div></div>
                            <div class="signin-error"><div class="alert alert-error"></div></div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input class="form-control validate" type="email" name="loginEmail" id="loginEmail" placeholder="Email-ID" required="required"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="password" class="form-control validate" placeholder="Password" name="loginPassword" id="loginPassword" required="required"  value="">
                                <div class="forgot-password"><a href="javascript:void(0);" onclick="load_popup(2);">Forgot Password?</a></div>
                            </div>
                            <div class="form-group form-fields-width">
                              <input type="submit" class="btn btn-block" id="signin" value="Login">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <div class="tab-pane" id="sign-up">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal" name="signup-form" id="signup-form" role="form" action="redirect" method="POST">
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                              <div class="signup-success"><div class="alert alert-success"></div></div>
                              <div class="signup-error"><div class="alert alert-error"></div></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input type="text" class="form-control validate" placeholder="Name" name="regName" id="regName" required="required"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input class="form-control validate" type="email" placeholder="Email-ID" name="regEmail" id="regEmail" required="required"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                                <input type="text" class="form-control validate" placeholder="Mobile No (optional)" name="regMobileNo" id="regMobileNo" maxlength="10"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                              <div class="checkbox" style="color:#000000;">
                                <label><input type="checkbox" value="yes" name="t_c" id="t_c" checked>I agree to the <a data-toggle="modal" href="#tc-pg">Terms & Conditions</a></label>
                              </div>
                            </div>
                            <div class="form-group form-fields-width">
                              <input type="submit" class="btn btn-block" id="signup" value="Sign Up">
                            </div>
                            <div class="form-group form-fields-width text-center">
                              <em><strong>Sign-Up Now To Grab Your Free eMagazine</strong></em>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="forgot-password">
                    <div class="row">
                      <div class="col-sm-12 ">
                        <form class="form-horizontal MB5" name="forgotpassword-form" id="forgotpassword-form" role="form" method="POST">
                          <div class="form-group form-fields-width">
                            <div class="forgotpassword-success"><div class="alert alert-success"></div></div>
                            <div class="forgotpassword-error"><div class="alert alert-error"></div></div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group form-fields-width">
                                <input class="form-control validate" type="email" name="forgotEmailId" id="forgotEmailId" placeholder="Registered Email-Id"  value="">
                            </div>
                            <div class="form-group form-fields-width">
                              <div class="col-sm-6">
                                <div class="forgot-password"><a href="javascript:void(0);" onclick="load_popup(0);" class="btn btn-block">Back to Sign In?</a></div>
                              </div>
                              <div class="col-sm-6">
                                <input type="submit" class="btn btn-block" id="forgotpassword" value="Reset Password">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>';
		}
		$this->_data['show_header_menu'] = "show";
		require_once _CONST_VIEW_PATH . 'gateway-error.tpl.php';
	}

	public function showPartialBook() {
		$this->_data['result'] = $this->_magazineModel->getPartialIssueList();
		if (in_array($this->_issue, $this->_data['result'])) {
			require_once _CONST_VIEW_PATH . 'partial-' . $this->_issue . '/index.php';
		}
	}

	public function showSubscribedBook() {
		$this->_data['result'] = $this->_magazineModel->checkAccessValidity($this->_issue);
		if ($this->_data['result'] > 0) {
			require_once _CONST_VIEW_PATH . $this->_issue . '/index.php';
		}
	}
}
?>
