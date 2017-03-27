
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
    <script type="text/rocketscript" data-rocketsrc="http://kidris.ru/style/js/statszy11.js"></script>
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/css/bootstrap3/bootstrap-switch.css">
      {script}
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
{dashgForGroup}
<div class="col-lg-4 col-sm-12">
   {statslist}


{news}</div></div></section>
    <!-- /.content -->
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
    
     <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.js"></script>
<script>

$('.BSswitch').bootstrapSwitch('state', true);


$('#CheckBoxValue').text($("#TheCheckBox").bootstrapSwitch('state'));

$('#TheCheckBox').on('switchChange.bootstrapSwitch', function () {

    $("#CheckBoxValue").text($('#TheCheckBox').bootstrapSwitch('state'));
});

$('.probeProbe').bootstrapSwitch('state', true);

$('.probeProbe').on('switchChange.bootstrapSwitch', function (event, state) {

    alert(this);
    alert(event);
    alert(state);
});

$('#toggleSwitches ').click(function () {
    $('.BSswitch ').bootstrapSwitch('toggleDisabled');
    if ($('.BSswitch ').attr('disabled')) {
        $(this).text('Enable All Switches ');
    } else {
        $(this).text('Disable All Switches ');
    }
});
 </script>
  </body>
</html>
