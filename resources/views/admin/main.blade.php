<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.head')
</head>
<body class="sidebar-mini control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item" >
        <a class="nav-link" href="/logout">
          Đăng xuất
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link" style="text-align: center">
      <span class="brand-text font-weight-light">PEDRO</span>
    </a>
    <!-- Sidebar -->
    @include('admin.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{$title}}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="card">
        @include('admin.alert')
        <div class="card-body">
          @yield('content')
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="mb-2 mb-md-0">
      © <script>
      document.write(new Date().getFullYear())
      </script>
      , made with ❤️ by PEDRO
    </div>
  </footer>

</div>
<!-- ./wrapper -->

@include('admin.footer')

@yield('script')
</body>

</html>
