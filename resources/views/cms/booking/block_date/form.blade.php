<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('date','Date') !!}
        {!! Form::date('date',null,['class' => 'form-control col-md-4', 'id' => 'date', 'placeholder' => "Enter Date"]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('note',"Note") !!}
        {!! Form::textarea('note',null,['class'=>'textarea form-control','id'=>'note','placeholder'=>'Enter note', 'style'=>'height:200px']) !!}
      </div>
      
    </div>
  
    <!-- /.box-body -->

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary', 'id' => 'submit_btn']) !!}

      <a href="{!! route('cms::block_dates.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
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

                @if(isset($block_date) && $block_date->publish == '1' || old('publish'))
                    <input type="checkbox" name="publish" checked>
                @else
                    <input type="checkbox" name="publish">
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

