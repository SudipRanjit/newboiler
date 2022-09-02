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
        {!! Form::label('price','Price') !!}
        {!! Form::number('price',null,['class'=>'form-control', 'placeholder'=>'Enter Radiator Price', 'id'=>'price', 'step' => '.01']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('btu','BTU') !!}
        {!! Form::number('btu',null,['class'=>'form-control', 'placeholder'=>'Enter Radiator BTU', 'id'=>'btu', 'step' => '.01']) !!}
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

