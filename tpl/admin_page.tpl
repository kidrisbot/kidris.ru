<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KIDRIS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../../plugins/pace/pace.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a  class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>K</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>KIDRIS</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
           
            
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">У вас есть ?? дней</li>
                <li class="footer">
                  <a href="#">Купить ещё</a>
                </li>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{photo_100}" class="user-image" alt="User Image">
                <span class="hidden-xs">{FIO}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{photo_100}" class="img-circle" alt="User Image">

                  <p>
                    {FIO}
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Настройки</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Выйти</a>
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
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{photo_100}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{FIO}</p>
          </div>
        </div>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li>
            <a href="http://kidris.ru/starter">
              <i class="fa fa-th"></i> <span>Главная</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>
          <li class="treeview active">
            <a href="http://kidris.ru/admin">
              <i class="fa fa-dashboard"></i> <span>Настройки комментов</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
             {sidebar_menu_groups}
           </ul>
         </li>
         <!--
         <li class="treeview">
          <a href="http://kidris.ru/list_com">
            <i class="fa fa-dashboard"></i> <span>Список комментов</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           {sidebar_menu_groups}
         </ul>
       </li>
       -->
       <li>
        <a href="https://vk.com/id253358984">
          <i class="fa fa-calendar"></i> <span>Оплата</span>
        </a>
      </li>
      
      <li class="header">Другое</li>
      <li><a href="http://biklus.ru/"><i class="fa fa-circle-o text-red"></i> <span>Biklus</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Настройки анон комментов
   </h1>

 </section>

 <!-- Main content -->
 <section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      {blockCommentPage}

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Если в меню  после "Настройки комментов" вы ничего не видите, то вам нужно перезайти через аккаунт администратора группы, в которую вы хотите подключить анонимные комментарии</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-lg-12" >
              {blockAdvert}
          </div>
        </div>
        
      </div>
      
      
      <!-- /.box -->
      
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>{lang_version}</b> 0.1.9
    <!--LiveInternet counter--><script type="text/javascript"><!--
    document.write("<a href='//www.liveinternet.ru/click' "+
      "target=_blank><img src='//counter.yadro.ru/hit?t26.14;r"+
      escape(document.referrer)+((typeof(screen)=="undefined")?"":
        ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
          screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
      ";"+Math.random()+
      "' alt='' title='LiveInternet: показано число посетителей за"+
      " сегодня' "+
      "border='0' width='88' height='15'><\/a>")
      //--></script><!--/LiveInternet-->
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="http://kidris.ru">Kidris</a>.</strong> {lang_copyright}
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../../plugins/pace/pace.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../admin.js"></script>

<script type="text/javascript">
  // To make Pace works on Ajax calls

</script>
</body>
</html>
