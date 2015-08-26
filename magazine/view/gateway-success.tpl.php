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
$type = ($this->_data['order_details'][0]['type'] == 'digital') ? 'eMagazine' : 'Magazine';
?>

    <!-- About Dalaltimes Magazine start -->
    <section id="error" class="intro white">
      <div class="container" >
        <div class="row" style="min-height: 500px;">
          <div style="">
            <div class="col-sm-12 text-center">
              <div class="title wow fadeInRight">
                <h2>Thank You For Subscribing!</h2>
                <div class="sub-ty-wrap">
                  <h3 class="sub-ty-h3">Order Summary:</h3>
                  <div class="sub-ty-sep"></div>
                  <h4 class="sub-ty-h4">Delivery Address:</h4>
                  <div class="sub-ty-text"><span>Name:<?php echo $this->_data['order_details'][0]['delivery_name'];?></span></div>
                  <div class="sub-ty-text"><span>Address:<?php echo $this->_data['order_details'][0]['delivery_address'];?></span></div>
                  <div class="sub-ty-text"><span>State<?php echo $this->_data['order_details'][0]['delivery_state'];?>, City,:<?php echo $this->_data['order_details'][0]['delivery_city'];?></span>,</div>
                  <div class="sub-ty-text"><span>Pincode:<?php echo $this->_data['order_details'][0]['delivery_zip'];?></span></div>
                  <div class="sub-ty-text"><span>Mobile No.:<?php echo $this->_data['order_details'][0]['delivery_telephone'];?></span></div>

                  <div class="sub-ty-sep"></div>
                  <h4 class="sub-ty-h4">Subscription Details:</h4>
                  <div class="sub-ty-text"><span>Type:</span><?php echo $this->_data['order_details'][0]['no_of_months'];?> Months <?php echo $type;?></div>
                  <div class="sub-ty-text"><span>Subscribed On:</span><?php echo $this->_data['order_details'][0]['created_date'];?></div>
                  <div class="sub-ty-text"><span>Delivery:</span><?php echo $this->_data['order_details'][0]['delivery_method'];?></div>

                  <div class="sub-ty-sep"></div>
                  <h4 class="sub-ty-h4">Order ID : <?php echo $this->_data['order_details'][0]['order_id'];?></h4>
                  <h4 class="sub-ty-h4">Payment Transaction: <span>Details from CC Avenue</span></h4>
                  <div class="sub-ty-text"><span>Order Date:</span><?php echo $this->_data['order_details'][0]['created_date'];?> UTC</div>
                  <div class="sub-ty-text"><span>CCAvenue Reference #:</span><?php echo $this->_data['order_details'][0]['tracking_id'];?></div>
                  <!--<div class="sub-ty-text"><span>Customer IP:</span>117.207.10.128</div>-->
                  <div class="sub-ty-text"><span>Pay Mode:</span><?php echo $this->_data['order_details'][0]['payment_mode'];?> - <?php echo $this->_data['order_details'][0]['card_name'];?></div>
                  <div class="sub-ty-text"><span>Bank Ref #:</span><?php echo $this->_data['order_details'][0]['bank_ref_no'];?></div>

                  <div class="sub-ty-sep"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Dalaltimes Magazine end -->

<?php
require_once _CONST_VIEW_PATH . 'footer.php';
?>
  </body>
</html>
