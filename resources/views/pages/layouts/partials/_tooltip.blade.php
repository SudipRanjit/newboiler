@if($toolTip->hot_water_flow != "")
<div class="modal fade" id="hot-water" tabindex="-1" aria-labelledby="hot-waterLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10 text-center">
                      <h2 class="modal-title mb-4" id="hot-waterLabel">Hot water flow rate</h2>
                      <br>
                      {!!$toolTip->hot_water_flow!!}
                  </div>
              </div>
              
          </div>
      </div>
  </div>
</div>
@endif
@if($toolTip->central_heating != "")
<div class="modal fade" id="central-heating" tabindex="-1" aria-labelledby="central-heatingLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10 text-center">
                      <h2 class="modal-title mb-4" id="central-heatingLabel">Central heating output</h2>
                      <br>
                      {!!$toolTip->central_heating!!}
                  </div>
              </div>
              
          </div>
      </div>
  </div>
</div>
@endif
@if($toolTip->warranty != "")
<div class="modal fade" id="warranty" tabindex="-1" aria-labelledby="warrantyLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10 text-center">
                      <h2 class="modal-title mb-4" id="warrantyLabel">Warranty</h2>
                      <br>
                      {!!$toolTip->warranty!!}
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endif
@if($toolTip->dimension != "")
<div class="modal fade" id="dimension" tabindex="-1" aria-labelledby="dimensionLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-4 p-lg-5">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-10 text-center">
                      <h2 class="modal-title mb-4" id="dimensionLabel">Dimension</h2>
                      <br>
                      {!!$toolTip->dimension!!}
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endif