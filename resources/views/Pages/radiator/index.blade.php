@extends('pages.layouts.master')

@section('title') Radiator @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler','control'] @endphp

@php $Selection = Session()->get('selection') @endphp

@section('content')
<div class="want-radiator-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-center mb-4">Do you require radiators?</h2>
                    <p class="text-center text-black-light mb-5">Choose up to 10 new radiators and we’ll fit these during your boiler installation. We can only fit new radiators in place of existing ones, not in new locations.</p>
                </div>
            </div>
            <div class="want-radiator">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-6">
                        <a href="#" class="want-radiator-item want-radiator-yes p-4 p-md-5">
                            <img src="{!! asset('assets/img/icon-check.png') !!}" alt="Want Radiator?" class="img-fluid mb-4">
                            <span class="h4 font-medium">Yes</span>
                            <span class="btn btn-secondary text-white">Select</span>
                        </a>
                    </div>
                    <div class="col-lg-4 col-6">
                        <a href="{!! route('page.smart-devices') !!}" class="want-radiator-item want-radiator-no p-4 p-md-5">
                            <img src="{!! asset('assets/img/icon-cross.png') !!}" alt="Want Radiator?" class="img-fluid mb-4">
                            <span class="h4 font-medium">No</span>
                            <span class="btn btn-secondary text-white">Select</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="choose-radiator">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-center mb-4">Choose radiator</h2>
                    <p class="text-center text-black-light mb-5">Choose up to 10 new radiators and we’ll fit these during your boiler installation. We can only fit new radiators in place of existing ones, not in new locations.</p>
                </div>
            </div>

            <div class="control-listing">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card p-4 p-lg-5">
                            <div class="row justify-content-center">
                                <div class="col-md-5 text-center">
                                    <img src="{!! $radiator->image !!}" alt="Radiator" class="img-fluid w-100 choose-radiator mb-5 mx-auto">
                                    <h5 class="f-20">{{ $radiator->radiator_name }}</h5>
                                    <p class="font-semibold text-secondary mb-4">£{{ $radiator->price }}</p>
                                    <p><small>{{ $radiator->summary }}</small></p>
                                    <a href="#" class="text-secondary"><small>More Info</small></a>
                                </div>
                            </div>
                            <div class="row border-top-1 pt-4 mt-5">
                                <div class="col-xl-4 col-md-12 mb-4">
                                    <label for="type" class="ps-4 mb-2">Type</label>
                                    <select class="form-select mb-4" aria-label="Type" id="type">
                                        {{--
                                        <option value="k1" selected>Single Convertor (K1)</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        --}}
                                        @foreach($radiator_types as $radiator_type)
                                            <option value="{!! $radiator_type->id !!}">{{ $radiator_type->type }}</option>
                                        @endforeach    
                                    </select>
                                    <small class="text-black-light d-block mb-3">If we don’t offer the exact size you need please choose the nearest smaller size to your current radiator.</small>
                                    <a href="#" class="text-danger"><small>Help me choose</small></a>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <label for="height" class="ps-4 mb-2">Height (mm)</label>
                                    <select class="form-select mb-4" aria-label="Height (mm)" id="height">
                                        {{--
                                        <option value="600" selected>600</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        --}}
                                        @foreach($radiator_heights as $radiator_height)
                                            <option value="{!! $radiator_height->id !!}">{{ $radiator_height->height }}</option>
                                        @endforeach
                                    </select>
                                    <a href="#" class="text-danger"><small>Help me choose</small></a>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <label for="length" class="ps-4 mb-2">Length (mm)</label>
                                    <select class="form-select mb-4" aria-label="Length (mm)" id="length">
                                        {{--<option value="1600" selected>1600</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        --}}
                                        @foreach($radiator_lengths as $radiator_length)
                                            <option value="{!! $radiator_length->id !!}">{{ $radiator_length->length }}</option>
                                        @endforeach
                                    </select>
                                    <a href="#" class="text-danger"><small>Help me choose</small></a>
                                </div>
                            </div>
                            <div class="row border-top-light-1 pt-4">

                                <div class="alert alert-danger alert-dismissable" id="cart_error" style="display:none">
                                    <button type="button" class="close" data-dismiss="alert" onclick="$(this).parents('.alert').hide()">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <span class="cart_error_message"></span> 
                                </div>

                                <div class="col-lg-4 col-md-4 mb-4 ps-4 ">
                                    <label class="mb-2">Total BTU:</label>
                                    <p>{{$radiator->btu}}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 mb-4">
                                    <label for="quantity" class="ps-4 mb-2">Quantity</label>
                                    
                                    <div class="input-group input-inc-dec mb-3 ms-0">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity" id="quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>

                                    @php 
                                    
                                    $cart_count = !empty($Selection['radiator']['quantity'])?$Selection['radiator']['quantity']:0;
                                    $cart_price = round($cart_count*$radiator->price,2);

                                    @endphp

                                    <span class="text-danger"><small><span class="basket_count">{{ !empty($Selection['radiator']['quantity'])?$Selection['radiator']['quantity']:0 }}</span> in the basket</small></span>
                                    <p class="text-black-50"><small>Up to 10 radiators</small></p>
                                </div>
                                <div class="col-lg-4 col-md-4 mb-4 ps-md-5">
                                    <label for="total" class="mb-2">Total price</label>
                                    <h3 class="mb-0">£<span class="total_price" id="cart_total_price">{{ $cart_price }}</span></h3>
                                    <small class="mb-4 d-block">including VAT</small>
                                    <a href="javascript:void(0)" class="btn btn-outline-secondary btn-add-radiator">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card p-4">
                            <div class="card-light p-4 text-center mb-4">
                                <p class="text-primary">Your fixed price including installation & radiators</p>
                                <h3 class="m-0">£{{ $boiler->price - $boiler->discount??0 }}</h3>
                                <small class="d-block mb-4">including VAT</small>
                                <a href="{!! route('page.smart-devices') !!}" class="btn btn-secondary d-block mb-4">Next</a>
                                <a href="#" class="text-secondary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                            </div>
                            <div class="card-light p-4 mb-4">
                                <p class="f-18 font-medium side-card-title text-primary">Radiator</p>
                                <ul class="side-card-list list-unstyled">
                                    <li>
                                        <p class="f-15 font-medium mb-0"><span class="basket_count">{{$cart_count}}</span>x {{$radiator->radiator_name}}</p>
                                        <p class="m-0">£<span class="total_price">{{$cart_price}}</span></p>
                                        @if ($cart_count)
                                        <a href="javascript:void(0)" class="text-danger btn-remove-radiator" >Remove</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="card-light p-4 mb-4">
                                <p class="f-18 font-medium side-card-title text-primary">Control</p>
                                <ul class="side-card-list list-unstyled">
                                    <li>
                                        <p class="f-15 text-secondary mb-0">Control Selected</p>
                                        <p class="f-15 font-medium mb-2">{{ $addon->addon_name}}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-light p-4 mb-4">
                                <p class="f-18 font-medium side-card-title text-primary">Boiler information</p>
                                <ul class="side-card-list list-unstyled">
                                    <li>
                                        <p class="f-15 text-secondary mb-0">Boiler Selected</p>
                                        <p class="f-15 font-medium mb-2">{{ $boiler->boiler_name }} £{{ $boiler->price - $boiler->discount??0 }}</p>
                                    </li>
                                    <li>
                                        <p class="f-15 text-secondary mb-0">Current boiler type</p>
                                        <p class="f-15 font-medium mb-2">{{ $boiler->boiler_type }}</p>
                                    </li>
                                    {{--
                                    <li>
                                        <p class="f-15 text-secondary mb-0">Moving boiler to</p>
                                        <p class="f-15 font-medium mb-2">
                                            <span class="d-block">Utility Room</span>
                                            £700
                                        </p>
                                    </li>
                                    --}}
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
        </div>
@endsection

@section('custom-scripts')
<script>
    $('.btn-add-radiator').click(function(){

     var quantity = $('#quantity').val();   
     if (!quantity)
     {
        $('#cart_error .cart_error_message').html('Please choose quantity.');
        $('#cart_error').show().attr('tabindex','-1').focus().removeAttr('tabindex');
        setTimeout(() => {
        $('#cart_error').hide();    
        }, 5000);
        return false;
     }

     if (quantity>10)
     {
        $('#cart_error .cart_error_message').html('Please choose quantity not more than 10.');
        $('#cart_error').show().attr('tabindex','-1').focus().removeAttr('tabindex');
        setTimeout(() => {
        $('#cart_error').hide();    
        }, 5000);
        return false;
     }

     add_to_cart(1,quantity);

    });

 function add_to_cart(action,quantity)
 {
    $.ajax({
                url: "{!! route('update-answer') !!}", 
                type: "POST",
                data: {
                        completed_wizard: 'page.radiators',
                        radiator: "{!! $radiator->id !!}",  
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
                  
                  if (data.success)
                    {
                       if (action=='0')
                          {
                            $('.basket_count').html('0');
                            $('.total_price').html('0');
                          }
                       else if (action=='1')
                         {
                            $('.btn-add-radiator').html('Added');
                            location.reload();
                         }         
                    }
                  
                }

            });
  
 }   

@if(isset($Selection['radiator'])) 
$(".want-radiator-yes").click();
@endif 

$('.btn-remove-radiator').click(function(){
add_to_cart(0,0);
});

function update_total()
{
    var quantity = $('#quantity').val();
    var rate = {!! $radiator->price !!};
    var total = quantity * rate;
    $('#cart_total_price').html(total.toFixed(2));

}

$('#quantity').change(function(){
    update_total();
});

function increase_decrease_event()
{
    $('.input-inc-dec').on('click', '.increase', function (event) {
	var value = $(this).closest('.input-inc-dec').find('input').val();
	value = isNaN(value) ? 0 : value;
	value++;
	$(this).closest('.input-inc-dec').find('input').val(value);
    
    update_total();

    });

    $('.input-inc-dec').on('click', '.decrease', function (event) {
	var value = $(this).closest('.input-inc-dec').find('input').val();
	value = isNaN(value) ? 0 : value;
	value < 1 ? value = 1 : '';
	value--;
	$(this).closest('.input-inc-dec').find('input').val(value);
    
    update_total();

    });
}

$('.input-inc-dec, .increase, .decrease').unbind();  
increase_decrease_event();

</script>    
@endsection