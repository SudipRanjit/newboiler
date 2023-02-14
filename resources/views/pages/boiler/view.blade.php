<!DOCTYPE html>
<html lang="en">

@php $completed_wizards = [] @endphp

@php $Selection = Session()->get('selection') @endphp

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
@endsection
    
@include('pages.layouts.partials._links')

<body class="bg-s-light">
<div class="navbar-grad gasking-header">

    @include('pages.layouts.partials._header')

    @include('pages.layouts.partials._nav')

</div>

<div class="main-container mt-4r">
    {{-- <div class="gasking-title-top">
        <div class="container">
            <div class="gasking-title-container d-lg-flex align-items-center justify-content-md-between">
                <div class="gasking-title">
                    <h1 class="text-secondary">New Boiler</h1>
                    <p class="text-white mb-4 mb-lg-0">New Boiler Installations in London and the surrounding area </p>
                </div>
                <div class="gasking-btn-container d-sm-flex">
                    <a href="#" class="btn btn-outline-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center" data-bs-toggle="modal" data-bs-target="#see-everything">
                        <i class="fa-solid fa-plus me-2"></i>
                        See everything included
                    </a>
                    <a href="{!! route('page.index') !!}" class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center">
                        <i class="fa-solid fa-arrow-rotate-right me-2"></i>
                        Restart
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="bg-white">  
        <div class="container pb-5">

            @include('pages.layouts.partials._menu')

            <div class="loader">
                <img src="{!! asset('assets/img/loader.svg') !!}" >        
            </div> 

            <div class="boiler-detail-container">
                <div class="row">
                    <div class="col-md-4 col-lg-4 offset-md-1">
                        <img src="{!! $boiler->image !!}" alt="Boiler" class="img-fluid w-100">
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="boiler-detail pt-md-4">
                            <div class="boiler-pro mb-3">
                              @if($boiler->latest)
                                <span class="boiler-latest">
                                    <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                    Latest
                                </span>
                              @endif 
                              @if($boiler->popular)
                                <span class="boiler-popular">
                                    <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                    Popular
                                </span>
                              @endif
                            </div>
                            <h1 class="border-bottom pb-4 mb-4">{{ $boiler->boiler_name }}</h1>
                            
                            <p class="m-0">Your fix price including installation</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#see-everything" class="text-secondary d-block mb-4">+ See everything included</a>
                            
                            @if ($boiler->discount)
                            <h3>£{{ $boiler->price - $boiler->discount }}</h3>
                            @else
                            <h3>£{{ $boiler->price }}</h3>
                            @endif

                            @if ($boiler->discount)
                            <h5 class="text-danger mb-3"><s>£{{ $boiler->price }}</s> </h5>

                            <h3>Save up to £{{ $boiler->discount }}</h3>
                            @endif
                            <div class="d-flex flex-wrap m-n-2">
                                <a href="javascript:void(0)" class="btn btn-secondary text-white m-2 choose-boiler">Choose Boiler</a>
                                <a href="#" class="btn btn-light text-secondary d-flex align-items-center m-2 save_this_quote" data-bs-toggle="modal" data-boiler={{$boiler->id}} data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
           
            
        </div>
    </div> 
    
    <div class="container py-5">
        <div class="d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="boiler-about mb-5">
                    <p class="f-20 font-medium boiler-sub-title"><i class="fa-solid fa-exclamation"></i>About Boiler</p>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            {{--
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In blandit libero nec metus sodales, nec dictum lorem tempor. Donec eget arcu at odio rhoncus imperdiet ut vel nulla. Sed eu gravida augue. Donec turpis orci, ullamcorper nec leo a, tempus auctor lorem. Aliquam gravida ut purus eget posuere.</p>
                            <p class="mb-5 mb-lg-0">Curabitur vel placerat erat, vitae eleifend erat. Integer magna nibh, pretium sit amet egestas accumsan, fermentum in nibh. Aliquam posuere, tellus vel vehicula mattis, sapien lorem placerat diam, sit amet posuere turpis enim in leo.</p>
                            --}}
                            {!! $boiler->description !!}    
                        </div>
                        <div class="col-lg-6 col-xl-5 offset-xl-1">
                            <ul class="list-unstyled boiler-features">
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/cube.png') !!}" alt="Measurements">
                                        Measurements <small class="text-black-50 ps-2"> (HxWxD)</small>
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->measurements }}
                                        <span class="text-black-50">mm</span>
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                        Warranty
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->warranty }} 
                                        <span class="text-black-50">years</span>
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/type.png') !!}" alt="Boiler Type">
                                        Boiler type
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->boiler_type }}
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/bolt.png') !!}" alt="Bolt">
                                        Fuel type
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->fuel_type }}
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/sun.png') !!}" alt="Bolt">
                                        Solar compatible
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->solar_compatibility }}
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Bolt">
                                        Flow rate
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->flow_rate }}
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/temperature.png') !!}" alt="Temperature">
                                        Central heating output
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->central_heating_output }} <span class="text-black-50">kW</span>
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/tap.png') !!}" alt="Tap">
                                        Hot water output
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->hot_water_output }} <span class="text-black-50">kW</span>
                                    </span>
                                </li>
                                <li class="boiler-feature mb-2">
                                    <span class="boiler-feature-title">
                                        <img src="{!! asset('assets/img/boiler-icons/efficiency.png') !!}" alt="Efficiency">
                                        Efficiency rating
                                    </span>
                                    <span class="boiler-feature-desc">
                                        {{ $boiler->effiency_rating }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="boiler-included">
                    <p class="f-20 font-medium boiler-sub-title"><i class="fa-solid fa-plus"></i>What else is included with the boiler?</p>
                    <div class="bg-g-light border-r-1 p-4 p-lg-5">
                        <div class="row align-items-center">
                            <div class="col-lg-6 pe-lg-5">                    
                                <img style="width:100%;" src="{!! asset('assets/img/boiler-select.png?v1.1') !!}" alt="Boiler" class="img-fluid w-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="accordion pt-5 pt-lg-0" id="accordionBoiler">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingDescOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Boiler & pipework installation, including any alterations and upgrades</button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingDescOne" data-bs-parent="#faqAccordian">
                                            <div class="accordion-body pb-4">
                                                We'll install your new boiler and won't leave until it's working and tested. We know every job is different so we include all pipework alterations to accommodate your new boiler within your fixed price. We will also install your condensate pipe, and upgrade the pipe from your gas meter to boiler, if required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          New Flue Installation and any required brickwork
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Electrical work
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Removal and disposal of existing boiler
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__5">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Removal of existing tanks and cylinder
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__6">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Gasking register the warranty & Building Control Certificate
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__7">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free Nest Learning Thermostat (3rd Generation) & Stand or Hive Active Heating Thermostat
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__8">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free Magnetic central heating Filter
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__9">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free Fernox Magnetic Scale Remover
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__10">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free Carbon Monoxide Detector
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__11">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free MagnaCleanse system flush
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__12">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free Fernox F3 Central Heating Cleaner
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__13">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free Fernox F1 central heating protector
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__14">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free Pipework installation, alterations, and upgrades
                                        </button>
                                      </h2>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading__15">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                          Free extended Boiler Aftercare: 10 years warranty ( Warranty must be reactive)
                                        </button>
                                      </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
 </div>

@include('pages.layouts.partials._footer')

<div class="modal fade" id="save-quote" tabindex="-1" aria-labelledby="save-quoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 p-lg-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="modal-title mb-4" id="save-quoteLabel">Save Your Quote</h2>
                        <p class="mb-5">Maecenas consequat felis nisi, in ullamcorper tortor viverra quis. Sed gravida diam ullamcorper purus vulputate accumsan. </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <form action="#">
                            <div class="mb-4">
                                <label for="email-quota" class="form-label ps-4">Email address</label>
                                <input type="text" class="form-control" id="email-quota" placeholder="Email address">
                            </div>
                            <div class="mb-4">
                                <label for="contact-quota" class="form-label ps-4">Contact number</label>
                                <input type="text" class="form-control" id="contact-quota" placeholder="Contact number">
                            </div>
                            <div class="form-check mb-5">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="agree-quota">
                                <label class="form-check-label" for="agree-quota">
                                    <small>I’m happy to...Fusce eget leo at lacus blandit luctus. Donec lacus libero, ultrices sed molestie sed, elementum nec sem. Phasellus dapibus molestie massa id mattis. Fusce in ligula augue. Donec euismod nibh ac lacinia consectetur.</small>
                                    <a href="#" class="text-secondary"><small>Privacy Policy</small></a>
                                </label>
                            </div>
                            <button class="btn btn-secondary w-100">Save Quote</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="see-everything" tabindex="-1" aria-labelledby="see-everythingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 p-lg-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="modal-title mb-4" id="see-everythingLabel">Included in your fixed price</h2>
                        <p class="mb-5">We include everything needed to make your installation hassle-free and your heating system run like a dream.</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="accordion" id="faqAccordian">
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Boiler & pipework installation, including any alterations and upgrades</button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordian">
                                <div class="accordion-body pb-4">
                                    We'll install your new boiler and won't leave until it's working and tested. We know every job is different so we include all pipework alterations to accommodate your new boiler within your fixed price. We will also install your condensate pipe, and upgrade the pipe from your gas meter to boiler, if required.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              New Flue Installation and any required brickwork
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Electrical work
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Removal and disposal of existing boiler
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Removal of existing tanks and cylinder
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Gasking register the warranty & Building Control Certificate
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free Nest Learning Thermostat (3rd Generation) & Stand or Hive Active Heating Thermostat
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free Magnetic central heating Filter
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free Fernox Magnetic Scale Remover
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free Carbon Monoxide Detector
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free MagnaCleanse system flush
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free Fernox F3 Central Heating Cleaner
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free Fernox F1 central heating protector
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free Pipework installation, alterations, and upgrades
                            </button>
                          </h2>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading__2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                              Free extended Boiler Aftercare: 10 years warranty ( Warranty must be reactive)
                            </button>
                          </h2>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.layouts.partials._tooltip')
@include('pages.layouts.partials._scripts')

</body>
</html>

<script>

$('.choose-boiler').click(function(){
$.ajax({
              url: "{!! route('update-answer') !!}", 
              type: "POST",
              data: {
                        completed_wizard: 'page.boilers',
                        boiler: {!! $boiler->id !!}
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

</script>    