@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
<div class="content-header sty-one">
  <h1>devices</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i> Smart Devices</li>
  </ol>
</div>


<div class="content">
  <div class="row">
    <div class="col-md-6 search__box">
      <div class="input-group">
        <input class="form-control" alt="device" route="{!! route('cms::devices.search') !!}" id="search_box" placeholder="Search" type="text" value="@if(isset($searchTxt)) {!! $searchTxt !!} @endif">
        <div class="input-group-addon search__icon" id="search-btn"><i class="ti-search"></i></div>
        @if(isset($searchTxt))
        <a href="{!! route('cms::devices.index') !!}" title="Cancel Search"><i class="fa fa-times cancel__search"></i></a>
        @endif
      </div>
    </div>
    <div class="col-md-6 add__btn">
      <a href="{!! route('cms::devices.create') !!}" class="btn btn-outline-primary">Add Smart Device</a>
    </div>
  </div>
  <!-- Default box -->
  <div class="row m-t-3">
    <div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Smart Device</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($devices as $device)
          <tr>
            <td scope="row">
              {!! $device->device_name !!}
            </td>
            <td><img src=" {!! $device->image !!}" class="table_image"></td>
            <td>
              @if($device->publish)
              <span class="label label-success">Published</span>
              @else
              <span class="label label-danger">Unpublished</span>
              @endif
            </td>
            <td>
              <a href="{!! route('cms::devices.edit',['device' => $device->id]) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>

              {!! Form::open(['route' => ['cms::devices.delete',$device->id],'method' => 'delete','onsubmit' =>'return confirm("Are you sure?")', 'class' => 'action-form']) !!}
                <button class="btn btn-default"><span class="fa fa-trash"></span></button>
              {!! Form::close() !!}
            </td>

          </tr>
          @endforeach

          <tr>
            <td colspan="8">{!! $devices->appends($_GET)->links() !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
    </div>
  </div>
</div>
<!-- /.content -->
</div>
@endsection

