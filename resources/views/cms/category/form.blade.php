<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('category','Category Name') !!}
        {!! Form::text('category',null,['class' => 'form-control', 'id' => 'category-name', 'placeholder' => "Enter Category name" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('slug','Slug') !!}
        {!! Form::text('slug',null,['class'=>'form-control', 'placeholder'=>'Enter Category Slug', 'id'=>'slug']) !!}
      </div>

      <input type="hidden" name="type" value="Category" />

      <div class="form-group">
        {!! Form::label('icon','Icon') !!}
        <div class="row">
          <div class="col-md-3">
            @if(isset($category) && $category->icon_dark)
            <div class="widget-image">
              <img id="icon-dark-img" src="{!! asset('uploads/icons/'.$category->icon_dark) !!}" alt="{!! $category->category !!}">
            </div>
            @else
            <img id="icon-dark-img" src="{!! asset('uploads/default.png') !!}">
            @endif
            <div class="form-group">
              <div class="custom-file">
               
                <fieldset class="form-group mt-30">
                  <label class="custom-file center-block block">
                    <input type="file" name="icon_dark" id="icon-dark" class="custom-file-input">
                    <span class="custom-file-control"></span> </label>
                </fieldset>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}

      <a href="{!! route('cms::categories.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>

  </div>
</div>
<!--</add news>-->

<!--<right side bar>-->
<div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">


  <!-- Categories -->
  <div class="card card-default categories-box">
    <div class="card-header">
      <h3 class="card-title">Parent</h3>
    </div>
    <div class="card-body">
      <!-- Minimal style -->
      <div class="form-group">
        <div class="radio">
          <label>
            {{ Form::radio('parent', 0, false) }}
            <span class="circle"></span>
            <span class="check"></span>
            Parent Category
          </label>
        </div>
        @foreach($categories as $k => $cat)
          @if(isset($category) && $category->id == $k)
            @continue
          @endif
          <div class="radio">

            <label>
              {{ Form::radio('parent', $k, false) }}
              <span class="circle"></span>
              <span class="check"></span>
              {{ $cat }}
            </label>

          </div>
        @endforeach
      </div>


    </div>
    <!-- /.box-body -->

  </div>


  <!-- Categories -->
  <div class="card card-default categories-box mt-30">
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

                @if(isset($category) && $category->publish == '1' || old('publish'))
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