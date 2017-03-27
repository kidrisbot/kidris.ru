<!doctype html>

<html>

<head>
    <title>Kidris - Панель управления</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css">
    <script data-cfasync="false"  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script data-cfasync="false"  type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    
<script type="text/rocketscript" data-rocketsrc="http://code.jquery.com/jquery-1.11.2.min.js"></script>
      <script data-cfasync="false"  src="http://kidris.ru/demo/amcharts/amcharts.js" type="text/javascript"></script>
        <script data-cfasync="false"  src="http://kidris.ru/demo/amcharts/serial.js" type="text/javascript"></script>
      
        <style type="text/css">

            .amcharts-graph-g1 .amcharts-graph-stroke {
                stroke-dasharray: 3px 3px;
                stroke-linejoin: round;
                stroke-linecap: round;
                -webkit-animation: am-moving-dashes 1s linear infinite;
                animation: am-moving-dashes 1s linear infinite;
            }

            @-webkit-keyframes am-moving-dashes {
                100% {
                    stroke-dashoffset: -30px;
                }
            }
            @keyframes am-moving-dashes {
                100% {
                    stroke-dashoffset: -30px;
                }
            }


            .lastBullet {
                -webkit-animation: am-pulsating 1s ease-out infinite;
                animation: am-pulsating 1s ease-out infinite;
            }
            @-webkit-keyframes am-pulsating {
                0% {
                    stroke-opacity: 1;
                    stroke-width: 0px;
                }
                100% {
                    stroke-opacity: 0;
                    stroke-width: 50px;
                }
            }
            @keyframes am-pulsating {
                0% {
                    stroke-opacity: 1;
                    stroke-width: 0px;
                }
                100% {
                    stroke-opacity: 0;
                    stroke-width: 50px;
                }
            }

            .amcharts-graph-column-front {
                -webkit-transition: all .3s .3s ease-out;
                transition: all .3s .3s ease-out;
            }
            .amcharts-graph-column-front:hover {
                fill: #496375;
                stroke: #496375;
                -webkit-transition: all .3s ease-out;
                transition: all .3s ease-out;
            }


            .amcharts-graph-g2 {
              stroke-linejoin: round;
              stroke-linecap: round;
              stroke-dasharray: 500%;
              stroke-dasharray: 0 \0/;    /* fixes IE prob */
              stroke-dashoffset: 0 \0/;   /* fixes IE prob */
              -webkit-animation: am-draw 40s;
              animation: am-draw 40s;
            }
            @-webkit-keyframes am-draw {
                0% {
                    stroke-dashoffset: 500%;
                }
                100% {
                    stroke-dashoffset: 0px;
                }
            }
            @keyframes am-draw {
                0% {
                    stroke-dashoffset: 500%;
                }
                100% {
                    stroke-dashoffset: 0px;
                }
            }




        </style>

  
       
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
{script}
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
            <ul class="nav navbar-nav">
                <li>
<a href="/dash">Настройки</a>
                    
                </li>
                 <li> <a href="/stats">Статистика</a> </li> 
				 <li class="active">
                    <a>Графики</a>
                </li>
				<li>
                    <a href="https://vk.com/kidrisru">Новости</a>
                </li>

            </ul>
            <form class="navbar-form navbar-right">
                <a href="/dash?logout" class="btn btn-success">Выход</a>
            </form>
        </div>
        <!--/.navbar-collapse -->
    </div>
</div>

<div class="jumbotron">
    <div class="container">
        <h1>Статистика </h1>

        <p>Тут вы можете отследить количество отправленных сообщений</p>
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