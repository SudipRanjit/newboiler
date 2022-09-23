<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('radiator_type_id','Radiator Type') !!}
        {!! Form::select('radiator_type_id', $radiator_types, null, ['class' => 'form-control', 'id'=>'radiator_type_id','placeholder' => 'Please Select']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('radiator_height_id','Radiator Height') !!}
        {!! Form::select('radiator_height_id', $radiator_heights, null, ['class' => 'form-control', 'id'=>'radiator_height_id','placeholder' => 'Please Select']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('radiator_length_id','Radiator Length') !!}
        {!! Form::select('radiator_length_id', $radiator_lengths, null, ['class' => 'form-control', 'id'=>'radiator_length_id','placeholder' => 'Please Select']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('range','Range') !!}
        {!! Form::text('range',null,['class'=>'form-control', 'placeholder'=>'Enter Radiator Range (eg; COMPACT)', 'id'=>'range']) !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('watts','Watts') !!}
        {!! Form::number('watts',null,['class'=>'form-control', 'placeholder'=>'Enter Radiator Watts', 'id'=>'watts', 'step' => '.01']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('btu','BTU') !!}
        {!! Form::number('btu',null,['class'=>'form-control', 'placeholder'=>'Enter Radiator BTU', 'id'=>'btu', 'step' => '.01']) !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('price','Price') !!}
        {!! Form::number('price',null,['class'=>'form-control', 'placeholder'=>'Enter Radiator Price', 'id'=>'price', 'step' => '.01']) !!}
      </div>

       
    </div>

     
    
    <!-- /.box-body -->

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary', 'id' => 'submit_btn']) !!}

      <a href="{!! route('cms::radiator_prices.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>

  </div>
</div>
<!--</add news>-->

<!--<right side bar>-->
  <div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">

    <!-- Boilers -->
    <div class="card card-default boilers-box">
      <div class="card-header">
        <h3 class="card-title">Status</h3>
      </div>
      <div class="card-body">
        <!-- Minimal style -->
  
        <!-- radio -->
        <div class="form-group">
        <div class="switch-box">
          <span class="switch-label">Active</span>
  
              <label class="switch">
                  {{ Form::hidden('publish', false) }}
  
                  @if(isset($radiator_price) && $radiator_price->publish == '1' || old('publish'))
                      <input type="checkbox" name="publish" checked>
                  @elseif(isset($radiator_price) && $radiator_price->publish == '0')
                      <input type="checkbox" name="publish">
                  @else
                      <input type="checkbox" name="publish" checked>
                  @endif
                  <span class="slider round"></span>
              </label>
          </div>
        </div>
        
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <!--</right side bar>-->
  
  

