@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Add Power</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::powers.index') !!}"><i class="fa fa-angle-right"></i> Powers</a></li>
      <li><i class="fa fa-angle-right"></i> Add Power</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::open(['route' => 'cms::powers.store','files'=>true]) !!}
    <div class="row">
      @include('cms.power.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection

@section('custom-scripts')
<script>
  $('#power-name').keyup(function() {
    var title = $('#power-name').val();
    slug = title.replace(/\ /g, '-').toLowerCase();
    $('#slug').val(slug);
  });
</script>
@endsection