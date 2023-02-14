<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('category','Brand Name') !!}
        {!! Form::text('category',null,['class' => 'form-control', 'id' => 'brand-name', 'placeholder' => "Enter Brand name" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('slug','Slug') !!}
        {!! Form::text('slug',null,['class'=>'form-control', 'placeholder'=>'Enter Brand Slug', 'id'=>'slug']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('url','Brand Site') !!}
        {!! Form::text('url',null,['class'=>'form-control', 'placeholder'=>'Enter Brand Url (if any)', 'id'=>'url']) !!}
      </div>

      <input type="hidden" name="type" value="Brand" />

     

      <div class="form-group">
        {!! Form::label('content',"Content") !!}
        <br>
        <a href="javascript:void(0);" class="btn btn-default" id="addMedia"><i class="fa fa-image"></i> Add Media</a>

        {!! Form::textarea('description',null,['class'=>'textarea form-control','id'=>'content','placeholder'=>'Enter Description']) !!}
      </div>

    </div>

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}

      <a href="{!! route('cms::brands.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>

  </div>
</div>
<!--</add news>-->

<!--<right side bar>-->
<div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">


  {!! Form::hidden("parent", 0) !!}

  <div class="card card-default brands-box">
    <div class="card-header">
      <h3 class="card-title">Brand Image</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('icon','Brand Logo') !!}
        <div class="row">
          <div class="col-md-12">
            @if(isset($brand) && $brand->icon_dark)
            <div class="widget-image-brand">
              <img id="icon-dark-img" src="{!! asset('uploads/icons/'.$brand->icon_dark) !!}" alt="{!! $brand->brand !!}">
            </div>
            @else
            <div class="widget-image-brand">
              <img id="icon-dark-img" src="{!! asset('uploads/default.png') !!}">
            </div>
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
  </div>
  <!-- Brands -->
  <div class="card card-default brands-box mt-30">
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

                @if(isset($brand) && $brand->publish == '1' || old('publish'))
                    <input type="checkbox" name="publish" checked>
                @else
                    <input type="checkbox" name="publish">
                @endif
                <span class="slider round"></span>
            </label>
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('s_order','Sort Order [Lowest number will be displayed first]') !!}
        {!! Form::text('s_order',null,['class'=>'form-control', 'placeholder'=>'Brand sort order', 'id'=>'s_order']) !!}
      </div>
      
    </div>
    <!-- /.box-body -->
  </div>
</div>
<!--</right side bar>-->

<div class="modal" id="imageLibrary">
  <div class="modal-header">
    <button type="button" class="close close-library" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <section class="content">
  
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" id="upload-box" href="javascript:void(0);">Upload</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="library-box" href="javascript:void(0);">Library</a>
    </li>
  </ul>
  
  <div class="row upload-content" id="upload-content">
    <div class="col-md-12">
      <div id="fileupload">
        <form id="mediaForm">
          @csrf
          <input id="mediaFiles" type="file" name="mediaFiles" accept=".jpg, .png, image/jpeg, image/png" multiple>
        </form>
      </div>
    </div>
  </div>
  
  <div class="row library-content" id="library-content">
    <div class="col-md-12">
      <div class="row row-no-padding filters justify-content-start align-items-end search-row">
        <div class="col-12">
          <form action="#" class="form">
            <input type="text" name="search" id="img-search" class="form-control search-input" placeholder="Search...">
          </form>
        </div>
      </div>
  
      <div class="row  media-manager-content">
        <div class="col-md-8 media-list">
          <div class="loader">
            <img src="{{asset('cms/dist/img/loading.gif')}}" />
          </div>
          <div class="form-box">
  
            <div class="row list-box gray-scroll library-scroll" id="medialist">
  
            </div>
  
          </div>
        </div>
  
        <div class="col-md-4 media-detail">
          <div class="form-box">
  
            <div id="detail-box-wrapper">
              <div class="row list-box detail-box gray-scroll" id="detail-box">
  
              </div>
              
            </div>
          </div>
        </div>
      </div>
  
  
    </div>
  </div>
  <input type="hidden" name="lastPage" id="lastPage" value={{$lastPage}} />
  </section>
  </div>