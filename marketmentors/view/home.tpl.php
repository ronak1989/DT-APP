<!DOCTYPE html>
<html>
  <head>
<?php
require_once _CONST_VIEW_PATH . 'header_tags.php';
?>
  </head>
  <body>
<?php
require_once _CONST_VIEW_PATH . 'header.php';
?>

    <!-- banner start -->
    <section id="banner" class="banner norm-img">
      <div class="trans-bg">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <h2><a href="" class="dt-logo"><img src="public/images/dtlogo_white.png"></a></h2> <!-- .lg-logo -->
              <h2 class="MT80"><a href="" class="dtm-logo"><img src="public/images/home_mmlogo.png" class="img-responsive"></a></h2> <!-- .lg-logo -->
                 <!-- Text slider start here -->
              <!-- Text slider start here -->
                 <div class="flex_text text-slider" style="display:none">
                  <ul class="slides">
                      <li>Best-selling Indian stock market magazine in the market</li>
                      <li>Gain key insights from our team of researchers and analysts</li>
                      <li>Don’t just read news or views, gain from their impact on the market</li>
                  </ul>
                </div>
                <!--/.text-slider end-->
                <!--/.text-slider end-->
                  <!-- <div class="download-block text-center"> -->
                    <!-- <a href="#about_dt" class="btn-download">About DT</a>
                    <a href="#why_dt" class="btn-download">Why DT</a>
                    <a href="#sneak_preview" class="btn-download">Sneak Preview</a>
                    <a href="#registration" class="btn-download">Subscribe</a>
                    <a href="" class="btn-download">Ask DT</a> -->
                  <!-- </div> -->
                  <ul class="download-block text-center MT80">
                   <li><a href="#about_marketmentors" class="btn-download">About Market Mentors</a></li>
                   <?php
if (!isset($_SESSION['_loggedIn'])) {
	?>
                   <li><a href="#registration" class="btn-download">Register</a></li>
                   <?php
}
?>
                  </ul>
                 <!-- </div> -->
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->
    </section>
    <!-- banner end -->

    <!-- About Dalaltimes Magazine start -->
    <section id="about_marketmentors" class="intro white PTB20">
      <div class="container">
        <div class="row" id="about_dt_sub">
          <div class="col-sm-12 text-center">
            <span class="sub-head wow fadeInLeft">About</span>

            <div class="title wow fadeInRight">
              <h2>Market Mentors</h2>

            </div>

          </div>
        </div>
        <div class="row" >
          <div class="col-sm-1"></div>
          <div class="col-sm-5 wow slideInLeft " data-wow-delay=".5s">
            <a href="#registration"><img class="img-responsive " src="public/images/about_mm.png" alt="Magazine Cover"></a>
          </div>
          <div class="col-sm-5 wow slideInRight justify" data-wow-delay=".5s">
            <p>Market Mentors is a specialized Knowledge platform of Dalal Times, which helps investors, traders and varied businesses, through a host of customized strategic solutions as well as innovative marketing.</p>

            <p>Leveraging the full spectrum of media options available, Market Mentors provides a neutral and credible platform for addressing the stock market related concerns of the audience. It also allows for focused and objective communication which no other media can provide so effectively and impactfully.Market Mentors is backed by Dalal Times's strong intellectual capital of management & editorial talent that includes one of the best research and analytics team in the stock market industry.</p>

            <p>Market Mentors professionalizes in various AUDIENCE DELIVERY formats like On-Ground Special Shows, Knowledge Seminars, Special Content creation, Online and Offline Branding.</p>
            <!-- /.description-list -->
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
    </section>
    <!-- About Dalaltimes Magazine end -->


    <!-- registration start -->
<?php
if (!isset($_SESSION['_loggedIn'])) {
	?>
    <section id="registration" class="registration norm-img">
      <div class="">
        <div class="container subscribe_box">
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="title wow fadeInRight">
                <h2>Register</h2>
              </div>
            </div>
          </div>
          <div class="row" id="registration_sub">
            <div class="PTB20">
              <div class="container subscribe_box" id="registration_sub">
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
                          <div onclick="removeErrorMsg(this);" id="register_terms_container" style="color:#000000;" class="checkbox">
                            <label><input type="checkbox" checked="" id="t_c" name="t_c" value="yes" class="validate">I agree to the <a href="#tc-pg" data-toggle="modal">Terms &amp; Conditions</a></label>
                          </div>
                        </div>
                        <div class="form-group form-fields-width">
                          <input type="submit" class="btn btn-block" id="register" value="Register">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div> <!-- /.trans-bg -->
          </div>
        </div>
      </div>
    </section>
    <!-- registration end -->
<?php
}
?>
<?php
require_once _CONST_VIEW_PATH . 'footer.php';
?>
  </body>
</html>
