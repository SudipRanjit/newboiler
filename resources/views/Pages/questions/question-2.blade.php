<div class="row justify-content-center question-wrapper" id="question__2">
  <div class="col-md-8 question">
    <h2 class="text-center">Currently, what kind of boiler do you have?</h2>
    <p class="text-center text-black-light mb-5 info__line" id="q2__info"><span class="fa fa-info-circle"></span> <a href="#" data-bs-toggle="modal" data-bs-target="#q2__info_modal">How to find out?</a></p>
  </div>
  <div class="options">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-3 col-md-4">
        <div class="card-questionaire text-center option-wrapper q2" id="q2o1" alt="question__3">
          <div class="questionaire-img figure">
            <img class="img-fluid mb-2 option-image" src="<?php echo WEBIFI_NEW_BOILER_IMAGE_PATH . "images/q2/o1.svg"; ?>" />
            <h4 class="option-title">Combi</h4>
          </div>
          <div class="questionaire-detail">
            <p class="p-4 option-info">Combi boilers heat water directly from the mains when you turn on a tap. So you get hot water instantly – without a cylinder or a tank in the loft.</p>
            <span class="btn btn-secondary text-white">Select</span>
          </div>  
        </div>
      </div>
      <div class="col-lg-3 col-md-4">
        <div class="card-questionaire text-center option-wrapper q2" id="q2o2" alt="question__2a">
          <div class="questionaire-img figure">
            <img class="img-fluid mb-2 option-image" src="<?php echo WEBIFI_NEW_BOILER_IMAGE_PATH . "images/q2/o2.svg"; ?>" />
            <h4 class="option-title">System</h4>
          </div>
          <div class="questionaire-detail">
            <p class="p-4 option-info">If you have a hot water storage cylinder but no cold water tank in the loft, you're likely to have a System boiler. The boiler will normally have a pressure gauge on the front of it.</p>
            <span class="btn btn-secondary text-white">Select</span>
          </div>  
        </div>
      </div>
      <div class="col-lg-3 col-md-4">
        <div class="card-questionaire text-center option-wrapper q2" id="q2o3" alt="question__2a">
          <div class="questionaire-img figure">
            <img class="img-fluid mb-2 option-image" src="<?php echo WEBIFI_NEW_BOILER_IMAGE_PATH . "images/q2/o3.svg"; ?>" />
            <h4 class="option-title">Standard</h4>
          </div>
          <div class="questionaire-detail">
            <p class="p-4 option-info">If you have a hot water storage cylinder as well as a cold water tank in the loft, your boiler is likely to be Standard. These are also called Regular, Traditional or Conventional boilers.</p>
            <span class="btn btn-secondary text-white">Select</span>
          </div>  
        </div>
      </div>
    </div>
  </div>
  {{-- 
  <div class="info__wrapper" id="q2__info_wrapper">
    <div class="close__btn_wrapper">
      <div class="close__btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" viewBox="0 0 32 32" width="64px" height="64px">
          <path d="M 7.21875 5.78125 L 5.78125 7.21875 L 14.5625 16 L 5.78125 24.78125 L 7.21875 26.21875 L 16 17.4375 L 24.78125 26.21875 L 26.21875 24.78125 L 17.4375 16 L 26.21875 7.21875 L 24.78125 5.78125 L 16 14.5625 Z" />
        </svg>
      </div>
    </div>
    <div class="info__content">
      <p>Take a look at the boiler. Its type should be written on the front.</p>
      <p>Otherwise, here are a few rules of thumb:</p>
      <ul>
        <li>If you don't have a cold water tank or a hot water cylinder, it's likely a Combi boiler</li>
        <li>If you have two cold water tanks (more than likely in the loft) and a hot water cylinder, it's a Standard boiler</li>
        <li>If you have one or no cold water tank and a cylinder for your hot water, it's probably a System boiler. If you are unsure you can double check by looking for a pressure gauge on the boiler or near the hot water cylinder.</li>
      </ul>
    </div>
  </div>
  --}}
  <div class="nav-wrapper back__btn" id="back__1" alt="question__1" cur="question__2"><i class="fa-solid fa-arrow-left"></i></div>
</div>

<div class="modal fade" id="q2__info_modal" tabindex="-1" aria-labelledby="q2__info_modal_label" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10">
                    <h2 class="modal-title mb-4" id="q2__info_modal_label">How to find out?</h2>
                    <p>Take a look at the boiler. Its type should be written on the front.</p>
                    <p>Otherwise, here are a few rules of thumb:</p>
                    <ul>
                      <li>If you don't have a cold water tank or a hot water cylinder, it's likely a Combi boiler</li>
                      <li>If you have two cold water tanks (more than likely in the loft) and a hot water cylinder, it's a Standard boiler</li>
                      <li>If you have one or no cold water tank and a cylinder for your hot water, it's probably a System boiler. If you are unsure you can double check by looking for a pressure gauge on the boiler or near the hot water cylinder.</li>
                    </ul>
                  </div>
              </div>
          </div>    
      </div>
  </div>
</div>
