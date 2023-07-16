@extends('pages.layouts.master')

@section('title') Boiler @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = [] @endphp

@php 
$Selection = Session()->get('selection');
@endphp

@section('content')
<div class="row justify-content-center question-wrapper">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Select a new boiler</h2>
            </div>
</div>

<div class="select-boiler d-flex flex-wrap justify-content-center mb-5">
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-bed.png') !!}" alt="Bed">
                <span class="text-primary text-small"><span class="select-boiler-bed-count">{{ $Selection['beds'] }}</span> Bed</span>
            </span>
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-bath.png') !!}" alt="bath">
                <span class="text-primary text-small"><span class="select-boiler-bath-count">{{ $Selection['baths'] }}</span> Bath</span>
            </span>
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-shower.png') !!}" alt="shower">
                <span class="text-primary text-small"><span class="select-boiler-shower-count">{{ $Selection['showers'] }}</span> Shower</span>
            </span>
            <span class="select-boiler-edit" data-bs-toggle="modal" data-bs-target="#edit-answer">
                <span>Edit Answer</span>
            </span>
        </div>

        <div class="filter_params d-flex flex-wrap justify-content-between mb-4">
          <div class="btn-group my-2">
                <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" ><span id="show-category">Select Manufacturer</span></button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item category-item" href="javascript:void(0)" data-value=""  >Select Manufacturer</a></li>
                    @foreach ($categories as $category_id=>$category)
                        <li><a class="dropdown-item category-item" href="javascript:void(0)" data-value="{{ $category_id }}"  >{{ $category }}</a></li>
                    @endforeach
                </ul>
                <input type="hidden" name="cat" id="cat" value="" class="filter-list"/>
            </div>

            <div class="gasking-btn-container d-sm-flex">
              <a href="#" class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center" data-bs-toggle="modal" data-bs-target="#see-everything">
                  <i class="fa-solid fa-plus me-2"></i>
                  See everything included
              </a>
              <a href="{!! route('page.index') !!}" class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center">
                  <i class="fa-solid fa-arrow-rotate-right me-2"></i>
                  Restart
              </a>
          </div>

            <div class="btn-group my-2">
                <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" id="btn-sort">Sort by: <span id="show-sort">Recommended</span></button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item sort-item" href="javascript:void(0)" data-sort-by="net_price" data-sort="desc">Price: High To Low</a></li>
                    <li><a class="dropdown-item sort-item" href="javascript:void(0)" data-sort-by="net_price" data-sort="asc">Price: Low To High</a></li>
                    <li><a class="dropdown-item sort-item" href="javascript:void(0)" data-sort-by="created_at" data-sort="desc">Newest First</a></li>
                    <li><a class="dropdown-item sort-item" href="javascript:void(0)" data-sort-by="created_at" data-sort="asc" >Oldest First</a></li>
                </ul>
                <input type="hidden" name="sort_by" id="sort_by" value="" class="filter-list"/>
                <input type="hidden" name="sort" id="sort" value="" class="filter-list"/>
            </div>
       </div>

        <div class="boiler-listing">
          <div class="boiler-item" >
            <img class="extras" style="width:100%;" src="{{asset('assets/img/extras.png?v1.1')}}" />
          </div>
            {{-- <div class="boiler-item free-items">
              <div class="free-title">
                <div class="free-title-img"><img src="{{asset('assets/img/free/free.png')}}"></div>
                <div class="free-title-text">£100s of free extras when you order a New Boiler</div>
              </div>
            </div> --}}
                <div class="boiler-item" id="boiler-item-0" style="display:none">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <div class="boiler-extra-icon"></div>
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler" class="boiler-pic">
                        <div class="boiler-icon-features"></div>
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
                        <a href="#" class="text-secondary d-block mb-4 more-info" target="_blank"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title _link" data-bs-toggle="modal" data-bs-target="#hot-water">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    <span class="boiler-flow-rate">10.4</span>
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title _link" data-bs-toggle="modal" data-bs-target="#central-heating">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Central heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    <span class="boiler-central-heating-output">25</span>
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title _link" data-bs-toggle="modal" data-bs-target="#warranty">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    <span class="boiler-warranty">10</span>
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title _link" data-bs-toggle="modal" data-bs-target="#dimension">
                                    <img src="{!! asset('assets/img/boiler-icons/cube.png') !!}" alt="Dimension">
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
                        <a href="javascript:void(0);" class="text-secondary d-block mb-4" data-bs-toggle="modal" data-bs-target="#see-everything">+ See everything included</a>
                        <h3 class="boiler-price boiler-net-price">£2542.79</h3>
                        <h5 class="text-danger mb-3 boiler-actual-price"><s>£2562.79</s></h5>
                        <h3 class="boiler-discount-price">Save up to £0.00</h3>

                        <a href="javascript:void(0)" class="btn btn-secondary text-white w-100 mt-3 mb-4 choose-boiler" >Choose Boiler</a>
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#save-quote" class="text-secondary d-flex align-items-center save_this_quote"><i class="fa-solid fa-envelope me-2"></i> Save This Quote</a>
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
                                        <span class="text-primary"><span class="item-count">{{ $Selection['beds'] }}</span> Bed</span>
                                        <input type="number" class="bed-count d-none" name="bed-count" value="2">
                                    </span>

                                    <button class="btn btn-outline-secondary decrease" type="button"><span class="fa fa-minus"></span></button>
                                    <button class="btn btn-outline-secondary increase" type="button"><span class="fa fa-plus"></span></button>
                                </div>
                                <div class="edit-answer-item col-sm-4 text-center mb-4">
                                    <span class="select-boiler-item mx-auto">
                                        <img src="{!! asset('assets/img/icon-bath.png') !!}" alt="bath">
                                        <span class="text-primary"><span class="item-count">{{ $Selection['baths'] }}</span> Bath</span>
                                        <input type="number" class="bath-count d-none" name="bath-count" value="1">
                                    </span>

                                    <button class="btn btn-outline-secondary decrease" type="button"><span class="fa fa-minus"></button>
                                    <button class="btn btn-outline-secondary increase" type="button"><span class="fa fa-plus"></button>
                                </div>
                                <div class="edit-answer-item col-sm-4 text-center mb-4">
                                    <span class="select-boiler-item mx-auto">
                                        <img src="{!! asset('assets/img/icon-shower.png') !!}" alt="shower">
                                        <span class="text-primary"><span class="item-count">{{ $Selection['showers'] }}</span> Shower</span>
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
var cBoiler = "";


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
          content += "<div class='price__block'><span class='price__discount'>Save up to £" + dPrice + "</span></div>";
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


    var bedPower = "";
    var bathPower = "";
    var finalBoiler = "";
    
    var next_page_url = "";
    var xhr = null;
    var oldScroll = 0;
    
  function listProductsFromAPI_modified(selection) {
   
    var all = apiBase + "all";
    var beds = parseInt(selection.beds);
    var baths = parseInt(selection.baths);
    var boiler = selection.boiler_type;
    var bConvert = selection.bConvert;

    

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
    
 
  filter();

  }

function create_list_item(data, append=false)
{
  if (!append)
    $('.boiler-listing .boiler-record').remove();

  $.each(data.boiler.data, function(key, value)
        {
            var tags = value.tags;
            var features = value.features;
            var item = $('#boiler-item-0').clone();
            item.show();
            item.removeAttr('id');
            item.addClass('boiler-record');
            item.attr('id', value.id);
            
            item.find('.boiler-pic').attr("src",value.image).attr("alt", "{!! url('boiler') !!}"+"/"+value.id+"");      
            item.find('.boiler-name').html("<a href='{!! url('boiler') !!}"+"/"+value.id+"' target='_blank'>"+value.boiler_name+"</a>");
            item.find('.boiler-summary').html(value.summary);
            item.find('.boiler-flow-rate').html(value.flow_rate);
            item.find('.boiler-central-heating-output').html(value.central_heating_output);
            item.find('.boiler-warranty').html(value.warranty);
            item.find('.boiler-measurements').html(value.measurements);
            
            if(value.latest == 0)
              item.find('.boiler-latest').hide();
            if(value.popular == 0)
              item.find('.boiler-popular').hide();

            if(value.tags.length == 0)
              item.find('.boiler-tags').hide();

            $.each(tags, function(key, val) {
              item.find(".boiler-pro").append("<span class='boiler-tags'><img src='{!! asset('assets/img/boiler-icons/tick.jpg') !!}'>"+val.tag+"</span>");
            });

            $.each(features, function(key, val){
              item.find(".boiler-icon-features").append("<img src='"+val.image+"' title='"+val.name+"'>")
            });
            console.log(value);
            if(value.extra_icon != null)
              item.find(".boiler-extra-icon").append("<img src='uploads/icons/"+ value.extra_icon +"' />")

            var discount = parseFloat(value.discount)?parseFloat(value.discount):0;
            // var price = parseFloat(data.selection.total_price);
            
            var conversionCharge = parseFloat(data.selection.conversion_charge);
            var movingBoilerCharge = parseFloat(data.selection.moving_boiler.price);
            var scaffoldingCharge = parseFloat(data.selection.scaffolding.price);
            var price = parseFloat(value.price) + conversionCharge + movingBoilerCharge + scaffoldingCharge;

            var dPrice = price  - discount;
            dPrice = dPrice.toFixed(2);
            price = price.toFixed(2);

            item.find('.boiler-net-price').html("£"+dPrice);
            if (discount)
                item.find('.boiler-actual-price').html("<s>£"+price+"</s>");
            else        
                item.find('.boiler-actual-price').remove();

            if(discount > 0)
              item.find('.boiler-discount-price').html('Save up to £'+value.discount);
            else
              item.find('.boiler-discount-price').remove();
            
            item.find('.more-info').attr('href',"{!! url('boiler') !!}"+"/"+value.id); 
            item.find('.choose-boiler').attr('data-boiler',value.id);       
            item.find('.save_this_quote').attr('data-boiler',value.id);       

            $('.boiler-listing').append(item);  

            

        });

      $(".save_this_quote").click(function(event){
          cBoiler = $(this).attr("data-boiler");
          $("#save-quote").show();
        });

    $(".boiler-pic").click(function(){
      var link = $(this).attr('alt');
      window.open(link, '_blank');
    });
}

$("#save-quote-btn").click(function(event){
  event.preventDefault();
  $("#emailErr").html("");
  var email = $("#email-quote").val();
  var contact = $("#contact-quote").val();
  if(email != "")
  {
    if(!validateEmail(email))
    {
      $("#emailErr").html("Please enter a valid email");
      return false;
    }
  }else{
    if(!validateEmail(email))
    {
      $("#emailErr").html("Please enter your email address");
      return false;
    }
  }
  var choice = JSON.stringify(selection);

  var url = '{!! route("save.quote") !!}';

  var saved_url = "{{url()->current()}}";

  $.ajax({
      url: url, 
      type: "POST",
      data: {
                selection: choice,
                boiler: cBoiler,
                email: email,
                contact: contact,
                saved_url: saved_url
            },
      dataType: "json",      
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
        Swal.fire({
          title: 'Done',
          text: data.message,
          icon: 'success',
          showCancelButton: false,
          showCloseButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Close'
          }).then((result) => {
          if (result.isConfirmed) {
            $('#save-quote').modal('hide');
          }
          });
      }

  });
});
var selection = JSON.parse('{!! json_encode($Selection) !!}');
//console.log(selection);


//var apiBase = "https://new-boiler.gasking.co.uk/api/";
var apiBase = "{{ url('/api/new') }}/";
listProductsFromAPI_modified(selection);

$('.save-answer').click(function(){

  //send ajax request to save,
  //close modal,
  //list products
  
  var bed_count =  $('#edit-answer .bed-count').val();
  var bath_count =  $('#edit-answer .bath-count').val();
  var shower_count =  $('#edit-answer .shower-count').val();

  $('.select-boiler-bed-count').html(bed_count);
  $('.select-boiler-bath-count').html(bath_count);
  $('.select-boiler-shower-count').html(shower_count);

  oldScroll = 0;

  $.ajax({
      url: "{!! route('update-answer') !!}", 
      type: "POST",
      data: {beds: bed_count,
              baths: bath_count,
              showers: shower_count,
            },
      dataType: "json",      
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
          var selection = data.selection;

          if (Object.keys(selection).length)
            listProductsFromAPI_modified(selection);
          
          $('#edit-answer').modal('hide');

      }

  });

});

$(window).scroll(function () {

    if (!next_page_url) 
      return false; 

    //to prevent firing while scroll up 
    if (oldScroll > this.scrollY)
      return false;
    
    oldScroll = this.scrollY;  

    // End of the document
    //if ($(document).height() - $(this).height() - 100 < $(this).scrollTop())
    //if ($(document).height() - $(this).height() - $('footer').offset().top < $(this).scrollTop())
    if (oldScroll > ($('footer').offset().top-600))
     {
        filter(next_page_url, true);  
     }
}); 

//Prevent automatic browser scroll on refresh
$(window).on('unload', function() {
   $(window).scrollTop(0);
});

window.onunload = function(){ window.scrollTo(0,0); }

if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}
//End prevent automatic browser scroll on refresh

function filter(url = "", append = false)
{ 
  var boilerAPI = apiBase + "boilers/" + finalBoiler + "/" + bedPower;
  var query = $('.filter-list').serialize();

  if (!url)
    url = boilerAPI;

  if (xhr)
    xhr.abort();

  xhr = $.ajax({
                url: url, 
                type: "GET",
                data: query,
                dataType: "json", 
                beforeSend: function () {
                    $('.loader').show();
                },
                complete: function () {
                    $('.loader').hide();
                },     
                success:function(data)
                {
                   //console.log(data);
                   create_list_item(data, append);
                   if (data.boiler)
                      next_page_url = data.boiler.next_page_url;
                   choose_boiler_click(); 
                }

        });
  
}

$('.category-item').click(function(){
  $('#show-category').text($(this).text());
  $('#cat').val($(this).attr('data-value'));
  oldScroll = 0;
  filter();
});

$('.sort-item').click(function(){
  $('#show-sort').text($(this).text());
  $('#sort_by').val($(this).attr('data-sort-by'));
  $('#sort').val($(this).attr('data-sort'));
  oldScroll = 0;
  filter();
});


function choose_boiler_click()
{
  $('.choose-boiler').click(function(){
  var boiler = $(this).attr('data-boiler');   
  $.ajax({
      url: "{!! route('update-answer') !!}", 
      type: "POST",
      data: {
                completed_wizard: 'page.boilers',
                boiler: boiler
            },
      dataType: "json",      
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
          var selection = data.selection;
          
          if (data.success)
            location.href = "{!! route('page.controls') !!}";
        
      }

  });
  });
}



</script> 
@endsection

