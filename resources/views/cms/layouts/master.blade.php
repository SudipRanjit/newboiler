@include('cms.layouts.partials._links')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
  
  @include('cms.layouts.partials._header')
  
  @include('cms.layouts.partials._messages')

  <!-- Main Nav -->
  @include('cms.layouts.partials._nav')
  <!-- Main Nav -->   

  @yield('content')

</div>
<!-- ./wrapper --> 
@include('cms.layouts.partials._scripts')
