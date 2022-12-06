<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('title','Title') !!}
        {!! Form::text('title',null,['class' => 'form-control', 'id' => 'title', 'placeholder' => "Enter Title"]) !!}
      </div>
 
    </div>
  
    <!-- /.box-body -->

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary', 'id' => 'submit_btn']) !!}

      <a href="{!! route('cms::payment_gateways.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>

  </div>
</div>
<!--</add news>-->

