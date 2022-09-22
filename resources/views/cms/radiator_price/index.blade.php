@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
<div class="content-header sty-one">
  <h1>Radiator Prices</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i>Radiator Price</li>
  </ol>
</div>


<div class="content">
  <div class="row">
    <div class="col-md-6 search__box">
      <div class="input-group">
        <input class="form-control" alt="Radiator " route="{!! route('cms::radiator_prices.search') !!}" id="search_box" placeholder="Search" type="text" value="@if(isset($searchTxt)) {!! $searchTxt !!} @endif">
        <div class="input-group-addon search__icon" id="search-btn"><i class="ti-search"></i></div>
        @if(isset($searchTxt))
        <a href="{!! route('cms::radiator_prices.index') !!}" title="Cancel Search"><i class="fa fa-times cancel__search"></i></a>
        @endif
      </div>
    </div>
    <div class="col-md-6 add__btn">
      <a href="{!! route('cms::radiator_prices.create') !!}" class="btn btn-outline-primary">Add Radiator Price </a>
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
            <th scope="col">S.No.</th>
            <th scope="col">Radiator Type </th>
            <th scope="col">Radiator Height </th>
            <th scope="col">Radiator Length </th>
            <th scope="col">Price (&pound;)</th>
            <th scope="col">BTU</th>
            <th scope="col">Created</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php $sno = 0; @endphp
          @foreach($radiator_prices  as $radiator_price )
          <tr>
            <td scope="row">
              {!! ++$sno !!}
            </td>
            <td>{!! $radiator_price->radiator_type()->exists() ? $radiator_price->radiator_type->type:'' !!}</td>
            <td>{!! $radiator_price->radiator_height()->exists() ? $radiator_price->radiator_height->height:'' !!}</td>
            <td>{!! $radiator_price->radiator_length()->exists() ? $radiator_price->radiator_length->length:'' !!}</td>
            <td>{!! $radiator_price->price !!}</td>
            <td>{!! $radiator_price->btu !!}</td>
            <td>{!! date('Y-m-d',strtotime($radiator_price->created_at)) !!}</td>
            <td>
              <a href="{!! route('cms::radiator_prices.edit',['radiator_price' => $radiator_price->id]) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>

              {!! Form::open(['route' => ['cms::radiator_prices.delete',$radiator_price->id],'method' => 'delete','onsubmit' =>'return confirm("Are you sure?")', 'class' => 'action-form']) !!}
                <button class="btn btn-default"><span class="fa fa-trash"></span></button>
              {!! Form::close() !!}
            </td>

          </tr>
          @endforeach

          <tr>
            <td colspan="8">{!! $radiator_prices ->appends($_GET)->links() !!}</td>
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

