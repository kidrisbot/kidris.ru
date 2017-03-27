<!doctype html>

<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8"/>
<meta http-equiv=X-UA-Compatible content="IE=edge"/>
    <title>{group_name} | Kidris - cервис анонимных сообщений ВКонтакте.</title>
    
<meta name="keywords" content="анонимно,вконтакте, кидрис, сообщения, предложить новость, подслушано, бесплатно, администратор,анонимная отправка сообщений, подслушано анонимно, платформа для сообществ вконтакте, ask.fm подслушано, анонимно отправить в паблик, подслушано пошлое анонимно, отправить сообщение анонимно, анонимно предложить новость, аналог ask.fm, аналог аск, замена аскфм, замена ask.fm, замена priano, замена приано, замена priano.ru, аналог priano, аналог priano.ru, аналог приано, замена priano, замена оверхеар, замена overhear.club, аналог overhear, аналог overhear.club, аналог оверхеар,замена sprashivai, замена спрашивай, замена sprashivai.ru, аналог sprashivai, аналог sprashivai.ru, аналог спрашивай "/>

<link rel="apple-touch-icon" sizes="60x60" href="http://kidris.ru/style/images/safari_60.png">
<link rel="apple-touch-icon" sizes="76x76" href="http://kidris.ru/style/images/safari_76.png">
<link rel="apple-touch-icon" sizes="120x120" href="http://kidris.ru/style/images/safari_120.png">
 <link rel="apple-touch-icon" sizes="152x152" href="http://kidris.ru/style/images/safari_152.png">


<meta property=og:type content=article>
<meta property=og:site_name content="Kidris.Ru"/>
<meta property=og:url content="http://kidris.ru/{group_screen_name}">
<meta property=og:title content="{group_name} | Kidris - Сервис анонимных сообщений ВКонтакте">
<meta property=og:description content="{group_description}">

<meta property=og:image content="https://pp.vk.me/c624328/v624328984/1e4f0/RiuTutNcnBQ.jpg">
<link rel=image_src href="https://pp.vk.me/c624328/v624328984/1e4f0/RiuTutNcnBQ.jpg">
<meta property=og:image content="http://mini.s-shot.ru/1024x768/800/jpeg/?http://kidris.ru/{group_screen_name}">

<link rel=image_src href="http://mini.s-shot.ru/1024x768/800/jpeg/?http://kidris.ru/{group_screen_name}">
<meta property=og:image content="{group_photo}">
<link rel=image_src href="{group_photo}">

       

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://kidris.ru/css/bbootstrap.min.css">
	<link rel="stylesheet" href="/style/css/asks.css">

    	<link rel="stylesheet" href="http://kidris.ru/style/css/jasny-bootstrap.min.css">
       
    <script data-cfasync="false"  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
       
    <script data-cfasync="false" type="text/javascript" src="/style/js/1maiisq.js"></script>

	<script data-cfasync="false" type="text/javascript" src="/style/js/jasny-bootstrap.min.js"></script>
	<script data-cfasync="false"  type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script> 
    <style type="text/css">
    body {
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		background-image: url('{group_fon}'); 
        background-repeat: repeat;
		background-color: #ecf0f1;   
	}
	
	.container { 
		background: #ecf0f1;
		border-radius: 5px;
		padding: 15px;
	}
	
    .ask-form {
        max-width: 95%;
    }
	
	.rating {
		padding-bottom: 10px;
	}
	
	footer {
		margin-top: 10px;
	} 
    form div{position:relative;margin:1em 0;}
form .counter{
	position:absolute;
	right:0;
	top:0;
	font-size:20px;
	font-weight:bold;
	color:#ccc;
	}
form .warning{color:#600;}	
form .exceeded{color:#e00;}	
    </style>
    
</head>


<body>
<div onclick="show('none')" id="wrap"></div>
<div class="counlive">
<!--LiveInternet counter-->
<script type="text/javascript"><!--
	document.write("<a href='//www.liveinternet.ru/click' "+
	"target=_blank><img src='//counter.yadro.ru/hit?t26.14;r"+
	escape(document.referrer)+((typeof(screen)=="undefined")?"":
	";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
	screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
	";"+Math.random()+
	"' alt='' title='LiveInternet: показано число посетителей за"+
	" сегодня' "+
	"border='0' width='88' height='15'><\/a>")
	//-->
</script>
<!--/LiveInternet--> </div>

<div class="jumbotron">
    <div class="container">
				<p class="group-title">
					<a href="https://vk.com/{group_screen_name_vtoroy}" rel="nofollow" target="_blank"><img src="{group_photo}" class="img-circle"> {group_name}</a>
				</p>
				<p>
					<span class="label label-success">Рейтинг: {rating}</span>
				</p>
				
		
        <div id="footer_old">
        
       <p class="group-description" align="justify" >{group_text}</p></div>
          <form class="ask-form" id="ask" name="ask" action="/{group_screen_name}" method="post" >
          
            <p>
          

        <div>
			
                <textarea class="form-control" autofocus rows="6" placeholder="Ваше сообщение" id="message" name="message" maxlength="700" ></textarea>
                </div>
				<input type="hidden" name="token" id="token" value="{token}" />
            </p>
			<input type="hidden" id="attach_polls_id" name="attach_polls_id" value="">
            <p>
                <div id="ajax_answer"></div>
            </p>
            <!--
            <div class="col-md-12">
                       
   						 <input id="input-6" name="input6[]" type="file" multiple class="file-loading">
    						<script>
   											 $(document).on('ready', function() {
        									$("#input-6").fileinput({
        									    showUpload: false,
           									  maxFileCount: 10,
          									  mainClass: "input-group-lg"
                                              data-allowed-file-extensions='["jpg", "gif", "png", "jpeg"]'
       										 });
   										 });
   							 </script>
                </div>
                -->
            <div class="row">
				<div class="col-md-5">
                {del1}
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
					  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
					  <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Прикрепить фото</span><span class="fileinput-exists">Изменить</span><input type="file" name="file"  id="file" accept="image/*"></span>
					  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Удалить</a>
                    </div>
                    {del2}
				</div>
				
				<div class="col-md-4">
                 {del1}
					<div class="fileinput fileinput-new input-group" onclick="show('block')" id="attach_polls_on">
					  <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Прикрепить опрос</span></span>
                    </div>
					<div class="fileinput fileinput-new input-group" onclick="attach_delete_polls()" id="attach_polls_off">
					  <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Открепить опрос</span></span>
                    </div>
                     {del2}
				</div>
				
				<script>
					$("#attach_polls_off").hide();
				</script>
				
                <div class="col-md-3">
                    <button class="btn btn-block btn-warning btn-lg" type="submit">Отправить</button>
                </div>
            </div>
            
            
        </form>
        
    </div> 
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 1, width: "220", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '#18bc9c'}, 88986513);
</script>
 </div>
<div class="container">
    <footer>
        <p> Kidris.ru  не имеет никакого отношения к этому контенту | <a href="http://kidris.ru/rules" rel="nofollow" target="_blank">Правила</a>  
  
     </p>
    </footer>
</div>

<div id="window" >
	<div class="container">
		<div class="window_title">
			<div class="name">
				Прикрепление опроса
			</div>
			<div class="close_win" onclick="show('none')">
				Х
			</div>
		</div>
		<div id="ajax_answer_polls"></div>
		<div>
			<form id="polls" name="polls" action="/{group_screen_name}" method="POST">
				<input class="win_input" type="text" name="polls_question" placeholder="Вопрос">
				<input class="win_input" type="text" name="polls_answer1" placeholder="Вариант ответа 1">
				<input class="win_input" type="text" name="polls_answer2" placeholder="Вариант ответа 2">
				<input class="win_input" type="text" name="polls_answer3" placeholder="Вариант ответа 3">
				<input class="win_input" type="text" name="polls_answer4" placeholder="Вариант ответа 4">
				<input class="win_input" type="text" name="polls_answer5" placeholder="Вариант ответа 5">
                <input class="win_input" type="text" name="polls_answer6" placeholder="Вариант ответа 6">
				<input class="win_input" type="text" name="polls_answer7" placeholder="Вариант ответа 7">
				<input class="win_input" type="text" name="polls_answer8" placeholder="Вариант ответа 8">
				<input class="win_input" type="text" name="polls_answer9" placeholder="Вариант ответа 9">
				<input class="win_input" type="text" name="polls_answer10" placeholder="Вариант ответа 10">
				
                
				<div class="col-md-4">
                    <button class="btn btn-block btn-warning" id="attach_polls" type="submit" name="attachment_polls">Прикрепить опрос</button>
                </div>
			</form>
		</div>
	</div>
</div>

</body>
<script  data-cfasync="false"  type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script   data-cfasync="false"  type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script  data-cfasync="false"  src='https://www.google.com/recaptcha/api.js'></script>
<script  data-cfasync="false"  type="text/javascript" src="/style/js/maii.js"></script>
<script  data-cfasync="false"  type="text/javascript" src="/style/js/jasny-bootstrap.min.js"></script>
<script  data-cfasync="false"  src="https://malsup.github.com/jquery.form.js"></script> 



</html>