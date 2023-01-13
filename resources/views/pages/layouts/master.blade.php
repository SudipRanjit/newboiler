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

</body>
</html>
