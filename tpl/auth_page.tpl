<!doctype html>

<html>

<head>
    <title>Kidris - авторизация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            padding-top: 100px;
            padding-bottom: 40px;
            background-color: #eee;
            text-align: center;
        }
        .form-signin-heading {
            max-width: 90%;
            padding-left: 10%;
            padding-bottom: 10px;
        }
        .container h1 {
            font-size: 80px;
        }
        .btn {
            width: 300px;
        }
         #counter {
display: none;
}
    </style>
</head>

<body>
<div class="container">
    <h1>Kidris</h1>
    <form class="form-signin">
        <h2 class="form-signin-heading">Для работы с системой необходимо авторизоватся через ВКонтакте</h2>
        {error}
        <a class="btn btn-primary btn-lg" href="{auth_url}">Войти через VK</a>
    </form>
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