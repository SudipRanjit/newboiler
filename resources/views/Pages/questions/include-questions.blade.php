
@php define ('WEBIFI_NEW_BOILER_IMAGE_PATH', asset('assets/questions').'/')  @endphp


@include('pages.questions.question-1')
@include('pages.questions.question-2')
@include('pages.questions.question-2a')
@include('pages.questions.question-2b')
@include('pages.questions.question-3')
@include('pages.questions.question-4')
@include('pages.questions.question-4a')
@include('pages.questions.question-4a1')
@include('pages.questions.question-4b')
@include('pages.questions.question-5')
@include('pages.questions.question-5a')
@include('pages.questions.question-5b')
@include('pages.questions.question-5c')
@include('pages.questions.question-6')
@include('pages.questions.question-7')
@include('pages.questions.question-7a')
@include('pages.questions.question-8')
@include('pages.questions.question-8a')
@include('pages.questions.question-8b')
@include('pages.questions.question-8c')
@include('pages.questions.question-9')
@include('pages.questions.question-10')
@include('pages.questions.question-10a')
@include('pages.questions.question-10b')
@include('pages.questions.question-10c')
@include('pages.questions.question-10d')
@include('pages.questions.question-10e')
@include('pages.questions.question-10f')
@include('pages.questions.question-10g')
@include('pages.questions.postal-code')
@include('pages.questions.contact-us')

@section('custom-scripts')
{{--
<script>
    
    $('.question-wrapper').hide();

    var selectedBoiler = "";
    var screenWidth = 0;
    var postalCode = "";
    var nextWidth = 0;
    var progress = 1.0;
    var apiBase = "https://new-boiler.gasking.co.uk/api/";
    var totalPrice = 0;
    var controlPrice = 0;
    var combi_convert_price = 900;
    var combi_convert = false;
    var same_room_price = 500;
    var same_room = false;
    var utility_room_price = 700;
    var utility_room = false;
    var kitchen_price = 700;
    var kitchen = false;
    var garage_price = 700;
    var garage = false;
    var airing_cupboard_price = 700;
    var airing_cupboard = false;
    var bedroom_price = 700;
    var bedroom = false;
    var loft_attic_price = 1000;
    var loft_attic = false;
    var answers = {
      current: "question__1",
      question1: {
        option: "",
        optionTxt: ""
      },
      question2: {
        option: "",
        optionTxt: ""
      },
      question2a: {
        option: "",
        optionTxt: ""
      },
      question2b: {
        option: "",
        optionTxt: ""
      },
      question3: {
        option: "",
        optionTxt: ""
      },
      question4: {
        option: "",
        optionTxt: ""
      },
      question4a: {
        option: "",
        optionTxt: ""
      },
      question4a1: {
        option: "",
        optionTxt: ""
      },
      question4b: {
        option: "",
        optionTxt: ""
      },
      question5: {
        option: "",
        optionTxt: ""
      },
      question5a: {
        option: "",
        optionTxt: ""
      },
      question5b: {
        option: "",
        optionTxt: ""
      },
      question5c: {
        option: "",
        optionTxt: ""
      },
      question6: {
        option: "",
        optionTxt: ""
      },
      question7: {
        option: "",
        optionTxt: ""
      },
      question7a: {
        option: "",
        optionTxt: ""
      },
      question8: {
        option: "",
        optionTxt: ""
      },
      question8a: {
        option: "",
        optionTxt: ""
      },
      question8b: {
        option: "",
        optionTxt: ""
      },
      question8c: {
        option: "",
        optionTxt: ""
      },
      question9: {
        option: "",
        optionTxt: ""
      },
      question10: {
        option: "",
        optionTxt: ""
      },
      question10a: {
        option: "",
        optionTxt: ""
      },
      question10b: {
        option: "",
        optionTxt: ""
      },
      question10c: {
        option: "",
        optionTxt: ""
      },
      question10d: {
        option: "",
        optionTxt: ""
      },
      question10e: {
        option: "",
        optionTxt: ""
      },
      question10f: {
        option: "",
        optionTxt: ""
      },
      question10g: {
        option: "",
        optionTxt: ""
      }
    };

    jQuery(document).ready(function() {
      screenWidth = jQuery(window).width();
      jQuery(".option-image").css("height", "150px");
  
      jQuery(".info__icon").click(function(event) {
        event.preventDefault();
        jQuery(this).children(".option-info").show();
  
      });
  
      jQuery(".option-wrapper").on({
        'mouseenter': function() {
          var self = this;
          jQuery(self).append("<div class='select'>Select</div>");
          jQuery(".select").show();
          if (jQuery(self).find(".option-info").length > 0) {
            jQuery(self).find(".option-info").show();
            jQuery(self).find(".option-image").animate({
              height: '30px'
            }, 200);
            jQuery(self).find(".option-title").animate({
              paddingTop: '20px'
            }, 10);
          }
        },
        'mouseleave': function() {
          jQuery(".option-info").hide();
          jQuery(".option-image").animate({
            height: '150px'
          }, 200);
          jQuery(".option-title").animate({
            paddingTop: '40px'
          }, 10);
          jQuery(".select").remove();
          jQuery(self).dequeue();
          jQuery(".option-info").dequeue();
          jQuery(".option-image").dequeue();
  
        }
      });
  
      jQuery(".info__line").click(function() {
        var box__name = jQuery(this).attr('id');
        jQuery("#" + box__name + "_wrapper").show();
        jQuery("#" + box__name + "_wrapper").animate({
          right: '0'
        }, 400);
        jQuery("#" + box__name + "_wrapper").children(".close__btn_wrapper").animate({
          right: '30px'
        }, 400);
        nextWidth = 30 - jQuery("#" + box__name + "_wrapper").width();
        jQuery(".background__wrapper").fadeIn(300);
      });
  
      jQuery(".background__wrapper").click(function() {
        jQuery(".background__wrapper").fadeOut(300);
        jQuery(".info__wrapper").animate({
          right: '-42%'
        }, 400);
        jQuery(".close__btn_wrapper").each(function(i, obj) {
          jQuery(this).animate({
            right: nextWidth
          }, 400);
        });
        jQuery(".info__wrapper").fadeOut(200);
        jQuery(".background__wrapper").dequeue();
        jQuery(".info__wrapper").dequeue();
        jQuery(".close__btn_wrapper").dequeue();
      });
  
      jQuery(".close__btn").click(function() {
        jQuery(".background__wrapper").fadeOut(300);
        jQuery(".info__wrapper").animate({
          right: '-42%'
        }, 400);
        jQuery(".close__btn_wrapper").each(function(i, obj) {
          jQuery(this).animate({
            right: nextWidth
          }, 400);
        });
        jQuery(".info__wrapper").fadeOut(200);
        jQuery(".background__wrapper").dequeue();
        jQuery(".info__wrapper").dequeue();
        jQuery(".close__btn_wrapper").dequeue();
      });
  
      
      jQuery("#show__products_old").click(function() {
        jQuery(".loader").show();
        postalCode = jQuery("#postal_code").val();
        if (postalCode !== "") {
          jQuery(".selected_beds").html(answers.question6.optionTxt);
          jQuery(".selected_baths").html(answers.question7.optionTxt);
          jQuery(".selected_showers").html(answers.question8.optionTxt);
          jQuery("#postal__code").fadeOut(0);
          jQuery("#products").fadeIn(400);
          jQuery(".progress-bar").hide();
  
          var current_boiler_type = "";
  
          if (answers.question2.option === "q2o1")
            current_boiler_type = "Combi";
          else if (answers.question2.option === "q2o2")
            current_boiler_type = "System";
          else
            current_boiler_type = "Standard";
  
          jQuery(".current__boiler_type").html(current_boiler_type);
  
          if (answers.question2a.option === "q2ao1"){
            jQuery(".conversion__charge").html("£900");
            totalPrice += 900;
          }else{
            jQuery(".conversion__charge_box").hide();
          }
  
          if (same_room) {
            jQuery(".moving__boiler_room").html("Same room - £" + same_room_price);
            totalPrice += same_room_price;
          } else if (utility_room) {
            jQuery(".moving__boiler_room").html("Utility room - £" + utility_room_price);
            totalPrice += utility_room_price;
          } else if (kitchen) {
            totalPrice += kitchen_price;
            jQuery(".moving__boiler_room").html("Kitchen - £" + kitchen_price);
          } else if (garage) {
            totalPrice += garage_price;
            jQuery(".moving__boiler_room").html("Garage - £" + garage_price);
          } else if (airing_cupboard) {
            totalPrice += airing_cupboard_price;
            jQuery(".moving__boiler_room").html("Airing Cupboard - £" + airing_cupboard_price);
          } else if (bedroom) {
            totalPrice += bedroom_price;
            jQuery(".moving__boiler_room").html("Bedroom - £" + bedroom_price);
          } else if (loft_attic) {
            totalPrice += loft_attic_price;
            jQuery(".moving__boiler_room").html("Loft or Attic - £" + loft_attic_price);
          } else {
            jQuery(".moving__boiler").hide();
          }
  
          listProductsFromAPI();
        }
      });
  
      jQuery(".info__line_edit").click(function() {
        jQuery("#products__info_wrapper").show();
        jQuery("#products__info_wrapper").animate({
          right: '0'
        }, 400);
        jQuery("#products__info_wrapper").children(".close__btn_wrapper").animate({
          right: '30px'
        }, 400);
        nextWidth = 30 - jQuery("#products__info_wrapper").width();
        jQuery(".background__wrapper").fadeIn(300);
        jQuery(".loader").hide();
      });
  
      jQuery(".back__products_btn").click(function() {
        jQuery("#products").fadeIn(0);
        jQuery("#controls").fadeOut(0);
        jQuery("#calendar__box").fadeOut(0);
        jQuery("#step-2").removeClass("step__active");
        jQuery("#step-1").addClass("step__active");
        listProductsFromAPI();
        jQuery(".loader").hide();
      });
  
      jQuery(".reload__btn").click(function() {
        jQuery("#products").fadeOut(0);
        jQuery("#controls").fadeOut(0);
        jQuery("#calendar__box").fadeOut(0);
        jQuery("#question__1").fadeIn(400);
        jQuery(".progress-bar").show();
  
        nextWidth = 0;
        progress = 1.0;
        jQuery(".progress-bar").css("transform", "scaleX(" + progress.toString() + ")");
        answers = {
          current: "question__1",
          question1: {
            option: "",
            optionTxt: ""
          },
          question2: {
            option: "",
            optionTxt: ""
          },
          question2a: {
            option: "",
            optionTxt: ""
          },
          question2b: {
            option: "",
            optionTxt: ""
          },
          question3: {
            option: "",
            optionTxt: ""
          },
          question4: {
            option: "",
            optionTxt: ""
          },
          question4a: {
            option: "",
            optionTxt: ""
          },
          question4a1: {
            option: "",
            optionTxt: ""
          },
          question4b: {
            option: "",
            optionTxt: ""
          },
          question5: {
            option: "",
            optionTxt: ""
          },
          question5a: {
            option: "",
            optionTxt: ""
          },
          question5b: {
            option: "",
            optionTxt: ""
          },
          question5c: {
            option: "",
            optionTxt: ""
          },
          question6: {
            option: "",
            optionTxt: ""
          },
          question7: {
            option: "",
            optionTxt: ""
          },
          question7a: {
            option: "",
            optionTxt: ""
          },
          question8: {
            option: "",
            optionTxt: ""
          },
          question8a: {
            option: "",
            optionTxt: ""
          },
          question8b: {
            option: "",
            optionTxt: ""
          },
          question8c: {
            option: "",
            optionTxt: ""
          },
          question9: {
            option: "",
            optionTxt: ""
          },
          question10: {
            option: "",
            optionTxt: ""
          },
          question10a: {
            option: "",
            optionTxt: ""
          },
          question10b: {
            option: "",
            optionTxt: ""
          },
          question10c: {
            option: "",
            optionTxt: ""
          },
          question10d: {
            option: "",
            optionTxt: ""
          },
          question10e: {
            option: "",
            optionTxt: ""
          },
          question10f: {
            option: "",
            optionTxt: ""
          },
          question10g: {
            option: "",
            optionTxt: ""
          }
        };
      });
  
      /*****************/
      jQuery("#bed_minus").click(function() {
        var beds = parseInt(answers.question6.optionTxt);
        if (beds > 1) {
          beds--;
          answers.question6.optionTxt = beds.toString();
          jQuery("#bed_plus").css("color", "#1c3157CA");
          jQuery(".selected_beds").html(answers.question6.optionTxt);
          listProductsFromAPI();
        } else {
          jQuery("#bed_minus").css("color", "#CCCCCC");
          jQuery(".selected_beds").html(answers.question6.optionTxt);
          listProductsFromAPI();
        }
      });
  
      jQuery("#bed_plus").click(function() {
        var beds = parseInt(answers.question6.optionTxt);
        if (beds < 6) {
          beds++;
          answers.question6.optionTxt = beds.toString();
          jQuery("#bed_minus").css("color", "#1c3157CA");
          jQuery(".selected_beds").html(answers.question6.optionTxt);
          listProductsFromAPI();
        } else {
          answers.question6.optionTxt = "6+";
          jQuery("#bed_plus").css("color", "#CCCCCC");
          jQuery(".selected_beds").html(answers.question6.optionTxt);
          listProductsFromAPI();
        }
      });
  
      jQuery("#bath_minus").click(function() {
        var beds = parseInt(answers.question7.optionTxt);
        if (beds > 0) {
          beds--;
          answers.question7.optionTxt = beds.toString();
          jQuery("#bath_plus").css("color", "#1c3157CA");
          jQuery(".selected_baths").html(answers.question7.optionTxt);
          listProductsFromAPI();
        } else {
          jQuery("#bath_minus").css("color", "#CCCCCC");
          jQuery(".selected_baths").html(answers.question7.optionTxt);
          listProductsFromAPI();
        }
      });
  
      jQuery("#bath_plus").click(function() {
        var beds = parseInt(answers.question7.optionTxt);
        if (beds < 3) {
          beds++;
          answers.question7.optionTxt = beds.toString();
          jQuery("#bath_minus").css("color", "#1c3157CA");
          jQuery(".selected_baths").html(answers.question7.optionTxt);
          listProductsFromAPI();
        } else {
          answers.question7.optionTxt = "3+";
          jQuery("#bath_plus").css("color", "#CCCCCC");
          jQuery(".selected_baths").html(answers.question7.optionTxt);
          listProductsFromAPI();
        }
      });
  
      jQuery("#shower_minus").click(function() {
        var beds = parseInt(answers.question8.optionTxt);
        if (beds > 0) {
          beds--;
          answers.question8.optionTxt = beds.toString();
          jQuery("#shower_plus").css("color", "#1c3157CA");
          jQuery(".selected_showers").html(answers.question8.optionTxt);
          listProductsFromAPI();
        } else {
          jQuery("#shower_minus").css("color", "#CCCCCC");
          jQuery(".selected_showers").html(answers.question8.optionTxt);
          listProductsFromAPI();
        }
      });
  
      jQuery("#shower_plus").click(function() {
        var beds = parseInt(answers.question7.optionTxt);
        if (beds < 2) {
          beds++;
          answers.question8.optionTxt = beds.toString();
          jQuery("#shower_minus").css("color", "#1c3157CA");
          jQuery(".selected_showers").html(answers.question8.optionTxt);
          listProductsFromAPI();
        } else {
          answers.question8.optionTxt = "2+";
          jQuery("#shower_plus").css("color", "#CCCCCC");
          jQuery(".selected_showers").html(answers.question8.optionTxt);
          listProductsFromAPI();
        }
      });
  
      /** Back Button **/
      jQuery(".back__btn_old").click(function() {
        progress = progress - 0.5;
        var cur = jQuery(this).attr("cur");
        var back = jQuery(this).attr("alt");
        var pro = jQuery(this).attr("pro");
        jQuery("#" + cur).fadeOut(0);
        jQuery("#" + back).fadeIn(400);
        jQuery(".progress-bar").css("transform", "scaleX(" + progress.toString() + ")");
      });
      /*****************/
  
      jQuery("#select__date").click(function() {
        jQuery("#controls").hide();
        jQuery("#calendar__box").show();
  
        if (postalCode !== "") {
          jQuery.get('https://api.getAddress.io/find/' + postalCode + '?api-key=6ntg7ko6iEqDAJVh9UVpxg33737', function(response, status) {
            var $model = jQuery('#address');
            $model.empty().append(function() {
              var output = '<option value="0">Choose your address</option>';
              jQuery.each(response.addresses, function(key, value) {
                value = replaceAll(value, ' ,', '');
                value = replaceAll(value, ',,', ',');
                value = value.trim();
                if (value.charAt(value.length - 1) === ",")
                  value.slice(-1);
                output += '<option value="' + value + '">' + value + '</option>';
              });
              return output;
            });
          });
  
        }
      });
    });
  
    jQuery(".final__btn").click(function() {
      var name = jQuery("#name").val();
      var email = jQuery("#email").val();
      email = email.replace(/\s/g, '');
      var mobile = jQuery("#mobile").val();
      var appointment_date = jQuery("#appointment_date").val();
      var additional_information = jQuery("#additional_information").val();
      var address = jQuery("#address").val();
      var address_text = jQuery("#address_text").val();
      if (name === "") {
        jQuery("#name__err").show();
        setTimeout(scrollToStep, 300);
        jQuery("#submit__inquiry_loading").hide();
        return false;
      }
      if (address === "0") {
        jQuery("#address__err").show();
        jQuery("#submit__inquiry_loading").hide();
        setTimeout(scrollToStep, 300);
        return false;
      }
  
      if (address_text === "") {
        jQuery("#address__err").show();
        jQuery("#submit__inquiry_loading").hide();
        setTimeout(scrollToStep, 300);
        return false;
      }
  
  
      if (email === "") {
        jQuery("#email__err").html("Email is required!");
        jQuery("#email__err").show();
        jQuery("#submit__inquiry_loading").hide();
        setTimeout(scrollToStep, 300);
        return false;
      }
      if (!validateEmail(email)) {
        jQuery("#email__err").html("Please enter a valid email!");
        jQuery("#email__err").show();
        jQuery("#submit__inquiry_loading").hide();
        setTimeout(scrollToStep, 300);
        return false;
      }
  
  
    });
  
    jQuery(".ctrl__btn").click(function() {
      jQuery(".ctrl__btn").removeClass("control__added_btn");
      jQuery(".ctrl__btn").addClass("control__add_btn");
      jQuery(".control__add_btn").html("Add");
      jQuery(this).addClass("control__added_btn");
      jQuery(this).removeClass("control__add_btn");
      jQuery(this).html("Added");
  
      var id = jQuery(this).attr('alt');
  
      var content = "";
  
      content += '<i class="fas fa-check-circle"></i> ' + jQuery('#ctrl__title_' + id).html() + ' <span class="addon__price">(' + jQuery('#ctrl__price_' + id).html() + ')</span>';
  
        var __price = parseInt(jQuery('#ctrl__price_' + id + ' > .price__digit').html());
  
        if(isNaN(__price))
          __price = 0;
  
        totalPrice -= controlPrice;
        controlPrice = __price;
        totalPrice += controlPrice;
  
      jQuery(".total__price").html("£" + totalPrice.toString());
      jQuery(".control__addon_name").html(content);
    });
  
    function listProductsFromAPI() {
      jQuery(".loader").show();
      var all = apiBase + "all";
      var beds = parseInt(answers.question6.optionTxt);
      var baths = parseInt(answers.question7.optionTxt);
      var boiler = answers.question2.optionTxt;
      var bConvert = answers.question2a.optionTxt;
  
      var bedPower = "";
      var bathPower = "";
  
      var finalBoiler = "";
      finalBoiler = boiler;
      if (boiler === "Combi") {
        finalBoiler = "Combi";
      }
  
      if (boiler !== "Combi" && bConvert === "YES") {
        finalBoiler = "Combi";
      }
  
      if (finalBoiler === "Combi") {
        switch (beds) {
          case 1:
            bedPower = "24-28";
            break;
          case 2:
            bedPower = "24-28";
            break;
          case 3:
            bedPower = "28-35";
            break;
          case 4:
            bedPower = "28-35";
            break;
          case 5:
            bedPower = "35-43";
            break;
          case 6:
            bedPower = "35-43";
            break;
          default:
            bedPower = "35-43";
            break;
        }
        switch (baths) {
          case 1:
            bathPower = "24-28";
            break;
          case 2:
            bathPower = "28-35";
            break;
          default:
            bathPower = "35-43";
            break;
        }
      } else if (finalBoiler === "System") {
        switch (beds) {
          case 1:
            bedPower = "12-15";
            break;
          case 2:
            bedPower = "12-15";
            break;
          case 3:
            bedPower = "15-30";
            break;
          case 4:
            bedPower = "15-30";
            break;
          case 5:
            bedPower = "30-100";
            break;
          case 6:
            bedPower = "30-100";
            break;
          default:
            bedPower = "30-100";
            break;
        }
  
        switch (baths) {
          case 1:
            bathPower = "12-15";
            break;
          case 2:
            bathPower = "15-30";
            break;
          default:
            bathPower = "30-100";
            break;
        }
      } else {
        switch (beds) {
          case 1:
            bedPower = "10-18";
            break;
          case 2:
            bedPower = "10-18";
            break;
          case 3:
            bedPower = "18-26";
            break;
          case 4:
            bedPower = "18-26";
            break;
          case 5:
            bedPower = "27-40";
            break;
          case 6:
            bedPower = "27-40";
            break;
          default:
            bedPower = "27-40";
            break;
        }
  
        switch (baths) {
          case 1:
            bathPower = "10-18";
            break;
          case 2:
            bathPower = "18-26";
            break;
          default:
            bathPower = "27-40";
            break;
        }
      }
      var boilerAPI = apiBase + "boilers/" + finalBoiler + "/" + bedPower;
      var i = 0;
      jQuery.get(boilerAPI, function(data, status) {
        var content = "";
        var dPrice = 0;
        jQuery.each([data], function(i, objects) {
  
          jQuery.each(objects.boiler, function(key, value) {
  
            dPrice = parseFloat(value.price) - parseFloat(value.discount);
            content += "<div class='row mt-30 product__box'>";
            content += "<div class='col-md-4 no-padding'>";
            content += "<div class='product__image' style='background-image:url(" + value.image + ");'>";
            content += "</div>";
            content += "</div>";
            content += "<div class='col-md-8 no-padding'>";
            content += "<div class='product__description'>";
            content += "<h3>" + value.boiler_name + "</h3>";
            if (value.summary !== null)
              content += "<p class='product__summary'>" + value.summary + "</p>";
            content += "</div>";
            content += "<div class='product__tags'>";
            content += "<div class='row'>";
            content += "<div class='col-md-4'><span class='btn btn-model full-width'>Latest Model</span></div>";
            content += "<div class='col-md-4'><span class='btn btn-choice full-width'>Popular Choice</span></div>";
            content += "</div>";
            content += "</div>";
            content += "<div class='product__attributes'>";
            content += "<div class='table__block'><span class='block__title'>Hot water flow rate</span> <span class='block__value'>" + value.flow_rate + "</span></div>";
            content += "<div class='table__block'><span class='block__title'>Central heating output</span> <span class='block__value'>" + value.central_heating_output + "</span></div>";
            content += "<div class='table__block'><span class='block__title'>Warranty</span> <span class='block__value'>" + value.warranty + "</span></div>";
            content += "<div class='table__block'><span class='block__title'>Dimension</span> <span class='block__value'>" + value.measurements + "</span></div>";
            content += "</div>";
            content += "<div class='product__price'>";
            content += "<p>Your fix price including installation</p>";
            content += "<div class='price__block'><span class='price__discount'>£" + value.price + "</span> £" + dPrice + "</div>";
            content += "</div>";
            content += "<div class='proceed__btns'>";
            content += "<div class='row'>";
            content += "<div class='col-md-4'><span class='choice__btn __proceed' id='" + value.id + "'>Choose</span></div>";
            content += "<div class='col-md-4'><span class='add__radiators __proceed'>Add Radiators</span></div>";
            //content += "<div class='col-md-4'><span class='save__quote __proceed'>Save This Quote</span></div>";
            content += "</div>";
            content += "</div>";
            content += "</div>";
            content += "</div>";
          });
        });
        jQuery(".loader").hide();
  
        jQuery("#all__products").html(content);
        jQuery(".choice__btn").click(function() {
          selectedBoiler = jQuery(this).attr("id");
          var boilerAPI = apiBase + "boiler/" + selectedBoiler;
          var i = 0;
          var dPrice = 0;
          jQuery(".loader").show();
  
          jQuery.get(boilerAPI, function(data, status) {
            jQuery("#products").fadeOut(0);
            jQuery("#controls").fadeIn(400);
            dPrice = parseFloat(data.boiler.price) - parseFloat(data.boiler.discount);
            jQuery("#selected__boiler").html(data.boiler.boiler_name);
            jQuery("#selected__summary").html(data.boiler.summary);
            totalPrice = totalPrice + dPrice;
            jQuery(".total__price").html("£" + totalPrice.toString());
            jQuery("#step-1").removeClass("step__active");
            jQuery("#step-2").addClass("step__active");
            jQuery(".loader").hide();
  
          });
        });
  
      });
    }
  
    function validateEmail(email) {
      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }
  
    function replaceAll(str, find, replace) {
      return str.replace(new RegExp(find, 'g'), replace);
    }
  </script>
--}}

<script>

$('.question-wrapper').hide();

    var selectedBoiler = "";
    var screenWidth = 0;
    var postalCode = "";
    var nextWidth = 0;
    var progress = 1.0;
    var apiBase = "https://new-boiler.gasking.co.uk/api/";
    var totalPrice = 0;
    var controlPrice = 0;
    var combi_convert_price = 900;
    var combi_convert = false;
    var same_room_price = 500;
    var same_room = false;
    var utility_room_price = 700;
    var utility_room = false;
    var kitchen_price = 700;
    var kitchen = false;
    var garage_price = 700;
    var garage = false;
    var airing_cupboard_price = 700;
    var airing_cupboard = false;
    var bedroom_price = 700;
    var bedroom = false;
    var loft_attic_price = 1000;
    var loft_attic = false;
    var answers = {
      current: "question__1",
      question1: {
        option: "",
        optionTxt: ""
      },
      question2: {
        option: "",
        optionTxt: ""
      },
      question2a: {
        option: "",
        optionTxt: ""
      },
      question2b: {
        option: "",
        optionTxt: ""
      },
      question3: {
        option: "",
        optionTxt: ""
      },
      question4: {
        option: "",
        optionTxt: ""
      },
      question4a: {
        option: "",
        optionTxt: ""
      },
      question4a1: {
        option: "",
        optionTxt: ""
      },
      question4b: {
        option: "",
        optionTxt: ""
      },
      question5: {
        option: "",
        optionTxt: ""
      },
      question5a: {
        option: "",
        optionTxt: ""
      },
      question5b: {
        option: "",
        optionTxt: ""
      },
      question5c: {
        option: "",
        optionTxt: ""
      },
      question6: {
        option: "",
        optionTxt: ""
      },
      question7: {
        option: "",
        optionTxt: ""
      },
      question7a: {
        option: "",
        optionTxt: ""
      },
      question8: {
        option: "",
        optionTxt: ""
      },
      question8a: {
        option: "",
        optionTxt: ""
      },
      question8b: {
        option: "",
        optionTxt: ""
      },
      question8c: {
        option: "",
        optionTxt: ""
      },
      question9: {
        option: "",
        optionTxt: ""
      },
      question10: {
        option: "",
        optionTxt: ""
      },
      question10a: {
        option: "",
        optionTxt: ""
      },
      question10b: {
        option: "",
        optionTxt: ""
      },
      question10c: {
        option: "",
        optionTxt: ""
      },
      question10d: {
        option: "",
        optionTxt: ""
      },
      question10e: {
        option: "",
        optionTxt: ""
      },
      question10f: {
        option: "",
        optionTxt: ""
      },
      question10g: {
        option: "",
        optionTxt: ""
      }
    };

    jQuery(".option-image").css("height", "150px");

 /** Questions Logic **/
      jQuery("#question__1").fadeIn(200);
      //jQuery(".progress-bar").show();
  
      /*jQuery(".option-wrapper").click(function() {
        progress = progress + 0.5;
        jQuery(".progress-bar").css("transform", "scaleX(" + progress.toString() + ")");
      });*/
      jQuery(".q1").click(function(event) {
        jQuery(".loader").show();
        answers.current = "question__2";
        answers.question1.option = jQuery(this).attr("id");
        answers.question1.optionTxt = jQuery("#" + answers.question1.option + " > .figure > .option-title").html();
        jQuery("#question__1").fadeOut(0);
        jQuery("#question__2").fadeIn(400);
        jQuery(".loader").hide();
      });
  
      jQuery(".q2").click(function() {
        jQuery(".loader").show();
        answers.question2.option = jQuery(this).attr("id");
        answers.question2.optionTxt = jQuery("#" + answers.question2.option + " > .figure > .option-title").html();
        if (answers.question2.option === "q2o1") {
          jQuery("#question__2").fadeOut(0);
          jQuery("#question__3").fadeIn(400);
          jQuery("#back__3").attr("alt", "question__2");
          answers.current = "question__3";
  
        } else {
          jQuery("#question__2").fadeOut(0);
          jQuery("#question__2a").fadeIn(400);
          answers.current = "question__2a";
          jQuery("#back__3").attr("alt", "question__2b");
        }
        jQuery(".loader").hide();
      });
  
      jQuery(".q2a").click(function() {
        jQuery(".loader").show();
        answers.question2a.option = jQuery(this).attr("id");
        answers.question2a.optionTxt = jQuery("#" + answers.question2a.option + " > .figure > .option-title").html();
        answers.current = "question__2b";
        jQuery("#question__2a").fadeOut(0);
        jQuery("#question__2b").fadeIn(400);
        jQuery(".loader").hide();
      });
  
      jQuery(".q2b").click(function() {
        jQuery(".loader").show();
        answers.question2b.option = jQuery(this).attr("id");
        answers.question2b.optionTxt = jQuery("#" + answers.question2b.option + " > .figure > .option-title").html();
        answers.current = "question__3";
        jQuery("#question__2b").fadeOut(0);
        jQuery("#question__3").fadeIn(400);
        jQuery(".loader").hide();
      });
  
      jQuery(".q3").click(function() {
        jQuery(".loader").show();
        answers.question3.option = jQuery(this).attr("id");
        answers.question3.optionTxt = jQuery("#" + answers.question3.option + " > .figure > .option-title").html();
        answers.current = "question__4";
        jQuery("#question__3").fadeOut(0);
        jQuery("#question__4").fadeIn(400);
        jQuery(".loader").hide();
      });
  
      jQuery(".q4").click(function() {
        jQuery(".loader").show();
        answers.question4.option = jQuery(this).attr("id");
        answers.question4.optionTxt = jQuery("#" + answers.question4.option + " > .figure > .option-title").html();
        if (answers.question4.option === "q4o1") {
          answers.current = "question__4a";
          jQuery("#question__4").fadeOut(0);
          jQuery("#question__4a").fadeIn(400);
        } else {
          answers.current = "question__5";
          jQuery("#question__4").fadeOut(0);
          jQuery("#question__5").fadeIn(400);
        }
  
        jQuery(".loader").hide();
      });
  
      jQuery(".q4a").click(function() {
        jQuery(".loader").show();
        answers.question4a.option = jQuery(this).attr("id");
        answers.question4a.optionTxt = jQuery("#" + answers.question4a.option + " > .figure > .option-title").html();
        if (answers.question4a.option === "q4ao1") {
          loft_attic = false;
          bedroom = false;
          airing_cupboard = false;
          garage = false;
          kitchen = false;
          utility_room = false;
          same_room = true;
          answers.current = "question__4b";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#question__4b").fadeIn(400);
        } else if (answers.question4a.option === "q4ao2") {
          loft_attic = false;
          bedroom = false;
          airing_cupboard = false;
          garage = false;
          kitchen = false;
          utility_room = true;
          same_room = false;
          answers.current = "question__4b";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#question__4b").fadeIn(400);
        } else if (answers.question4a.option === "q4ao3") {
          loft_attic = false;
          bedroom = false;
          airing_cupboard = false;
          garage = false;
          kitchen = true;
          utility_room = false;
          same_room = false;
          answers.current = "question__4b";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#question__4b").fadeIn(400);
        } else if (answers.question4a.option === "q4ao4") {
          loft_attic = false;
          bedroom = false;
          airing_cupboard = false;
          garage = true;
          kitchen = false;
          utility_room = false;
          same_room = false;
          answers.current = "question__4b";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#question__4b").fadeIn(400);
        } else if (answers.question4a.option === "q4ao5") {
          loft_attic = false;
          bedroom = false;
          airing_cupboard = true;
          garage = false;
          kitchen = false;
          utility_room = false;
          same_room = false;
          answers.current = "question__4a1";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#question__4a1").fadeIn(400);
        } else if (answers.question4a.option === "q4ao6") {
          loft_attic = false;
          bedroom = true;
          airing_cupboard = false;
          garage = false;
          kitchen = false;
          utility_room = false;
          same_room = false;
          answers.current = "question__4b";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#question__4b").fadeIn(400);
        } else if (answers.question4a.option === "q4ao7") {
          loft_attic = true;
          bedroom = false;
          airing_cupboard = false;
          garage = false;
          kitchen = false;
          utility_room = false;
          same_room = false;
  
          answers.current = "question__4b";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#question__4b").fadeIn(400);
        } else {
          answers.current = "contact__us";
          jQuery("#question__4a").fadeOut(0);
          jQuery("#contact__us").fadeIn(400);
        }
        jQuery(".loader").hide();
      });
      jQuery(".q4a1").click(function() {
        jQuery(".loader").show();
        answers.question4a1.option = jQuery(this).attr("id");
        answers.question4a1.optionTxt = jQuery("#" + answers.question4a1.option + " > .figure > .option-title").html();
        answers.current = "question__4b";
        jQuery("#question__4a1").fadeOut(0);
        jQuery("#question__4b").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q4b").click(function() {
        jQuery(".loader").show();
        answers.question4b.option = jQuery(this).attr("id");
        answers.question4b.optionTxt = jQuery("#" + answers.question4b.option + " > .figure > .option-title").html();
        answers.current = "question__5";
        jQuery("#question__4b").fadeOut(0);
        jQuery("#question__5").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q5").click(function() {
        jQuery(".loader").show();
        answers.question5.option = jQuery(this).attr("id");
        answers.question5.optionTxt = jQuery("#" + answers.question5.option + " > .figure > .option-title").html();
        if (answers.question5.option === "q5o4") {
          answers.current = "question__5a";
          jQuery("#question__5").fadeOut(0);
          jQuery("#question__5a").fadeIn(400);
        } else if (answers.question5.option === "q5o5") {
          answers.current = "question__5c";
          jQuery("#question__5").fadeOut(0);
          jQuery("#question__5c").fadeIn(400);
        } else {
          answers.current = "question__6";
          jQuery("#question__5").fadeOut(0);
          jQuery("#question__6").fadeIn(400);
        }
        jQuery(".loader").hide();
      });
      jQuery(".q5a").click(function() {
        jQuery(".loader").show();
        answers.question5a.option = jQuery(this).attr("id");
        answers.question5a.optionTxt = jQuery("#" + answers.question5a.option + " > .figure > .option-title").html();
        if (answers.question5a.option === "q5ao1") {
          answers.current = "question__5b";
          jQuery("#question__5a").fadeOut(0);
          jQuery("#question__5b").fadeIn(400);
        } else {
          answers.current = "question__6";
          jQuery("#question__5b").fadeOut(0);
          jQuery("#question__6").fadeIn(400);
        }
        jQuery(".loader").hide();
      });
      jQuery(".q5b").click(function() {
        jQuery(".loader").show();
        answers.question5b.option = jQuery(this).attr("id");
        answers.question5b.optionTxt = jQuery("#" + answers.question5b.option + " > .figure > .option-title").html();
        answers.current = "question__6";
        jQuery("#question__5b").fadeOut(0);
        jQuery("#question__6").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q5c").click(function() {
        jQuery(".loader").show();
        answers.question5c.option = jQuery(this).attr("id");
        answers.question5c.optionTxt = jQuery("#" + answers.question5c.option + " > .figure > .option-title").html();
        answers.current = "question__6";
        jQuery("#question__5c").fadeOut(0);
        jQuery("#question__6").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q6").click(function() {
        jQuery(".loader").show();
        answers.question6.option = jQuery(this).attr("id");
        answers.question6.optionTxt = jQuery("#" + answers.question6.option + " > .figure > .option-title").html();
        answers.current = "question__7";
        jQuery("#question__6").fadeOut(0);
        jQuery("#question__7").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q7").click(function() {
        jQuery(".loader").show();
        answers.question7.option = jQuery(this).attr("id");
        answers.question7.optionTxt = jQuery("#" + answers.question7.option + " > .figure > .option-title").html();
        if (answers.question5a.option === "q7o1") {
          answers.current = "question__8";
          jQuery("#question__7").fadeOut(0);
          jQuery("#question__8").fadeIn(400);
        } else {
          answers.current = "question__7a";
          jQuery("#question__7").fadeOut(0);
          jQuery("#question__7a").fadeIn(400);
        }
        jQuery(".loader").hide();
      });
      jQuery(".q7a").click(function() {
        jQuery(".loader").show();
        answers.question7a.option = jQuery(this).attr("id");
        answers.question7a.optionTxt = jQuery("#" + answers.question7a.option + " > .figure > .option-title").html();
        answers.current = "question__8";
        jQuery("#question__7a").fadeOut(0);
        jQuery("#question__8").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q8").click(function() {
        jQuery(".loader").show();
        answers.question8.option = jQuery(this).attr("id");
        answers.question8.optionTxt = jQuery("#" + answers.question8.option + " > .figure > .option-title").html();
        answers.current = "question__8b";
        jQuery("#question__8").fadeOut(0);
        jQuery("#question__8b").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q8a").click(function() {
        jQuery(".loader").show();
        answers.question8a.option = jQuery(this).attr("id");
        answers.question8a.optionTxt = jQuery("#" + answers.question8a.option + " > .figure > .option-title").html();
        answers.current = "question__8b";
        jQuery("#question__8a").fadeOut(0);
        jQuery("#question__8b").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q8b").click(function() {
        jQuery(".loader").show();
        answers.question8b.option = jQuery(this).attr("id");
        answers.question8b.optionTxt = jQuery("#" + answers.question8b.option + " > .figure > .option-title").html();
        answers.current = "question__8c";
        jQuery("#question__8b").fadeOut(0);
        jQuery("#question__8c").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q8c").click(function() {
        jQuery(".loader").show();
        answers.question8c.option = jQuery(this).attr("id");
        answers.question8c.optionTxt = jQuery("#" + answers.question8c.option + " > .figure > .option-title").html();
        answers.current = "question__9";
        jQuery("#question__8c").fadeOut(0);
        jQuery("#question__9").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q9").click(function() {
        jQuery(".loader").show();
        answers.question9.option = jQuery(this).attr("id");
        answers.question9.optionTxt = jQuery("#" + answers.question9.option + " > .figure > .option-title").html();
        answers.current = "question__10";
        jQuery("#question__9").fadeOut(0);
        jQuery("#question__10").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q10").click(function() {
        jQuery(".loader").show();
        answers.question10.option = jQuery(this).attr("id");
        answers.question10.optionTxt = jQuery("#" + answers.question10.option + " > .figure > .option-title").html();
        /////////////////////////////////////////////////
        if (answers.question10.option === "q10o1") {
          answers.current = "question__10b";
          jQuery("#question__10").fadeOut(0);
          jQuery("#question__10b").fadeIn(400);
        } else {
          answers.current = "question__10a";
          jQuery("#question__10").fadeOut(0);
          jQuery("#question__10a").fadeIn(400);
        }
        jQuery(".loader").hide();
      });
      jQuery(".q10a").click(function() {
        jQuery(".loader").show();
        answers.question10a.option = jQuery(this).attr("id");
        answers.question10a.optionTxt = jQuery("#" + answers.question10a.option + " > .figure > .option-title").html();
        answers.current = "question__10d";
        jQuery("#question__10a").fadeOut(0);
        jQuery("#question__10d").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q10b").click(function() {
        jQuery(".loader").show();
        answers.question10b.option = jQuery(this).attr("id");
        answers.question10b.optionTxt = jQuery("#" + answers.question10b.option + " > .figure > .option-title").html();
        if(answers.question10b.option === "q10bo1"){
          answers.current = "question__10c";
          jQuery("#question__10b").fadeOut(0);
          jQuery("#question__10c").fadeIn(400);
        }else{
          answers.current = "postal__code";
          jQuery("#question__10b").fadeOut(0);
          jQuery("#postal__code").fadeIn(400);
        }
        jQuery(".loader").hide();
      });
      jQuery(".q10c").click(function() {
        jQuery(".loader").show();
        answers.question10c.option = jQuery(this).attr("id");
        answers.question10c.optionTxt = jQuery("#" + answers.question10c.option + " > .figure > .option-title").html();
        answers.current = "postal__code";
        jQuery("#question__10c").fadeOut(0);
        jQuery("#postal__code").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q10d").click(function() {
        jQuery(".loader").show();
        answers.question10d.option = jQuery(this).attr("id");
        answers.question10d.optionTxt = jQuery("#" + answers.question10d.option + " > .figure > .option-title").html();
        answers.current = "question__10e";
        jQuery("#question__10d").fadeOut(0);
        jQuery("#question__10e").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q10e").click(function() {
        jQuery(".loader").show();
        answers.question10e.option = jQuery(this).attr("id");
        answers.question10e.optionTxt = jQuery("#" + answers.question10e.option + " > .figure > .option-title").html();
        answers.current = "question__10f";
        jQuery("#question__10e").fadeOut(0);
        jQuery("#question__10f").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q10f").click(function() {
        jQuery(".loader").show();
        answers.question10f.option = jQuery(this).attr("id");
        answers.question10f.optionTxt = jQuery("#" + answers.question10f.option + " > .figure > .option-title").html();
        answers.current = "question__10g";
        jQuery("#question__10f").fadeOut(0);
        jQuery("#question__10g").fadeIn(400);
        jQuery(".loader").hide();
      });
      jQuery(".q10g").click(function() {
        jQuery(".loader").show();
        answers.question10g.option = jQuery(this).attr("id");
        answers.question10g.optionTxt = jQuery("#" + answers.question10g.option + " > .figure > .option-title").html();
        answers.current = "postal__code";
        jQuery("#question__10g").fadeOut(0);
        jQuery("#postal__code").fadeIn(400);
        jQuery(".loader").hide();
      });

   /** End question logic **/   

/** Back Button **/
jQuery(".back__btn").click(function() {
        progress = progress - 0.5;
        var cur = jQuery(this).attr("cur");
        var back = jQuery(this).attr("alt");
        var pro = jQuery(this).attr("pro");
        jQuery("#" + cur).fadeOut(0);
        jQuery("#" + back).fadeIn(400);
     });
/*****************/   

jQuery("#show__products").click(function() {
        jQuery(".loader").show();
        postalCode = jQuery.trim(jQuery("#postal_code").val());
        if (postalCode !== "") {
      
          var beds = parseInt(answers.question6.optionTxt);
          var baths = parseInt(answers.question7.optionTxt);
          var showers = parseInt(answers.question8.optionTxt);
          var boiler = answers.question2.optionTxt;
          var bConvert = answers.question2a.optionTxt;
      
          saveAnswer(beds,baths,showers,boiler,bConvert);
        }
        else {
          jQuery("#show__products").addClass('disabled');
        }
      }); 

  jQuery("#postal_code").keyup(function(){
  jQuery("#show__products").removeClass('disabled');
 }); 

   function saveAnswer(beds,baths,showers,boiler,bConvert)
   {

    /*
     beds = 2;
     baths = 1;
     showers = 3;
     boiler = 'Combi';
     bConvert = 'YES';
    */

    $.ajax({
                url:"{!! route('save-answer') !!}", 
                type: "POST",
                data:{beds: beds,
                      baths: baths,
                      showers: showers,
                      boiler_type: boiler,
                      bConvert: bConvert
                     },
                headers: {
                    'X-CSRF-TOKEN': "{!! csrf_token() !!}"
                },
                beforeSend: function () {
                    $('.loader').show();
                },
                complete: function () {
                    $('.loader').hide();
                },     
                success:function(data)
                {
                    //console.log(data);
                    location.href = "{!! route('page.boilers') !!}";
                }

            });
   } 

   //saveAnswer();
   
 </script> 
@endsection


