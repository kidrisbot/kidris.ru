<!doctype html>

<html>

<head>
    <title>Kidris - панель управления</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="http://kidris.ru/style/js/statszy.js"></script>
      
    <script data-cfasync="false" type="text/javascript" src="/style/js/dashScripts.js"></script>
    
    <style type="text/css">
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
        .jumbotron {
            text-align: center;
        }
        .alert_block {
            text-align: center;
        }
        .row {
            text-align: center;
        }

        a {
            text-decoration: none;
        }
        #counter {
			display: none;
		}
		.footer-row {
			text-align: left;
		}
        .onoffswitch {
    position: relative; width: 93px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    height: 30px; padding: 0; line-height: 30px;
    border: 2px solid #999999; border-radius: 30px;
    background-color: #D6D6D6;
    transition: background-color 0.3s ease-in;
}
.onoffswitch-label:before {
    content: "";
    display: block; width: 30px; margin: 0px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 61px;
    border: 2px solid #999999; border-radius: 30px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label {
    background-color: #18BC9C;
}
.onoffswitch-checkbox:checked + .onoffswitch-label, .onoffswitch-checkbox:checked + .onoffswitch-label:before {
   border-color: #18BC9C;
}
.onoffswitch-checkbox:checked + .onoffswitch-label:before {
    right: 0px; 
}
</style>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar">                    </span>
            </button>
            <a class="navbar-brand" href="/dash">Kidris</a>
        </div>
        <div class="navbar-collapse collapse">
           <ul class="nav navbar-nav"> <li> <a href="/dash">Настройки</a> </li> <li class="active"> <a>Статистика</a> </li> <li> <a href="/stati">Графики</a> </li> <li> <a href="https://vk.com/kidrisru">Новости</a> </li> </ul>
            <form class="navbar-form navbar-right">
                <a href="/dash?logout" class="btn btn-success">Выход</a>
            </form>
        </div>
        <!--/.navbar-collapse -->
    </div>
</div>

<div class="jumbotron">
    <div class="container">
        <h1>Статистика сообществ </h1>

        <p></p>
<p>
Для того, чтобы подключить дополнительные функции, например, настроить стиль фотографии "Сервис анонимных сообщений",  Вы должны обратиться <a href="https://vk.com/im?media=&amp;sel=-88986513" target="_blank">сюда</a>.</p>
    </div>
</div>

<div class="container">
    <div class="alert_block">{alert_message}</div>
    <div class="row">
     <h2>Ваши группы</h2>
    <ul class="nav nav-tabs">
     {row} </ul>
     
<div class="tab-content">
		{group_screen_name}
        {rows}
        
    </div>  </div>
    <hr>
</div>

<div class="container">
    <div class="row footer-row">
        <div class="col-lg-4">
            <h2>Удобно</h2>
            <p>Сообщения пользователей будут отправлены сразу в "предложку". Больше не нужно копировать сообщения пользователей со сторонних сервисов.</p>
            <p>Оптимизированный дизайн, который одинаково удобен как на десктопе, так и на портативных устройствах.</p>
			<p>Нет ограничений в количестве символов.</p>
        </div>
        <div class="col-lg-4">
            <h2>Бесплатно</h2>
            <p>Сервис абсолютно бесплатен!</p>
            <p>После добавления сообщества, вам не нужно ждать модерации. Мы добавляем сообщества в систему сразу!</p>
        </div>
        <div class="col-lg-4">
            <h2>Следите за новостями</h2>
            <p>Будьте в курсе всех изменений на сайте - подписывайтесь на нашу группу в контакте..</p>
           <iframe src="http://vk.com/widget_community.php?gid=88986513&width=300&height=220" width="300" height="220" scrolling="no" frameborder="0"></iframe>
        </div>
    </div>
    <hr>
    <footer>
        <p>&copy; Kidris</p>
    </footer>
</div>
<!-- /container -->

</body>
<div id="counter">
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

</html>