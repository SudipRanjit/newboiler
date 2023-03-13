@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
<div class="content-header sty-one">
  <h1>Quotes</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i> Quote</li>
  </ol>
</div>


<div class="content">
  <div class="row">
    <div class="col-md-6 search__box">
      <div class="input-group">
        <input class="form-control" alt="Quote" route="{!! route('cms::quotes.search') !!}" id="search_box" placeholder="Search" type="text" value="@if(isset($searchTxt)) {!! $searchTxt !!} @endif">
        <div class="input-group-addon search__icon" id="search-btn"><i class="ti-search"></i></div>
        @if(isset($searchTxt))
        <a href="{!! route('cms::quotes.index') !!}" title="Cancel Search"><i class="fa fa-times cancel__search"></i></a>
        @endif
      </div>
    </div>
    <div class="col-md-6 add__btn">
      {{-- <a href="{!! route('cms::quotes.create') !!}" class="btn btn-outline-primary">Add Quote</a> --}}
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
            <th scope="col">Boiler</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
            <th scope="col">Offered Price</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($quotes as $quote)
          <tr>
            <td scope="row">
                {!! $quote->quoteBoiler->boiler_name !!} ({!! $quote->quoteBoiler->boiler_type !!})
            </td>
            <td>
                {{$quote->email}}
            </td>
            <td>
                {{$quote->contact}} @if($quote->call_requested)<br><span class="label label-success">Call Requested</span>@endif
            </td>
            <td>
                £ {{$quote->offered_price}} (At the time, client saved the quote)
            </td>
            <td>
                {{$quote->created_at}}
            </td>
            <td>
              <a href="{!! route('page.boiler',['id' => $quote->boiler]) !!}" target="_blank" class="btn btn-default" title="View"><span class="fa fa-eye"></span></a>
            </td>
          </tr>
          @endforeach

          <tr>
            <td colspan="8">{!! $quotes->appends($_GET)->links() !!}</td>
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

