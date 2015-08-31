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
            <div>
              <div class="text-slider slider">
                  <ul class="slides">
                     <li>For more information please call our toll free no : 1800-2700-479</li>
                     <li style="color:#FBDA00">For more information please call our toll free no : 1800-2700-479</li>
                  </ul>
            </div>
            <div class="col-sm-12">

              <h2><a href="" class="dt-logo"><img src="public/images/dtlogo_white.png"></a></h2> <!-- .lg-logo -->
              <h2 class="MT80"><a href="" class="dtm-logo"><img src="public/images/magazinelogo_white.png"></a></h2> <!-- .lg-logo -->
                 <!-- Text slider start here -->
              <!-- Text slider start here -->
                 <div class="flex_text text-slider">
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
                  <ul class="download-block text-center">
                   <li><a href="#about_dt" class="btn-download">About Magazine</a></li>
                   <li><a href="#why_dt" class="btn-download">Why Subscribe</a></li>
                   <li><a href="#sneak_preview_sub" class="btn-download">Sneak Peek</a></li>
                   <li><a href="#registration" class="btn-download">Subscribe</a></li>
		  <?php if ($_SESSION['_loggedIn'] == 1) {?>
                   <li><a href="#emagazine" class="btn-download">eMagazine</a></li>
		 <?php }
?>
                   <li><a href="#ask_dt" class="btn-download">Ask DT</a></li>
                  </ul>
                 <!-- </div> -->
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->
    </section>
    <!-- banner end -->

    <!-- About Dalaltimes Magazine start -->
    <section id="about_dt" class="intro white PTB20">
      <div class="container">
        <div class="row" id="about_dt_sub">
          <div class="col-sm-12 text-center">
            <span class="sub-head wow fadeInLeft">About</span>

            <div class="title wow fadeInRight">
              <h2>Dalal Times Magazine</h2>

            </div>

          </div>
        </div>
        <div class="row" >
          <div class="col-sm-2"></div>
          <div class="col-sm-4 wow slideInLeft " data-wow-delay=".5s">
            <a href="#registration"><img class="img-responsive " src="<?php echo $this->_data['aboutdt']['img'];?>" width="300px" height="406px" alt="Magazine Cover"></a>
          </div>
          <div class="col-sm-4 wow slideInRight" data-wow-delay=".5s" style="text-align:justify;">
            <?php echo $this->_data['aboutdt']['content'];?>
            <!-- /.description-list -->
          </div>
          <div class="col-sm-2"></div>
        </div>
      </div>
    </section>
    <!-- About Dalaltimes Magazine end -->

    <!-- Why Read Dalaltimes start -->
    <section id="why_dt" class="feature norm-img">
      <div class="trans-bg">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="sub-head wow fadeInLeft">Why Read</span>
              <div class="title wow fadeInRight">
                <h2>Dalal Times Magazine</h2>
              </div>
            </div>
          </div>
          <div class="row" id="why_dt_sub" >
            <div class="col-sm-4">
              <ul class="feature-list-left">
<?php
$whydt_cover = $this->_data['whydt']['cover_img'];
foreach ($this->_data['whydt']['featurelist-left'] as $key => $value) {
	echo '<li>
                  <div class="feature-detail wow fadeInLeft" data-wow-delay=".4s" onmouseover="document.getElementById(\'why_read_img_block\').src=\'' . $value['mouseover'] . '\';" onmouseout="document.getElementById(\'why_read_img_block\').src=\'' . $whydt_cover . '\'">
                    <h4><i class="glyphicon glyphicon-ok">&nbsp;</i>' . $value['heading'] . '</h4>
                    ' . $value['content'] . '
                  </div>
                </li>';
}
?>
              </ul>
            </div>
            <div class="col-sm-4 text-center">
              <img class="wow fadeIn img-responsive" data-wow-delay=".8s" id="why_read_img_block" src="<?php echo $whydt_cover;?>" alt="" title="">
            </div>
            <div class="col-sm-4">
              <ul class="feature-list-right">
<?php
foreach ($this->_data['whydt']['featurelist-right'] as $key => $value) {

	echo '<li>
                  <div class="feature-detail wow fadeInRight" data-wow-delay=".4s" onmouseover="document.getElementById(\'why_read_img_block\').src=\'' . $value['mouseover'] . '\';" onmouseout="document.getElementById(\'why_read_img_block\').src=\'' . $whydt_cover . '\'">
                    <h4><i class="glyphicon glyphicon-ok">&nbsp;</i>' . $value['heading'] . '</h4>
                    ' . $value['content'] . '
                  </div>
                </li>';
}
?>
              </ul>
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->
    </section>
    <!-- Wht Read Dalaltimes Magazine end -->

    <!-- Sneak Preview start -->
    <section id="sneak_preview" class="feature-wrap">
      <div class="container features center">
        <div class="row">
          <div class="col-sm-12 text-center">
            <span class="sub-head wow fadeInLeft">A Glimpse of Whats in Store</span>
            <div class="title wow fadeInRight">
              <h2>Sneak Peek</h2>
            </div>
            <div style="text-align: justify;">
                <p>The ninth issue of Dalal Times Magazine showcases an upcoming trend in Broking services with Nithin Kamath, Founder and CEO of Zerodha, in the spotlight. The cover story explores his journey and offers valuable insight to other brokers and broking firms. The magazine also carries sections like Gems In The Offing, Pink Stock, Make Or Break and Technically Speaking; segments that have earned us the title of ‘Most Preferred Stock Market Magazine In India’, by our readers.</p>
              </div>
          </div>
        </div>
        <div class="row" id="sneak_preview_sub">
          <div class="col-lg-12">

              <!--Features container Starts -->
              <ul id="card-ul" class="features-hold baraja-container">
<?php
foreach ($this->_data['sneakpreview'] as $key => $value) {

	echo '<li class="single-feature" title="">
                  <img src="' . $value . '" class="feature-image" alt="" />
                </li>';
}
?>
              </ul>
              <!--Features container Ends -->

              <!-- Features Controls Starts -->
              <div class="features-control relative">
                <p style="font-size:30px;text-align: center">To Read More <br> <a href="javascript:void(0);" onclick="goToByScroll1('#registration');"><strong>Subscribe Now</strong></a></p>
              </div>
              <!-- Features Controls Ends -->
          </div>
        </div>
      </div>
    </section>
    <!-- Sneak Preview end -->

    <!-- registration start -->
    <section id="registration" class="registration norm-img">
      <div class="">
        <div class="container subscribe_box">
          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="sub-head wow fadeInLeft">unbelievable</span>
              <div class="title wow fadeInRight">
                <h2>Pricing</h2>
              </div>
            </div>
          </div>
          <div class="row" id="registration_sub">
            <form method="POST" name="subscribe-form" id="subscribe-form" action="redirect">
              <input type="hidden" name="loginPkgId" id="loginPkgId" value="" readonly >
            </form>
            <?php if ($_SESSION['q'] != "") {
	echo '<div class="col-sm-3"></div>';
	foreach ($this->_data['subscribe'] as $key => $value) {
		$type = ($value['type'] == 'digital') ? 'eMagazine' : 'Magazine';
		$copy = ($value['type'] == 'digital') ? 'only eMagazine' : 'Print + eMagazine';

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
		echo '<div class="col-sm-3">
                            <div class="price_box">
                              <div class="' . $price_header . ' pkg_name">
                                  <h3 style="text-transform:none;"> ' . $value['no_of_months'] . ' Months <br> ' . $type . ' </h3>
                              </div>
                              <div class="pkg_plan">
                                <ul>
                                  <li>' . $value['no_of_issues'] . ' issues</li>
                                  <li><strike>Original Price - Rs ' . $value['cover_price'] . '</strike></li>
                                  <li>You Pay - Rs ' . $value['package_value'] . '</li>
                                  <li>' . $copy . '</li>
                                  <li class="' . $background_button_color . '">
                                    <a class="' . $subscribe_button . '" href="javascript:;" onclick="getPackage(' . $value['package_id'] . ')">subscribe</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>';
	}
	echo '<div class="col-sm-3"></div>';
} else {
	?>
            <ul class="dummy" style="margin: auto;">
            <?php
foreach ($this->_data['subscribe'] as $key => $value) {
		$type = ($value['type'] == 'digital') ? 'eMagazine' : 'Magazine';
		$copy = ($value['type'] == 'digital') ? 'only eMagazine' : 'Print + eMagazine';

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
		echo '<li>
                            <div class="price_box">
                              <div class="' . $price_header . ' pkg_name">
                                  <h3 style="text-transform:none;"> ' . $value['no_of_months'] . ' Months <br> ' . $type . ' </h3>
                              </div>
                              <div class="pkg_plan">
                                <ul>
                                  <li>' . $value['no_of_issues'] . ' issues</li>
                                  <li>You Pay - Rs' . $value['package_value'] . '</li>
                                  <li>' . $copy . '</li>
                                  <li class="' . $background_button_color . '">
                                    <a class="' . $subscribe_button . '" href="javascript:;" onclick="getPackage(' . $value['package_id'] . ')">subscribe</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </li>';
	}
}
?>
            </ul>
	</div>
	 <!--<div class="col-xm-12 text-center">
	   <p><strong><em>To avail student discount, write to us at <a href="mailto:subscription@dalaltimes.in">subscription@dalaltimes.in</a>.</em></strong></p>
	 </div> -->
        </div>
      </div>
    </section>
    <!-- registration end -->
        <!-- review start -->
<?php
if ($_SESSION['_loggedIn'] == 1) {
	$complete_issue_list = '';
	if ($this->_data['result'] > 0) {
		$issue_array = array(
			'august2015' => array('issue' => 'August 2015 issue', 'issue_url' => '/magazine/august2015', 'issue_cover_img' => 'view/august2015/cover.jpg'),
		);
		$complete_issue_list = '<div class="active item">
      <a href="' . $issue_array['august2015']['issue_url'] . '" target="_new">
        <span>
           <img src="' . $issue_array['august2015']['issue_cover_img'] . '" width="189px" height="260px">
         </span>
      </a>
      <a href="' . $issue_array['august2015']['issue_url'] . '" target="_new"><span class="reviewer-name">' . $issue_array['august2015']['issue'] . '</span></a>
    </div>';
	}
	$partial_issue_array = array(
		'august2015' => array('issue' => 'August 2015 issue', 'issue_url' => '/sneak-preview/august2015', 'issue_cover_img' => 'view/partial-august2015/cover.jpg'),
		'july2015' => array('issue' => 'July 2015 issue', 'issue_url' => '/sneak-preview/july2015', 'issue_cover_img' => 'view/partial-july2015/cover.jpg'),
		'june2015' => array('issue' => 'June 2015 issue', 'issue_url' => '/sneak-preview/june2015', 'issue_cover_img' => 'view/partial-june2015/cover.jpg'),
		'may2015' => array('issue' => 'May 2015 issue', 'issue_url' => '/sneak-preview/may2015', 'issue_cover_img' => 'view/partial-may2015/cover.jpg'),
		'april2015' => array('issue' => 'April 2015 issue', 'issue_url' => '/sneak-preview/april2015', 'issue_cover_img' => 'view/partial-april2015/cover.jpg'),
		'march2015' => array('issue' => 'March 2015 issue', 'issue_url' => '/sneak-preview/march2015', 'issue_cover_img' => 'view/partial-march2015/cover.jpg'),
	);
	$partial_issue_list = '';
	$this->_data['partialIssues'] = array_reverse($this->_data['partialIssues']);
	for ($i = 0; $i < count($this->_data['partialIssues']); $i++) {
		if ($i == 0 && $complete_issue_list == '') {
			$active_cls = 'active';
		} else {
			$active_cls = '';
		}
		$partial_issue_list .= '<div class="' . $active_cls . ' item">
      <a href="' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue_url'] . '" target="_new">
        <span>
           <img src="' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue_cover_img'] . '" width="189px" height="260px">
         </span>
      </a>
      <a href="' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue_url'] . '" target="_new"><span class="reviewer-name">' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue'] . '</span></a>
    </div>';
	}
	?>
    <section id="emagazine" class="review norm-img" style="background-color: #000000;">
      <div class="trans-bg">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <h2 class="wow swing">Magazine</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 text-center">
              <div id="myCarousel1" class="carousel slide" data-ride="carousel" data-wrap="false">
                <div class="carousel-inner">
                  <?php echo $complete_issue_list . $partial_issue_list;?>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel1" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="carousel-control right" href="#myCarousel1" data-slide="next"><i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->
    </section>
    <!-- review end -->
<?php
}
?>
    <section>
      <div class="white " id="ask_dt">
        <div class="container subscribe_box">
          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="sub-head wow fadeInLeft"></span>
              <div class="title wow fadeInRight">
                <h2>Ask DT</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 ">
              <form class="form-horizontal" name="askdt-form" action="redirect" id="askdt-form" role="form" method="POST">
                <input type="hidden" name="stock_ref_id" id="stock_ref_id" value="">
                <div class="form-group form-fields-width">
                  <p class="askdt-success">Your Message has been Successfully Sent!</p>
                  <p class="askdt-error">Error! Something went wrong!</p>
                </div>
                <div class="col-sm-12" id="ask-dt-success">
                  <div class="form-group form-fields-width">
                      <input class="form-control validate" type="text" name="billing_name" id="billing_name" placeholder="Name" required="required">
                  </div>
                  <div class="form-group form-fields-width">
                      <input class="form-control validate" type="email" id="billing_email" name="billing_email" placeholder="Email" value="">
                  </div>
                  <div class="form-group form-fields-width">
                      <input type="text" class="form-control validate" placeholder="Mobile No (optional)" id="billing_tel" name="billing_tel" maxlength="10">
                  </div>
                  <div class="form-group form-fields-width">
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
                  <div class="form-group form-fields-width">
                    <input type="text" class="form-control validate" placeholder="City" id="delivery_city" name="delivery_city" required="required">
                  </div>
                  <div class="form-group form-fields-width">
                    <input type="text" class="form-control validate" placeholder="Stock Name" id="search_stock" name="search_stock" required="required">
                  </div>
                  <div class="form-group form-fields-width">
                    <textarea class="form-control btn-block validate" rows="3" name="user_query" id="user_query" placeholder="Kindly type in your query..."></textarea>
                  </div>
                  <div class="form-group form-fields-width">
                    <input type="submit" class="btn btn-block" id="askdt" value="Send Query">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->
    </section>
<?php
require_once _CONST_VIEW_PATH . 'footer.php';
?>
  </body>
</html>
