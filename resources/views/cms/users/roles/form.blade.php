<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
      <div class="card-body">
        <div class="form-group">
          {!! Form::label('name','Name') !!}
          {!! Form::text('name',null,['class' => 'form-control','id' => 'news-title', 'placeholder' => "Enter News title"]) !!}
        </div>
        <div class="form-group">
          {!! Form::label('description','Description') !!}
          {!! Form::textarea('description',null,['class' => 'form-control','id' => 'email-id']) !!}
        </div>
      </div>
  </div>
</div>

<!--<right side bar>-->
<div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">
  <div class="card ">
    <div class="card-body">
      {!! Form::submit($button,['class' => 'btn btn-primary']) !!}
      <a href="{!! route('cms::users.roles.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>
</div>

</div>
<!--</right side bar>-->