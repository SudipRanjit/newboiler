<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Gasking New Boiler Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="{!! asset('cms/bootstrap/css/bootstrap.min.css') !!}">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('cms/css/style.css') !!}">
<link rel="stylesheet" href="{!! asset('cms/css/font-awesome/css/font-awesome.min.css') !!}">
<link rel="stylesheet" href="{!! asset('cms/css/et-line-font/et-line-font.css') !!}">
<link rel="stylesheet" href="{!! asset('cms/css/themify-icons/themify-icons.css') !!}">
<link rel="stylesheet" href="{!! asset('cms/plugins/hmenu/ace-responsive-menu.css') !!}">
<link rel="stylesheet" href="{!! asset('cms/vendors/fancy-file-uploader/fancy_fileupload.css') !!}">
<script src="{!! asset('cms/js/jquery.min.js') !!}"></script> 

<link href="{!! asset('cms/vendors/flatpicker/flatpicker.min.css') !!}" rel="stylesheet" />
<script src="{!! asset('cms/vendors/flatpicker/flatpicker.min.js') !!}"></script>

<link href="{!! asset('cms/vendors/select2/select2.min.css') !!}" rel="stylesheet" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="{!! asset('cms/css/custom.css') !!}">

@yield('custom-styles')

</head>