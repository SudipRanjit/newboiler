<div class="row justify-content-center question-wrapper" id="question__1">
  <div class="col-md-8 question">
    <h2 class="text-center">What kind of fuel does your boiler use? </h2>
    <p class="text-center text-black-light mb-5 info__line" id="q1__info"><span class="fa fa-info-circle"></span> <a href="#" data-bs-toggle="modal" data-bs-target="#q1__info_modal">How to find out?</a></p>
  </div>
  <div class="options">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-3 col-md-4">
        <div class="card-questionaire text-center option-wrapper q1" id="q1o1">
          <div class="questionaire-img figure">
            <img class="img-fluid mb-2 option-image" src="<?php echo WEBIFI_NEW_BOILER_IMAGE_PATH . "images/q1/o1.svg"; ?>" />
            <h4 class="option-title">GAS</h4>
          </div>
          <div class="questionaire-detail">
            <p class="p-4 option-info">If you have a gas meter, your boiler uses gas.</p>
            <span class="btn btn-secondary text-white">Select</span>
          </div>   
          
        </div>
      </div>

      <div class="col-lg-3 col-md-4">
        <div class="card-questionaire text-center option-wrapper q1" id="q1o2">
            <div class="questionaire-img figure">
              <img class="img-fluid mb-2 option-image" src="<?php echo WEBIFI_NEW_BOILER_IMAGE_PATH . "images/q1/o2.svg"; ?>" />
              <h4 class="option-title">LPG</h4>
            </div>
            <div class="questionaire-detail">
              <p class="p-4 option-info">LPG stands for Liquid Petroleum Gas. It's a gas stored in a tank outside. It's not the same as oil so please check carefully.</p>
              <span class="btn btn-secondary text-white">Select</span> 
            </div>  
        </div>
      </div>
    </div>
  </div>

  {{--
  <div class="info__wrapper" id="q1__info_wrapper">
    <div class="close__btn_wrapper">
      <div class="close__btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" viewBox="0 0 32 32" width="64px" height="64px">
          <path d="M 7.21875 5.78125 L 5.78125 7.21875 L 14.5625 16 L 5.78125 24.78125 L 7.21875 26.21875 L 16 17.4375 L 24.78125 26.21875 L 26.21875 24.78125 L 17.4375 16 L 26.21875 7.21875 L 24.78125 5.78125 L 16 14.5625 Z" />
        </svg>
      </div>
    </div>
    <div class="info__content">
      <p>The fuel type is often written on the front of the boiler.</p>
      <p>Most boilers are supplied with gas. If you have a gas meter, gas cooker or gas fire it is likely to be a gas boiler. If you have gas bottles or an LPG storage tank outside then it is LPG.</p>
    </div>
  </div>
--}}
</div>

<div class="modal fade" id="q1__info_modal" tabindex="-1" aria-labelledby="q1__info_modal_label" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10">
                    <h2 class="modal-title mb-4" id="q1__info_modal_label">How to find out?</h2>
                    <p>The fuel type is often written on the front of the boiler.</p>
                    <p>Most boilers are supplied with gas. If you have a gas meter, gas cooker or gas fire it is likely to be a gas boiler. If you have gas bottles or an LPG storage tank outside then it is LPG.</p>
                  </div>
              </div>
          </div>    
      </div>
  </div>
</div>