<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {!! Form::label('boiler_name','Boiler Name') !!}
        {!! Form::text('boiler_name',null,['class' => 'form-control', 'id' => 'boiler-name', 'placeholder' => "Enter Boiler name" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('price','Price') !!}
        {!! Form::number('price',null,['class'=>'form-control', 'placeholder'=>'Enter Boiler Price', 'id'=>'price', 'step' => '.01']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('discount','Discount') !!}
        {!! Form::number('discount',null,['class'=>'form-control', 'placeholder'=>'Enter Discount (if any)', 'id'=>'discount', 'step' => '.01']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('summary',"Summary") !!}
        {!! Form::textarea('summary',null,['class'=>'textarea form-control','id'=>'summary','placeholder'=>'Enter Summary (Short description)']) !!}
      </div>
      

      <input type="hidden" name="type" value="Boiler" />

      <div class="form-group">
        {!! Form::label('content',"Content") !!}
        <br>
        <a href="javascript:void(0);" class="btn btn-default" id="addMedia"><i class="fa fa-image"></i> Add Media</a>

        {!! Form::textarea('description',null,['class'=>'textarea form-control','id'=>'content','placeholder'=>'Enter Description']) !!}
      </div>
      {{--
      <div class="form-group">
        {!! Form::label('category',"Category") !!}

        <select name="category" id="category" class="select2 form-control">
          <option value="0">Select Category</option>

          @foreach($categories as $cat)
          @if($cat->subCategories()->count() > 0)
          <optgroup label="{{ $cat->category }}" style="font-weight: bolder;">
            @foreach($cat->subCategories() as $subCat)
            <option value="{{$subCat->id}}" 
            @if(isset($boiler) && $subCat->id == $boiler->category)
            selected="selected"
            @endif  
            >{{ $subCat->category }}</option>
            @endforeach
          </optgroup>
          @else
          @if($cat->parent == 0)
          <option value="{{$cat->id}}"
          @if(isset($boiler) && $cat->id == $boiler->category)
            selected="selected"
          @endif  
          >{{ $cat->category }}</option>
          @endif
          @endif
          @endforeach
        </select>

      </div>
      --}}
      <div class="form-group">
        {!! Form::label('brand',"Brand") !!}

        <select name="brand" id="brand" class="select2 form-control">
          <option value="0">Select Category</option>

          @foreach($brands as $cat)
          @if($cat->subCategories()->count() > 0)
          <optgroup label="{{ $cat->category }}" style="font-weight: bolder;">
            @foreach($cat->subCategories() as $subCat)
            <option value="{{$subCat->id}}" 
            @if(isset($boiler) && $subCat->id == $boiler->brand)
            selected="selected"
            @endif  
            >{{ $subCat->category }}</option>
            @endforeach
          </optgroup>
          @else
          @if($cat->parent == 0)
          <option value="{{$cat->id}}"
          @if(isset($boiler) && $cat->id == $boiler->brand)
            selected="selected"
          @endif  
          >{{ $cat->category }}</option>
          @endif
          @endif
          @endforeach
        </select>

      </div>
      {{--
      <div class="form-group">
        {!! Form::label('power',"Power Range (KW)") !!}

        <select name="power_range" id="power" class="select2 form-control">
          <option value="0">Select Power Range</option>

          @foreach($powers as $cat)
          @if($cat->subCategories()->count() > 0)
          <optgroup label="{{ $cat->category }}" style="font-weight: bolder;">
            @foreach($cat->subCategories() as $subCat)
            <option value="{{$subCat->id}}" 
            @if(isset($boiler) && $subCat->id == $boiler->power_range)
            selected="selected"
            @endif  
            >{{ $subCat->category }}</option>
            @endforeach
          </optgroup>
          @else
          @if($cat->parent == 0)
          <option value="{{$cat->id}}"
          @if(isset($boiler) && $cat->id == $boiler->power_range)
            selected="selected"
          @endif  
          >{{ $cat->category }}</option>
          @endif
          @endif
          @endforeach
        </select>

      </div>
      --}}

      
    </div>

     <!-- Boilers -->
    <div class="card-header">
      <h3 class="card-title">Additional Information</h3>
    </div>
    <div class="card-body">
    <div class="row">
      <div class="col-md-6">
      {{--  
      <div class="form-group">
        {!! Form::label('measurements',"Measurements (mm)",['style' => 'display:block;']) !!}
        {!! Form::text('height',null,['class' => 'form-control dimension-box', 'id' => 'measurements', 'placeholder' => "H" ]) !!} X
        {!! Form::text('width',null,['class' => 'form-control dimension-box', 'id' => 'measurements', 'placeholder' => "W" ]) !!} X
        {!! Form::text('depth',null,['class' => 'form-control dimension-box', 'id' => 'measurements', 'placeholder' => "D" ]) !!}
      </div>
      --}}
      
      <div class="form-group">
        {!! Form::label('measurements',"Measurements (height x width x depth in mm)") !!}
        {!! Form::text('measurements',null,['class' => 'form-control', 'id' => 'measurements', 'placeholder' => "Enter measurements" ]) !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('warranty',"Warranty (years)") !!}
        {!! Form::text('warranty',null,['class' => 'form-control', 'id' => 'warranty', 'placeholder' => "Enter Warranty" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('boiler_type','Boiler Type') !!}
        {!! Form::select('boiler_type', ['Combi' => 'Combi', 'System' => 'System', 'Standard' => 'Standard'],null, ['class'=>'form-control', 'placeholder'=>'Select Boiler Type', 'id'=>'boiler-type']) !!}
      </div> 
      
      <div class="form-group">
        {!! Form::label('fuel_type',"Fuel Type") !!}
        {!! Form::text('fuel_type',null,['class' => 'form-control', 'id' => 'fuel_type', 'placeholder' => "Enter Fuel Type" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('solar_compatibility',"Solar Compatibility") !!}
        {!! Form::select('solar_compatibility', ['Yes' => 'Yes', 'No' => 'No'],null, ['class'=>'form-control', 'placeholder'=>'Select Boiler Type', 'id'=>'solar_compatibility']) !!}
      </div>
      </div>
      <div class="col-md-6">
       <div class="form-group">
        {!! Form::label('flow_rate',"Flow Rate") !!}
        {!! Form::text('flow_rate',null,['class' => 'form-control', 'id' => 'flow_rate', 'placeholder' => "Enter Flow Rate" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('central_heating_output',"Power (KW)") !!}
        {!! Form::number('central_heating_output',null,['class' => 'form-control', 'id' => 'central_heating_output', 'placeholder' => "Enter Power in KW" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('hot_water_output',"Hot Water Output") !!}
        {!! Form::text('hot_water_output',null,['class' => 'form-control', 'id' => 'hot_water_output', 'placeholder' => "Enter Hot Water Output" ]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('effiency_rating',"Effiency Rating") !!}
        {!! Form::text('effiency_rating',null,['class' => 'form-control', 'id' => 'measurements', 'placeholder' => "Enter Effiency Rating" ]) !!}
      </div>
      </div>
    </div>
      

     
    </div>
    <!-- /.box-body -->

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary', 'id' => 'submit_btn']) !!}

      <a href="{!! route('cms::boilers.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
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

                @if(isset($boiler) && $boiler->publish == '1' || old('publish'))
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

  <div class="card card-default boilers-box mt-30">
    <div class="card-header">
      <h3 class="card-title">Controls</h3>
    </div>
    <div class="card-body">
      <!-- Minimal style -->
      {!! Form::label('addon_id',"Default Control") !!}
        <select name="addon_id" id="addon_id" class="select2 form-control">
          <option value="0">Select Default Control</option>
          @foreach($addons as $add)
          <option value="{{$add->id}}"
          @if(isset($boiler) && $add->id == $boiler->addon_id)
            selected="selected"
          @endif  
          >{{ $add->addon_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="card-body">

        <div class="form-group">
        {!! Form::label('addons_id',"Additional Controls") !!}
          <p class="info__text">[Compatible controls with this boiler]</p>
          <select name="multiple_addons[]" id="addons_id" multiple="multiple" class="select2 form-control">
            @foreach($addons as $add)
            <option value="{{$add->id}}"
            @if(isset($boiler) && in_array($add->id, $boiler->addons()->pluck('addon_id')->toArray()))
              selected="selected"
            @endif  
            >{{ $add->addon_name }}</option>
            @endforeach
          </select>
        </div>
    </div>
    <!-- /.box-body -->
  </div>

 

  <div class="card boilers-box mt-30">
    <div class="card-header">
      <h3 class="card-title">Featured Image</h3>
    </div>
      <!-- Minimal style -->
      <div id="featured_image">
        @if(isset($boiler) && $boiler->image)
        <img src="{!!$boiler->image !!}" alt="{!! $boiler->image !!}" style="width: 100%;height: auto;">
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