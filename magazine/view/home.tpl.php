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
    <section id="banner" >
          <div class="col-sm-12" style="padding:0px;">
              <div id="hp">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 " style="padding: 0px">
                  <?php if ($_SESSION['_loggedIn'] == 1) {?>
                  <div class="col-xs-12" id="samvat" style="background-image: url('public/images/samvat.jpg');background-size: contain;background-repeat: no-repeat;background-position: center center;background-color: #FFFFFF;" onclick="window.open('http://www.dalaltimes.com');">
                  <?php } else {?>
                  <div class="col-xs-12" id="samvat" style="background-image: url('public/images/samvat.jpg');background-size: contain;background-repeat: no-repeat;background-position: center center;background-color: #FFFFFF;cursor: pointer" onclick="window.open('http://www.dalaltimes.com');">
                  <?php }
?>
                  </div>
                  <div class="col-xs-12 " style="background-color: #000000"  id="testimonial">
                    <div>
                      <h3 style="font-size:15px">Client Testimonial</h3>
                    </div>
                    <div class="textitem">
                      <blockquote class="testimonial" >
                        <p>Congratulations for bringing out an excellent publication catering to the ever changing financial markets! All the best for a strong readership.</p>
                      </blockquote>
                      <p class="testimonial-author">Saurabh S Dhanorkar</p>
                    </div>
                    <div class="textitem">
                      <blockquote class="testimonial">
                        <p>Dalal Times Magazine gives wide coverage of fundamental and technical analysis, recommendations of large and midcap stocks, corporate data bank, mutual funds etc.. We hope it will be one of the leading investment magazine of our country.</p>
                      </blockquote>
                      <p class="testimonial-author">S. M. Potdar </p>
                    </div>
                    <div class="textitem">
                      <blockquote class="testimonial">
                        <p>Dalal Times Magazine looks really promising. Indian traders finally get a great stock market media house. I hope DT continues to focus on capital market news only, rather than become a second Economic Times.</p>
                      </blockquote>
                      <p class="testimonial-author">Anurag Bhatia </p>
                    </div>
                    <div class="textitem">
                      <blockquote class="testimonial">
                        <p>Congratulations for bringing out an excellent publication catering to the ever changing financial markets! All the best for a strong readership.</p>
                      </blockquote>
                      <p class="testimonial-author">Saurabh S Dhanorkar</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding: 0px">
                      <div id="mycarousel" class="carousel-hp carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div id="hp-rank" class="carousel-inner" role="listbox">
                          <div class="item active" >
                            <img src="public/images/im1.jpg" data-color="black" alt="First Image">
                            <!-- <div class="rank-article">
                              <span class="article-category">Cover Story</span>
                              <h3>How airlines are managing the labyrinth of aviation risk</h3>
                            </div> -->
                          </div>
                          <div class="item" >
                            <img src="public/images/im2.jpg" data-color="black" alt="Second Image">
                            <!-- <div class="rank-article">
                              <span class="article-category">Cover Story</span>
                              <h3>How airlines are managing the labyrinth of aviation risk</h3>
                            </div> -->
                          </div>
                          <div class="item" >
                            <img src="public/images/im3.jpg" data-color="black" alt="Third Image">
                            <!-- <div class="rank-article">
                              <span class="article-category">Cover Story</span>
                              <h3>How airlines are managing the labyrinth of aviation risk</h3>
                            </div> -->
                          </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                </div>
                <div style="clear:both"></div>
              </div>
          </div>
          <div style="clear:both"></div>
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
                <p>The January issue of Dalal Times Magazine came out with a changed theme. From January 2016 onwards, we will be looking at companies, groups or companies within a business group that have the potential to create wealth for its investors in the future and also have some good track record attached to them. This time read our Cover Story on the Godrej Group and what the Chairperson of the group Adi Godrej have to say. The third issue (Vol. II) of the magazine also brings to you reader-favourite segments like How Good A Bet, Gems In The Offing, Pink Stock et al for investors to make better and informed portfolio decisions. Subscribe and read stock recommendations and suggestions that hold ground even in the present turbulent phase of the market.</p>
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
    $youpay = ($value['type'] == 'digital') ? 'You Pay - Rs ' . $value['package_value'] : 'You Pay - Rs ' . $value['package_value'].'<br>+<br>Courier Charges';
		

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
                                  <li>'.$youpay.'</li>
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
    $youpay = ($value['type'] == 'digital') ? '<li>You Pay - Rs ' . $value['package_value'].'</li>' : '<li style="padding:0px 10px;font-size: 14px">You Pay - Rs ' . $value['package_value'].'<br>+<br>Courier Charges</li>';
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
                                  ' . $youpay . '
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
	if (is_array($this->_data['completeIssues'])) {
		$issue_array = array(
      'december2015' => array('issue' => 'Dec 2015', 'issue_url' => '/magazine/december2015', 'issue_cover_img' => 'view/december2015/cover.jpg'),
			'november2015' => array('issue' => 'Nov 2015', 'issue_url' => '/magazine/november2015', 'issue_cover_img' => 'view/november2015/cover.jpg'),
			'october2015' => array('issue' => 'Oct 2015', 'issue_url' => '/magazine/october2015', 'issue_cover_img' => 'view/october2015/cover.jpg'),
			'september2015' => array('issue' => 'Sept 2015', 'issue_url' => '/magazine/september2015', 'issue_cover_img' => 'view/september2015/cover.jpg'),
			'august2015' => array('issue' => 'Aug 2015', 'issue_url' => '/magazine/august2015', 'issue_cover_img' => 'view/august2015/cover.jpg'),
		);
		$this->_data['completeIssues'] = array_flip($this->_data['completeIssues']);
		$this->_data['completeIssues'] = array_intersect_key($issue_array, $this->_data['completeIssues']);
		$cntr = 0;
		foreach ($this->_data['completeIssues'] as $key => $value) {
			$complete_issue_list .= '<li><a href="' . $value['issue_url'] . '" target="_new"><img src="' . $value['issue_cover_img'] . '" width="88" height="126" alt="" border="0" title="' . $value['issue'] . '" /><br>' . $value['issue'] . '</a></li>';
			$cntr++;
		}
	}
	$partial_issue_array = array(
    'december2015' => array('issue' => 'Dec 2015', 'issue_url' => '/sneak-preview/december2015', 'issue_cover_img' => 'view/partial-december2015/cover.jpg'),
		'november2015' => array('issue' => 'Nov 2015', 'issue_url' => '/sneak-preview/november2015', 'issue_cover_img' => 'view/partial-november2015/cover.jpg'),
		'october2015' => array('issue' => 'Oct 2015', 'issue_url' => '/sneak-preview/october2015', 'issue_cover_img' => 'view/partial-october2015/cover.jpg'),
		'september2015' => array('issue' => 'Sept 2015', 'issue_url' => '/sneak-preview/september2015', 'issue_cover_img' => 'view/partial-september2015/cover.jpg'),
		'august2015' => array('issue' => 'Aug 2015', 'issue_url' => '/sneak-preview/august2015', 'issue_cover_img' => 'view/partial-august2015/cover.jpg'),
		'july2015' => array('issue' => 'July 2015', 'issue_url' => '/sneak-preview/july2015', 'issue_cover_img' => 'view/partial-july2015/cover.jpg'),
		'june2015' => array('issue' => 'June 2015', 'issue_url' => '/sneak-preview/june2015', 'issue_cover_img' => 'view/partial-june2015/cover.jpg'),
		'may2015' => array('issue' => 'May 2015', 'issue_url' => '/sneak-preview/may2015', 'issue_cover_img' => 'view/partial-may2015/cover.jpg'),
		'april2015' => array('issue' => 'April 2015', 'issue_url' => '/sneak-preview/april2015', 'issue_cover_img' => 'view/partial-april2015/cover.jpg'),
		'march2015' => array('issue' => 'March 2015', 'issue_url' => '/sneak-preview/march2015', 'issue_cover_img' => 'view/partial-march2015/cover.jpg'),
	);
	if ($complete_issue_list == '') {
		$register_text = '<a href="http://magazine.dalaltimes.com#registration_sub" style="text-decoration:none;"><h5 style="color:#FFFFFF;font-size:18px;">This is a partial copy. To get the latest issue or to read full version <span class="reviewer-name" style="color:#428bca">SUBSCRIBE NOW</span></h5></a>';
	}
	$partial_issue_list = '';
	$this->_data['partialIssues'] = array_reverse($this->_data['partialIssues']);
	for ($i = 0; $i < count($this->_data['partialIssues']); $i++) {
		$partial_issue_list .= '<li><a href="' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue_url'] . '" target="_new"><img src="' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue_cover_img'] . '" width="88" height="126" alt="" border="0" title="' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue'] . '" /><br>' . $partial_issue_array[$this->_data['partialIssues'][$i]]['issue'] . '</a></li>';
	}
	?>
    <section class="review norm-img" style="background-color: #000000;">
      <div class="trans-bg">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <h2 class="wow swing">Magazine</h2>
            </div>
          </div>
          <div id="emagazine"></div>
          <div class="col-sm-12">
          <?php if ($complete_issue_list != '') {?>
          <div class="row">
            <h2 style="margin-bottom: 10px;font-size: 20px;">Subscribed Issues</h2>
            <div id="liquid1" class="liquid">
              <span class="previous"></span>
              <div class="wrapper">
                <ul>
                  <?php echo $complete_issue_list;?>
                </ul>
              </div>
              <span class="next"></span>
            </div>
          </div>
          <?php }
	?>
	<?
	if($this->_data['specialIssue']==true){?>
          <div class="row">
            <h2 style="margin-bottom: 10px;font-size: 20px;">Special Issues</h2>
            <div id="liquid2" class="liquid">
              <span class="previous"></span>
              <div class="wrapper">
                <ul>
                  <li><a href="/samvat/november2015"><img src="view/samvat-november2015/cover.jpg" width="88" height="126" border="0" /><br>Samvat 2015</a></li>

                </ul>
              </div>
              <span class="next"></span>
            </div>
          </div>
         <?php } ?>
        <?php if ($partial_issue_list != '') {?>
            <div class="row">
              <h2 style="margin-bottom: 10px;font-size: 20px;">Partial Copy</h2>
              <div id="liquid3" class="liquid">
                <span class="previous"></span>
                <div class="wrapper">
                  <ul>
                  <?php echo $partial_issue_list;?>
                  </ul>
                </div>
                <span class="next"></span>
              </div>
            </div>
          <?php }
	?>
            <div class="row text-center">
              <?php echo $register_text;?>
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
