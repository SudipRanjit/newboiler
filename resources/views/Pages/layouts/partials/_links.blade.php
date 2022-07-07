<?php /*?>
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
<?php */?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'New Boiler') | GasKing</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{!! asset('assets/css/styles.css') !!}">

    @yield('custom-styles')

</head>

