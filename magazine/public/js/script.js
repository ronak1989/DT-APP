show_tab = "";
$(document).ready(function() {
	"use strict";


// ------------- Pre-loader--------------

// makes sure the whole site is loaded

$(window).load(function() {
    // will first fade out the loading animation
    $(".preloader").fadeOut();
    //then background color will fade out slowly
    $("#faceoff").delay(200).fadeOut("slow");
    if(window.location.hash=="#emagazine"){
      if(show_loginpopup==1){
        show_tab = "emagazine";
        load_popup(0);
      }else{

        var $scrollHeight = $(window).scrollTop();
        if ($scrollHeight > 500) {
          //$('#home').slideDown(400);
          $('#sticky_footer').slideDown(400);
        }else{
          //$('#home').slideUp(400);
          $('#sticky_footer').slideUp(400);
        }
        if(window.location.hash=='#emagazine')
          window.setTimeout(custom_scroll(window.location.hash,'-',30), 500);
      }
    }else{
      if(show_updateprofile==1){
        load_popup(1);
      }
    }

    $('.carousel-hp').carousel({
      interval: 6000,
      pause: "true"
    });
    var $item = $('.carousel-hp .item');
    var $deviceW = $(window).width();
    var $deviceH = $(window).height();
    var $mt = $("#home").height()+9;
    var $wHeight = $(window).height()-$mt;
    console.log($mt);
    $("#hp").css({'margin-top':$mt});
    if($deviceW>990){
      if(($wHeight+$mt) < $deviceH){
        var $diff = $deviceH -$mt-$wHeight;
        $("#hp").css({'padding-bottom':$diff/2});
      }
    }
    if($deviceW>990){
      var $wMiddleHeight = $wHeight/2;
      $('#samvat, #testimonial').height($wMiddleHeight);
      $item.height($wHeight);
    }else{
      var $wMiddleHeight = $wHeight/2;
      $('#samvat').height($wMiddleHeight);
      $('#testimonial').height(300);
      $item.height($deviceW);
    }

    if($deviceW>990){
      $item.addClass('full-screen-cover');
    }else{
      $item.addClass('full-screen-contain');
    }


    $('.carousel-hp img').each(function() {
      var $src = $(this).attr('src');
      var $color = $(this).attr('data-color');
      $(this).parent().css({
      'background-image' : 'url(' + $src + ')',
      'background-color' : '#4E4E50'
      });
      $(this).remove();
    });
});

//-------Appearence of navigation----------
if(load_js==1){
  $('header .nav').onePageNav({
    scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
    scrollOffset: 90 //Height of Navigation Bar
  });
}
  /*$('.download-block').onePageNav({
    scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
    scrollOffset: 90 //Height of Navigation Bar
  });
*/
  //var winWidth = $(window).width();
  if(load_js == 1){
  $(window).scroll(function() {
    //if (winWidth > 767) {
      var $scrollHeight = $(window).scrollTop();
      if ($scrollHeight > 500) {
        /*$('#home').slideDown(400);*/
        $('#sticky_footer').slideDown(400);
      }else{
       // $('#home').slideUp(400);
        $('#sticky_footer').slideUp(400);
      }
    //}

	//got o top
	  /*if ($(this).scrollTop() > 500) {
			$('#go-to-top a').fadeIn('slow');
      $('#sticky_login a').fadeIn('slow');

      $('#sticky_facebook a').fadeIn('slow');
      $('#sticky_twitter a').fadeIn('slow');
      $('#sticky_linkedin a').fadeIn('slow');
      $('#sticky_blogger a').fadeIn('slow');

		  } else {
			$('#go-to-top a').fadeOut('slow');
      $('#sticky_login a').fadeOut('slow');

      $('#sticky_facebook a').fadeOut('slow');
      $('#sticky_twitter a').fadeOut('slow');
      $('#sticky_linkedin a').fadeOut('slow');
      $('#sticky_blogger a').fadeOut('slow');

	  }*/
  });
}

  //-------scroll to top---------

 $('#go-to-top a').click(function(){
	$("html,body").animate({ scrollTop: 0 }, 750);
	return false;
  });

//--------------- SmoothSroll--------------------

var scrollAnimationTime = 1200,
    scrollAnimation = 'easeInOutExpo';
$('a.scrollto').bind('click.smoothscroll', function (event) {
    event.preventDefault();
    var target = this.hash;
    $('html, body').stop().animate({
        'scrollTop': $(target).offset().top
    }, scrollAnimationTime, scrollAnimation, function () {
        window.location.hash = target;
    });
});

// ------------- Owl Carousel--------------

 $("#owl-demo").owlCarousel({
  navigation : true,
  slideSpeed : 300,
  pagination: false,
  autoPlay: 5000,
  items : 4,
  });

//--------------- for navigation---------------------
if(load_js==1){
    $('.navbar-collapse ul li a').click(function() {
      $('.navbar-toggle:visible').click();
  });
}
 /* -----------------------------
Card Style Script
----------------------------- */
$(document).ready(function() {
  'use strict';
  if(load_js == 1){

    var $el       = $( '#card-ul' ),
      sectionFeature  = $('#sneak_preview'),
      baraja      = $el.baraja();
      var _device_width = $(window).width();
      if ( _device_width > 1250) {
        baraja.fanSettings.range = 100;
        baraja.fanSettings.direction = 'right';
        baraja.fanSettings.origin = { x : 50, y : 200 };
        sectionFeature.appear(function(){
          baraja.fan({
            speed : 1500,
            easing : 'ease-out',
            range : 100,
            direction : 'right',
            origin : { x : 50, y : 200 },
            center : true
          });

        });

      }else if(_device_width > 690){
        baraja.fanSettings.range = 100;
        baraja.fanSettings.direction = 'right';
        baraja.fanSettings.origin = { x : 50, y : 150 };
        baraja.fan({
            speed : 1500,
            easing : 'ease-out',
            range : 100,
            direction : 'right',
            origin : { x : 50, y : 150 },
            center : true
          });
      }else if(_device_width > 480){
        baraja.fanSettings.range = 100;
        baraja.fanSettings.direction = 'right';
        baraja.fanSettings.origin = { x : 50, y : 100 };
        baraja.fan({
            speed : 1500,
            easing : 'ease-out',
            range : 100,
            direction : 'right',
            origin : { x : 50, y : 100 },
            center : true
          });
      } else {
        sectionFeature.appear(function(){

          /*baraja.fan();*/
          /*baraja.fan({
            speed : 1500,
            easing : 'ease-out',
            range : 80,
            direction : 'left',
            origin : { x : 200, y : 50 },
            center : true
          });*/
        });

      }

    // Feature navigation
    $('#feature-prev').on( 'click', function( event ) {
      baraja.previous();
    });

    $('#feature-next').on( 'click', function( event ) {
      baraja.next();
    });

    // close Features
    $('#feature-close').on( 'click', function( event ) {
      baraja.close();
    });

    // close Features
  }

});

//-----------Text Slider on Banner-----------
if(load_js == 1){
   $('.flex_text').flexslider({
        animation: "slide",
    selector: ".slides li",
    controlNav: false,
    directionNav: false,
    slideshowSpeed: 4000,
    touch: true,
    useCSS: false,
    direction: "vertical",
        before: function(slider){
     var height = $('.flex_text').find('.flex-viewport').innerHeight();
     $('.flex_text').find('li').css({ height: height + 'px' });
        }
    });

   $('.slider').flexslider({
        animation: "slide",
    selector: ".slides li",
    controlNav: false,
    directionNav: false,
    slideshowSpeed: 10000,
    touch: true,
    useCSS: false,
    direction: "vertical",
        before: function(slider){
     var height = $('.slider').find('.flex-viewport').innerHeight();
     $('.slider').find('li').css({ height: height + 'px' });
        }
    });
}

// ----------initializing the wow.js ---------

    // Animate and WOW Animation
    var wow = new WOW(
        {
            //offset: 50,
            mobile: false
           // live: true
        }
    );
    wow.init();


});

function custom_reload(){
  window.location.hash = "#registration_sub";
  //window.location.href = window.location+'/#registration';
  window.location.reload(true);
}

function getPackage( pkgId ){
    $.ajax({
        url: 'verify',
        dataType: 'json',
        type: 'post',
        data: {pkgId:pkgId},
        success: function( response, textStatus, jQxhr ){
          if(response['data']=='redirect'){
            $("#subscribe-form input[name=loginPkgId]").val(pkgId);
            $('#subscribe-form').submit();
          }else{
            $('#registration').html( response['data'] );
          }
          setTimeout(function() {
            goToByScroll1("#registration");
          }, 0);

        },
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        }
    });
}

function validateEmail(sEmail) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

function validateMobile(phoneText) {
    var filter = /^[0-9- +]+$/;
    if (filter.test(phoneText)) {
        return true;
    }
    else {
        return false;
    }
}

function validateAlphanumeric(str){
    var filter = /^[\w\?\@\&\-\(\)\/\,\(\)\ \.\/\r\n]+$/;

    if (filter.test(str)) {
        return true;
    }
    else {
        return false;
    }
}

function addErrorMsg(element, err_msg){
  element.addClass('highlight-error');
  if(element.next('.error-msg').length==0)
    element.after("<span class='error-msg'>"+err_msg+"</span>");
}

function removeErrorMsg(element){
  if($(element).hasClass('highlight-error')){
    $(element).removeClass('highlight-error');
    $(element).next().remove();
  }
}

$(document).ready(function() {
  $( "#search_stock" ).autocomplete({
    source: "search-stock",
    minLength: 3,
    select: function( event, ui ) {
      $("#stock_ref_id").val(ui.item.id);
      $("#user_query").focus();
      /*log( ui.item ?
        "Selected: " + ui.item.value + " aka " + ui.item.id :
        "Nothing selected, input was " + this.value );*/
      console.log(ui);
    }
  });

  $( "#search_stock" ).focus(function() {
      $("#search_stock").val('');
      $("#stock_ref_id").val('');
  });

  $(document).on('focus',"input[type=text],input[type=password],input[type=email],textarea,select",function(e){
    removeErrorMsg(this);
  });
  $(document).on('change','#delivery_option',function(e){
      var option = $('#delivery_option:checked').val();
      if(option=='Postal'){
        $(".notes").html('**Indian Postal Service is responsible for all postal deliveries.');
      }else{
        $(".notes").html('**Courier charges will be extra');
      }
    }
  );
  $(document).on('click',"#forgotpassword, #changepassword, #register, #login, #subscribeorder, #signin, #signup, #askdt, #updateprofile",function(e) {
    e.preventDefault();
    e.stopPropagation();
    var error = 0;
    var clicked_id = this.id;
    if(this.id=='register'){
      $("#register-form .validate").each(function(){
        var input_val = $(this).val();
        if($(this).attr('name')=='regMobileNo'){
          if(input_val.length != 0 && validateMobile(input_val)==false || (input_val.length > 0 && input_val.length <10)){
            addErrorMsg($(this),'Invalid mobile no');
            error++;
            return;
          }
        }else if($(this).attr('name')=='t_c'){
		if($("#register-form #t_c").is(":checked")==false){
			 addErrorMsg($("#register_terms_container"),'Please accepts Terms & Conditions');
            		 error++;
           		 return;

		}
	}else{

          if(input_val.length == '0'){
            addErrorMsg($(this),'Cannot be blank');
            error++;
            return;
          }
          switch($(this).attr('type')){
            case "email":
              if(validateEmail(input_val)==false){
                addErrorMsg($(this),'Invalid Email-ID');
                error++;
              }
              break;
          }
        }
      });
      if(error==0){
        $("#"+clicked_id).prop('disabled', true);
        $(".register-success").hide();
        $(".register-error").hide();
        $.ajax({
          url: 'register',
          dataType: 'json',
          type: 'post',
          data: $('#register-form').serialize(),
          success: function( response, textStatus, jQxhr ){
            if(response['error']=='generic'){
              $(".register-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Something went wrong. Please try again!!</div>');
              $(".register-error").show();
            }else if(response['error']=='regEmail'){
              $(".register-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Email-Id is already registered.</div>');
              $(".register-error").show();
            }else if(response['data']=='redirect'){
              $('#register-form').submit();
            }else{
              goToByScroll("#registration");
              $('#registration').html( response['data'] );

            }
            $("#"+clicked_id).prop('disabled', false);
          },
          error: function( jqXhr, textStatus, errorThrown ){
            $("#"+clicked_id).prop('disabled', false);
          }
        });
      }
    }else if(this.id=='updateprofile'){

        $("#updateprofile-form .validate").each(function(){
          var input_val = $(this).val();
          if(input_val == '' && $(this).attr('name')!='regState'){
            addErrorMsg($(this),'Cannot be blank');
            error++;
            return;
          }
          if($(this).attr('name')=='regState'){
            if($( "#regState" ).val()==''){
               addErrorMsg($(this),'Please select State');
               error++;
            }
          }else if($(this).attr('name')=='regZip'){
            if(input_val.length != 0 && validateMobile(input_val)==false){
              addErrorMsg($(this),'Invalid pincode');
              error++;
              return;
            }
          }else if($(this).attr('name')=='regMobileNo'){
            if(input_val.length != 0 && validateMobile(input_val)==false || (input_val.length > 0 && input_val.length <10)){
              addErrorMsg($(this),'Invalid mobile no');
              error++;
              return;
            }
          }else{
            switch($(this).attr('type')){
              case "email":
                if(validateEmail(input_val)==false){
                  addErrorMsg($(this),'Invalid Email-ID');
                  error++;
                }
                break;
              default:
                if(validateAlphanumeric(input_val)==false){
                  addErrorMsg($(this),'Cannot have special characters');
                  error++;
                }
                break;
            }
          }
        });
        if(error==0){
          $(".updateprofile-success").hide();
          $(".updateprofile-error").hide();
          $("#"+clicked_id).prop('disabled', true);
          $.ajax({
            url: 'updateprofile',
            dataType: 'json',
            type: 'post',
            data: $('#updateprofile-form').serialize(),
            success: function( response, textStatus, jQxhr ){
              if(response['error']=='generic'){
                $(".updateprofile-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Something went wrong. Please try again!!</div>');
                $(".updateprofile-error").show();
              }else if(response['data']=='success'){
                //window.location.reload();
                $(".updateprofile-success").html( '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your Profile has been updated Successfully</div>' );
              $(".updateprofile-success").show();
              }
              $("#"+clicked_id).prop('disabled', false);
            },
            error: function( jqXhr, textStatus, errorThrown ){
              $("#"+clicked_id).prop('disabled', false);
            }
          });
        }

    }else if(this.id=='signup'){
      $("#signup-form .validate").each(function(){
        var input_val = $(this).val();
        if(input_val == '' && $(this).attr('name')!='regState'){
          addErrorMsg($(this),'Cannot be blank');
          error++;
          return;
        }
        if($(this).attr('name')=='regState'){
          if($( "#regState" ).val()==''){
             addErrorMsg($(this),'Please select State');
             error++;
          }
        }else if($(this).attr('name')=='regZip'){
          if(input_val.length != 0 && validateMobile(input_val)==false){
            addErrorMsg($(this),'Invalid pincode');
            error++;
            return;
          }
        }else if($(this).attr('name')=='regMobileNo'){
          if(input_val.length != 0 && validateMobile(input_val)==false || (input_val.length > 0 && input_val.length <10)){
            addErrorMsg($(this),'Invalid mobile no');
            error++;
            return;
          }
        }else if($(this).attr('name')=='t_c'){
          if($("#signup-form #t_c").is(":checked") == false){
             addErrorMsg($("#term_condition_container"),'Please accepts Terms & Conditions');
             error++;
             return;
          }
        }else{
          switch($(this).attr('type')){
            case "email":
              if(validateEmail(input_val)==false){
                addErrorMsg($(this),'Invalid Email-ID');
                error++;
              }
              break;
            default:
              if(validateAlphanumeric(input_val)==false){
                addErrorMsg($(this),'Cannot have special characters');
                error++;
              }
              break;
          }
        }
      });
      if(error==0){
        $(".signup-success").hide();
        $(".signup-error").hide();
        $("#"+clicked_id).prop('disabled', true);
        $.ajax({
          url: 'signup',
          dataType: 'json',
          type: 'post',
          data: $('#signup-form').serialize(),
          success: function( response, textStatus, jQxhr ){
            if(response['error']=='generic'){
              $(".signup-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Something went wrong. Please try again!!</div>');
              $(".signup-error").show();
            }else if(response['error']=='regEmail'){
              $(".signup-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Email-Id is already registered.</div>');
              $(".signup-error").show();
            }else if(response['data']=='redirect'){
              //window.location.reload();
$('#sign-up').html('<div style=\'padding:50px 20px 0px\'><p>Your Dalal Times account password will be sent to the registered Email-ID</p></div><div style=\'text-align:center;padding-bottom:50px;\'>You will be redirected in <span id=\'redirect_cntr\'>5</span> secs</div>');
console.log($('#redirect_cntr').html());
setInterval(function () {
  var cntr = parseInt($('#redirect_cntr').html());
   cntr = cntr-1;
  $('#redirect_cntr').html(cntr);
  if(cntr==0){
    window.location.reload();
  }

}, 1000);
            }
            $("#"+clicked_id).prop('disabled', false);
          },
          error: function( jqXhr, textStatus, errorThrown ){
            $("#"+clicked_id).prop('disabled', false);
          }
        });
      }
    }else if(this.id=='signin'){
      $("#signin-form .validate").each(function(){
        var input_val = $(this).val();
        if(input_val.length == '0'){
          addErrorMsg($(this),'Cannot be blank');
          return;
        }
        switch($(this).attr('type')){
          case "email":
            if(validateEmail(input_val)==false){
              addErrorMsg($(this),'Invalid Email-ID');
              error++;
            }
            break;
          case "password":
            break;
          default:
            if(validateAlphanumeric(input_val)==false){
              addErrorMsg($(this),'Cannot have special characters');
              error++;
            }
            break;
        }
      });
      if(error==0){
        $("#"+clicked_id).prop('disabled', true);
        $.ajax({
            url: 'signin',
            dataType: 'json',
            type: 'post',
            data: $('#signin-form').serialize(),
            success: function( response, textStatus, jQxhr ){
              if(response['error']=='generic'){
                $(".signin-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Invalid User-Id or Password!!</div>');
                $(".signin-error").show();
              }else if(response['data']=='redirect'){
		if(show_tab!=""){
                  window.location.hash = show_tab;
                }
                window.location.reload();
              }
              $("#"+clicked_id).prop('disabled', false);
            },
            error: function( jqXhr, textStatus, errorThrown ){
              $("#"+clicked_id).prop('disabled', false);
            }
        });
      }
    }else if(this.id=='login'){
      $("#login-form .validate").each(function(){
        var input_val = $(this).val();
        if(input_val.length == '0'){
          addErrorMsg($(this),'Cannot be blank');
          return;
        }
        switch($(this).attr('type')){
          case "email":
            if(validateEmail(input_val)==false){
              addErrorMsg($(this),'Invalid Email-ID');
              error++;
            }
            break;
          default:
            if(validateAlphanumeric(input_val)==false){
              addErrorMsg($(this),'Cannot have special characters');
              error++;
            }
            break;
        }
      });
      if(error==0){
        $("#"+clicked_id).prop('disabled', true);
        $.ajax({
            url: 'login',
            dataType: 'json',
            type: 'post',
            data: $('#login-form').serialize(),
            success: function( response, textStatus, jQxhr ){

              if(response['error']=='generic'){
                $(".login-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Invalid User-Id or Password!!</div>');
                $(".login-error").show();
              }else if(response['data']=='redirect'){
                $('#login-form').submit();
              }else{
                goToByScroll("#registration");
                $('#registration').html( response['data'] );

              }
              $("#"+clicked_id).prop('disabled', false);
            },
            error: function( jqXhr, textStatus, errorThrown ){
              $("#"+clicked_id).prop('disabled', false);
            }
        });
      }
    }else if(this.id=='forgotpassword'){
      $(".forgotpassword-error").hide();
      $(".forgotpassword-success").hide();
      $("#forgotpassword-form .validate").each(function(){
        var input_val = $(this).val();
        if(input_val.length == '0'){
          addErrorMsg($(this),'Cannot be blank');
          error++;
          return;
        }
        switch($(this).attr('type')){
          case "email":
            if(validateEmail(input_val)==false){
              addErrorMsg($(this),'Invalid Email-ID');
              error++;
            }
            break;
        }
      });
      if(error==0){
        $("#"+clicked_id).prop('disabled', true);
        $.ajax({
          url: 'forgot-password',
          dataType: 'json',
          type: 'post',
          data: $('#forgotpassword-form').serialize(),
          success: function( response, textStatus, jQxhr ){
            if(response['error']=='sys'){
              $(".forgotpassword-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Something went wrong. Please try again!!</div>');
              $(".forgotpassword-error").show();
            }else if(response['error']=='generic'){
              $(".forgotpassword-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> This Email-Id has not been registered with Dalaltimes.com</div>');
              $(".forgotpassword-error").show();
            }else if(response['data']=='success'){
              $(".forgotpassword-success").html( '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Request you to check your registered Email ID for your new computer generated password.</div>' );
              $(".forgotpassword-success").show();
            }
            $("#"+clicked_id).prop('disabled', false);
          },
          error: function( jqXhr, textStatus, errorThrown ){
            $("#"+clicked_id).prop('disabled', false);
          }
        });
      }
    }else if(this.id=='changepassword'){
      $(".changepassword-error").hide();
      $(".changepassword-success").hide();
      $("#changepassword-form .validate").each(function(){
        var input_val = $(this).val();
        if(input_val.length == '0'){
          addErrorMsg($(this),'Cannot be blank');
          error++;
          return;
        }
        switch($(this).attr('type')){
          case "email":
            if(validateEmail(input_val)==false){
              addErrorMsg($(this),'Invalid Email-ID');
              error++;
            }
            break;
        }
      });
      if($('#chngNewPassword').val()!=$('#chngCnfrmNewPassword').val()){
        addErrorMsg($('#chngCnfrmNewPassword'),'Your new password & confirm new password should match');
        addErrorMsg($('#chngNewPassword'),'');
        error++;
        return;
      }
      if(error==0){
        $("#"+clicked_id).prop('disabled', true);
        $.ajax({
          url: 'change-password',
          dataType: 'json',
          type: 'post',
          data: $('#changepassword-form').serialize(),
          success: function( response, textStatus, jQxhr ){
            if(response['error']=='generic' || response['error']=='sys'){
              $(".changepassword-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Something went wrong. Please try again!!</div>');
              $(".changepassword-error").show();
            }else if(response['error']=='mismatch'){
              addErrorMsg($('#chngCnfrmNewPassword'),'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your new password & confirm new password should match</div>');
              addErrorMsg($('#chngNewPassword'),'');
            }else if(response['error']=='orig-mismatch'){
              $(".changepassword-error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Old password provided is invalid!!</div>');
              $(".changepassword-error").show();
            }else{
              $(".changepassword-success").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your password has been successfully changed.</div>');
              $(".changepassword-success").show();
            }
            $("#"+clicked_id).prop('disabled', false);
          },
          error: function( jqXhr, textStatus, errorThrown ){
            $("#"+clicked_id).prop('disabled', false);
          }
        });
      }
    }else if(this.id=='subscribeorder'){
      $("#subscribeorder-form .validate").each(function(){
        var input_val = $(this).val();
        if(input_val == '' && $(this).attr('name')!='billing_state'){
          addErrorMsg($(this),'Cannot be blank');
          error++;
          return;
        }
        if($(this).attr('name')=='billing_state'){
          if($( "#billing_state" ).val()==''){
             addErrorMsg($(this),'Please select State');
             error++;
          }
        }else if($(this).attr('name')=='billing_zip'){
          if(input_val.length != 0 && validateMobile(input_val)==false){
            addErrorMsg($(this),'Invalid pincode');
            error++;
            return;
          }
        }else if($(this).attr('name')=='billing_tel'){
          if(input_val.length != 0 && validateMobile(input_val)==false || (input_val.length > 0 && input_val.length <10)){
            addErrorMsg($(this),'Invalid Mobile No');
            error++;
            return;
          }
        }else{
          switch($(this).attr('type')){
            case "email":
              if(validateEmail(input_val)==false){
                addErrorMsg($(this),'Invalid Email-ID');
                error++;
              }
              break;
            default:
              if(validateAlphanumeric(input_val)==false){
                addErrorMsg($(this),'Cannot have special characters');
                error++;
              }
              break;
          }
        }
      });
	 if(error==0){
                $("#subscribeorder-form").submit();
        }

    }else if(this.id=='askdt'){
      $(".askdt-error").hide();
      $(".askdt-success").hide();
      $("#askdt-form .validate").each(function(){
        var input_val = $(this).val();
        if(input_val.length == '0' && $(this).attr('name')!='billing_state' && $(this).attr('name')!='billing_tel'){
          addErrorMsg($(this),'Cannot be blank');
          error++;
          return;
        }
        if($(this).attr('name')=='billing_state'){
          if($( "#billing_state" ).val()==''){
             addErrorMsg($(this),'Please select State');
             error++;
          }
        }else if($(this).attr('name')=='delivery_zip'){
          if(input_val.length != 0 && validateMobile(input_val)==false){
            addErrorMsg($(this),'Invalid pincode');
            error++;
            return;
          }
        }else if($(this).attr('name')=='billing_tel'){
          if(input_val.length != 0 && validateMobile(input_val)==false || (input_val.length > 0 && input_val.length <10)){
            addErrorMsg($(this),'Invalid Mobile No');
            error++;
            return;
          }
        }else{
          switch($(this).attr('type')){
            case "email":
              if(validateEmail(input_val)==false){
                addErrorMsg($(this),'Invalid Email-ID');
                error++;
              }
              break;
            default:
              if(validateAlphanumeric(input_val)==false){
                addErrorMsg($(this),'Cannot have special characters');
                error++;
              }
              break;
          }
        }
      });
      if(error==0){
        $.ajax({
          url: 'ask-dt',
          dataType: 'json',
          type: 'post',
          data: $('#askdt-form').serialize(),
          success: function( response, textStatus, jQxhr ){
            if(response['error']=='generic' || response['error']=='sys'){
              $(".askdt-error").html('<div class="alert alert-error"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong. Please try again!!</div>');
              $(".askdt-error").show();
            }else{
              $(".askdt-success").html('<div class="col-sm-12 text-center"><span class="sub-head">Thank You for sending us your query.<br>Our team will surely get back to you with answers!</span></div>');
              $(".askdt-success").show();
              $("#ask-dt-success").hide();
            }
            $("#"+clicked_id).prop('disabled', false);
          },
          error: function( jqXhr, textStatus, errorThrown ){
            $("#"+clicked_id).prop('disabled', false);
          }
        });
      }
    }

  });
});

$(document).ready(function() {
	if($(window).width() > 600){
      $('.dummy').roundabout({
         autoplay: false,
         autoplayDuration: 1000,
         autoplayPauseOnHover: false,
         minScale: 1.0,
          maxScale: 1.0,
      });
	}else{
	$(".dummy").css({"width":"60%","margin":"0 auto"});
	}
});

$(document).ready(function(){
    setupRotator();
    $("#settings").click(function(){
        $("#user-option").modal();
    });
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
     switch(e.currentTarget.hash){
      case "#forgot-password":
        $(".forgotpassword-success").hide();
        $(".forgotpassword-error").hide();
        removeErrorMsg("#forgotEmailId");
        $("#forgotEmailId").val("");
        break;
      case "#sign-in":
        $(".signin-success").hide();
        $(".signin-error").hide();
        removeErrorMsg("#loginEmail");
        removeErrorMsg("#loginPassword");
        $("#loginEmail").val("");
        $("#loginPassword").val("");
        break;
      case "#sign-up":
        $(".signup-success").hide();
        $(".signup-error").hide();
        removeErrorMsg("#regName");
        removeErrorMsg("#regEmail");
        removeErrorMsg("#regMobileNo");
        $("#regName").val("");
        $("#regEmail").val("");
        $("#regMobileNo").val("");
        break;
     }
    });
    $(".download-block > li > a").click(function(e) {
          // Prevent a page reload when a link is pressed
        e.preventDefault();
          // Call the scroll function
        goToByScroll($(this).attr("href"));
    });

    if(window.location.hash=="#registration_sub"){
      var $scrollHeight = $(window).scrollTop();
      if ($scrollHeight > 500) {
        //$('#home').slideDown(400);
        $('#sticky_footer').slideDown(400);
      }else{
        //$('#home').slideUp(400);
        $('#sticky_footer').slideUp(400);
      }
      $('.navbar-collapse ul li a').each(function(e) {
          if($(this).attr('href') == window.location.hash){
            $(this).parent().addClass('current');
            if(window.location.hash=='#registration_sub')
              custom_scroll(window.location.hash,'+',40);
          }
      });
    }


});


var fullScreenHome = function() {
    $('.carousel-hp').carousel({
      interval: 6000,
      pause: "true"
    });
    var $item = $('.carousel-hp .item');
    var $deviceW = $(window).width();
    var $deviceH = $(window).height();
    var $mt = $("#home").height()+9;
    var $wHeight = $(window).height()-$mt;
    console.log($mt);
    $("#hp").css({'margin-top':$mt});
    if($deviceW>990){
      if(($wHeight+$mt) < $deviceH){
        var $diff = $deviceH -$mt-$wHeight;
        $("#hp").css({'padding-bottom':$diff/2});
      }
    }
    if($deviceW>990){
      var $wMiddleHeight = $wHeight/2;
      $('#samvat, #testimonial').height($wMiddleHeight);
      $item.height($wHeight);
    }else{
      var $wMiddleHeight = $wHeight/2;
      $('#samvat').height($wMiddleHeight);
      $('#testimonial').height(300);
      $item.height($deviceW);
    }

    if($deviceW>990){
      $item.addClass('full-screen-cover');
    }else{
      $item.addClass('full-screen-contain');
    }


    $('.carousel-hp img').each(function() {
      var $src = $(this).attr('src');
      var $color = $(this).attr('data-color');
      $(this).parent().css({
      'background-image' : 'url(' + $src + ')',
      'background-color' : '#4E4E50'
      });
      $(this).remove();
    });
    if(matchMedia( "(min-width: 992px) and (min-height: 500px)" ).matches) {
      "use strict"; //RUN JS IN STRICT MODE
    var height = $(window).height();
      contH = $(".banner .col-sm-12").height(),
      contH = $(".banner-carousel .col-sm-12").height(),
      contMT = (height / 2) - (contH / 2);
    $(".banner-carousel").css('min-height', height + "px");
    $(".trans-bg").css('min-height', height + "px");
    //$(".banner .col-sm-12").css('margin-top', (contMT - 270) + "px");
    $(".banner-carousel .col-sm-12").css('margin-top', (contMT - 10) + "px");
  }
}

$(document).ready(fullScreenHome);
$(window).resize(fullScreenHome);

function load_popup(cnt){
  $("#user-option").modal();
  $('#settings-tab li a').eq(cnt).tab('show');

}

function custom_scroll(id,type,val){
  id = id.replace("#", "");
      // Scroll
    if(type=='-'){
      $('html,body').animate({
        scrollTop: $("#"+id).offset().top-val},
        'slow');
    }else{
      $('html,body').animate({
        scrollTop: $("#"+id).offset().top+val},
        'slow');
    }


}

function goToByScroll(id){
      // Reove "link" from the ID
    id = id.replace("#", "");
      // Scroll
    if(id=="sneak_preview_sub"){
      $('html,body').animate({
        scrollTop: $("#"+id).offset().top+-90},
        'slow');
    }else{
      $('html,body').animate({
        scrollTop: $("#"+id).offset().top+30},
        'slow');
    }

}

function goToByScroll1(id){
      // Reove "link" from the ID
    id = id.replace("#", "");
      // Scroll
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top-70},
        'slow');
}

function setupRotator()
{
   if($('.textitem').length > 1)
   {
       $('.textitem:first').addClass('current').fadeIn(1000);
       setInterval('textRotate()', 10000);
   }
}

function textRotate()
{
  var current = $('#testimonial > .current');
  if(current.next().length == 0)
  {
    current.removeClass('current').fadeOut(500);
    $('.textitem:first').addClass('current').fadeIn(5000);
  }
  else
  {
    current.removeClass('current').fadeOut(500);
    current.next().addClass('current').fadeIn(5000);
  }
}
