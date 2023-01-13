@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
<div class="content-header sty-one">
  <h1>Tool Tips</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i> Tool Tip</li>
  </ol>
</div>


<div class="content">
  
  <!-- Default box -->
  <div class="row m-t-3">
    <div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td scope="row">
              Hot water flow rate
            </td>
            <td>
              <a href="{!! route('cms::tooltips.edit',['tip' => 'hot_water_flow']) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>
            </td>
          </tr>
          <tr>
            <td scope="row">
              Central Heating
            </td>
            <td>
              <a href="{!! route('cms::tooltips.edit',['tip' => 'central_heating']) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>
            </td>
          </tr>
          <tr>
            <td scope="row">
              Warranty
            </td>
            <td>
              <a href="{!! route('cms::tooltips.edit',['tip' => 'warranty']) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>
            </td>
          </tr>
          <tr>
            <td scope="row">
              Dimension
            </td>
            <td>
              <a href="{!! route('cms::tooltips.edit',['tip' => 'dimension']) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>
            </td>
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

