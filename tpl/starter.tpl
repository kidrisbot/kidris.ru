
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kidris - панель управления</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="//kidris.ru/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="//kidris.ru/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="//kidris.ru/dist/css/skins/skin-green.min.css">
 
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

        <a href="#" class="logo">
          <span class="logo-mini"><b>K</b></span>
          <span class="logo-lg"><b>KID</b>RIS</span>
        </a>

       <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Меню</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
<ul class="nav navbar-nav">
            <li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ваш рейтинг">
                                    <a><text id="contentr">{ratingId} </text><i class="fa fa-bar-chart"> </i>
</a>
                                </li>
                                <li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ваш баланс">
                                    <a><text id="contentb">{pointId} </text><i class="fa  fa-heart-o"> </i>
</a>
                                </li>
          
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                    <img src="{fotos}" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                   <span class="hidden-xs">{name}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{fotos}" class="img-circle" alt="User Image">
                    <p>
                   {target}
                </p>
                <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <!--<a href="/personal_area" class="btn btn-default btn-flat">Настройки</a>-->
                    </div>
                    <div class="pull-right">
                      <a href="/starter?logout" class="btn btn-default btn-flat">Выйти</a>
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

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{fotos}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
               <p>{target}</p>
            </div>
          </div>

        {menu}
       <ul> <li>
<a href="http://kidris.ru/admin">
<i class="fa fa-th"></i> <span>Комменты</span>
<span class="pull-right-container">
<small class="label pull-right bg-green">new</small>
</span>
</a>
</li> </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Панель управления Кидриса
            
          </h1>
         
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-rub"></i></span>

            <div class="info-box-content">
            <span class="info-box-number">от 5 рублей</span>
              <span class="info-box-text">Купить лайки</span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">3 043</span>
              <span class="info-box-text">админов</span>
            
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-sitemap"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">354184</span>
              <span class="info-box-text">сообщений</span>
            
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-male"></i></span>

            <div class="info-box-content">
              
              <span class="info-box-number">3 793</span>
              <span class="info-box-text">групп</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">:)</h3>

           {message}
            </div>
            <div class="box box-primary">
	<div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-thumbs-up"></i> Настройка фотографии "Сервис анонимных сообщений"</h3>
                </div>
		<div class="box-body">
	<form class="form-horizontal" id="formx action=" javascript:void(null);"="" method="post" enctype="multipart/form-data" onsubmit="call()">
<fieldset>

<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Выберите группу:
</label>
 <div class="col-lg-6">
      
      <select class="form-control" id="sel1" name="taskOption">
       <option value="0">-не выбрано-</option>
       {listforfoto}
       </select>
</div>
</div>




<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Замените фото: 
</label>
 <div class="col-lg-6">
      <input type="file" name="file" accept="image/*">
<br>
          
</div>


</div>


<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput"></label>
 <div class="col-lg-6">
 <input type="submit" class="btn btn-primary" value="Обновить подпись" name="submit">
   </div>
 </div>


</fieldset></form>
		</div>
	</div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
             
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div> </div>
{news}
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015-2016 <a href="#">Kidris</a>.</strong> Все права защищены.
      </footer>

  
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="//kidris.ru/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="//kidris.ru/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="//kidris.ru/dist/js/app.min.js"></script>
<script src="//kidris.ru/plugins/iCheck/icheck.min.js"></script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
