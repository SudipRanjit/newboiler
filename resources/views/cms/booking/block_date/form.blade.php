<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('date','Date') !!}
        {!! Form::date('date',null,['class' => 'form-control', 'id' => 'date', 'placeholder' => "Enter Date"]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('time','Time') !!}
        <select name="time" class="form-control">
          <option value="00">No time block</option>
          <option value="07" @if(isset($block_date) && $block_date->time == "07") selected @endif>7 AM</option>
          <option value="08" @if(isset($block_date) && $block_date->time == "08") selected @endif>8 AM</option>
          <option value="09" @if(isset($block_date) && $block_date->time == "09") selected @endif>9 AM</option>
          <option value="10" @if(isset($block_date) && $block_date->time == "10") selected @endif>10 AM</option>
          <option value="11" @if(isset($block_date) && $block_date->time == "11") selected @endif>11 AM</option>
          <option value="12" @if(isset($block_date) && $block_date->time == "12") selected @endif>12 PM</option>
          <option value="13" @if(isset($block_date) && $block_date->time == "13") selected @endif>1 PM</option>
          <option value="14" @if(isset($block_date) && $block_date->time == "14") selected @endif>2 PM</option>
          <option value="15" @if(isset($block_date) && $block_date->time == "15") selected @endif>3 PM</option>
          <option value="16" @if(isset($block_date) && $block_date->time == "16") selected @endif>4 PM</option>
          <option value="17" @if(isset($block_date) && $block_date->time == "17") selected @endif>5 PM</option>
          <option value="18" @if(isset($block_date) && $block_date->time == "18") selected @endif>6 PM</option>
        </select>
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

