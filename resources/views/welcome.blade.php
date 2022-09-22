<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('favicon.ico') }}" rel="icon">
        <title>MyAppsZ</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="{{ asset('css/styless.css') }}" type="text/css" rel="stylesheet">
    </head>
    <body>

<div class="header">
  @if (Route::has('login'))
      <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
          @auth 
              <a href="{{ url('/dashboard') }}" style="font-family: 'Lato', sans-serif; float: right; margin-right: 25px; background: #fff; padding: 5px 15px; border-radius: 5px; text-decoration: none; color: #467fb9;">Dashboard</a>
          @else
              <a href="{{ route('login') }}" style="font-family: 'Lato', sans-serif; float: right; margin-right: 25px; background: #fff; padding: 5px 15px; border-radius: 5px; text-decoration: none; color: #467fb9;">Log in</a>
          @endauth
      </div>
  @endif
</div>
<div class="content">
  
<div id="container">
  <div id="header">
    <ul class="menu">
      <li class="btn_1"><a href="#">dfdf</a></li>
      <li class="btn_2"><a href="#">about</a></li>
      <li class="btn_3"><a href="#">albums</a></li>
      <li class="btn_4"><a href="{{ url('/tiket') }}">tour dates</a></li>
      <li class="btn_5"><a href="#">contacts</a></li>
    </ul>
    <img src="images/logo.jpg" alt="" name="logo" width="314" height="66" id="logo"/> </div>
  <div id="content">
    
    <div id="leftPan">
      <div id="welcome">
        <h2></h2>
        <p class="headline">PULVINAR QUIS, TINCIDUNT ET, RISUS. QUISQUE A NUNC EGET NIBH INTERDUM FRINGILLA. FUSCE DAPIBUS ODIO </p>
        <img src="images/img_welcome.jpg" width="66" height="66" alt="" />
        <p id="welText">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam eu nulla. Donec lobortis purus vel urna. Nunc laoreet lacinia nunc. In volutpat sodales ipsum. Sed vestibulum. Integer in ante. Sed posuere ligula </p>
        <div class="clear"></div>
      </div>
      <div id="about">
        <h2></h2>
        <img src="images/img_about.jpg" width="61" height="61" alt="" />
        <p><span class="headline2">Lorem ipsum dolor sit amet, consectetuer adipiscing</span> elit. Nam eu nulla. Donec lobortis purus vel urna. Nunc laoreet lacinia nunc. In volutpat sodales ipsum. Sed vestibulum. Integer in ante. Sed posuere ligula </p>
        <div class="clear"></div>
      </div>
    </div>
    <div id="rightPan">
      <div id="new">
        <h2></h2>
        <img src="images/img_new.jpg" width="61" height="61" alt="" />
        <p id="newText"><span class="headline2">Lorem ipsum dolor sit amet, consectetuer </span> elit. elit. Nam eu nulla. Donec lobortis purus vel urna. Nunc laoreet lacinia nunc. In volutpat sodales ipsum. Sed vestibulum. </p>
        <div class="clear"></div>
        <p><a href="#">Quisque ut magna et nisi bibendum sagittis. Fusce elit ligula, sodales sit amet, tincidunt in, ullamcorper condimentum, </a></p>
      </div>
      <div id="news">
        <h2></h2>
        <p><span class="headline2">19/09/09</span> <a href="#">elit. Nam eu nulla. Donec lobortis purus vel urna.</a><br />
          Nunc laoreet lacinia nunc. In volutpat sodales ipsum. Sed </p>
        <p><span class="headline2">19/09/09</span> <a href="#">elit. Nam eu nulla. Donec lobortis purus vel urna.</a><br />
          Nunc laoreet lacinia nunc. In volutpat sodales ipsum. Sed </p>
      </div>
    </div>
    <div class="clear" id="end"></div>
  </div>
  <div id="footer">
    <p><a href="#">HOME PAGE</a> | <a href="#">ABOUT US</a> | <a href="#">ALBUMS</a> | <a href="#">TOUR DATES</a> | <a href="#">CONTACTS</a><br/>
      Copyright &copy; Your Company Name | Design by <a href="http://freshtemplates.com/">Website Templates</a></p>
  </div>
</div>
</div>

<span class="usechrome">Use Chrome for a better experience</span>
    </body>
</html>
