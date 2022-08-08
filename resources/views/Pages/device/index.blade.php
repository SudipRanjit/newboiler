@extends('pages.layouts.master')

@section('title') Smart Device @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler','control','radiator'] @endphp

@php $Selection = Session()->get('selection') @endphp

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Add Smart Devices</h2>
                <p class="text-center text-black-light mb-5">We’ll install your smart home devices, connect them up & show you how they work</p>
            </div>
        </div>

        <div class="control-listing">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row control-items">
                        <div class="col-md-6 mb-4" id="control-item_0" style="display:none">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/trv.jpg') !!}" alt="Thermostatic radiator valve (TRV)" class="control-pic">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium control-name">Thermostatic radiator valve (TRV)</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£<span class="control-price">35</span></span>
                                    <p class="m-0"><small class="control-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control control-quantity" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-outline-secondary px-5 btn-action btn-add" onclick="btn_click(this)">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                       {{-- 
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest-mini.jpg') !!}" alt="Nest Mini">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Mini</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£49</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest-hub-g2.jpg') !!}" alt="Nest Hub Gen 2">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Hub Gen 2</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£79.99</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest-alarm.jpg') !!}" alt="Nest Protect smoke and CO alarm">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Protect smoke and CO alarm</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£109</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/cam.jpg') !!}" alt="Nest Cam Indoor">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Cam Indoor</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£129.99</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/cam-doorbell.jpg') !!}" alt="Google Nest Doorbell">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Google Nest Doorbell</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£179.99</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
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
                            <a href="{!! route('page.booking') !!}" class="btn btn-secondary d-block mb-4">Next</a>
                            <a href="#" class="text-secondary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                        </div>
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Smart Devices {{--(<span id="added_devices_count">{{$devices?count($devices):0}}</span>)--}}</p>
                            <ul class="side-card-list list-unstyled" id="added_devices">
                                <li id="added_devices_li_0" style="display:none">
                                    <p class="f-15 font-medium mb-0"><span class="device-quantity">1</span>x <span class="device-name">Thermostatic radiator valve (TRV)</span></p>
                                    <p class="m-0 device-price">£</p>
                                    <a href="javascript:void(0)" class="text-danger mb-2 d-block btn-device-remove" >Remove</a>
                                </li>

                                @if($devices)
                                    @foreach($devices as $device)
                                    <li id="added_devices_li_{{$device->id}}">
                                        <p class="f-15 font-medium mb-0"><span class="device-quantity">{{ $Selection['devices'][$device->id]['quantity'] }}</span>x  <span class="device-name">{{$device->device_name}}</span></p>
                                        <p class="m-0  device-price">
                                            @if($Selection['devices'][$device->id]['quantity']>1)
                                                £{{round($device->price * $Selection['devices'][$device->id]['quantity'],2)}} (£{{$device->price}}*{{$Selection['devices'][$device->id]['quantity']}})
                                            @else
                                                £{{$device->price}}
                                            @endif    
                                        </p>
                                        <a href="javascript:void(0)" class="text-danger mb-2 d-block btn-device-remove" onclick="added_devices_remove({{$device->id}})">Remove</a>
                                    </li>
                                    @endforeach
                                @endif

                               {{-- 
                                <li>
                                    <p class="f-15 font-medium mb-0">2x Nest Mini</p>
                                    <p class="m-0">£98</p>
                                    <a href="#" class="text-danger mb-2 d-block">Remove</a>
                                </li>
                                --}}
                            </ul>
                        </div>
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Control</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 text-secondary mb-0">Control Selected</p>
                                    <p class="f-15 font-medium mb-2"><a href="{!! route('page.controls') !!}">{{ $addon->addon_name}}</a></p>
                                </li>
                            </ul>
                        </div>

                        @if(!empty($radiator))
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Radiator</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 font-medium mb-0"><span class="basket_count"><a href="{!! route('page.radiators') !!}">{{$Selection['radiator']['quantity']}}</span>x {{$radiator->radiator_name}}</a></p>
                                    <p class="m-0">£<span class="total_price">{{round($Selection['radiator']['quantity']*$radiator->price,2);}}</span></p>
                                    @if(!empty($Selection['radiator_type']))
                                    <p class="m-0">Type: {{ $radiator_type->type}}</p>
                                    @endif
                                    @if(!empty($Selection['radiator_height']))
                                    <p class="m-0">Height: {{ $radiator_height->height }}mm</p>
                                    @endif
                                    @if(!empty($Selection['radiator_length']))
                                    <p class="m-0">Length: {{ $radiator_length->length }}mm</p>
                                    @endif

                                </li>
                            </ul>
                        </div>
                        @endif

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
var apiBase = "{{ url('/api/new') }}/";
var next_page_url = '';

var selection = JSON.parse('{!! json_encode($Selection) !!}');

function fetch(url = '', append = false)
{ 
  var controlAPI = apiBase + "devices/";
  
  if (!url)
    url = controlAPI;

  if (xhr)
    xhr.abort();

  xhr = $.ajax({
                url: url, 
                type: "GET",
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
                   next_page_url = data.device.next_page_url;
                   if (next_page_url)
                    $('#div_view_more').show();
                   else 
                    $('#div_view_more').hide();

                }

        });
  
}

function create_list_item(data, append=false)
{
  if (!append)
    $('.control-items .control-record').remove();

  $.each(data.device.data, function(key, value)
        {
            var item = $('#control-item_0').clone();
            item.show();
            item.attr('id','control-item_'+value.id);
            item.addClass('control-record');
            
            item.find('.control-pic').attr("src",value.image);      
            item.find('.control-name').html(value.device_name);
            item.find('.control-summary').html(value.summary);
            
            if (value.price)
                item.find('.control-price').html(value.price);
            
            item.find('.btn-action').attr('data-device',value.id);  

            if (selection.devices &&  Object.keys(selection.devices).indexOf(value.id.toString())>-1)
                {
                    item.find('.btn-action').removeClass('btn-add').addClass('btn-remove').text('Remove');
                    item.find('.control-quantity').val(selection.devices[value.id.toString()]['quantity']);    
                }
            else    
                item.find('.btn-action').removeClass('btn-remove').addClass('btn-add').text('Add');
           

            

            $('.control-items').append(item);

            $('.input-inc-dec, .increase, .decrease').unbind();  
            increase_decrease_event();

        });
}

fetch();

function btn_click(el)
{
  el = $(el);
  var device = el.attr('data-device');
  var device_name = el.parents('.control-record').find('.control-name').text();
  var device_price = el.parents('.control-record').find('.control-price').text();
  var quantity = el.parents('.control-record').find('.control-quantity').val();
  quantity = parseInt(quantity);

  var action = el.hasClass('btn-add')?1:0;
 
  if (action && !quantity)
    {
        alert('Please provide quantity to add.');
        return false;
    }

  $.ajax({
                url: "{!! route('update-answer') !!}", 
                type: "POST",
                data: {
                        completed_wizard: 'page.smart-devices',  
                        device: device,
                        action: action,
                        quantity: quantity 
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
                  
                  if (action)
                    {
                        el.removeClass('btn-add').addClass('btn-remove').text('Remove');
                        $('#added_devices_li_'+device).remove();

                        var li = $('#added_devices_li_0').clone();
                        li.attr('id','added_devices_li_'+device).addClass('added-devices-li').show();
                        li.find('.device-name').html(device_name);

                        if (quantity>1)
                            li.find('.device-price').html('£'+(device_price*quantity).toFixed(2)+' (£'+device_price+'*'+quantity+')');
                        else
                            li.find('.device-price').html('£'+device_price);

                        li.find('.device-quantity').html(quantity);    

                        li.find('.btn-device-remove').attr('onclick',"added_devices_remove("+device+")");

                        $('#added_devices').append(li);
                        
                    }
                  else
                    {
                        el.removeClass('btn-remove').addClass('btn-add').text('Add');  
                        $('#added_devices_li_'+device).remove();
                    }

                    //$('#added_devices_count').text(Object.keys(data.selection.devices).length);
                    $(".net-total-price").html(data.selection.total_price);

                    

                }

            });

}

$('#a_view_more').click(function(){
   if (next_page_url)
       fetch(next_page_url,true);  
});

function added_devices_remove(device)
{
    $('#added_devices_li_'+device).remove();
    $.ajax({
                url: "{!! route('update-answer') !!}", 
                type: "POST",
                data: {
                        completed_wizard: 'page.smart-devices',  
                        device: device,
                        action: 0
                         
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
                  
                    $('#control-item_'+device).find('.btn-remove').addClass('btn-add').text('Add');
                    
                    $('#added_devices_li_'+device).remove();
                    
                    //$('#added_devices_count').text(Object.keys(data.selection.devices).length);
                    
                    selection = data.selection;

                    $(".net-total-price").html(data.selection.total_price);

                }

            });
 

}

function increase_decrease_event()
{
    $('.input-inc-dec').on('click', '.increase', function (event) {
	var value = $(this).closest('.input-inc-dec').find('input').val();
	value = isNaN(value) ? 0 : value;
	value++;
	$(this).closest('.input-inc-dec').find('input').val(value);
    
    if (value)
        $(this).closest('.control-item').find('.btn-remove').removeClass('btn-remove').addClass('btn-add').text('Add');
    });

    $('.input-inc-dec').on('click', '.decrease', function (event) {
	var value = $(this).closest('.input-inc-dec').find('input').val();
	value = isNaN(value) ? 0 : value;
	value < 1 ? value = 1 : '';
	value--;
	$(this).closest('.input-inc-dec').find('input').val(value);
    
    if (value)
        $(this).closest('.control-item').find('.btn-remove').removeClass('btn-remove').addClass('btn-add').text('Add');
    });

}

</script>
@endsection    