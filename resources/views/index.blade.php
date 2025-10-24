<?php
session_save_path('');
session_start();
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="static/mui.min.css" rel="stylesheet" type="text/css" />
    <link href="static/style.css" rel="stylesheet" type="text/css" />

    <script src="//cdn.muicss.com/mui-latest/js/mui.min.js"></script>
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="static/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script>
//paste this code under the head tag or in a separate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
	<style>
	body {
  background-color: mui-color('purple', '700');
}
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

P { text-align: justify }

hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
}
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript,
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(images/loading-ttcredesign.gif) center no-repeat #fff;
}
</style>
	<title>Calculadora de Impuestos | www.ConfiApp.com.mx </title>
	</head>
<body>
<div class="se-pre-con"></div>
	<?if(isset($_COOKIE['name_x1'])){?>

  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@include("menu")
    <header id="header">
      <div class="mui-appbar mui--appbar-line-height">
        <div class="mui-container-fluid">
          <a class="sidedrawer-toggle mui--visible-xs-inline-block mui--visible-sm-inline-block js-show-sidedrawer">☰</a>
          <a class="sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer">☰</a>
          <font size="2">Calculadora de Impuestos</font><img src="./images/logo.png" align="right" />
        </div>
      </div>
    </header>
    <div id="content-wrapper">
      <div class="mui--appbar-height"></div>
      <div class="mui-container-fluid">
<br>
<?//echo "<script>document.write(localStorage.getItem('name_x1'));</script>";?>
<?//echo "<script>document.write(localStorage.getItem('year_x1'));</script>";?>
<?//echo "<script>document.write(localStorage.getItem('sub_x1'));</script>";?>


<br>
<p>Te has preguntado: ¿Cuánto me cobran de impuestos? ¿Quieres saber cuanto ganarás? <b>Contador:</b> ¿Tienes problemas para calcular el impuesto a retener de algún empleado? Aquí te presentamos una nueva calculadora.</p>
<p>Esta aplicación le permitirá calcular de manera sencilla el impuesto semanal, quincenal, mensual o anual a retener a los trabajadores.</p>
<div class="fb-page" data-href="https://www.facebook.com/confiappmx" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/calculadoraisr/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/calculadoraisr/">Calculadora ISR SIISA</a></blockquote></div>
</p>
      </div>
    </div>
    <footer id="footer">
      <div class="mui-container-fluid">
        <br>
        Derechos reservados <a href="https://confiapp.com.mx/">ConfiApp.com.mx</a> 2025<br>
		Esta aplicación web utiliza cookies, al continuar navegando, usted acepta y aprueba el uso de las mismas.
      </div>
    </footer>
<?} else {
	?>
<script>

var name_x1 = localStorage.getItem('name_x1');
var year_x1 = localStorage.getItem('year_x1');
var sub_x1 = localStorage.getItem('sub_x1');

if (localStorage.getItem("name_x1") != null) {
window.location = "{{ route('app_config') }}?year="+year_x1+"&sub="+sub_x1+"&name="+name_x1+"";
} else {
window.location = "{{ route('opcion') }}?ver=config";
}
</script>
<?
}?>

  </body>
</html>
