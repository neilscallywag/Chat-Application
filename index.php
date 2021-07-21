<?php 
include("functions.php");

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
                     <li><a href="#" data-target="">Updates</a></li>
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
         <div class="container">
            <div class="section welcome">
               <h1>Chatroom</h1>
               <p>
                  Simple Chat application
               </p>
               <div class="chat">
                  <div data-from="{from}" data-id="{messageId}">
                     <div class="messagecontainer" style="--user-color: #234A65">
                        <span class="meta">
                       
                        <span class="user">Neil</span>
                        <i class="metaBG"></i>
                        </span>
                        <span class="message">Hello world</span>
                     </div>
                  </div>
                  <div data-from="{from}" data-id="{messageId}">
                     <div class="messagecontainer" style="--user-color: #F4A651">
                        <span class="meta">
                        
                        <span class="user">some_user_not</span>
                        <i class="metaBG"></i>
                        </span>
                        <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas porta malesuada ante vitae ultricies. Suspendisse sagittis, quam vitae ultricies ornare, elit nibh fermentum nisi, id feugiat libero turpis a lacus.</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>