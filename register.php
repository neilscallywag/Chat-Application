<?php 
include("functions.php");
$return = '<div class="alert-blue"><i class="alert-icon fa fa-exclamation-circle"></i>Enter the following details in order to register</div>';
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
if(isset($_POST['register'])){
    
    if(empty($_POST['username'])){
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter an username</div>';
	}
	elseif(empty($_POST['password'])){
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a password</div>';
	}
	elseif(empty($_POST['email'])){
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter an email</div>';
	}
	else{
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
	
	
  
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	$sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['num'] > 0){
        $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>That username already exists!</div>';
    }
	elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username))
{
        $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Do not use special characters in your username</div>';

	}
    elseif($res['num'] > 0 ){
		  $return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>That email already exists!</div>';
    }
	elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
		$return = '<div class="alert-red"><i class="alert-icon fa fa-exclamation-circle"></i>Please enter a valid email!</div>';
	}
    else {
    $passwordHash = md5(sha1(trim($password)));
    $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
	$stmt->bindValue(':email', $email);
    $result = $stmt->execute();
    if($result){
        $return = '<div class="alert-green"><i class="alert-icon fa fa-exclamation-circle"></i>Resgistered successfully!</div>';
    }

}
}
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
               <h1>Registeration</h1>
               <p>
                  Register an account in order to use the chatroom
               </p>
               <div class="chat">
                
				<?php echo($return); ?>
				<form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
			<label for="email">Email</label>
            <input type="text" id="email" name="email"><br>
            <input type="submit" name="register" value="Register"></button>
        </form>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>