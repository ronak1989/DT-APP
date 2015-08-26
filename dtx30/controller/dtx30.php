<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class dtx30 extends dtx30Model {

	static private $_pageType = 'nonloggedin';
	private $_dtx30Model = NULL;
	private $_data = array();
	private $_issue = NULL;

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array(), $issue = NULL) {
		$this->_dtx30Model = new dtx30Model($id, $params);
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
                              <div class="checkbox" id="term_condition_container" style="color:#000000;" onclick="removeErrorMsg(this);">
                                <label><input type="checkbox" class="validate" value="yes" name="t_c" id="t_c" checked>I agree to the <a data-toggle="modal" href="#tc-pg">Terms & Conditions</a></label>
                              </div>
                            </div>
			                      <div class="form-group form-fields-width">
			                        <input type="submit" class="btn btn-block" id="signup" value="Sign Up">
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
			$this->_data['show_login'] = 1;
		}
		$this->_data['load_js'] = true;
		require_once _CONST_VIEW_PATH . 'home.tpl.php';
	}

	public function register() {
		$this->_dtx30Model->registerUser();
		/*echo json_encode($this->_data);*/
	}

	public function login() {
		$this->_dtx30Model->loginUser();
		/*echo json_encode($this->_data);*/
	}

	public function signup() {
		$this->_dtx30Model->registerUser();
		/*echo json_encode($this->_data);*/
	}

	public function signin() {
		$this->_dtx30Model->loginUser();
		/*echo json_encode($this->_data);*/
	}

	public function logout() {
		$this->_dtx30Model->logoutUser();
		$this->redirect("303", _CONST_WEB_URL);
		/*echo json_encode($this->_data);*/
	}

	public function changePassword() {
		$this->_dtx30Model->changePassword();
	}

	public function forgotPassword() {
		$this->_dtx30Model->resetPassword();
	}

}
?>
