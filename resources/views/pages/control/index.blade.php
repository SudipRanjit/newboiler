@extends('pages.layouts.master')

@section('title') Control @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler'] @endphp

@php $Selection = Session()->get('selection') @endphp

@section('content')
<div class="row justify-content-center question-wrapper">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Choose a Control</h2>
                <p class="text-center text-black-light mb-5">Choose a control for the boiler. We will help you with the installation and usage</p>
            </div>
        </div>

        <div class="filter_params d-flex flex-wrap justify-content-between mb-4">
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
       </div>

        <div class="control-listing">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row control-items">
                        <div class="col-md-6 mb-4" id="control-item_0" style="display:none" >
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest.jpg') !!}" alt="Nest" class="control-pic">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium control-name">Google Nest 3rd Gen</h4>
                                    <span class="font-semibold text-secondary d-block mb-4 control-price">FREE</span>
                                    <p class="m-0"><small class="control-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#control-info" class="text-secondary d-block mb-4 more_info"><small>More Info</small></a>
                                    
                                    <a href="javascript:void(0)" class="btn btn-outline-secondary d-block btn-action-control btn-added-control">Added</a>
                                    <a href="javascript:void(0)" class="btn btn-outline-secondary w-100 btn-action-control btn-choose-control" >Choose</a>
                                   
                                </div>

                            </div>
                        </div>

                        @if($boiler->addon)
                        <div class="col-md-6 mb-4 control-record" data-control="{{$boiler->addon->id}}">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest.jpg') !!}" alt="Nest" class="control-pic">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium control-name">{{$boiler->addon->addon_name}}</h4>
                                    <span class="font-semibold text-secondary d-block mb-4 control-price">{{ $boiler->addon->price?'£'.$boiler->addon->price:'FREE'}}</span>
                                    <p class="m-0"><small class="control-summary">{{$boiler->addon->summary}}</small></p>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#control-info" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    
                                   @if($boiler->addon->id==$Selection['control']) 
                                    <a href="javascript:void(0)" class="btn btn-outline-secondary d-block btn-action-control btn-added-control" data-control="{{$boiler->addon->id}}">Added</a>
                                   @else
                                   <a href="javascript:void(0)" class="btn btn-outline-secondary w-100 btn-action-control btn-choose-control" data-control="{{$boiler->addon->id}}">Choose</a>
                                   @endif
                                  

                                </div>
                            </div>
                        </div>
                        @endif
                        {{--
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/hive.jpg') !!}" alt="hive">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Google Hive</h4>
                                    <span class="font-semibold text-secondary d-block mb-4">FREE</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    <a href="#" class="btn btn-outline-secondary w-100">Choose</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/control-3.jpg') !!}" alt="control-3">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Control 3</h4>
                                    <span class="font-semibold text-secondary d-block mb-4">£199</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    <a href="#" class="btn btn-outline-secondary w-100">Choose</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/control-4.jpg') !!}" alt="control-4">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Control 4</h4>
                                    <span class="font-semibold text-secondary d-block mb-4">£299</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    <a href="#" class="btn btn-outline-secondary w-100">Choose</a>
                                </div>

                            </div>
                        </div>
                       --}} 
                    </div>

                  <div class="row mt-3 mb-4" style="display:none" id="div_view_more">
                    <div class="col-md-4">  
                    <a href="javascript:void(0)" class="btn btn-outline-secondary" id="a_view_more">View More</a>    
                    </div>
                  </div>  

                </div>
                <div class="col-lg-4">
                    <div class="card p-4">
                        <div class="card-light p-4 text-center mb-4">
                            <p class="text-primary">Your fixed price including installation & radiators</p>
                            <h3 class="m-0">£<span class="net-total-price">{{ $Selection['total_price'] }}</span></h3>
                            <small class="d-block mb-4">including VAT</small>
                            <a href="{!! route('page.radiators') !!}" class="btn btn-secondary d-block mb-4">Next</a>
                            <a href="#" class="text-secondary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                        </div>
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Control</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 text-secondary mb-0" id="p_control_selected_label">{{ $addon?'Control Selected':'Control Not Selected'}}</p>
                                    <p class="f-15 font-medium mb-2" id="p_control_selected">{{ $addon->addon_name??''}} {{ !empty($addon->price)?'£'.$addon->price:'' }}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Boiler information</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 text-secondary mb-0">Boiler Selected</p>
                                    <p class="f-15 font-medium mb-2"><a href="{!! route('page.boiler', ['id' => $boiler->id]) !!}">{{ $boiler->boiler_name }} £{{ $boiler->price - $boiler->discount??0 }}</a></p>
                                </li>
                                <li>
                                    <p class="f-15 text-secondary mb-0">Current boiler type</p>
                                    <p class="f-15 font-medium mb-2">{{ $boiler->boiler_type }}</p>
                                </li>

                                @if (!empty($Selection['moving_boiler']['type']))
                                <li>
                                    <p class="f-15 text-secondary mb-0">Moving boiler to</p>
                                    <p class="f-15 font-medium mb-2">
                                        <span class="d-block">{{ $Selection['moving_boiler']['type'] }}</span>
                                        £{{ $Selection['moving_boiler']['price'] }}
                                    </p>
                                </li>
                                @endif

                                @if (!empty($Selection['scaffolding']['type']))
                                <li>
                                    <p class="f-15 text-secondary mb-0">Scaffolding</p>
                                    <p class="f-15 font-medium mb-2">
                                        <span class="d-block">{{ $Selection['scaffolding']['type'] }}</span>
                                        £{{ $Selection['scaffolding']['price'] }}
                                    </p>
                                </li>
                                @endif

                                @if (!empty($Selection['conversion_charge']))
                                <li>
                                    <p class="f-15 text-secondary mb-0">Conversion charge (converting to a Combi boiler)</p>
                                    <p class="f-15 font-medium mb-2">
                                        £{{ $Selection['conversion_charge'] }}
                                    </p>
                                </li>
                                @endif

                            </ul>
                        </div>
                        <div class="card-light p-4">
                            <p class="f-18 font-medium side-card-title text-primary">Extras included</p>
                            <ul class="side-card-list list-unstyled side-card-extras">
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Extended Warranty</span>
                                        <span>12 years</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Carbon Monoxide Alarm</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Magnetic Filter </span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Chemical Flush</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Fernox Magnetic Scale Remover</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Fernox F1 Central Heating Protector</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Fernox F3 Central Heating Cleaner</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection

@section('custom-scripts')
<script>

var xhr = null;
var apiBase = "{{ asset('/api/new') }}/";
var next_page_url = '';

var selection = JSON.parse('{!! json_encode($Selection) !!}');

function fetch(url = '', append = false)
{ 
  
  var controlAPI = "{!! route('new.controls') !!}";
  if (!url)
    url = controlAPI;

  if (xhr)
    xhr.abort();

  xhr = $.ajax({
                
                url: url,
                type: "GET",
                dataType: "json",
                data: {ids: "{!! $boiler_addon_ids_string !!}" },
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
                   next_page_url = data.control.next_page_url;
                   if (next_page_url)
                    $('#div_view_more').show();
                   else 
                    $('#div_view_more').hide();

                   choose_control_click(); 
                   more_info_click();
                }

        });
  
}

function create_list_item(data, append=false)
{
  if (!append)
    $('.control-items .control-record').remove();

  $.each(data.control.data, function(key, value)
        {
            var item = $('#control-item_0').clone();
            item.show();
            item.removeAttr('id');
            item.addClass('control-record');
            item.attr('data-control',value.id);
            
            item.find('.control-pic').attr("src",value.image);      
            item.find('.control-name').html(value.addon_name);
            item.find('.control-summary').html(value.limited_summary);
            
            if (value.price)
                item.find('.control-price').html("£"+value.price);
            else
                item.find('.control-price').html("FREE");    
            
            item.find('.btn-choose-control').attr('data-control',value.id);
            item.find('.btn-added-control').attr('data-control',value.id);  
                        
            if (selection.control && value.id==selection.control)
                item.find('.btn-choose-control').remove();
            else    
                item.find('.btn-added-control').remove();

            item.find(".more_info").attr("id", value.id);

            $('.control-items').append(item);  

        });
}

fetch('',true);

choose_control_click();

more_info_click();

function more_info_click(){
  $(".more_info").click(function(){
    var id = $(this).attr('id');

    var url = "/api/control-devices/"+id;

  if (xhr)
    xhr.abort();

  xhr = $.ajax({
      url: url,
      type: "GET",
      dataType: "json",
      beforeSend: function () {
          $('.loader').show();
      },
      complete: function () {
          $('.loader').hide();
      },     
      success:function(data)
      {
        var value = data.device;
        console.log(value.addon_name);
        $('#controlLabel').html(value.addon_name);
        $('#controlDescription').html(value.description);
        $('#controlImage').attr("src",value.image);
        if (value.price)
            $('#controlPrice').html("£"+value.price);
        else
            $('#controlPrice').html("FREE");    
        // $("#control-info").css("opacity", "1");
        // $("#control-info").fadeIn(200);

        // $("#controlInfoClose").click(function(){
        //   $("#control-info").fadeOut(200);
        // })
      }

      });
  });
}

function choose_control_click()
{
  $('.btn-choose-control').click(function(){
  var el =$(this);
  var control = el.attr('data-control');
  var control_name = el.parents('.control-record').find('.control-name').text();
  var control_price = el.parents('.control-record').find('.control-price').text();
    
  $.ajax({
                url: "{!! route('update-answer') !!}", 
                type: "POST",
                data: {
                        completed_wizard: 'page.controls',  
                        control: control
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
                  
                  $(".btn-action-control").not(el).removeClass("d-block btn-added-control").addClass("w-100 btn-choose-control").html("Choose");
                  el.removeClass("w-100 btn-choose-control").addClass("d-block btn-added-control").html("Added");
                  
                  $('#p_control_selected_label').text('Control Selected');
                  $('#p_control_selected').text(control_name+' '+control_price);
                  
                  $(".btn-action-control").unbind();  
                  choose_control_click();

                  $(".net-total-price").html(data.selection.total_price);
                }

            });
  });
}

$('#a_view_more').click(function(){
   if (next_page_url)
       fetch(next_page_url,true);  
});

</script>
@endsection    