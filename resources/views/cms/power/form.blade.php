<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('category','Power Range (KW)') !!}
        {!! Form::text('category',null,['class' => 'form-control', 'id' => 'power-name', 'placeholder' => "Enter Power range (KW)" ]) !!}
      </div>

      <div class="form-group" style="display: none;">
        {!! Form::label('slug','Slug') !!}
        {!! Form::text('slug',null,['class'=>'form-control', 'placeholder'=>'Enter Power Slug', 'id'=>'slug']) !!}
      </div>

      <input type="hidden" name="type" value="Power" />
      <input type="hidden" name="boiler_type" value="" />

    </div>

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}

      <a href="{!! route('cms::powers.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>

  </div>
</div>
<!--</add news>-->

<!--<right side bar>-->
<div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">


  {!! Form::hidden("parent", 0) !!}

  <!-- Powers -->
  <div class="card card-default powers-box">
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

                @if(isset($power) && $power->publish == '1' || old('publish'))
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