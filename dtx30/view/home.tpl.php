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
              <h2 class="MT80"><a href="" class="dtm-logo"><img src="public/images/home_dtx30.png"></a></h2> <!-- .lg-logo -->
                 <!-- Text slider start here -->
              <!-- Text slider start here -->
                 <div class="flex_text text-slider" style="display: none;">
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
                   <li><a href="#chart" class="btn-download">Chart</a></li>
                   <li><a href="#about_dtx30" class="btn-download">About DTX30</a></li>
                   <li><a href="#list_companies" class="btn-download">List of Companies</a></li>
                   <li><a href="#methodology" class="btn-download">Methodology</a></li>
                   <li><a href="#objectives" class="btn-download">Objectives</a></li>
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
    <section id="chart" class="intro white PTB20">
      <div class="container">
        <div class="row" id="about_dt_sub">
          <div class="col-sm-12 text-center">
            <div class="title wow fadeInRight">
              <h2>Chart</h2>

            </div>

          </div>
        </div>
        <div class="row" >
          <div class="col-sm-12 wow slideInLeft " data-wow-delay=".5s">
            <img class="img-responsive text-center" src="public/images/chart.jpg" >
          </div>
        </div>
      </div>
    </section>
    <!-- About Dalaltimes Magazine end -->


    <section id="about_dtx30" class="white PTB20">
      <div class="">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="sub-head wow fadeInLeft">About</span>
              <div class="title wow fadeInRight">
                <h2>DTX30</h2>
              </div>
            </div>
          </div>
          <div class="row" id="about_dtx30_sub">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-4">
              <img class="wow fadeIn img-responsive" data-wow-delay=".8s" src="public/images/about_dtx30.jpg" alt="" title="" style="margin:0 auto;">
            </div>
            <div class="col-sm-7">
                <div class="about_dtx mCustomScrollbar">
                  <p>It is an index that will make your investment in the stock market work smart. DTX30, rather than focusing only on market capitalisation to assign weightage, also focuses on the fundamental aspects of companies. As a result, only performing companies form a part of this index. We have created an index that would be a combination of weighting techniques. At present, DTX30 focuses on providing equal weightage to all the constituents. Eventually, we would make alterations based on different financial analytical parameters fixed by us. It would be a combination of equal weightage and fundamental weightage of companies based on parameters set by us. In a nutshell, companies would be part of our index only by virtue of merit, and not merely because of their large market cap.</p>
                  <p>Furthermore, we are also adding more number of sectors that represent the Indian economy (for the list of companies, refer to the table). We have allotted equal weightage to each stock; the base would be 1000 and the base date would be January 1, 2015. However as a practice we will regularly evaluate the performance of the stocks on parameters set by us. Accordingly, weightage in the index will change and hence contribution of each company will also change. Based on various parameters set by our expert team, alterations in the weightage will be done. Reviews will take place on a monthly basis. In simple terms, a stock that is not performing as per our parameters will be eventually out of the index and only the performing ones will remain. This will help in creating an index that will reflect the actual worth of Indian companies to the investors. In the process of doing monthly reviews, we will be able to highlight the stock of the month and even the sector of the month. Our core idea is to present to you an index that brings out a new lot of companies, which may not be big in terms of market capitalisation, but certainly are a better performing lot on all times. Ultimately, our index would consist of only the best performing stocks and thus, would remain a perennial well-performing index.</p>
                </div>
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->
      <div style="clear:both"></div>
    </section>

    <section id="list_companies" class="list_companies PTB20">
      <div class="">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="title wow fadeInRight">
                <h2>List of Companies</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 list-companies-main-lft">
                <table class="table-responsive">
                  <tr>
                    <th width="44%">COMPANY</th>
                    <th width="25%">SECTOR</th>
                    <th width="16%">ORIGINAL<br>WEIGHTAGE</th>
                    <th width="16%">CURRENT<br>WEIGHTAGE</th>
                  </tr>
                  <tr class="odd">
                    <td>Asian Paints</td>
                    <td>FMCG</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>Axis Bank</td>
                    <td>Banking</td>
                    <td>1.2</td>
                    <td>1.2</td>
                  </tr>
                  <tr class="odd">
                    <td>Bajaj Auto</td>
                    <td>Automobile</td>
                    <td>1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>Bharat Forging</td>
                    <td>Auto Ancillary</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="odd">
                    <td>Castrol India</td>
                    <td>Oil/Variants</td>
                    <td>0.8</td>
                    <td>0.8</td>
                  </tr>
                  <tr class="even">
                    <td>CESC</td>
                    <td>Power</td>
                    <td>0.7</td>
                    <td>0.6</td>
                  </tr>
                  <tr class="odd">
                    <td>Cipla</td>
                    <td>Pharmaceuticals</td>
                    <td>1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>HCL Technologies</td>
                    <td>IT</td>
                    <td>0.8</td>
                    <td>0.8</td>
                  </tr>
                  <tr class="odd">
                    <td>HDFC Bank</td>
                    <td>Banking</td>
                    <td>1.1</td>
                    <td>1.2</td>
                  </tr>
                  <tr class="even">
                    <td>Hero MotoCorp</td>
                    <td>Automobile</td>
                    <td>1</td>
                    <td>0.8</td>
                  </tr>
                  <tr class="odd">
                    <td>Hindustan Unilever</td>
                    <td>FMCG</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>HDFC</td>
                    <td>Finance</td>
                    <td>1</td>
                    <td>1.2</td>
                  </tr>
                  <tr class="odd">
                    <td>IndusInd Bank</td>
                    <td>Banking</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>IRB Infrastructure</td>
                    <td>Infrastructure</td>
                    <td>1</td>
                    <td>1</td>
                  </tr>
                  <tr class="odd">
                    <td>Larsen & Turbo</td>
                    <td>Engineering</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                </table>
            </div>
            <div class="col-sm-6 list-companies-main-rgt">
                <table class="table-responsive">
                  <tr>
                    <th width="44%">COMPANY</th>
                    <th width="25%">SECTOR</th>
                    <th width="16%">ORIGINAL<br>WEIGHTAGE</th>
                    <th width="16%">CURRENT<br>WEIGHTAGE</th>
                  </tr>
                  <tr class="odd">
                    <td>Lupin</td>
                    <td>Pharmaceuticals</td>
                    <td>1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>Mahindra & Mahindra</td>
                    <td>Automobile</td>
                    <td>1</td>
                    <td>0.9</td>
                  </tr>
                  <tr class="odd">
                    <td>Maruti Suzuki India</td>
                    <td>Automobile</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>Page Industires</td>
                    <td>Textile</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="odd">
                    <td>Persistent Technologies</td>
                    <td>IT</td>
                    <td>0.7</td>
                    <td>0.7</td>
                  </tr>
                  <tr class="even">
                    <td>Pidellite Industries</td>
                    <td>FMCG</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="odd">
                    <td>Repco Home Finance</td>
                    <td>Finance</td>
                    <td>0.9</td>
                    <td>0.8</td>
                  </tr>
                  <tr class="even">
                    <td>State Bank Of India</td>
                    <td>Banking</td>
                    <td>1</td>
                    <td>0.8</td>
                  </tr>
                  <tr class="odd">
                    <td>Stride Arcolab</td>
                    <td>Pharmaceuticals</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>Sun Pharmaceuticals Industries</td>
                    <td>Pharmaceuticals</td>
                    <td>1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="odd">
                    <td>Tata Motors</td>
                    <td>Automobile</td>
                    <td>0.9</td>
                    <td>0.7</td>
                  </tr>
                  <tr class="even">
                    <td>Tech Mahindra</td>
                    <td>IT</td>
                    <td>0.7</td>
                    <td>0.7</td>
                  </tr>
                  <tr class="odd">
                    <td>UltraTech Cement</td>
                    <td>Cement</td>
                    <td>1.1</td>
                    <td>1.1</td>
                  </tr>
                  <tr class="even">
                    <td>VA Tech Wabag</td>
                    <td>Water Treatment</td>
                    <td>1.1</td>
                    <td>1.2</td>
                  </tr>
                  <tr class="odd">
                    <td>Wabco India</td>
                    <td>Auto Ancillary</td>
                    <td>1.1</td>
                    <td>1.2</td>
                  </tr>
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="methodology" class="white PTB20">
      <div class="">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="title wow fadeInRight">
                <h2>Methodology</h2>
              </div>
            </div>
          </div>
          <div class="row" id="about_dtx30_sub">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-4">
              <img class="wow fadeIn img-responsive" data-wow-delay=".8s" src="public/images/methodology.jpg" alt="" title="" style="margin:0 auto;">
            </div>
            <div class="col-sm-7">
                <div class="methodology mCustomScrollbar">
                  <p><strong>Why DTX 30?</strong></p>
                  <p>While there is an instant need of creating a new index, the first and foremost question that would haunt the investors is: What is it so unique about DTX30? DTX30 is a combination of various weighing techniques. To start with, it gives equal weightage to all the constituents, however, going forward it would make alterations based on the different analytical parameters set by us. But the moot question is what is unique about this DTX30? In a nutshell, a company would form a part of our index only on the basis of merit and not because of its market cap.</p>

                  <p><strong>Weightage - Will That Change?</strong></p>
                  <p>We allot equal weightage to each stock, with the base being 1,000 and the base date, January 1, 2015. However, as a practice we would be regularly evaluating the performance of the stocks. Accordingly, the weightage in the index would change and hence the contribution of each company would also change. Reviews would be done on a monthly basis. In simple terms, a stock which is not performing well would eventually be out of the index, and only the performing ones would continue to be a part of it.</p>

                  <p><strong>Track Pad</strong></p>
                  <p>Tracking an index is important, involving a lot of factors like managing the different constituents. Besides a monthly review of our index companies, tracking would be done on daily basis as well. We would be providing a daily open, high, low and close. Events like, bonus, split, dividends, mergers, de-mergers and even spin-off of divisions would also be taken care of as and when they occur. While initially we would provide daily basis ticks. </p>

                  <p><strong>Fundamental Indices</strong></p>
                  <p>Fundamental indices, like market-cap-weighed indices, aim to give more weight to larger companies and smaller weight to smaller companies. Instead of using share prices as a guide, they use a "fundamental" value figure like sales, earnings, book value, dividends or cash flow.</p>

                  <p><strong>Equal Weighed Indices</strong></p>
                  <p>Equal-weighed indices simply allot an equal share of the index to each stock. For example, the S&P 500 Equal Weight Index, which has the same constituents as the traditional S&P 500, but with each stock making up 0.2% of the index.</p>
                  <p><strong>Adjustments Factors</strong></p>
                  <p>
                    <ul>
                      <li>Stock Split</li>
                      <li>Rights</li>
                      <li>Bonus Issues</li>
                      <li>Restructuring - Spin offs</li>
                      <li>QIP</li>
                      <li>ADR/GDR</li>
                      <li>Warrants</li>
                      <li>FCCBs</li>
                      <li>Buy Back </li>
                    </ul>
                  </p>
                </div>
            </div>
          </div>
        </div>
      </div> <!-- /.trans-bg -->
      <div style="clear:both"></div>
    </section>

    <section id="objectives" class="objectives_bkgrnd PTB20">
      <div class="">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="title wow fadeInRight">
                <h2>Objectives</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-4">
              <img class="wow fadeIn img-responsive" data-wow-delay=".8s" src="public/images/objectives.png" alt="" title="" style="margin:0 auto;">
            </div>
            <div class="col-sm-7">
                <div class="objectives mCustomScrollbar">
                  <p>The primary objective of our index creation is to bring out the actual worth of Indian companies to the investors. Our index would bring out the best performing company from a sector and not the one with a high market capitalisation but meek performance.</p>
                  <p>With more than 12 sectors being part of our index, our monthly review would also give performance highlights of sectors for our readers. As stated earlier, there would be reviews on the performance on a month on month (MoM) basis, eventually identifying a stock of the month and a sector of the month. Our index would consist only the best performing stocks, as a non-performer would get lower weightage and eventually be out of the index.</p>
                  <p><strong>What Investors Get?</strong></p>
                  <p>In equity markets, it is the returns generated that matters the most. With DTX30, we are confident of providing amazing returns even in a difficult macro-economic scenario. Having premised its technique on the performance of the company, we would not be surprised if our index delivers more than 1000 percent returns in the next three years.</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      <?php
if (!isset($_SESSION['_loggedIn'])) {
	?>
    <section class="registration norm-img" id="registration">
      <div class="">
        <div class="container subscribe_box">
          <div class="row">
            <div class="col-sm-12 text-center">
              <div class="title wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
                <h2>Register</h2>
              </div>
            </div>
          </div>
          <div id="registration_sub" class="row">
            <div class="PTB20">
              <div id="registration_sub" class="container subscribe_box">
                <div class="row">
                  <div class="col-sm-12">
                    <form method="POST" action="redirect" role="form" id="register-form" name="register-form" class="form-horizontal">
                      <input type="hidden" readonly="" value="' . $this-&gt;_pkgId . '" id="regPkgId" name="regPkgId">
                      <div class="col-sm-12">
                        <div class="form-group form-fields-width">
                          <p class="register-success">Your Message has been Successfully Sent!</p>
                          <p class="register-error">Error! Something went wrong!</p>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-fields-width">
                            <input type="text" required="required" id="regName" name="regName" placeholder="Name" class="form-control validate">
                        </div>
                        <div class="form-group form-fields-width">
                            <input type="email" required="required" id="regEmail" name="regEmail" placeholder="Email-ID" class="form-control validate">
                        </div>
                        <div class="form-group form-fields-width">
                            <input type="text" maxlength="10" id="regMobileNo" name="regMobileNo" placeholder="Mobile No (optional)" class="form-control validate">
                        </div>
                        <div class="form-group form-fields-width">
                          <div class="checkbox" style="color:#000000;" id="register_terms_container" onclick="removeErrorMsg(this);">
                            <label><input type="checkbox" class="validate" value="yes" name="t_c" id="t_c" checked="">I agree to the <a data-toggle="modal" href="#tc-pg">Terms &amp; Conditions</a></label>
                          </div>
                        </div>
                        <div class="form-group form-fields-width">
                          <input type="submit" value="Register" id="register" class="btn btn-block">
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
<?php
}
?>
<?php
require_once _CONST_VIEW_PATH . 'footer.php';
?>
  </body>
</html>
