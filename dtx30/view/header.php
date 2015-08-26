<?php
$menu = $this->_data['show_header_menu'] != '' ? $this->_data['show_header_menu'] : 'navbar-fixed-top';
?>
    <!-- Preloader -->

    <div id="faceoff">
      <div id="preloader"></div>
      <div class="preloader-section"></div>
    </div>
    <!-- Preloader end -->
    <!-- header start -->
    <header id="home" class="<?php echo $menu;?>">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="row">
            <div class="col-sm-1 navlogo-left">
              <img src="public/images/dtx30_sticky.jpg">
            </div>
            <div class="col-sm-11" id="loggedin-section">
              <div style="float:right;">
                  <?php echo $this->_data['header_text'];?>
              </div>
            </div>
            <div class="col-sm-1 navlogo-right">
              <img src="public/images/dtlogo_grey.png">
            </div>
          <div class="row">
            <div class="col-sm-2">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <h1><a class="nav-brand" href=""></a></h1>
              </div>
            </div>
            <div class="col-sm-10" id="static_menu">
              <!-- Collect the nav toggling -->
              <div class="collapse navbar-collapse navbar-example" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li><a href="<?php echo _CONST_WEB_URL;?>#banner">Home</a></li>
                  <li><a href="<?php echo _CONST_WEB_URL;?>#chart">Chart of the Month</a></li>
                  <li><a href="<?php echo _CONST_WEB_URL;?>#about_dtx30_sub">About DTX30</a></li>
                  <li><a href="<?php echo _CONST_WEB_URL;?>#list_companies">List of Companies</a></li>
                  <li><a href="<?php echo _CONST_WEB_URL;?>#methodology">Methodology</a></li>
                  <li><a href="<?php echo _CONST_WEB_URL;?>#objectives">Objectives</a></li>
                  <?php
if (!isset($_SESSION['_loggedIn'])) {
	?>
                  <li><a href="#registration_sub">Register</a></li>
                  <?php
}
?>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div>
          </div>
        </div><!-- /.container -->
      </nav>
    </header>
    <!-- header end -->
