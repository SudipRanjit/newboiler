@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Roles</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><i class="fa fa-angle-right"></i> Roles</li>
    </ol>
  </div>



<div class="content"> 

  <div class="row">
    <div class="col-md-6 search__box">
      <div class="input-group">
        <input class="form-control" id="search_box" placeholder="Search" type="text">
        <div class="input-group-addon"><i class="ti-search"></i></div>
      </div>
    </div>
    <div class="col-md-6 add__btn">
      <a href="{!! route('cms::users.roles.create') !!}" class="btn btn-outline-primary">Add Role</a>
    </div>
  </div>

  <div class="row m-t-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr>
                  <th scope="row">{!! $role->id !!}</th>
                  <td>
                    {!! $role->name !!}
                  </td>
                  <td>
                    <a href="{!! route('cms::users.roles.permissions',['role'=>$role->id]) !!}" class="btn btn-outline-warning permission-btn" title="Permission">Permission</a>
                    <a href="{!! route('cms::users.roles.edit',['role' => $role->id]) !!}" class="btn btn-outline-primary" title="Edit">Edit</a>  
                  </td>
                </tr>
                @endforeach
              </tbody>
             
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

</div>

@endsection