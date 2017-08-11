<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Articole.test</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="public/theme/blog_theme/default.css" rel="stylesheet" type="text/css" />
<script src="public/js/scripts.js"></script>
<script src="https://use.fontawesome.com/cd06caff6c.js"></script>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
<div id="content">
  <div id="menutop">
    <ul>
      <li>
        <a href="index.php?c=user&a=list&pag=1" id="main-menu4">
          Useri
        </a>
      </li>
      <li>
        <a href="index.php?c=user&a=login" id="main-menu4">
          Login
        </a>
      </li>
      <li>
        <a href="index.php?c=user&a=add" id="main-menu4">
          Sign-up
        </a>
      </li>            
    </ul>
  </div>
  <div>
    <img src="public/images/header5.jpg" style="max-width: 100%; max-height: 100%;">
  </div>
  <div id="menu">
    <ul>
      <li>
        <a href="index.php?c=article&a=list&pag=1" id="main-menu1">
          <i class="fa fa-home" style="font-size:27px;" aria-hidden="true"></i>
        </a>
      </li>
      <li>
        <a href="index.php?c=article&a=catlist&cat=1&pag=1" id="main-menu1">
          Stiinta
        </a>
      </li>
      <li>
        <a href="index.php?c=article&a=catlist&cat=2&pag=1" id="main-menu2">
          Cultura
        </a>
      </li>
      <li>
        <a href="index.php?c=article&a=catlist&cat=3&pag=1" id="main-menu3">
          Natura
        </a>
      </li>
    </ul>
  </div>
  
    <div id="message">
    <?php 
      $message = \framework\Mess::getAllMess();
      if($message){
        foreach ($message as $mess) {
          echo $mess;
        }
      }       
    ?>
    </div>   
    <?php echo $content; ?>
  

  <div id="footer">
  </div>
</div>
  <div class="footer">
    <div class="fmov">
      Built with&nbsp; 
      <svg class="heart" viewBox="0 0 32 29.6">
        <path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,9.5,11.9,16,21.2
    c6.1-9.3,16-12.1,16-21.2C32,3.8,28.2,0,23.6,0z"/>
      </svg> &nbsp;by Tudor
    </div>
  </div>
</body>
</html>
