<!DOCTYPE html>
<html>
  <head>
    <?php
      $user = Auth::user();
      $username = $user->name;
      $fullname = $user->fullname;
      $user_photo = !empty($user->photo) ? $user->photo : ($user->sex == 'm' ? 'ikhwan.png' : 'akhwat.png');
      $company = false;
      if (!empty(Auth::user()->company_id)) {
        $company = App\Company::find($user->company_id);
        $company_name = !empty($company->company_shortname) ? $company->company_shortname : $company->company_name;
        $company_logo = !empty($company->company_logo) ? $company->company_logo : 'no-image.jpg';
        $company_address = $company->company_address;
        $favicon = !empty($company->company_logo) ? $company->company_logo : 'mtk.png';
      } else {
        $company_name = 'Machinetik';
        $company_logo = 'machinetik.png';
        $company_address = 'Cimahi';
        $favicon = 'mtk.png';
      }
      $menus = App\Menu::getRoledMenus();
      // dd($user, $user->group_id, $menus);
    ?>
    <meta charset="UTF-8">
    <title>{{ $company_name }} - @yield('title', 'App')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" href="{{ asset('images/'.$favicon) }}" type="image/x-icon">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="{{ asset('/fonts/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="{{ asset('/fonts/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="{{ asset('/adminlte/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/adminlte/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/adminlte/plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{ asset('/adminlte/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ asset('/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{ asset('/adminlte/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{ asset('/adminlte/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{ asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- Javascript -->
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="{{ asset('/adminlte/plugins/jQueryUI/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/adminlte/dist/js/app.min.js') }}" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .required{
        color: red;
      }
      a{
        cursor: pointer;
      }
    </style>
    @stack('style')
  </head>
  <body class="skin-blue sidebar-mini skin-red">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/home') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>Tk</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Machine</b>TIK</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('/images/'.$user_photo) }}" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">{{ $fullname }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('/images/'.$user_photo) }}" class="img-circle" alt="User Image" />
                    <p>
                      {{ $fullname }}
                      <small>{{ '@'.$username }}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ url('/profile') }}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <?php
            
          ?>
          <!-- Sidebar user panel -->
          @if ($company)
          <a href="{{ url('/company') }}">
          @endif
          <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/images/'.$company_logo) }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{{ $company_name }}</p>
              <small>{{ $company_address }}</small>
            </div>
          </div>
          @if ($company)
          </a>
          @endif
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php
            foreach ($menus as $menu) {
              echo '<li class="treeview"><a href="'.url($menu['url']).'"><i class="fa '.$menu['icon'].'"></i> <span>'.$menu['label'].'</span></a>';
              if (isset($menu['items'])) {
                echo '<ul class="treeview-menu">';
                foreach ($menu['items'] as $items) {
                  echo '<li class="treeview"><a href="'.url($items['url']).'"><i class="fa '.$items['icon'].'"></i> <span>'.$items['label'].'</span></a>';
                  if (isset($items['items'])) {
                    echo '<ul class="treeview-menu">';
                    foreach ($items['items'] as $item) {
                      echo '<li class="treeview"><a href="'.url($item['url']).'"><i class="fa '.$item['icon'].'"></i> <span>'.$item['label'].'</span></a>';
                      if (isset($item['items'])) {
                        echo '<ul class="treeview-menu">';
                        foreach ($item['items'] as $value) {
                          echo '<li class="treeview"><a href="'.url($value['url']).'"><i class="fa '.$value['icon'].'"></i> <span>'.$value['label'].'</span></a></li>';
                        }
                        echo '</ul>';
                      }
                      echo '</li>';
                    }
                    echo '</ul>';
                  }
                  echo '</li>';
                }
                echo '</ul>';
              }
              echo '</li>';
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @yield('title')
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> BETA 1.0
        </div>
        <strong>Copyright &copy; 2016 <a href="http://azkalf.machinetik.com">Azkal Fikri</a>.</strong> All rights reserved. Using AdminLTE Template from  <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.
      </footer>
    </div><!-- ./wrapper -->

    @stack('script')
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script> 
    <!-- Morris.js charts -->
    <script src="{{ asset('/adminlte/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/adminlte/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ asset('/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/adminlte/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/adminlte/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="{{ asset('/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('/adminlte/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
      $(window).load(function(){
        currentURL = $(location).attr('href');
        currentHost = $(location).attr('host');
        currentPath = currentURL.replace('http://'+currentHost,'');
        paths = currentPath.split('/');
        path = paths[1];
        pat = new RegExp('(?!.*\\b\\1\\b)', 'i');
        currentPath = path.replace(pat, '');
        $('ul.sidebar-menu').children('li').each(function(){
          // level 1
          level1 = $(this).children('a')
          level1URL = level1.attr('href');
          if (level1URL) {
            level1URL = level1URL.replace('http://'+currentHost+'/','');
            if (level1URL.toLowerCase() == currentPath.toLowerCase()) {
              $(this).closest('li').addClass('active');
            }
          }

          // level 2
          level2 = $(this).children('ul');
          level2.children('li').each(function(){
            level2URL = $(this).children('a').attr('href');
            if (level2URL) {
              level2URL = level2URL.replace('http://'+currentHost+'/','');
              if (level2URL.toLowerCase() == currentPath.toLowerCase()) {
                $(this).closest('li').addClass('active');
                $(this).closest('li').parents('ul').parents('li').addClass('active');
              }
            }
            // level 3
            level3 = $(this).children('ul');
            level3.children('li').each(function(){
              level3URL = $(this).children('a').attr('href');
              if (level3URL) {
                level3URL = level3URL.replace('http://'+currentHost+'/','');
                if (level3URL.toLowerCase() == currentPath.toLowerCase()) {
                  $(this).closest('li').addClass('active');
                  $(this).closest('li').parents('ul').parents('li').addClass('active');
                }
              }
              // level 4
              level4 = $(this).children('ul');
              level4.children('li').each(function(){
                level4URL = $(this).children('a').attr('href');
                if (level4URL) {
                  level4URL = level4URL.replace('http://'+currentHost+'/','');
                  if (level4URL.toLowerCase() == currentPath.toLowerCase()) {
                    $(this).closest('li').addClass('active');
                    $(this).closest('li').parents('ul').parents('li').addClass('active');
                  }
                }
              })
            })
          })
        })
      })
    </script>
  </body>
</html>