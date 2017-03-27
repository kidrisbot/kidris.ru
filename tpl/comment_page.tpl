
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> {group_name} | {lang_title}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
    label.label_video {
 border:1px solid #ccc;
 padding:10px;
 margin:0 0 10px;
 display:block; 
}
label.label_video:hover {
 background:#eee;
 cursor:pointer;
}
.skin-green .sidebar-menu>li>a {
    border-left: 3px solid transparent;
    overflow-x: hidden;
}

</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
      <body class="hold-transition skin-green sidebar-mini">


        <div class="wrapper">
          <div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
          </div>
          <div class="pace-activity"></div></div>
          <header class="main-header">
            <!-- Logo -->
            <a href="http://kidris.ru/" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>K</b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>KIDRIS</b></span>
            </a>


          </header>
          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- Sidebar user panel -->

          <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">{lang_menu}</li>
            <li class="active">
              <a href="">
                <i class="fa fa-dashboard"></i> <span>{lang_comment}</span> <i class="fa fa-angle-left pull-right"></i>
              </a>

            </li>
            <!--
            <li>
              <a href="http://kidris.ru/{21}">
                <i class="fa fa-dashboard"></i> <span>{lang_message}</span> <i class="fa fa-angle-left pull-right"></i>
              </a>

            </li>
            -->
            
            
            <li><a href="http://kidris.ru/rules"><i class="fa fa-book"></i> <span>{lang_rules}</span></a></li>
            <li class="header">{lang_links}</li>
            {com_links}
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>{lang_content_header}</h1>

        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="{group_photo}" alt="User profile picture">
                  <h3 class="profile-username text-center">{group_name}</h3>
                  <p class="text-muted text-center">{status}</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>{lang_followers}</b> <a class="pull-right">{Followers}</a>
                    </li>
                    <li class="list-group-item">
                    <b>{lang_posts}</b> <a class="pull-right">{posts}</a>
                    </li>
                    <li class="list-group-item">
                    <b>{lang_suggested_posts}</b> <a class="pull-right">{countSuggest}</a>
                    </li>
                    
                  </ul>

                  <a href="https://new.vk.com/public{groupId}" class="btn btn-primary btn-block"><b>{lang_open_in} <i class="fa fa-vk "></i></b></a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-file-text-o margin-r-5"></i> {lang_description}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">



                  <strong></strong>
                  <p>{group_description}</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">

                <div class="tab-content">
                <div id="" class="captchaSend" style="display:none;"> </div>
                 {wall_posts}
               </div><!-- /.tab-content -->
             </div><!-- /.nav-tabs-custom -->
           </div><!-- /.col -->
         </div><!-- /.row -->

       </section><!-- /.content -->
     </div><!-- /.content-wrapper -->
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





      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
     
    <!-- jQuery 2.1.4 -->
    <script   data-cfasync="false"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- PACE -->
    <script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/pace/pace.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script> 
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script  data-cfasync="false" src="../../jquery_form.js"></script> 
    <script  data-cfasync="false" src="../../comment4.js"></script> 
<script type="text/javascript">

 

</script>
  </body>
  </html>
