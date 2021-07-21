<?php 
session_start();	
include("functions.php");

if(isset($_SESSION["uid"])){
	header("location: chatroom.php");
}
$return = '<div class="alert-blue"><i class="alert-icon fa fa-exclamation-circle"></i>Do Not share your password with anyone</div>';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
if(isset($_POST['login'])){
	
	$u = trim($_POST['username']);
	$p =  md5(sha1(trim($_POST['password'])));
	if(empty($u)){
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter username</div>';
	
	
	}
	elseif(empty($p)){
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a password</div>';
		
		
	}
	else {

		$sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username AND password = :password";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':username', $u);
	$stmt->bindValue(':password', $p);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row['num'] == 1){
       		$sql = "select * from users WHERE username = :username ";
			$stmt = $x->prepare($sql);
    $stmt->bindValue(':username', $u);
    $stmt->execute();
    $sid = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!empty($sid['uid'])){
	         $_SESSION["uid"] = $sid['uid'];
			$return= '<div class="alert-yellow"><i class="alert-icon fa fa-exclamation-circle"></i>Welcome: '.$sid['username'].'!</div>';
				
	}
	else { $return= '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a password</div>';

	}
					
    }
	else {
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Incorrect Username or Password.</div>';
		
		
	}
	}
}
else { $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Is Not set Login</div>';
}
}




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
               <h1>Login</h1>
               
               <div class="chat">
                
				<?php echo($return); ?>
				<form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="login" value="login"></button>
        </form>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>