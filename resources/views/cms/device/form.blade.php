<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('device_name','Smart Device Name') !!}
        {!! Form::text('device_name',null,['class' => 'form-control', 'id' => 'device-name', 'placeholder' => "Enter device name" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('price','Price') !!}
        {!! Form::number('price',null,['class'=>'form-control', 'placeholder'=>'Enter device Price', 'id'=>'price', 'step' => '.01']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('summary',"Summary") !!}
        {!! Form::textarea('summary',null,['class'=>'textarea form-control','id'=>'summary','placeholder'=>'Enter Summary (Short description)']) !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('content',"Content") !!}
        <br>
        <a href="javascript:void(0);" class="btn btn-default" id="addMedia"><i class="fa fa-image"></i> Add Media</a>

        {!! Form::textarea('description',null,['class'=>'textarea form-control','id'=>'content','placeholder'=>'Enter Description']) !!}
      </div>


    </div>

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary', 'id' => 'submit_btn']) !!}

      <a href="{!! route('cms::devices.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>

  </div>
</div>
<!--</add news>-->

<!--<right side bar>-->
<div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">

  <!-- devices -->
  <div class="card card-default devices-box">
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

                @if(isset($device) && $device->publish == '1' || old('publish'))
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

  <div class="card card-default devices-box">
    <div class="card-header">
      <h3 class="card-title">Type</h3>
    </div>
    <div class="card-body">
      <!-- Minimal style -->

      <!-- radio -->
      <div class="form-group">
      <div class="switch-box">
        <span class="switch-label">Combi</span>

            <label class="switch">
                {{ Form::hidden('combi', false) }}

                @if(isset($device) && $device->combi == '1' || old('combi'))
                    <input type="checkbox" name="combi" checked>
                @else
                    <input type="checkbox" name="combi">
                @endif
                <span class="slider round"></span>
            </label>
        </div>
      </div>

      <div class="form-group">
        <div class="switch-box">
          <span class="switch-label">Standard</span>
  
              <label class="switch">
                  {{ Form::hidden('standard', false) }}
  
                  @if(isset($device) && $device->standard == '1' || old('standard'))
                      <input type="checkbox" name="standard" checked>
                  @else
                      <input type="checkbox" name="standard">
                  @endif
                  <span class="slider round"></span>
              </label>
          </div>
        </div>

        <div class="form-group">
          <div class="switch-box">
            <span class="switch-label">System</span>
    
                <label class="switch">
                    {{ Form::hidden('system', false) }}
    
                    @if(isset($device) && $device->system == '1' || old('system'))
                        <input type="checkbox" name="system" checked>
                    @else
                        <input type="checkbox" name="system">
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

  <div class="card devices-box mt-30">
    <div class="card-header">
      <h3 class="card-title">Featured Image</h3>
    </div>
      <!-- Minimal style -->
      <div id="featured_image">
        @if(isset($device) && $device->image)
        <img src="{!!$device->image !!}" alt="{!! $device->image !!}" style="width: 100%;height: auto;">
        @else
        <img src="{{asset('uploads/default.png')}}" style="width: 100%;height: auto;">
        @endif
      </div>
      {!! Form::hidden('featured_image', null,['id' => 'featured_image_field']) !!}
      <div class="form-group" style="text-align: center;">
        <span>
          <a href="javascript:void(0);" class="btn btn-default" id="featuredImage" style="width:80%;">Select Image</a>
        </span>

      </div>
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