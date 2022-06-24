@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Users</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><i class="fa fa-angle-right"></i> Users</li>
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
      <a href="{!! route('cms::users.create') !!}" class="btn btn-outline-primary">Add User</a>
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
                  <th scope="col">Role</th>
                  <th scope="col">Email Address</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <th scope="row">{!! $user->id !!}</th>
                  <td>
                    <div class="widget-user-image user-image-circle">
                      <img class="img-circle user-img" src="{!! asset('uploads/users/'.$user->profile_image) !!}" alt="{!! $user->name !!}">
                    </div><span class="media-heading user-title">{!! $user->name !!}</span>
                  </td>
                  <td>
                    @if($user->isSuperuser())
                    <span class="label label-success">Super Admin</span>
                    @endif
                    @foreach($user->roles as $role)
                    <span class="label label-primary">{!! $role->name !!}</span>
                    @endforeach
                  </td>
                  <td>{!! $user->email !!}</td>
                  <td>
                    @if($user->active)
                    <span class="label label-success">Active</span>
                    @else
                    <span class="label label-danger">In-Active</span>
                    @endif
                  </td>
                  <td><a href="{!! route('cms::users.edit',['user' => $user->id]) !!}" class="btn btn-outline-primary" title="Edit"><i class="fa fa-edit"></i> Edit</a></td>
                </tr>
                @endforeach

                <tr>
                  <td colspan="8">{!! $users->links() !!}</td>
                </tr>
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