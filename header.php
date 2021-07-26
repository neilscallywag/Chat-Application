<?php 
session_start();	
include("functions.php");

if(!isset($_SESSION["uid"])){
	?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Chatroom</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
	  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/skeleton.css">
	  <script src="js/jquery-2.1.4.min.js"></script>
      <script src="js/main.js"></script>

      <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
   </head>
   <body>
      <div class="wrap">
         <div class="navigation">
            <div class="wrapper">
               <div class="navbar navbar-left">
                  <ul>
                     <li><a href="index.php" data-target="">Home</a></li>
                     <li><a href="#" data-target="">Credits</a></li>
                     <li><a href="#" data-target="">Forums</a></li>
                     <li><a href="#" data-target="">Rules</a></li>
                  </ul>
               </div>
               <div class="navbar navbar-right">
                  <ul>
                     <li><a class="btn btn-empty" href="register.php">Sign up</a></li>
                     <li><a class="btn btn-full" href="login.php">Log in</a></li>
                  </ul>
               </div>
            </div>
         </div>
		 
		<?php } else { ?>
	<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title><?php echo($_SESSION["uid"]); ?></title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
	  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/skeleton.css">
      <script src="js/jquery-2.1.4.min.js"></script>
      <script src="js/main.js"></script>
      <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
   </head>
   <body>
      <div class="wrap">
         <div class="navigation">
            <div class="wrapper">
               <div class="navbar navbar-center">
                  <ul>
                     <li><a href="index.php" data-target="">Chatroom</a></li>
                     <li><a href="#" data-target="">Credits</a></li>
                     <li><a href="Chatroom.php" data-target="">Message</a></li>
                     <li><a href="logout.php" data-target="">Logout</a></li>
                  </ul>
               </div>
             
            </div>
         </div>
		 
		 <?php } ?>