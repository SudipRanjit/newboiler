@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Edit Category</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::categories.index') !!}"><i class="fa fa-angle-right"></i> Category</a></li>
      <li><i class="fa fa-angle-right"></i> Edit Category</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::model($category,['route' => ['cms::categories.update', $category->id], 'method' => 'patch','files'=>true]) !!}
    <div class="row">
      @include('cms.category.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection

@section('custom-scripts')
<script>
  $('#category-name').keyup(function() {
    var title = $('#category-name').val();
    slug = title.replace(/\ /g, '-').toLowerCase();
    $('#slug').val(slug);
  });
</script>
@endsection