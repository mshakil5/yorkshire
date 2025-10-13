<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">

<head>
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Title --}}
  <title></title>

  <!-- Favicon -->
  <link rel="icon" href="">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('resources/admin/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/admin/css/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/admin/datatables/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/codemirror/codemirror.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/codemirror/theme/monokai.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/admin/css/style.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="#" width="120">
  </div> --}}

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item mt-1">
        <a class="btn btn-sm btn-secondary" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="brand-link" style="cursor: pointer;">
      <span class="brand-text font-weight-bold text-white ml-3">{{Auth::user()->name}}</span>
    </div>

    <div class="sidebar">
      @include('admin.sidebar')
    </div>
  </aside>
  <div class="content-wrapper">
    @yield('content')
  </div>

</div>


<script src="{{ asset('resources/admin/js/jquery.min.js')}}"></script>

<script src="{{ asset('resources/admin/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('resources/admin/js/adminlte.js')}}"></script>

<script src="{{ asset('resources/admin/js/dashboard.js')}}"></script>

<script src="{{ asset('resources/admin/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{ asset('resources/admin/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{ asset('resources/admin/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('resources/admin/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('resources/admin/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{ asset('resources/admin/select2/select2.min.js')}}"></script>
<script src="{{ asset('resources/admin/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('resources/admin/codemirror/codemirror.js')}}"></script>
<script src="{{ asset('resources/admin/codemirror/mode/css/css.js')}}"></script>
<script src="{{ asset('resources/admin/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
<script src="{{ asset('resources/admin/codemirror/mode/php/php.js')}}"></script>
<script src="{{ asset('resources/admin/toastr/toastr.min.js')}}"></script>

<script src="{{ asset('resources/admin/js/app.js')}}"></script>

@yield('script')
</body>
</html>