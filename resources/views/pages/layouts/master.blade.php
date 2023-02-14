<!DOCTYPE html>
<html lang="en">

@include('pages.layouts.partials._links')

<body class="bg-s-light">
<div class="navbar-grad gasking-header">

    @include('pages.layouts.partials._header')

    @include('pages.layouts.partials._nav')

</div>

<div class="main-container mt-4r">
    <div class="gasking-title-top hidden">
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
    </div>

    <div class="container @yield('container-css')">

        @include('pages.layouts.partials._menu')

        @include('pages.layouts.partials._messages')

        @yield('content')

        <div class="loader">
            <img src="{!! asset('assets/img/loader.svg') !!}" >        
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
                        <h2 class="modal-title mb-4" id="save-quoteLabel">Save This Quote</h2>
                        {{-- <p class="mb-5">Maecenas consequat felis nisi, in ullamcorper tortor viverra quis. Sed gravida diam ullamcorper purus vulputate accumsan. </p> --}}
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                            <div class="mb-4">
                                <label for="email-quote" class="form-label ps-4">Email address <small class="text-danger" id="emailErr"></small></label>
                                <input type="text" class="form-control" id="email-quote" placeholder="Email address">
                            </div>
                            <div class="mb-4">
                                <label for="contact-quote" class="form-label ps-4">Contact number</label>
                                <input type="text" class="form-control" id="contact-quote" placeholder="Contact number">
                            </div>
                            <div class="form-check mb-5">
                                <label class="form-check-label" for="agree-quote">
                                    <small>By saving this quote, you'll receive a fixed price email quote from Gasking.<br>
                                      Gasking will also contact you if there are discounts available on certain days within your quote period.*
                                    <br>
                                    For more information see our <a href="https://gasking.co.uk/privacy-policy/" target="_blank" class="text-secondary">Privacy Policy</a></small>
                                </label>
                            </div>
                            <button class="btn btn-secondary w-100" id="save-quote-btn">Save Quote</button>
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

<div class="modal fade" id="control-info" tabindex="-1" aria-labelledby="control-infoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" id="controlInfoClose" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10 text-center">
                      <h2 class="modal-title mb-4" id="controlLabel">Control Title</h2>
                      <p class="mb-5 text-secondary" id="controlPrice">Control Summary</p>
                  </div>
              </div>
              <div class="row justify-content-center controlDesc">
                  <div class="col-lg-8 col-md-10">
                      <div class="controlImageBox">
                        <img src="" id="controlImage" />
                      </div>
                      <div id="controlDescription"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="device-info" tabindex="-1" aria-labelledby="device-infoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" id="deviceInfoClose" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10 text-center">
                      <h2 class="modal-title mb-4" id="deviceLabel">Control Title</h2>
                      <p class="mb-5 text-secondary" id="devicePrice">Control Summary</p>
                  </div>
              </div>
              <div class="row justify-content-center controlDesc">
                  <div class="col-lg-8 col-md-10">
                      <div class="controlImageBox">
                        <img src="" id="deviceImage" />
                      </div>
                      <div id="deviceDescription"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="radiator-info" tabindex="-1" aria-labelledby="radiator-infoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" id="radiatorInfoClose" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10 text-center">
                      <h2 class="modal-title mb-4" id="radiatorLabel">Control Title</h2>
                  </div>
              </div>
              <div class="row justify-content-center controlDesc">
                  <div class="col-lg-8 col-md-10">
                      <div class="controlImageBox">
                        <img src="" id="radiatorImage" />
                      </div>
                      <div id="radiatorDescription"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@include('pages.layouts.partials._tooltip')

@include('pages.layouts.partials._scripts')
<script>
function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}
var cBoiler = "";
$(".save_this_quote").click(function(event){
  cBoiler = $(this).attr("data-boiler");
  console.log("Boiler "+cBoiler);
  $("#save-quote").show();
});
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

  $.ajax({
      url: url, 
      type: "POST",
      data: {
                selection: choice,
                boiler: cBoiler,
                email: email,
                contact: contact
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
</script>

</body>
</html>
