@extends('pages.layouts.master')

@section('title') Boiler @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler'] @endphp

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Select a new boiler</h2>
            </div>
</div>

<div class="select-boiler d-flex flex-wrap justify-content-center mb-5">
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-bed.png') !!}" alt="Bed">
                <span class="text-primary text-small">2 Bed</span>
            </span>
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-bath.png') !!}" alt="bath">
                <span class="text-primary text-small">1 Bath</span>
            </span>
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-shower.png') !!}" alt="shower">
                <span class="text-primary text-small">1 Shower</span>
            </span>
            <span class="select-boiler-edit" data-bs-toggle="modal" data-bs-target="#edit-answer">
                <span>Edit Answer</span>
            </span>
        </div>

        <div class="filter_params d-flex flex-wrap justify-content-between mb-4">
            <div class="btn-group my-2">
                <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Select Manufacturer</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Manufacturer 1</a></li>
                    <li><a class="dropdown-item" href="#">Manufacturer 2</a></li>
                </ul>
            </div>
            <div class="btn-group my-2">
                <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Sort by: <span>Recommended</span></button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Price: High To Low</a></li>
                    <li><a class="dropdown-item" href="#">Price: Low To High</a></li>
                    <li><a class="dropdown-item" href="#">Newest First</a></li>
                    <li><a class="dropdown-item" href="#">Oldest First</a></li>
                </ul>
            </div>
        </div>

        <div class="boiler-listing">
                <div class="boiler-item" id="boiler-item-0" style="display:none">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler" class="boiler-pic">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3 class="boiler-name">Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small boiler-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    <span class="boiler-flow-rate">10.4</span>
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    <span class="boiler-central-heating-output">25</span>
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    <span class="boiler-warranty">10</span>
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(HxWxD)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    <span class="boiler-measurements">700 x 390 x 295</span>
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3 class="boiler-price boiler-net-price">£2542.79</h3>
                        <h5 class="text-danger mb-3 boiler-actual-price"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
            
</div>

<!--  Edit answer modal -->
<div class="modal fade" id="edit-answer" tabindex="-1" aria-labelledby="edit-answerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 p-lg-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="modal-title mb-4" id="edit-answerLabel">Edit your answers</h2>
                        <p class="mb-5">Edit your answers below to adjust your results</p>
                    </div>
                </div>
                <div class="row justify-content-center edit-answer">
                    <div class="col-lg-6 col-md-12">
                        <div class="edit-answer-container">
                            <div class="select-boiler d-flex flex-wrap flex-column flex-sm-row justify-content-center mb-5">
                                <div class="edit-answer-item col-sm-4 text-center mb-4">
                                    <span class="select-boiler-item mx-auto">
                                        <img src="{!! asset('assets/img/icon-bed.png') !!}" alt="Bed">
                                        <span class="text-primary"><span class="item-count">2</span> Bed</span>
                                        <input type="number" class="bed-count d-none" name="bed-count" value="2">
                                    </span>

                                    <button class="btn btn-outline-secondary decrease" type="button"><span class="fa fa-minus"></span></button>
                                    <button class="btn btn-outline-secondary increase" type="button"><span class="fa fa-plus"></span></button>
                                </div>
                                <div class="edit-answer-item col-sm-4 text-center mb-4">
                                    <span class="select-boiler-item mx-auto">
                                        <img src="{!! asset('assets/img/icon-bath.png') !!}" alt="bath">
                                        <span class="text-primary"><span class="item-count">1</span> Bath</span>
                                        <input type="number" class="bath-count d-none" name="bath-count" value="1">
                                    </span>

                                    <button class="btn btn-outline-secondary decrease" type="button"><span class="fa fa-minus"></button>
                                    <button class="btn btn-outline-secondary increase" type="button"><span class="fa fa-plus"></button>
                                </div>
                                <div class="edit-answer-item col-sm-4 text-center mb-4">
                                    <span class="select-boiler-item mx-auto">
                                        <img src="{!! asset('assets/img/icon-shower.png') !!}" alt="shower">
                                        <span class="text-primary"><span class="item-count">1</span> Shower</span>
                                        <input type="number" class="shower-count d-none" name="shower-count" value="1">
                                    </span>

                                    <button class="btn btn-outline-secondary decrease" type="button"><span class="fa fa-minus"></button>
                                    <button class="btn btn-outline-secondary increase" type="button"><span class="fa fa-plus"></button>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-secondary btn-lg save-answer">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End edit answer modal -->

@endsection

@section('custom-scripts')
<script>
function listProductsFromAPI_old(selection) {
    jQuery(".loader").show();
    var all = apiBase + "all";
    var beds = selection.beds;
    var baths = selection.baths;
    var boiler = selection.boiler;
    var bConvert = selection.bConvert;

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

  function listProductsFromAPI_modified(selection) {
   
    var all = apiBase + "all";
    var beds = selection.beds;
    var baths = selection.baths;
    var boiler = selection.boiler;
    var bConvert = selection.bConvert;

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
    
    $.ajax({
                url: boilerAPI, 
                type: "GET",
                
                beforeSend: function () {
                    $('.loader').show();
                },
                complete: function () {
                    $('.loader').hide();
                },     
                success:function(data)
                {
                   jQuery.each([data], function(i, objects)
                   {
                        jQuery.each(objects.boiler, function(key, value)
                        {
                            var item = $('#boiler-item-0').clone();
                            item.show();
                            item.removeAttr('id');
                            
                            item.find('.boiler-pic').attr("src",value.image);      
                            item.find('.boiler-name').html(value.boiler_name);
                            item.find('.boiler-summary').html(value.summary);
                            item.find('.boiler-flow-rate').html(value.flow_rate);
                            item.find('.boiler-central-heating-output').html(value.central_heating_output);
                            item.find('.boiler-warranty').html(value.warranty);
                            item.find('.boiler-measurements').html(value.measurements);
                            
                            var price = parseFloat(value.price);
                            var discount = parseFloat(value.discount)?parseFloat(value.discount):0;
                            var dPrice = price - discount;
                            
                            item.find('.boiler-net-price').html("£"+dPrice);
                            if (discount)
                                item.find('.boiler-actual-price').html("<s>£"+price+"</s>");    

                            $('.boiler-listing').append(item);  
        
                        });

                    });
                }

            });
  }

var selection = JSON.parse('{!! $selection !!}');
//console.log(selection);  

var apiBase = "https://new-boiler.gasking.co.uk/api/";
listProductsFromAPI_modified(selection);

</script> 
@endsection

